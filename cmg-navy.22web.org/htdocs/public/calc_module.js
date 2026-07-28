export function calculateBodyMetrics(gender, height, weight, neck, waist, hip, activityMultiplier, isAthlete = false) {
    const diff = gender === 'male' ? (waist - neck) : (waist + hip - neck);
    if (!height || !weight || !neck || !waist || (gender === 'female' && !hip) || diff <= 0) return null;

    let density = gender === 'male' 
        ? 1.0324 - 0.19077 * Math.log10(waist - neck) + 0.15456 * Math.log10(height)
        : 1.29579 - 0.35004 * Math.log10(waist + hip - neck) + 0.22100 * Math.log10(height);

    let bodyFat = Math.max(0, (495 / density) - 450);

    // CORRECTION ATHLÈTE
    if (isAthlete) {
        // On compense le tour de taille musculaire en réduisant de 1.5% la MG
        const minFat = gender === 'male' ? 4.0 : 12.0; 
        bodyFat = Math.max(minFat, bodyFat - 1.5);
    }

    const fatMass = weight * (bodyFat / 100);
    const leanMass = weight - fatMass;
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