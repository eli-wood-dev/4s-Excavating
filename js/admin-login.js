/**
 * Gurbaz Sogi, Eli Wood
 * 2026-03-30
 * JavaScript for the admin login page.
 */

/**
 * Sets up the login form event listener.
 */
function start() {
    let loginForm;

    loginForm = document.getElementById("admin-login-form");

    if (loginForm !== null) {
        loginForm.addEventListener("submit", handleLogin);
    }
}
/**
 * Checks login details and redirects to admin page if correct.
 * @param {*} event the form submit event
 */
function handleLogin(event) {
    let username;
    let password;
    let message;

    event.preventDefault();

    email = document.getElementById("email").value;
    password = document.getElementById("password").value;
    message = document.getElementById("login-message");

    fetch("backend/login.php", {
        method: "POST",
        body: JSON.stringify({
            "email": email,
            "password": password
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(res=>{
        if(res.ok){
            localStorage.setItem("adminLoggedIn", "true");
            return res.text()
        } else{
            throw new Error("Incorrect username or password.");
        }
    })
    .then(data=>{
        console.log(data);
        message.textContent = "Login successful. Redirecting...";
        window.location.href = "admin.php";
    })
    .catch(error=>{
        message.textContent = error;
    })
}

window.addEventListener("load", start);