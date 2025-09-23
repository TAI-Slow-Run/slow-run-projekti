import * as dUtils from "../databaseTools/databaseUtilities.js";

document.addEventListener("DOMContentLoaded", () => {
  document
    .getElementById("return-btn")
    .addEventListener("click", async (event) => {
      dUtils.redirect("admin-menu.php", null);
    });
});

document.addEventListener("DOMContentLoaded", () => {
  const unreadBtn = document.getElementById("unread-toggle");
  const allBtn = document.getElementById("all-toggle");
  const titleElement = document.getElementById("admin-container-title");
  unreadBtn.addEventListener("click", toggleBtn);
  allBtn.addEventListener("click", toggleBtn);

  function toggleBtn(event) {
    unreadBtn.classList.remove("active-toggle");
    allBtn.classList.remove("active-toggle");

    event.currentTarget.classList.add("active-toggle");

    if (event.currentTarget.id == "unread-toggle") {
      titleElement.textContent = "Toiminto: Näe vain lukemattomat viestit";
    } else {
      titleElement.textContent = "Toiminto: Näe kaikki viestit";
    }
  }
});
