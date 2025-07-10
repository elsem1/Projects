/**
 * Vergelijkt twee waarden (number/string).
 * Null/undefined worden altijd onderaan gezet in ascending sort,
 * en bovenaan in descending sort.
 * Locale-aware string sortering via localeCompare.
 */
export const compare = (
    a: number | string | null | undefined,
    b: number | string | null | undefined,
    reverse = false
): -1 | 0 | 1 => {
    if (a == null && b == null) return 0; // beide null -> gelijk
    if (a == null) return reverse ? -1 : 1; // a = null -> onderaan of bovenaan bij reverse
    if (b == null) return reverse ? 1 : -1; // b = null -> onderaan of bovenaan bij reverse
    
    const result = typeof a === 'string' && typeof b === 'string'
        ? a.localeCompare(b) // string sortering, rekening houdend met locale
        : typeof a === 'number' && typeof b === 'number'
        ? a - b              // numerieke sortering
        : 0;                 // fallback: beschouw ze als gelijk
        
    return reverse ? (-result as -1 | 0 | 1) : (result as -1 | 0 | 1);
};

/**
 * Sorteert een array van objecten op een veldnaam of custom key-functie.
 * Null/undefined veilig en ondersteunt ascending/descending.
 * Schwartzian Transform: optimaliseert sorteren door vooraf sorteerwaarden te berekenen.
 *
 * @param array - Array van items om te sorteren
 * @param key - Veldnaam of functie die een sorteerwaarde teruggeeft
 * @param reverse - Sorteer aflopend (true) of oplopend (false, default)
 * @returns Gesorteerde kopie van de array
 */
export const sortBy = <Item>(
    array: Item[],
    key: keyof Item | ((item: Item) => number | string | null | undefined),
    reverse = false
): Item[] => {
    const getValue = typeof key === 'function'
        ? key  // als key een functie is, gebruik deze direct
        : (item: Item) => item[key] as number | string | null | undefined; // anders: pak veld uit object
    
    return array
        .map(item => [getValue(item), item] as const) // Schwartzian: decorate
        .sort(([a], [b]) => compare(a, b, reverse))  // sorteert op de extracted waarden van compare()
        .map(([, item]) => item);                    // Schwartzian: undecorate
};
