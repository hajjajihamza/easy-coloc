export function initProfile() {
    const image_file = document.getElementById('image-file');
    const image_preview = document.getElementById('image-preview');
    const image_placeholder = document.getElementById('image-placeholder');
    const delete_image_btn = document.getElementById('delete-image-btn');

    image_file.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                image_preview.src = e.target.result;
                image_preview.classList.remove('hidden');
                image_placeholder.classList.add('hidden');
                delete_image_btn.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    delete_image_btn.addEventListener('click', function() {
        image_preview.src = '#';
        image_preview.classList.add('hidden');
        image_placeholder.classList.remove('hidden');
        delete_image_btn.classList.add('hidden');
        image_file.value = '';
    });
}