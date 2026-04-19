window.addEventListener("load", () => {
    let container = document.querySelector(".machines-container");
    let placeholder = createMachineTile({
        image: "images/placeholder.png",
        name: "Placeholder"
    }, container);

    fetch("backend/machines.php")
        .then(res => {
            if (res.ok) {
                return res.json();
            }
        })
        .then(data => {
            placeholder.remove();

            for (const machine of Object.values(data)) {
                createMachineTile(machine, container);
            }
        })
        .catch((error) => {
            console.error("Error fetching machines:", error);
        })

    function createMachineTile(machine, parent) {
        const container = document.createElement("div");
        container.classList.add("equipment-card");

        if (!machine.image) {
            machine.image = "images/placeholder.png";
        }

        const image = document.createElement("img");
        image.classList.add("equipment-image");
        image.src = machine.image;
        container.appendChild(image);

        const cardContent = document.createElement("div");
        cardContent.classList.add("equipment-content");

        const name = document.createElement("h3");
        name.classList.add("equipment-title");
        name.textContent = machine.name;
        cardContent.appendChild(name);

        const bookingsContainer = document.createElement("div");
        bookingsContainer.classList.add("equipment-bookings");
        bookingsContainer.style.maxHeight = "90px";
        bookingsContainer.style.overflowY = "auto";
        bookingsContainer.style.marginBottom = "8px";

        if (machine.rentals && machine.rentals.length > 0) {
            for (const rental of machine.rentals) {
                const startDate = new Date(rental.startDate);
                const endDate = new Date(rental.endDate);

                const row = document.createElement("div");
                row.classList.add("equipment-info-row");

                const startStr = startDate.toLocaleDateString();
                const endStr = endDate.toLocaleDateString();

                row.innerHTML = `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; min-width: 16px;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> <span style="font-size: 0.85em; color: var(--text-muted);">${startStr} &mdash; ${endStr}</span>`;
                bookingsContainer.appendChild(row);
            }
        } else {
            const row = document.createElement("div");
            row.classList.add("equipment-info-row");
            row.innerHTML = `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; min-width: 16px;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> <span style="font-size: 0.85em; color: rgb(10, 219, 10); font-weight: 700;">Available Now</span>`;
            bookingsContainer.appendChild(row);
        }
        cardContent.appendChild(bookingsContainer);
        container.appendChild(cardContent);

        parent.appendChild(container);
        return container;
    }
})