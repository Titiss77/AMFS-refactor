export function calculateBodyMetrics(gender, height, weight, neck, waist, hip, activityMultiplier, isAthlete = false) {
    const diff = gender === 'male' ? (waist - neck) : (waist + hip - neck);
    if (!height || !weight || !neck || !waist || (gender === 'female' && !hip) || diff <= 0) return null;

    // 1. Estimation LBM (Boer Formula) - Base physiologique pondérale
    let lbmBoer = gender === 'male'
        ? (0.407 * weight) + (0.267 * height) - 19.2
        : (0.252 * weight) + (0.473 * height) - 48.3;

    // Correction Athlétique (Hypertrophie musculaire augmentant la densité de FFM)
    if (isAthlete) {
        lbmBoer *= (gender === 'male' ? 1.08 : 1.05); // +8% pour hommes, +5% pour femmes
    }

    // 2. Estimation LBM (US Navy) - Base morphologique spatiale
    let density = gender === 'male'
         ? 1.0324 - 0.19077 * Math.log10(diff) + 0.15456 * Math.log10(height)
         : 1.29579 - 0.35004 * Math.log10(diff) + 0.22100 * Math.log10(height);

    let bfNavy = Math.max(0, (495 / density) - 450);
    let lbmNavy = weight * (1 - (bfNavy / 100));

    // 3. Modèle Hybride Scientifique
    // Moyenne pondérée lissant les aberrations liées aux variations extrêmes du tour de taille.
    let leanMass = (lbmBoer + lbmNavy) / 2;

    // Bornes physiologiques strictes (impossible d'avoir < 3% de gras pour un homme, 10% pour femme)
    const minFatPercent = gender === 'male' ? 3.0 : 10.0;
    const maxLbm = weight * (1 - (minFatPercent / 100));
    leanMass = Math.min(maxLbm, Math.max(weight * 0.4, leanMass));

    // Déduction finale des métriques (Balance de masse exacte)
    const fatMass = weight - leanMass;
    const bodyFat = (fatMass / weight) * 100;

    // 4. Calculs énergétiques : Katch-McArdle reste l'étalon or
    const bmr = 370 + (21.6 * leanMass);
    const tdee = bmr * activityMultiplier;
    const imc = weight / Math.pow(height / 100, 2);

    return { bf: bodyFat, fatMass, leanMass, bmr, tdee, imc };
}

export function calculateMacros(tdee, weight, trainingType) {
    let proteinMultiplier, fatMultiplier;
    switch(trainingType) {
        case 'force':
            proteinMultiplier = 2.2;
            fatMultiplier = 1.0;
            break;
        case 'endurance':
            proteinMultiplier = 1.6;
            fatMultiplier = 1.0;
            break;
        default: // repos
            proteinMultiplier = 1.8;
            fatMultiplier = 0.9;
    }
    const protein = weight * proteinMultiplier;
    const fat = weight * fatMultiplier;
    const carbs = (tdee - (protein * 4) - (fat * 9)) / 4;
    return {
        protein: Math.round(protein),
        fat: Math.round(fat),
        carbs: Math.max(0, Math.round(carbs))
    };
}
