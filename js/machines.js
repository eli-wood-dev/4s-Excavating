window.addEventListener("load", () => {
    let container = document.querySelector(".machines-container");
    fetch("backend/machines.php")
        .then(res => {
            if (res.ok) {
                return res.json();
            }
        })
        .then(data => {
            console.log(data)
            for (const machine of Object.values(data)) {
                createMachineTile(machine, container);
            }
        })
        .catch((error) => {
            createMachineTile({
                image: "images/placeholder.png",
                name: "Missing"
            }, container);
            console.error("Error fetching machines:", error);
        })





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

        if (machine.rentals && machine.rentals.length > 0) {
            const rentalContainer = document.createElement("div")
            image.classList.add("machine-rental-container")
            container.appendChild(rentalContainer)

            const rentalTitle = document.createElement("h3")
            rentalTitle.classList.add("machine-rental-title")
            rentalTitle.textContent = "In Use"
            rentalContainer.appendChild(rentalTitle)

            for (const rental of machine.rentals) {
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
    }
})