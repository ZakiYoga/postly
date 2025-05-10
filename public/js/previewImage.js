function previewImage() {
    const input = document.getElementById("image");
    const fileName = document.getElementById("file-name");
    const previewContainer = document.getElementById("preview-container");
    const previewImage = document.getElementById("preview-image");

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            // Show the preview image
            previewImage.src = e.target.result;
            previewContainer.classList.remove("hidden");

            // Update file name display
            fileName.textContent = input.files[0].name;
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function removeImage() {
    const input = document.getElementById("image");
    const fileName = document.getElementById("file-name");
    const previewContainer = document.getElementById("preview-container");

    // Clear the file input
    input.value = "";

    // Hide the preview
    previewContainer.classList.add("hidden");

    // Reset the file name display
    fileName.textContent = "No file selected";
}
