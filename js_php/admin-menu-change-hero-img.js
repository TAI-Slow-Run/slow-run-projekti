import * as dUtils from "../databaseTools/databaseUtilities.js";

document.addEventListener("DOMContentLoaded", () => {
  document
    .getElementById("return-btn")
    .addEventListener("click", async (event) => {
      dUtils.redirect("admin-menu.php", null);
    });
});

document.addEventListener("DOMContentLoaded", () => {
  const fileInput = document.getElementById("img-file");
  fileInput.addEventListener("input", checkFileType);
});

document.addEventListener("DOMContentLoaded", () => {
  const submitBtn = document.getElementById("submit-btn");
  submitBtn.addEventListener("click", validateForm);
});

function checkFileType() {
  let fileElement = document.getElementById("img-file");
  let fileToCheck = "";
  if ("files" in fileElement) {
    fileToCheck = fileElement.files[0]["type"];
  }
  if (fileToCheck !== "image/jpeg") {
    handleErrorPageChangeTheTypeOfTheFile();
 } else {
let url = URL.createObjectURL(fileElement.files[0]);
let previewText = document.getElementById("preview-img-text");
previewText.removeAttribute("hidden");
previewText.innerHTML = "Pääkuva korvataan seuraavalla:";
const previewImgEl = document.getElementById("preview-img");
previewImgEl.removeAttribute("hidden");
previewImgEl.src = url;
  }
}

function handleErrorPageChangeTheTypeOfTheFile() {
  alert("Valitse toinen tiedostotyyppi. Sen tulisi olla VAIN .jpg.");
  document.getElementById("img-file").value = "";
}

function validateForm(event) {
  const inputFile = document.getElementById("img-file");
  if (inputFile.value.trim() === "") {
    alert("Lataa tiedosto!");
    event.preventDefault();
  }
}
