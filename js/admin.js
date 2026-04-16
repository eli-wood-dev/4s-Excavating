/*
    Name: Group
    Date: 2026-04-07
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
    let checkbox;
    let resolvedAt;
    let response;
    let result;

    card = document.getElementById("message-" + id);
    statusText = document.getElementById("status-" + id);
    checkbox = document.getElementById("checkbox-" + id);
    resolvedAt = document.getElementById("resolved-at-" + id);

    if (card === null || statusText === null || checkbox === null) {
        return;
    }

    checkbox.disabled = true;

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
            card.classList.remove("unresolved-card");
            card.classList.add("resolved-card");

            statusText.textContent = "Resolved";
            statusText.classList.remove("status-unresolved");
            statusText.classList.add("status-resolved");

            checkbox.checked = true;

            if (resolvedAt !== null) {
                resolvedAt.innerHTML = "<strong>Resolved At:</strong> " + new Date().toLocaleString();
                resolvedAt.classList.remove("hidden-resolved-at");
            }
        }
        else {
            card.classList.remove("resolved-card");
            card.classList.add("unresolved-card");

            statusText.textContent = "Unresolved";
            statusText.classList.remove("status-resolved");
            statusText.classList.add("status-unresolved");

            checkbox.checked = false;

            if (resolvedAt !== null) {
                resolvedAt.innerHTML = "<strong>Resolved At:</strong> Not resolved yet";
                resolvedAt.classList.add("hidden-resolved-at");
            }
        }
    }
    catch (error) {
        console.error(error);
        checkbox.checked = !checkbox.checked;
        alert("Could not update message status.");
    }
    finally {
        checkbox.disabled = false;
    }
}