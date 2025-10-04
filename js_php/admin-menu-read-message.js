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
  document.getElementById("unread-toggle").addEventListener("click", async (event) => {
      window.location.href = "admin-menu-read-message.php?filter=unread";
    });
});

document.addEventListener("DOMContentLoaded", () => {
  document.getElementById("all-toggle").addEventListener("click", async (event) => {
      window.location.href = "admin-menu-read-message.php?filter=all";
    });
});
//EventListener to the checkbox - to get index of the message:
document.addEventListener("DOMContentLoaded", () => {
  let checkboxes = document.querySelectorAll(".message-checkbox");
  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener("click", async (event) => {
      let checkboxValue = event.currentTarget.value;
    });
  });
});

//EventListener to the button Mark-as-read:
document.addEventListener("DOMContentLoaded", () => {
  document.getElementById("mark-as-read").addEventListener("click", async (event) => {
    let checkedItemIds = getCheckedIds();
      fillHiddenInput(event.target.id, checkedItemIds);
    });
});

//EventListener to the button Delete:
document.addEventListener("DOMContentLoaded", () => {
  document.getElementById("delete-msg").addEventListener("click", async (event) => {
    // event.preventDefault();
    let checkedItemIds = getCheckedIds();
    fillHiddenInput(event.target.id, checkedItemIds);
  });
});


// Function to gather in the array the ids of all checked checkboxÖ
function getCheckedIds() {
  let checkboxes = document.querySelectorAll(".message-checkbox");
  let checkedItems = [];
  checkboxes.forEach((checkbox) => {
      if (checkbox.checked) {
          checkedItems.push(checkbox.value)
      }
  });
  
  return checkedItems;
}

function fillHiddenInput(btnName, arrayOfCheckedItemsIds) {
  const hiddenInputIds = document.getElementById("checkedItemIds");
  const hiddenInputAction = document.getElementById("btnAction");
  hiddenInputAction.value = JSON.stringify(btnName);
  hiddenInputIds.value = JSON.stringify(arrayOfCheckedItemsIds);
  console.log("Array and action are: ", JSON.stringify(arrayOfCheckedItemsIds), JSON.stringify(btnName));
}