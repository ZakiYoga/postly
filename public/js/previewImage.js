function previewImage() {
    const input = document.getElementById("cover_image");
    const fileName = document.getElementById("file-name");
    const previewContainer = document.getElementById("preview-container");
    const previewImage = document.getElementById("preview-image");
    const removeImageInput = document.getElementById("remove_image");
    const existingImageContainer = document.getElementById("existing-image-container");

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            // Hide existing image component
            if (existingImageContainer) {
                existingImageContainer.style.display = 'none';
            }

            // Show the new preview image
            previewImage.src = e.target.result;
            previewImage.style.display = 'block';
            previewContainer.classList.remove("hidden");

            // Update file name display
            fileName.textContent = input.files[0].name;
            updateUploadButton("Change Image");
            
            // Reset remove flag
            removeImageInput.value = "0";
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function updateUploadButton(text) {
    const btnUp = document.getElementById("btn-upload");
    btnUp.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.8" stroke="#2F3A4A" class="w-5 h-5 pb-0.5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 16V4m0 0l-5 5m5-5l5 5M4 16v4a1 1 0 001 1h14a1 1 0 001-1v-4" />
        </svg>
        <span class="text-sm/6">${text}</span>
    `;
}

function removeImage() {
    const input = document.getElementById("cover_image");
    const fileName = document.getElementById("file-name");
    const previewContainer = document.getElementById("preview-container");
    const previewImage = document.getElementById("preview-image");
    const removeImageInput = document.getElementById("remove_image");
    const existingImageContainer = document.getElementById("existing-image-container");

    // Clear the file input
    input.value = null;

    // Hide both previews
    previewContainer.classList.add("hidden");
    previewImage.style.display = 'none';
    previewImage.src = '';

    // Hide existing image
    if (existingImageContainer) {
        existingImageContainer.style.display = 'none';
    }

    // Reset the file name display
    fileName.textContent = "No file selected";

    // Update upload button content
    updateUploadButton("Select Image");

    // Mark for removal
    removeImageInput.value = "1";
}

function handleToggleChange(event) {
    const isChecked = event.target.checked;
    const input = document.getElementById("cover_image");
    const fileName = document.getElementById("file-name");
    const previewContainer = document.getElementById("preview-container");
    const previewImage = document.getElementById("preview-image");
    const existingImageContainer = document.getElementById("existing-image-container");

    // Clear the file input
    input.value = "";

    // Hide all previews
    previewContainer.classList.add("hidden");
    previewImage.style.display = 'none';
    previewImage.src = '';

    if (existingImageContainer) {
        existingImageContainer.style.display = 'none';
    }

    // Reset the file name display
    fileName.textContent = "No file selected";

    // Update upload button content back to original
    updateUploadButton("Select Image");
}