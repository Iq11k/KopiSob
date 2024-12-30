document.addEventListener("DOMContentLoaded", () => {
    const sections = document.querySelectorAll("section");
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                const navLink = document.querySelector(
                    `#nav-${entry.target.id}`
                );
                if (entry.isIntersecting) {
                    document
                        .querySelectorAll("nav ul li a")
                        .forEach((link) =>
                            link.classList.remove("text-[#009D3C]")
                        );
                    if (navLink) navLink.classList.add("text-[#009D3C]");
                }
            });
        },
        { threshold: 0.3 }
    );
    sections.forEach((section) => observer.observe(section));
});

function showPassword() {
    const x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}