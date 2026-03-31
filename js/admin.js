/*
    Name: Group
    Date: 2026-03-30
    Description: JavaScript for the admin dashboard.
*/

/*
    Purpose: Toggle a message between resolved and unresolved.
    Parameters: id - the message id.
    Returns: Nothing.
*/
async function toggleResolved(id) {
    let card;
    let statusText;
    let button;
    let response;
    let result;

    card = document.getElementById("message-" + id);
    statusText = document.getElementById("status-" + id);
    button = document.getElementById("button-" + id);

    if (card === null || statusText === null || button === null) {
        return;
    }

    button.disabled = true;

    try {
        response = await fetch("backend/toggle_message_resolved.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "id=" + encodeURIComponent(id)
        });

        result = await response.json();

        if (!response.ok || result.success !== true) {
            throw new Error(result.message || "Unable to update message status.");
        }

        if (Number(result.resolved) === 1) {
            card.classList.add("resolved");
            statusText.textContent = "Resolved";
            button.textContent = "Mark Unresolved";
        }
        else {
            card.classList.remove("resolved");
            statusText.textContent = "Unresolved";
            button.textContent = "Mark Resolved";
        }
    }
    catch (error) {
        console.error(error)
    }
    finally {
        button.disabled = false;
    }
}
