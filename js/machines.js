/**
 * Eli Wood
 * 2026-03-31
 * Script for machine page
 * Uses AJAX to get data from the backend and dynamically creates html elements
 */

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

    /**
     * Creates a tile DOM element based on the machine object and adds it to the parent element
     * @param {*} machine object which store data about a specific machine
     * @param {*} parent element to append tile to
     * @returns container element which is appended to the parent 
     */
    function createMachineTile(machine, parent) {
        const container = document.createElement("div")
        container.classList.add("machine-container")

        const name = document.createElement("h3")
        name.classList.add("machine-title")
        name.textContent = machine.name
        container.appendChild(name)

        const description = document.createElement("p")
        description.classList.add("machine-description")
        description.textContent = machine.description
        container.appendChild(description)

        if (!machine.image) {
            machine.image = "images/placeholder.png"
        }

        const image = document.createElement("img")
        image.classList.add("machine-image")
        image.src = machine.image
        container.appendChild(image)

        const available = document.createElement("h3");
        available.textContent = "Available";
        available.classList.add("available")
        container.appendChild(available)

        if (machine.rentals && machine.rentals.length > 0) {
            const rentalContainer = document.createElement("div")
            image.classList.add("machine-rental-container")
            container.appendChild(rentalContainer)

            const rentalTitle = document.createElement("h3")
            rentalTitle.classList.add("machine-rental-title")
            rentalTitle.textContent = "Bookings"
            rentalContainer.appendChild(rentalTitle)

            for (const rental of machine.rentals) {
                let now = new Date();
                now.setHours(0, 0, 0, 0);
                let startDate = new Date(rental.startDate);
                //should not matter but good to check anyway
                let endDate = new Date(rental.endDate);
                if(startDate.getTime() < now.getTime() && endDate.getTime() > now.getTime()){
                    available.remove();
                }

                const dateContainer = document.createElement("p")
                dateContainer.classList.add("machine-rental-date-container")

                const start = document.createElement("span")
                start.classList.add("machine-rental-date")
                start.textContent = rental.startDate
                dateContainer.appendChild(start)

                dateContainer.appendChild(document.createTextNode(" - "))

                const end = document.createElement("span")
                end.classList.add("machine-rental-date")
                end.textContent = rental.endDate
                dateContainer.appendChild(end)

                rentalContainer.appendChild(dateContainer)
            }
        }


        parent.appendChild(container)
        return container;
    }
})