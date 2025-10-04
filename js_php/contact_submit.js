import * as dUtil from "../databaseTools/databaseUtilities.js";

// just a small comment for testing purposes.

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("contact-form");
    form.addEventListener("submit", async (e) => {
        const data = await dUtil.sendDataToServer(e, "contact_submit.php", null);
        alert(data.keyData);
        form.reset();
    });
})