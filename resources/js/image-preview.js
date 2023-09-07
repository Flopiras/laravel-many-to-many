const placeholder = "https://marcolanci.it/utils/placeholder.jpg";
const thumbInput = document.getElementById('image');
const imagePreview = document.getElementById('image-preview');

let blobUrl = null;

thumbInput.addEventListener('change', () => {
    if(thumbInput.files && thumbInput.files[0]) {
        const file = thumbInput.files[0];

        blobUrl = URL.createObjectURL(file);

        imagePreview.src = blobUrl;
    } else {
        imagePreview.src = placeholder;
    }
})