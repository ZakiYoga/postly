document.addEventListener("DOMContentLoaded", function () {
    const previewContainer = document.getElementById("preview-container");
    const previewImage = document.getElementById("preview-image");
    const fileName = document.getElementById("file-name");

    // Set the preview image to the existing image
    previewImage.src = "{{ Storage::url($post->image) }}";
    previewContainer.classList.remove("hidden");

    // Extract and display the file name from the path
    const path = "{{ $post->image }}";
    const name = path.split("/").pop();
    fileName.textContent = name;
});
