window.addEventListener("load", ()=>{
    let container = document.querySelector(".machines-container");
    fetch("backend/machines.php")
    .then(res=>{
        if(res.ok){
            return res.json();
        }
    })
    .then(data=>{
        
    })
    .catch(()=>{

    })
})