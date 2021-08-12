export const useDefaultPhoto = (name: string = '') => {
    return `https://ui-avatars.com/api/?name=${encodeURI(name.split(' ').slice(0, 2).join(' '))}&color=6dbda1&background=bcf0da`;
}

export const classNames = (...classes: string[]) => {
    return classes.filter(Boolean).join(' ')
}