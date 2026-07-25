import { calculateBodyMetrics, calculateMacros } from './calc_module.js';

const thresholds = {
    male:   { bas: 2, ess: 5, ath: 13.7, fit: 17, moy: 25, max: 45 },
    female: { bas: 10, ess: 13, ath: 20, fit: 24, moy: 31, max: 45 }
};

document.addEventListener('DOMContentLoaded', () => {
    const genderSelect = document.getElementById('gender');
    const hipGroup = document.getElementById('hip-group');

    // Gestion de l'affichage du champ "hanches"
    genderSelect.addEventListener('change', (e) => {
        hipGroup.classList.toggle('hidden', e.target.value !== 'female');
        updateUI();
    });

    // Gestion des Steppers (+ / -)
    document.querySelectorAll('.stepper button').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const input = e.target.parentElement.querySelector('input');
            const step = parseFloat(input.getAttribute('step')) || 1;
            let val = parseFloat(input.value.replace(',', '.')) || 0;
            
            if (e.target.classList.contains('minus')) val -= step;
            if (e.target.classList.contains('plus')) val += step;
            
            // Évite les valeurs négatives
            if (val < 0) val = 0;
            
            input.value = val.toFixed(input.step.includes('.') ? 1 : 0);
            updateUI();
        });
    });

    const inputs = document.querySelectorAll('input, select');
    inputs.forEach(input => input.addEventListener('input', updateUI));
    document.getElementById('training-type').addEventListener('change', updateUI);

    // Sauvegarde AJAX silencieuse
    const form = document.getElementById('metric-form');
    if (form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const submitBtn = form.querySelector('.btn-save');
            submitBtn.textContent = 'Enregistrement...';
            
            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const data = await response.json();
                
                if (data.success) {
                    window.location.reload(); // Recharge pour afficher le nouveau point sur le graphe
                } else {
                    alert('Erreur: ' + data.message);
                }
            } catch (err) {
                alert('Erreur réseau lors de la sauvegarde.');
            } finally {
                submitBtn.textContent = 'Enregistrer le relevé officiel';
            }
        });
    }

    updateUI();
});

function getCategory(bf, gender) {
    const t = thresholds[gender];
    if (bf < t.bas) return "Bas";
    if (bf < t.ess) return "Essentielle";
    if (bf < t.ath) return "Athlètes";
    if (bf < t.fit) return "Fitness";
    if (bf < t.moy) return "Moyen";
    return "Obèse";
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

function updateUI() {
    const gender = document.getElementById('gender').value;
    const weight = parseFloat(document.getElementById('weight').value.replace(',', '.'));
    const height = parseFloat(document.getElementById('height').value.replace(',', '.'));
    const neck = parseFloat(document.getElementById('neck').value.replace(',', '.'));
    const waist = parseFloat(document.getElementById('waist').value.replace(',', '.'));
    const hip = document.getElementById('hip') ? parseFloat(document.getElementById('hip').value.replace(',', '.')) : 0;
    const activity = parseFloat(document.getElementById('activity').value);
    const trainingType = document.getElementById('training-type').value;

    const metrics = calculateBodyMetrics(gender, height, weight, neck, waist, hip, activity);
    
    if (metrics) {
        updateZones(gender);
        const { bf, fatMass, leanMass, bmr, tdee, imc } = metrics;
        
        // Mise à jour de la graisse corporelle
        document.getElementById('indicator-value').textContent = `${bf.toFixed(1)}%`;
        document.getElementById('summary-bf').textContent = `${bf.toFixed(1)}%`;
        document.getElementById('summary-cat').textContent = getCategory(bf, gender);
        document.getElementById('indicator').style.left = `${Math.min((bf / 45) * 100, 100)}%`;
        
        // Mise à jour des masses
        document.getElementById('detail-fat').textContent = `${fatMass.toFixed(1)} kg`;
        document.getElementById('detail-lean').textContent = `${leanMass.toFixed(1)} kg`;
        
        // Mise à jour de l'énergie
        document.getElementById('energy-bmr').textContent = `${Math.round(bmr)} kcal`;
        document.getElementById('energy-tdee').textContent = `${Math.round(tdee)} kcal`;
        
        // Mise à jour de l'IMC
        const imcIndicatorValue = document.getElementById('imc-indicator-value');
        if (imcIndicatorValue) {
            imcIndicatorValue.textContent = imc.toFixed(1);
            document.getElementById('imc-indicator').style.left = `${Math.min((imc / 40) * 100, 100)}%`;
        }

        // Mise à jour des Macros
        const macros = calculateMacros(tdee, weight, trainingType);
        document.getElementById('macro-protein').textContent = `${macros.protein}g`;
        document.getElementById('macro-carbs').textContent = `${macros.carbs}g`;
        document.getElementById('macro-fat').textContent = `${macros.fat}g`;
    }
}