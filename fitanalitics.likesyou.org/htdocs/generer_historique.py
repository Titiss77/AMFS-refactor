import json
import os
import pandas as pd
from collections import defaultdict

JSON_DIR = 'json_uploads'
OUTPUT_FILE = 'historique_complet.json'

def generer_historique():
    all_data = []
    
    # 1. Lire tous les JSON
    fichiers_json = [f for f in os.listdir(JSON_DIR) if f.endswith('.json')]
    for nom_fichier in fichiers_json:
        date_seance = nom_fichier.replace('.json', '')
        with open(os.path.join(JSON_DIR, nom_fichier), 'r', encoding='utf-8') as f:
            donnees = json.load(f)
            for serie in donnees:
                serie['date'] = date_seance
                all_data.append(serie)

    if not all_data: return

    # 2. Agrégation avec Pandas
    df = pd.DataFrame(all_data)
    
    # --- AJOUTER CETTE LIGNE POUR CORRIGER LE NaN ---
    df = df.fillna(0) 
    # ------------------------------------------------
    
    # Calcul des stats par Exercice et par Date
    summary = df.groupby(['exercice', 'date']).agg({
        'repetitions': ['count', 'sum'],
        'poids': 'mean' 
    }).reset_index()
    
    summary.columns = ['exercice', 'date', 'series', 'total_reps', 'poids_moyen']
    
    # On recalcule le volume en s'assurant qu'il n'y a pas de NaN
    summary['volume_total'] = summary['total_reps'] * summary['poids_moyen']
    summary['volume_total'] = summary['volume_total'].fillna(0) # Sécurité supplémentaire

    # 3. Structure en JSON groupé par exercice
    historique_final = defaultdict(list)
    for _, row in summary.iterrows():
        # Utilisation de int() sans risque car on a fait le fillna(0) plus haut
        historique_final[row['exercice']].append({
            "date": row['date'],
            "series": int(row['series']),
            "total_reps": int(row['total_reps']),
            "poids": round(row['poids_moyen'], 1),
            "volume": int(row['volume_total'])
        })

    with open(OUTPUT_FILE, 'w', encoding='utf-8') as f:
        json.dump(historique_final, f, ensure_ascii=False, indent=4)
    print(f"Historique généré avec succès dans {OUTPUT_FILE}")

if __name__ == '__main__':
    generer_historique()