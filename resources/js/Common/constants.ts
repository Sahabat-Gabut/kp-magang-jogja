// @ts-ignore
export const csrfToken = document.querySelector<HTMLMetaElement>('meta[name="csrf-token"]').getAttribute('content');
export const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Magang Jogja';