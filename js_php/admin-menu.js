import * as dUtils from "../databaseTools/databaseUtilities.js";

document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("add-article").addEventListener("click", async (event) => {
            dUtils.redirect("admin-menu-add-article.php", null);
    });
});

document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("read-message").addEventListener("click", async (event) => {
            dUtils.redirect("admin-menu-read-message.php", null);
    });
});

document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("change-hero-img").addEventListener("click", async (event) => {
            dUtils.redirect("admin-menu-change-hero-img.php", null);
    });
});

document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("change-contact").addEventListener("click", async (event) => {
            dUtils.redirect("admin-menu-change-contact.php", null);
    });
});


// document.addEventListener("DOMContentLoaded", () => {
//     document.getElementById("add-article").addEventListener("click", async (event) => {
//         const data = await dUtils.sendDataToServer(event, "./js_php/login_server.php", null);
//         if(data.keyData == "ok") {
//             dUtils.redirect("admin-menu-add-article.php", null);
//         }
//     });
// });

// document.addEventListener("DOMContentLoaded", () => {
//     document.getElementById("read-message").addEventListener("click", async (event) => {
//         const data = await dUtils.sendDataToServer(event, "./js_php/login_server.php", null);
//         if(data.keyData == "ok") {
//             dUtils.redirect("admin-menu-read-message.php", null);
//         }
//     });
// });

// document.addEventListener("DOMContentLoaded", () => {
//     document.getElementById("change-hero-img").addEventListener("click", async (event) => {
//         const data = await dUtils.sendDataToServer(event, "./js_php/login_server.php", null);
//         if(data.keyData == "ok") {
//             dUtils.redirect("admin-menu-change-hero-img.php", null);
//         }
//     });
// });

// document.addEventListener("DOMContentLoaded", () => {
//     document.getElementById("change-contact").addEventListener("click", async (event) => {
//         const data = await dUtils.sendDataToServer(event, "./js_php/login_server.php", null);
//         if(data.keyData == "ok") {
//             dUtils.redirect("admin-menu-change-contact.php", null);
//         }
//     });
// });