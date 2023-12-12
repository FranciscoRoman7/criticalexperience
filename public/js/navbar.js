document.getElementById("menu-toggle").addEventListener("click", function () {
    document.getElementById("sidebar-wrapper").classList.toggle("toggled");

    const menuToggle = document.getElementById("menu-toggle");
    if (document.getElementById("sidebar-wrapper").classList.contains("toggled")) {
        menuToggle.style.left = "90px";
    } else {
        menuToggle.style.left = "20px";
    }
});