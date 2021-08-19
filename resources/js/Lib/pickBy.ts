export default function pickBy(object: Object, predicate: any = (v: any) => v) {
    // @ts-ignore
    return Object.assign(...Object.entries(object)
        .filter(([, v]) => predicate(v))
        .map(([k, v]) => ({[k]: v})));
}