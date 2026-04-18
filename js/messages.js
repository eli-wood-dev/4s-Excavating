/**
 * Shreyas Hegde
 * 2026-04-06
 * Script for sending messages
 * handles user input and sends the message to be created to the backend using
 */

window.addEventListener("load", () => {
    const form = document.getElementById("contact-form");
    const content = document.getElementById("message");
    const email = document.getElementById("email");
    const name = document.getElementById("name");
    const phoneNumber = document.getElementById("phone");
    const category = document.getElementById("category");
    const submitBtn = document.getElementById("submit-btn");

    const modal = document.getElementById("status-modal");
    const closeModalBtn = document.getElementById("close-modal-btn");
    const modalTitle = document.getElementById("modal-title");
    const modalText = document.getElementById("modal-text");

    /**
     * Shows a message to the user using DOM elements instead of alert
     * @param {*} title title of the message
     * @param {*} msg content of the message
     */
    function showModal(title, msg) {
        modalTitle.textContent = title;
        modalText.textContent = msg;
        modal.classList.add("show");
    }

    closeModalBtn.addEventListener("click", () => {
        modal.classList.remove("show");
    });

    window.addEventListener("click", (ev) => {
        if (ev.target === modal) {
            modal.classList.remove("show");
        }
    });

    form.addEventListener("submit", (ev) => {
        ev.preventDefault();

        const originalText = submitBtn.textContent;
        submitBtn.textContent = "Sending....";
        submitBtn.disabled = true;

        fetch("backend/message.php", {
            method: 'POST',
            body: JSON.stringify({
                content: content.value,
                email: email.value,
                name: name.value,
                phone_number: phoneNumber.value,
                category: category.value
            }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(res => {
                if (res.ok) {
                    showModal("Success!", "Your message has been sent successfully.");
                    form.reset();
                } else {
                    showModal("Server Error", "There was an error sending your message. Please try again later.");
                }
                return res.json()
            })
            .then(data => {
                console.log(data);
            })
            .catch(err => {
                console.error(err);
                showModal("Network Error", "There was a network error sending your message. Please try again later.");
            })
            .finally(() => {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            });
    });
});