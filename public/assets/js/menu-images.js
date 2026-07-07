const menuImagesInput = document.getElementById("menuImagesInput");
const selectedImagesList = document.getElementById("selectedImagesList");

let selectedFiles = [];

menuImagesInput.addEventListener("change", () => {
  const newFiles = Array.from(menuImagesInput.files);

  selectedFiles = [...selectedFiles, ...newFiles].slice(0, 3);

  updateFileInput();
  renderSelectedImages();
});

function renderSelectedImages() {
  selectedImagesList.innerHTML = "";

  selectedFiles.forEach((file, index) => {
    const item = document.createElement("div");
    item.className = "d-flex justify-content-between align-items-center border rounded p-2 mb-2";

    item.innerHTML = `
      <span>${file.name}</span>
      <button type="button" class="btn btn-sm btn-outline-danger">
        ✕
      </button>
    `;

    item.querySelector("button").addEventListener("click", () => {
      selectedFiles.splice(index, 1);
      updateFileInput();
      renderSelectedImages();
    });

    selectedImagesList.appendChild(item);
  });
}

function updateFileInput() {
  const dataTransfer = new DataTransfer();

  selectedFiles.forEach(file => {
    dataTransfer.items.add(file);
  });

  menuImagesInput.files = dataTransfer.files;
}