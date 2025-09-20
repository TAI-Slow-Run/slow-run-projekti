// import * as dUtils from "../databaseTools/databaseUtilities.js";

function checkFileType() {

    let fileElement = document.getElementById("img-file");
    console.log("Files are: ", fileElement.files[0]["type"]);
    let fileToCheck = "";
    if ("files" in fileElement) {
        
      fileToCheck = fileElement.files[0]["type"];
    }
    if (fileToCheck !=="image/jpeg" && fileToCheck !=="image/png") {
      handleErrorPageChangeTheTypeOfTheFile();
    }
  }
  
  function handleErrorPageChangeTheTypeOfTheFile() {
    alert("Valitse toinen tiedostotyyppi. Sen tulisi olla .jpg tai .png.");
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