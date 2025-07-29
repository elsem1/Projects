/**
 * Vergelijkt twee waarden (number/string/array).
 * Null/undefined worden altijd onderaan gezet in ascending sort,
 * en bovenaan in descending sort.
 * Locale-aware string sortering via localeCompare.
 *
 * Ondersteunt ook arrays: vergelijkt element voor element (lexicografisch).
 * Binnen arrays worden strings en getallen correct gesorteerd (met { numeric: true }).
 *
 * @param a - Eerste waarde om te vergelijken (kan array zijn)
 * @param b - Tweede waarde om te vergelijken (kan array zijn)
 * @param reverse - Als true: keer het resultaat om (voor aflopende volgorde)
 * @returns -1 (a < b), 0 (gelijk), 1 (a > b)
 */
export const compare = (
    a: number | string | (number | string)[] | null | undefined,
    b: number | string | (number | string)[] | null | undefined,
    reverse = false
): -1 | 0 | 1 => {
    // Null/undefined: altijd onderaan (of bovenaan bij reverse)
    if (a == null && b == null) return 0; // beide null → gelijk
    if (a == null) return reverse ? -1 : 1; // a is null → zet onderaan (of bovenaan bij reverse)
    if (b == null) return reverse ? 1 : -1; // b is null → zet onderaan (of bovenaan bij reverse)

    // Arrays: vergelijk element voor element
    const aIsArray = Array.isArray(a);
    const bIsArray = Array.isArray(b);

    if (aIsArray && bIsArray) {
        // Loop over de gemeenschappelijke lengte
        for (let i = 0; i < Math.min(a.length, b.length); i++) {
            const comp = compare(a[i], b[i]); // recursief vergelijken
            if (comp !== 0) {
                // Als er een verschil is, retourneer direct (eventueel omgedraaid bij reverse)
                return reverse ? (comp === 1 ? -1 : comp === -1 ? 1 : 0) : comp;
            }
        }

        // Alle elementen zijn gelijk tot hier: kortere array is kleiner
        if (a.length < b.length) return reverse ? 1 : -1;
        if (a.length > b.length) return reverse ? -1 : 1;
        return 0;
    }

    // Als één waarde een array is en de ander niet → verschillende types
    // Veilige keuze: beschouw als gelijk (voorkomt onverwachte volgorde)
    // Alternatief: je zou kunnen kiezen dat arrays altijd voor of na strings komen
    if (aIsArray || bIsArray) {
        return 0;
    }

    // Nu weten we: a en b zijn geen array, geen null/undefined → vergelijk als string of number
    let result: number;

    if (typeof a === 'string' && typeof b === 'string') {
        // Locale-aware sortering, met numerieke herkenning (bv. "10" > "2")
        result = a.localeCompare(b, undefined, { numeric: true, sensitivity: 'base' });
    } else if (typeof a === 'number' && typeof b === 'number') {
        // Numerieke sortering (geen string-conversie nodig)
        result = a - b;
    } else {
        // Fallback: verschillende types (bijv. string vs number)
        // Veilige keuze: beschouw als gelijk
        return 0;
    }

    // Zorg dat het resultaat altijd -1, 0 of 1 is
    const normalized = Math.sign(result) as -1 | 0 | 1;

    // Draai om bij reverse
    return reverse ? (normalized === 0 ? 0 : normalized === 1 ? -1 : 1) : normalized;
};

/**
 * Sorteert een array van objecten op een veldnaam of custom key-functie.
 * Null/undefined veilig en ondersteunt ascending/descending.
 * Ondersteunt ook geneste arrays als sorteerwaarde.
 *
 * Gebruikt de Schwartzian Transform: optimaliseert sorteren door vooraf sorteerwaarden te berekenen.
 * → Elke waarde wordt maar één keer geëxtraheerd, goed voor performance bij complexe key-functies.
 *
 * @param array - Array van items om te sorteren
 * @param key - Veldnaam (bijv. 'name') of functie die een sorteerwaarde teruggeeft (bijv. item => item.user.name)
 * @param reverse - Sorteer aflopend (true) of oplopend (false, default)
 * @returns Gesorteerde kopie van de array
 *
 * @example
 * sortBy(users, 'age'); // oplopend op leeftijd
 * sortBy(users, 'name', true); // aflopend op naam
 * sortBy(users, user => user.tags, false); // oplopend op tag-array
 */
export const sortBy = <Item>(
    array: Item[],
    key: keyof Item | ((item: Item) => number | string | (number | string)[] | null | undefined),
    reverse = false
): Item[] => {
    const getValue = typeof key === 'function'
        ? key // gebruik de functie direct
        : (item: Item) => item[key] as number | string | (number | string)[] | null | undefined; // haal veld uit object

    // Schwartzian Transform: decorate → sort → undecorate
    return array
        .map(item => [getValue(item), item] as const) // [sortValue, originalItem]
        .sort(([a], [b]) => compare(a, b, reverse))  // gebruik compare
        .map(([, item]) => item);                    // haal originele item er weer uit
};