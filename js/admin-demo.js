/*
    Name: Group
    Date: 2026-04-07
    Description: Temporary local demo JavaScript for admin page.
*/

function start() {
    if (localStorage.getItem("adminLoggedIn") !== "true") {
        window.location.href = "admin-login.html";
    }
}

function toggleResolvedDemo(id) {
    let card;
    let statusText;
    let checkbox;
    let resolvedAt;

    card = document.getElementById("message-" + id);
    statusText = document.getElementById("status-" + id);
    checkbox = document.getElementById("checkbox-" + id);
    resolvedAt = document.getElementById("resolved-at-" + id);

    if (checkbox.checked) {
        card.classList.remove("unresolved-card");
        card.classList.add("resolved-card");

        statusText.textContent = "Resolved";
        statusText.classList.remove("status-unresolved");
        statusText.classList.add("status-resolved");

        resolvedAt.innerHTML = "<strong>Resolved At:</strong> " + new Date().toLocaleString();
        resolvedAt.classList.remove("hidden-resolved-at");
    }
    else {
        card.classList.remove("resolved-card");
        card.classList.add("unresolved-card");

        statusText.textContent = "Unresolved";
        statusText.classList.remove("status-resolved");
        statusText.classList.add("status-unresolved");

        resolvedAt.innerHTML = "<strong>Resolved At:</strong> Not resolved yet";
        resolvedAt.classList.add("hidden-resolved-at");
    }
}

function logoutDemo() {
    localStorage.removeItem("adminLoggedIn");
}

window.addEventListener("load", start);