import json 
import os 
import pandas as pd 
from collections import defaultdict 

JSON_DIR = 'json_uploads' 
OUTPUT_FILE = 'historique_complet.json' 
MAPPING_FILE = 'exercices_mapping.json'

def generer_historique():     
    all_data = []          
    mapping_updated = False
    
    # --- 1. Chargement du fichier de mapping ---
    try:
        with open(MAPPING_FILE, 'r', encoding='utf-8') as f:
            mapping = json.load(f)
    except FileNotFoundError:
        mapping = {}
        
    # --- 2. Lire tous les JSON ---
    fichiers_json = [f for f in os.listdir(JSON_DIR) if f.endswith('.json')]     
    for nom_fichier in fichiers_json:         
        date_seance = nom_fichier.replace('.json', '')         
        with open(os.path.join(JSON_DIR, nom_fichier), 'r', encoding='utf-8') as f:             
            try:
                donnees = json.load(f)             
                for serie in donnees:
                    nom_brut = serie['exercice']
                    
                    # Logique de traduction
                    if nom_brut in mapping and mapping[nom_brut]:
                        # Si une traduction existe et n'est pas vide, on l'utilise
                        serie['exercice'] = mapping[nom_brut]
                    else:
                        # Si le nom est inconnu, on l'ajoute au dictionnaire
                        if nom_brut not in mapping:
                            mapping[nom_brut] = ""
                            mapping_updated = True
                        serie['exercice'] = nom_brut # On garde le nom brut par défaut
                        
                    serie['date'] = date_seance                 
                    all_data.append(serie)     
            except json.JSONDecodeError:
                print(f"Erreur de lecture du fichier {nom_fichier}")
                
    # --- 3. Sauvegarde du nouveau dictionnaire si nécessaire ---
    if mapping_updated:
        with open(MAPPING_FILE, 'w', encoding='utf-8') as f:
            json.dump(mapping, f, ensure_ascii=False, indent=4)
        print(f"--- Fichier {MAPPING_FILE} mis à jour avec de nouveaux exercices ! ---")
                
    if not all_data: 
        print("Aucune donnée à traiter.")
        return     
    
    # --- 4. Agrégation avec Pandas ---     
    df = pd.DataFrame(all_data)          
    df['poids'] = df['poids'].fillna(0)
    df['repetitions'] = df['repetitions'].fillna(0)     
    
    historique_final = defaultdict(list)

    # On groupe par exercice et par date     
    for (exercice, date), group in df.groupby(['exercice', 'date']):
        series_details = []
        volume_total = 0
        total_reps = 0

        # On boucle sur chaque série du groupe pour sauvegarder TOUTES les infos
        for _, row in group.iterrows():
            reps = int(row['repetitions'])
            poids = float(row['poids'])
            
            series_details.append({
                "reps": reps,
                "poids": poids
            })
            
            total_reps += reps
            volume_total += (reps * poids)

        poids_moyen = group['poids'].mean()

        historique_final[exercice].append({
            "date": date,
            "series": len(series_details),
            "total_reps": total_reps,
            "poids": round(poids_moyen, 1),
            "volume": int(volume_total),
            "details": series_details
        })
        
    # --- 5. Écriture du fichier final ---     
    with open(OUTPUT_FILE, 'w', encoding='utf-8') as f:         
        json.dump(historique_final, f, ensure_ascii=False, indent=4)     
    print(f"Historique généré avec succès dans {OUTPUT_FILE}") 

if __name__ == '__main__':     
    generer_historique()