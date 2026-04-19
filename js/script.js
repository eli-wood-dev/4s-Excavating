/**
 * Shreyas Hegde
 * 2026-03-30
 * Script for general purpose code for any page
 * Used primarily for page animations and navbar login/admin button updates
 */
window.addEventListener("load", ()=>{
    // Intersection Observer for Slide-Up Animations
    const observerOptions = {
        root: null,
        rootMargin: "0px",
        threshold: 0.15
    };

    const observer = new IntersectionObserver((entries, currentObserver) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("active");
                currentObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll(".section-animate").forEach((element) => {
        observer.observe(element);
    });

    const adminNavBtn = document.getElementById("admin-nav-btn");

    if (adminNavBtn !== null && localStorage.getItem("adminLoggedIn") === "true") {
        adminNavBtn.textContent = "Admin";
        adminNavBtn.href = "admin.php";
    }
});