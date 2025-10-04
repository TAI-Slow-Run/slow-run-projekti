import * as dUtils from "../databaseTools/databaseUtilities.js";

document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("return-btn").addEventListener("click", async (event) => {
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
  console.log("Now in checkFileType");
  let fileToCheck = "";
  if ("files" in fileElement) {
    fileToCheck = fileElement.files[0]["type"];
  }
  if (fileToCheck !== "image/jpeg") {
    handleErrorPageChangeTheTypeOfTheFile();
  }
}

function handleErrorPageChangeTheTypeOfTheFile() {
  alert("Valitse toinen tiedostotyyppi. Sen tulisi olla VAIN .jpg.");
  document.getElementById("img-file").value = "";
}

function validateForm(event) {
  const inputTitle = document.getElementById("article-title");
  const inputText = document.getElementById("article-text");
  const inputFile = document.getElementById("img-file");

  if (inputTitle.value.trim() === "") {
    alert("Kirjoita artikkelin otsikko!");
    event.preventDefault();
  } else if (inputText.value.trim() === "") {
    alert("Kirjoita artikkelin teksti!");
    event.preventDefault();
  } else if (inputFile.value.trim() === "") {
    alert("Lataa tiedosto!");
    event.preventDefault();
  }
}
