const inputs = document.querySelectorAll('input, select');
const genderSelect = document.getElementById('gender');
const hipGroup = document.getElementById('hip-group');

// Éléments du graphique (Pourcentage de graisse)
const indicator = document.getElementById('indicator');
const indicatorValue = document.getElementById('indicator-value');
const summaryBf = document.getElementById('summary-bf');
const summaryCat = document.getElementById('summary-cat');

// Éléments du graphique (IMC)
const imcIndicator = document.getElementById('imc-indicator');
const imcIndicatorValue = document.getElementById('imc-indicator-value');

// Masses
const detailFat = document.getElementById('detail-fat');
const detailLean = document.getElementById('detail-lean');

// Énergie
const energyBmr = document.getElementById('energy-bmr');
const energyTdee = document.getElementById('energy-tdee');

// Configuration des catégories (% limite pour chaque zone)
const thresholds = {
    male:   { bas: 2, ess: 5, ath: 13.7, fit: 17, moy: 25, max: 45 },
    female: { bas: 10, ess: 13, ath: 20, fit: 24, moy: 31, max: 45 }
};

inputs.forEach(input => input.addEventListener('input', updateWidget));

genderSelect.addEventListener('change', (e) => {
    hipGroup.classList.toggle('hidden', e.target.value !== 'female');
    updateWidget();
});

function calculateBodyMetrics() {
    const gender = genderSelect.value;
    
    // Remplacement de la virgule par un point pour le calcul JS
    const height = parseFloat(document.getElementById('height').value.replace(',', '.'));
    const weight = parseFloat(document.getElementById('weight').value.replace(',', '.'));
    const neck = parseFloat(document.getElementById('neck').value.replace(',', '.'));
    const waist = parseFloat(document.getElementById('waist').value.replace(',', '.'));
    const hip = parseFloat(document.getElementById('hip').value.replace(',', '.'));
    const activityMultiplier = parseFloat(document.getElementById('activity').value);

    const diff = gender === 'male' ? (waist - neck) : (waist + hip - neck);
    if (!height || !weight || !neck || !waist || (gender === 'female' && !hip) || diff <= 0) {
        return null; 
    }

    let density, bodyFat;
    if (gender === 'male') {
        density = 1.0324 - 0.19077 * Math.log10(waist - neck) + 0.15456 * Math.log10(height);
    } else {
        density = 1.29579 - 0.35004 * Math.log10(waist + hip - neck) + 0.22100 * Math.log10(height);
    }
    
    bodyFat = (495 / density) - 450;
    bodyFat = Math.max(0, bodyFat);
    
    // Calcul des masses absolues
    const fatMass = weight * (bodyFat / 100);
    const leanMass = weight - fatMass; // Masse maigre (inclut les os)

    // Formule de Katch-McArdle pour le BMR (Métabolisme de base)
    const bmr = 370 + (21.6 * leanMass);
    
    // TDEE (Total Daily Energy Expenditure)
    const tdee = bmr * activityMultiplier;

    // Calcul de l'IMC (Poids en kg / (Taille en m)²)
    const heightM = height / 100;
    const imc = weight / (heightM * heightM);

    return { 
        bf: bodyFat, 
        gender,
        fatMass,
        leanMass,
        bmr,
        tdee,
        imc
    };
}

function updateZones(gender) {
    const t = thresholds[gender];
    const max = 45; 

    document.getElementById('zone-bas').style.width = (t.bas / max * 100) + '%';
    document.getElementById('zone-ess').style.width = ((t.ess - t.bas) / max * 100) + '%';
    document.getElementById('zone-ath').style.width = ((t.ath - t.ess) / max * 100) + '%';
    document.getElementById('zone-fit').style.width = ((t.fit - t.ath) / max * 100) + '%';
    document.getElementById('zone-moy').style.width = ((t.moy - t.fit) / max * 100) + '%';
    document.getElementById('zone-obe').style.width = ((max - t.moy) / max * 100) + '%';
}

function getCategory(bf, gender) {
    const t = thresholds[gender];
    if (bf < t.bas) return "Bas";
    if (bf < t.ess) return "Essentielle";
    if (bf < t.ath) return "Athlètes";
    if (bf < t.fit) return "Fitness";
    if (bf < t.moy) return "Moyen";
    return "Obèse";
}

function updateWidget() {
    const result = calculateBodyMetrics();
    
    if (!result) {
        indicatorValue.textContent = "--%";
        summaryBf.textContent = "--%";
        summaryCat.textContent = "--";
        detailFat.textContent = "-- kg";
        detailLean.textContent = "-- kg";
        energyBmr.textContent = "-- kcal";
        energyTdee.textContent = "-- kcal";
        indicator.style.left = "0%";
        
        if (imcIndicatorValue) {
            imcIndicatorValue.textContent = "--";
            imcIndicator.style.left = "0%";
        }
        return;
    }

    const { bf, gender, fatMass, leanMass, bmr, tdee, imc } = result;
    const formattedBf = bf.toFixed(1);
    const category = getCategory(bf, gender);

    updateZones(gender);

    // Mises à jour textuelles (Graisse)
    indicatorValue.textContent = `${formattedBf}%`;
    summaryBf.textContent = `${formattedBf}%`;
    summaryCat.textContent = category;
    
    detailFat.textContent = `${fatMass.toFixed(1)} kg`;
    detailLean.textContent = `${leanMass.toFixed(1)} kg`;

    // Énergie (Arrondi à l'entier le plus proche)
    energyBmr.textContent = `${Math.round(bmr)} kcal`;
    energyTdee.textContent = `${Math.round(tdee)} kcal`;

    // Animation du curseur (Graisse)
    const positionPercent = Math.min((bf / 45) * 100, 100);
    indicator.style.left = `${positionPercent}%`;

    // Mise à jour de l'IMC et animation de son curseur (Échelle étalonnée de 0 à 40 max)
    if (imcIndicator && imcIndicatorValue) {
        const formattedImc = imc.toFixed(1);
        imcIndicatorValue.textContent = formattedImc;
        const maxImc = 40;
        const imcPositionPercent = Math.min((imc / maxImc) * 100, 100);
        imcIndicator.style.left = `${imcPositionPercent}%`;
    }
}

// Initialisation
updateWidget();