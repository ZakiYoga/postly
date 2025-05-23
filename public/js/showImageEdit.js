document.addEventListener("DOMContentLoaded", function () {
    const previewContainer = document.getElementById("preview-container");
    const previewImage = document.getElementById("preview-image");
    const fileName = document.getElementById("file-name");

    if (previewImage.src) {
        previewContainer.classList.remove("hidden");
        fileName.textContent = "cover_image.jpg";
        updateUploadButton("Change Image");
    }
});
