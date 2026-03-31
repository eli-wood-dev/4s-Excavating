/*
    Name: Group
    Date: 2026-03-30
    Description: JavaScript for the admin login page.
*/

/*
    Purpose: Set up the login form event listener.
    Parameters: None.
    Returns: Nothing.
*/
function start() {
    let loginForm;

    loginForm = document.getElementById("admin-login-form");

    if (loginForm !== null) {
        loginForm.addEventListener("submit", handleLogin);
    }
}

/*
    Purpose: Check login details and redirect to admin page if correct.
    Parameters: event - the form submit event.
    Returns: Nothing.
*/
function handleLogin(event) {
    let username;
    let password;
    let message;

    event.preventDefault();

    username = document.getElementById("username").value;
    password = document.getElementById("password").value;
    message = document.getElementById("login-message");

    if (username === "admin" && password === "1234") {
        localStorage.setItem("adminLoggedIn", "true");
        message.textContent = "Login successful. Redirecting...";
        window.location.href = "admin.html";
    }
    else if (username === "" || password === "") {
        message.textContent = "Please enter both username and password.";
    }
    else {
        message.textContent = "Incorrect username or password.";
    }
}

window.addEventListener("load", start);