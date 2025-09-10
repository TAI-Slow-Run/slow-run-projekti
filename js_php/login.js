import * as dUtils from "../databaseTools/databaseUtilities.js";

document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("submitButton").addEventListener("click", async (event) => {
        const data = await dUtils.sendDataToServer(event, "./js_php/login_server.php", null);
        console.log(data);
    });
});