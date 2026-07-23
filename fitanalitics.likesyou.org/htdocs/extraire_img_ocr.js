const fs = require('fs');
const path = require('path');
const Tesseract = require('tesseract.js');

// --- CONFIGURATION ---
const SOURCE_DIR = 'img_uploads';
const DEST_DIR = 'json_uploads';

if (!fs.existsSync(DEST_DIR)) fs.mkdirSync(DEST_DIR);
if (!fs.existsSync(SOURCE_DIR)) fs.mkdirSync(SOURCE_DIR);

/**
 * Cherche une date française dans le texte (ex: "23 juil. 2026" ou "21 juillet 2026")
 * Retourne les formats YYYYMMDD et YYYY-MM-DD
 */
function extraireDateOCR(text) {
    const dateRegex = /(\d{1,2})\s+([a-zA-Zàâäéèêëîïôöùûüç]+)\.?\s+(\d{4})/i;
    const match = text.match(dateRegex);
    
    if (!match) return null;

    const day = match[1].padStart(2, '0');
    const monthStr = match[2].toLowerCase();
    const year = match[3];

    // Mapping des mois français vers leur numéro
    const mois = {
        'janv': '01', 'fevr': '02', 'févr': '02', 'mars': '03',
        'avr': '04', 'mai': '05', 'juin': '06', 'juil': '07',
        'aout': '08', 'août': '08', 'sept': '09', 'oct': '10',
        'nov': '11', 'dec': '12', 'déc': '12'
    };

    let monthNum = '01'; // Fallback par défaut
    for (const key in mois) {
        if (monthStr.startsWith(key)) {
            monthNum = mois[key];
            break;
        }
    }

    return {
        dateStr: `${year}${monthNum}${day}`,
        dateFormatee: `${year}-${monthNum}-${day}`
    };
}

/**
 * Analyse le texte brut d'une capture d'écran de l'application Coros.
 */
function parseOCRText(text, dateSeance) {
    const lines = text.split('\n');
    const resultats = [];

    let currentExercise = "Exercice Inconnu";
    let expectedIndex = 1;      
    let appendingToName = false; 

    lines.forEach(line => {
        const cleanLine = line.trim();
        if (!cleanLine) return;

        // 1. Détecter le début d'un exercice (ex: "1 Exercice d'haltères en")
        const regexExo = new RegExp(`^${expectedIndex}\\s+([a-zA-ZÀ-ÿ].+)`);
        const matchExo = cleanLine.match(regexExo);

        if (matchExo) {
            let name = matchExo[1].replace(/\d+\s*séries?/i, ''); 
            name = name.replace(/[^a-zA-ZÀ-ÿ\s'-]/g, ''); 
            currentExercise = name.replace(/\s+/g, ' ').trim();
            expectedIndex++;
            appendingToName = true;
            return;
        }

        // 2. Détecter une série (Beaucoup plus souple, gère le poids de corps)
        if (cleanLine.toLowerCase().startsWith('définir')) {
            appendingToName = false;
            
            // On récupère tout le texte situé après "Définir [Numéro]"
            const parts = cleanLine.match(/^Définir\s+\d+\s+(.*)$/i);
            
            if (parts) {
                const restOfLine = parts[1].trim();
                let reps = 0;
                let poids = 0;
                
                // Extraction des reps : on prend le premier chiffre avant un éventuel slash
                const repsMatch = restOfLine.match(/(\d+)\s*\//);
                if (repsMatch) {
                    reps = parseInt(repsMatch[1], 10);
                }
                
                // Extraction du poids : on cherche un nombre décimal (avec ou sans "kg")
                const weightMatch = restOfLine.match(/([\d]+[.,][\d]+)/);
                if (weightMatch) {
                    poids = parseFloat(weightMatch[1].replace(',', '.'));
                }
                
                // On enregistre la série
                resultats.push({
                    timestamp: `${dateSeance}T12:00:00`,
                    exercice: currentExercise,
                    repetitions: reps,
                    poids: poids
                });
            }
            return;
        }

        // 3. Reconstruire les noms coupés sur deux lignes
        if (appendingToName) {
            if (!cleanLine.match(/\d/) && !cleanLine.toLowerCase().includes('séries')) {
                let extra = cleanLine.replace(/[^a-zA-ZÀ-ÿ\s'-]/g, '').trim();
                if (extra.length > 2) {
                    currentExercise += " " + extra;
                }
            }
        }
    });

    return resultats;
}

async function processImages() {
    const files = fs.readdirSync(SOURCE_DIR).filter(file => file.match(/\.(png|jpe?g)$/i));

    if (files.length === 0) {
        console.log("Aucune image trouvée dans le dossier img_uploads.");
        return;
    }

    // --- NOUVEAUTÉ : On garde en mémoire les fichiers touchés pendant CETTE exécution ---
    const fichiersTraitesCeRun = new Set();

    for (const file of files) {
        const imagePath = path.join(SOURCE_DIR, file);

        console.log(`\n========================================`);
        console.log(`Analyse OCR en cours : ${file}`);
        console.log(`========================================`);

        try {
            const { data: { text } } = await Tesseract.recognize(
                imagePath,
                'fra',
                { logger: m => process.stdout.write(`\r  [OCR] ${m.status}: ${Math.round(m.progress * 100)}%`) }
            );

            // Gestion de la date
            let dateStr = new Date().toISOString().slice(0, 10).replace(/-/g, '');
            let dateFormatee = `${dateStr.slice(0, 4)}-${dateStr.slice(4, 6)}-${dateStr.slice(6, 8)}`;

            const parsedDate = extraireDateOCR(text);
            if (parsedDate) {
                dateStr = parsedDate.dateStr;
                dateFormatee = parsedDate.dateFormatee;
                console.log(`\n  [Date] Trouvée dans l'image : ${dateFormatee}`);
            } else {
                // Cherche 8 chiffres (20260713) OU 6 chiffres (260713)
                const dateMatchFile = file.match(/\d{8}|\d{6}/);
                if (dateMatchFile) {
                    let matchedDate = dateMatchFile[0];
                    // Si le format est court (6 chiffres), on ajoute "20" devant
                    if (matchedDate.length === 6) {
                        matchedDate = "20" + matchedDate; 
                    }
                    dateStr = matchedDate;
                    dateFormatee = `${dateStr.slice(0, 4)}-${dateStr.slice(4, 6)}-${dateStr.slice(6, 8)}`;
                }
                console.log(`\n  [Date] Introuvable dans l'image. Utilisation du nom de fichier : ${dateFormatee}`);
            }

            const jsonPath = path.join(DEST_DIR, `${dateStr}.json`);
            
            // Parsing
            const donnees = parseOCRText(text, dateFormatee);

            if (donnees.length > 0) {
                let finalData = donnees;
                
                // Si on a DÉJÀ créé/écrasé ce fichier pendant CETTE exécution, on fusionne
                if (fichiersTraitesCeRun.has(jsonPath)) {
                    try {
                        const existingData = JSON.parse(fs.readFileSync(jsonPath, 'utf-8'));
                        finalData = existingData.concat(donnees); 
                        console.log(`  [Info] Ajout de ${donnees.length} séries à la suite (Total: ${finalData.length} séries).`);
                    } catch (e) {
                        console.log("  [Attention] Fichier existant corrompu. Écrasement.");
                    }
                } else {
                    // Première fois qu'on traite cette date dans ce lancement, on remet à zéro (écrase)
                    console.log(`  [Info] Création/Écrasement du fichier JSON avec ${donnees.length} séries.`);
                    fichiersTraitesCeRun.add(jsonPath); // On note qu'on l'a touché
                }

                fs.writeFileSync(jsonPath, JSON.stringify(finalData, null, 4), 'utf-8');
                console.log(`  -> Sauvegarde réussie : ${jsonPath}`);
            } else {
                console.log(`  -> Avertissement: Aucune série détectée dans l'image.`);
            }
        } catch (error) {
            console.error(`\n  [Erreur] Impossible d'analyser l'image :`, error);
        }
    }
}

// Lancement
processImages();