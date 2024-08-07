<div>
    <textarea id="{{ $id }}" name="{{ $name }}">{{ $slot }}</textarea>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        ClassicEditor
            .create(document.querySelector('#{{ $id }}'))
            .catch(error => {
                console.error(error);
            });
    });
</script>