const $fileURI = document.querySelector('script[src*="file.js"]');
const $body = document.getElementsByTagName('body');

// const src = $fileURI.getAttribute('src');
const now = new Date();
$fileURI.src = $fileURI.src + '?' + now.getTime();
console.log('$fileURI');

let script = document.createElement('script');
script.src = 'http://get-popup/js/file2.js?' + now.getTime();
document.body.appendChild(script);

