import "./bootstrap";

window.addEventListener("DOMContentLoaded", () => {
    // Cek apakah elemen sidebar ada
    const sidebarWrapper = document.getElementById("sidebar-wrapper");
    if (!sidebarWrapper) return;

    // Buat elemen backdrop
    const backdrop = document.createElement("div");
    backdrop.className = "sidebar-backdrop";
    document.body.appendChild(backdrop);

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector("#sidebarToggle");
    if (sidebarToggle) {
        // Hapus status dari localStorage saat halaman dimuat agar tidak "berkedip"
        // Kita biarkan defaultnya tertutup di mobile
        if (window.innerWidth < 768) {
            document.body.classList.remove("sb-sidenav-toggled");
        }

        const toggleSidebar = (event) => {
            if (event) event.preventDefault();
            document.body.classList.toggle("sb-sidenav-toggled");
            localStorage.setItem(
                "sb|sidebar-toggle",
                document.body.classList.contains("sb-sidenav-toggled")
            );
        };

        // Event untuk tombol hamburger dan backdrop
        sidebarToggle.addEventListener("click", toggleSidebar);
        backdrop.addEventListener("click", toggleSidebar);
    }
});
