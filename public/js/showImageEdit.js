document.addEventListener("DOMContentLoaded", function () {
    const previewContainer = document.getElementById("preview-container");
    const previewImage = document.getElementById("preview-image");
    const fileName = document.getElementById("file-name");
    const existingImageContainer = document.getElementById("existing-image-container");
    const removeImageInput = document.getElementById("remove_image");

    // Check if there's an existing image and it's not marked for removal
    if (existingImageContainer && removeImageInput.value !== "1") {
        // Show existing image container
        existingImageContainer.style.display = 'block';
        previewContainer.classList.remove("hidden");
        updateUploadButton("Change Image");
        
        // Hide the new preview image
        if (previewImage) {
            previewImage.style.display = 'none';
        }
    } else {
        // No existing image
        if (existingImageContainer) {
            existingImageContainer.style.display = 'none';
        }
        updateUploadButton("Select Image");
    }
});