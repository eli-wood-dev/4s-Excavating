/*
    Name: Group
    Date: 2026-03-30
    Description: JavaScript for the admin dashboard page.
*/

/*
    Purpose: Set up the admin page and check login status.
    Parameters: None.
    Returns: Nothing.
*/
function start() {
    let logoutButton;

    checkLogin();

    logoutButton = document.getElementById("logout-button");

    if (logoutButton !== null) {
        logoutButton.addEventListener("click", logout);
    }
}

/*
    Purpose: Check whether the admin is logged in.
    Parameters: None.
    Returns: Nothing.
*/
function checkLogin() {
    if (localStorage.getItem("adminLoggedIn") !== "true") {
        window.location.href = "admin-login.html";
    }
}

/*
    Purpose: Log the admin out and return to the login page.
    Parameters: None.
    Returns: Nothing.
*/
function logout() {
    localStorage.removeItem("adminLoggedIn");
    window.location.href = "admin-login.html";
}

window.addEventListener("load", start);