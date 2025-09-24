import * as dUtils from "../databaseTools/databaseUtilities.js";

// Button Palaa toimintoon valitsemalla - Return to the options page:
document.addEventListener("DOMContentLoaded", () => {
  document
    .getElementById("return-btn")
    .addEventListener("click", async (event) => {
      dUtils.redirect("admin-menu.php", null);
    });
});

//Behavior of the page depending on the admin's action:
document.addEventListener("DOMContentLoaded", () => {
  document
    .getElementById("unread-toggle")
    .addEventListener("click", async (event) => {
      window.location.href = "admin-menu-read-message.php?filter=unread";
    });
});

document.addEventListener("DOMContentLoaded", () => {
  document
    .getElementById("all-toggle")
    .addEventListener("click", async (event) => {
      window.location.href = "admin-menu-read-message.php?filter=all";
    });
});
//EventListener to the checkbox - to get index of the message:
document.addEventListener("DOMContentLoaded", () => {
  let checkboxes = document.querySelectorAll(".message-checkbox");
  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener("click", async (event) => {
      let checkboxValue = event.currentTarget.value;
      // console.log(checkboxValue);
    });
  });
});

//EventListener to the button Mark-as-read:
document.addEventListener("DOMContentLoaded", () => {
  document
    .getElementById("mark-as-read")
    .addEventListener("click", async (event) => {
        event.preventDefault();
      handleCheckboxValue();
    });
});

function handleCheckboxValue() {
  let checkboxes = document.querySelectorAll(".message-checkbox");
  checkboxes.forEach((checkbox) => {
    let checkboxValue = checkbox.value;
    let checkboxChecked = checkbox.checked;
    console.log(checkboxValue, checkboxChecked);
  });
}
