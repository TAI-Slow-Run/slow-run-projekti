import * as dUtils from "../databaseTools/databaseUtilities.js";

document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("return-btn").addEventListener("click", async (event) => {
            dUtils.redirect("admin-menu.php", null);
    });
});