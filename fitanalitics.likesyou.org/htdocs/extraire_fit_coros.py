import fitdecode
import json
import os
import re

# --- CONFIGURATION ---
SOURCE_DIR = 'fit_uploads'
DEST_DIR = 'json_uploads'
WEIGHT_THRESHOLD = 20  # Seuil pour séparer le Curl Biceps ( < 20) du Triceps ( > 20)
mapping_path = os.path.join(os.path.dirname(__file__), 'exercices_mapping.json')

# Chargement du fichier de traduction
try:
    with open(mapping_path, 'r', encoding='utf-8') as f:
        TRADUCTIONS = json.load(f)
except FileNotFoundError:
    TRADUCTIONS = {}

def extraire_donnees_final(fichier_fit):
    resultats = []
    mapping_updated = False
    
    try:
        with fitdecode.FitReader(fichier_fit) as fit:
            for frame in fit:
                if frame.frame_type == fitdecode.FIT_FRAME_DATA and frame.name == 'set':
                    data = {f.name: f.value for f in frame.fields}
                    
                    if data.get('set_type') == 'active':
                        cat = data.get('category')
                        sub = data.get('category_subtype')
                        cle = f"{cat}_{sub}"
                        
                        # --- LOGIQUE DE SÉPARATION (Biceps vs Triceps) ---
                        if cle == "curl_None":
                            poids = data.get('weight') or 0
                            if poids > WEIGHT_THRESHOLD:
                                cle = "curl_triceps_split"
                            else:
                                cle = "curl_biceps_split"
                        
                        # --- LOGIQUE DE MAPPING (Affiche clé technique si vide) ---
                        if cle in TRADUCTIONS and TRADUCTIONS[cle]:
                            exercice_name = TRADUCTIONS[cle]
                        else:
                            exercice_name = cle  # Utilise la clé technique pour faciliter le mapping
                            # On ajoute la clé vide au mapping si elle est inconnue
                            if cle not in TRADUCTIONS:
                                print(f"  [Info] Nouvel exercice détecté : {cle}. Ajout...")
                                TRADUCTIONS[cle] = "" 
                                mapping_updated = True
                            
                        resultats.append({
                            'timestamp': data.get('timestamp'),
                            'exercice': exercice_name,
                            'repetitions': data.get('repetitions'),
                            'poids': data.get('weight'),
                        })
    except Exception as e:
        print(f"  [Erreur] Impossible de lire {fichier_fit} : {e}")
        
    return resultats, mapping_updated

if __name__ == '__main__':
    if not os.path.exists(DEST_DIR):
        os.makedirs(DEST_DIR)

    fichiers_fit = [f for f in os.listdir(SOURCE_DIR) if f.lower().endswith('.fit')]
    global_update = False
    
    for nom_fichier in fichiers_fit:
        chemin_fit = os.path.join(SOURCE_DIR, nom_fichier)
        
        # --- EXTRACTION DE LA DATE ---
        match = re.search(r'\d{8}', nom_fichier)
        date_str = match.group(0) if match else "date_inconnue"
        
        chemin_json = os.path.join(DEST_DIR, f"{date_str}.json")
        
        print(f"Analyse : {nom_fichier} -> {os.path.basename(chemin_json)}")
        donnees, updated = extraire_donnees_final(chemin_fit)
        
        if updated:
            global_update = True
            
        if donnees:
            # Conversion date pour JSON
            for serie in donnees:
                if 'timestamp' in serie and serie['timestamp']:
                    serie['timestamp'] = serie['timestamp'].isoformat()
            
            # --- FUSION INTELLIGENTE (via timestamp) ---
            final_data = donnees
            if os.path.exists(chemin_json):
                with open(chemin_json, 'r', encoding='utf-8') as f:
                    try:
                        existing_data = json.load(f)
                        # On ne garde que les nouvelles séries dont le timestamp est inconnu
                        existing_timestamps = {s.get('timestamp') for s in existing_data if 'timestamp' in s}
                        new_data = [s for s in donnees if s.get('timestamp') not in existing_timestamps]
                        
                        if new_data:
                            final_data = existing_data + new_data
                            print(f"  [Info] Ajout de {len(new_data)} nouvelle(s) série(s).")
                        else:
                            final_data = existing_data
                            print(f"  [Info] Aucune nouvelle donnée (déjà à jour).")
                    except json.JSONDecodeError:
                        print("  [Attention] Fichier existant corrompu, réécriture.")
            
            with open(chemin_json, 'w', encoding='utf-8') as f:
                json.dump(final_data, f, ensure_ascii=False, indent=4)
        else:
            print(f"  -> [Avertissement] Aucune donnée trouvée.")
    
    # Mise à jour du mapping si nécessaire
    if global_update:
        with open(mapping_path, 'w', encoding='utf-8') as f:
            json.dump(TRADUCTIONS, f, ensure_ascii=False, indent=4)
        print("\n--- Exercices_mapping.json mis à jour avec les nouvelles clés ---")