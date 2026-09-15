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
  selectedImagesList.replaceChildren();

  selectedFiles.forEach((file, index) => {
    const item = document.createElement("div");
    item.className = "d-flex justify-content-between align-items-center border rounded p-2 mb-2";

    const fileName = document.createElement("span");
    fileName.textContent = file.name;

    const button = document.createElement("button");
    button.type = "button";
    button.className = "btn btn-sm btn-outline-danger";
    button.textContent = "✕";

    item.appendChild(fileName);
    item.appendChild(button);

    button.addEventListener("click", () => {
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