import * as dUtil from "../databaseTools/databaseUtilities.js";

document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("contact-form").addEventListener("submit", async (e) => {
        const data = await dUtil.sendDataToServer(e, "contact_submit.php", null);
        alert(data.keyData);
    });
})