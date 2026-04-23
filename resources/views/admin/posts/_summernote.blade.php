<script>
    (function () {
        $('#post-content-editor').summernote({
            height: 380,
            lang: 'id-ID',
            placeholder: 'Tulis konten artikel di sini...',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video', 'hr']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });

        const fileInput = document.getElementById('thumbnail_file');
        const preview = document.getElementById('thumbnail-preview');

        if (fileInput && preview) {
            fileInput.addEventListener('change', function (event) {
                const [file] = event.target.files || [];
                if (!file) {
                    return;
                }

                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target?.result || preview.src;
                };
                reader.readAsDataURL(file);
            });
        }
    })();
</script>
