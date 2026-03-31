window.addEventListener("load", ()=>{
    const form = document.querySelector(".contact-form")
    form.addEventListener("submit", (ev)=>{
        ev.preventDefault();

        const content = document.querySelector("#message")
        const email = document.querySelector("#email")
        const name = document.querySelector("#name")
        const phoneNumber = document.querySelector("#phone")
        const category = document.querySelector("#category")

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
        .then(res=>{
            if(res.ok){
                window.location.reload();
            } else{
                //warn user of error
                window.location.reload();
            }
            return res.json()
        })
        .then(data=>{
            console.log(data)
        })
    })
})