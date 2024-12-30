const searchInput = document.getElementById("search-input");
const searchBar = document.getElementById("search-bar");
const searchIcon = document.getElementById("search-icon");
const accoutPlaceHolder = document.getElementById("account");
const popUpAkun = document.getElementById("pop-up-akun");

searchInput.addEventListener("focus", () => {
    searchBar.classList.remove("hover:w-[300px]");
    searchBar.classList.add("w-[300px]");
    searchInput.classList.add("opacity-100");
    searchIcon.classList.add("left-4");
    searchIcon.classList.remove("left-1/2");
    searchIcon.classList.remove("-translate-x-1/2");
});

searchInput.addEventListener("blur", () => {
    if (searchInput.value === "") {
        searchBar.classList.remove("w-[300px]");
        searchBar.classList.add("hover:w-[300px]");
        searchInput.classList.remove("opacity-100");
        searchIcon.classList.remove("left-4");
        searchIcon.classList.add("left-1/2");
        searchIcon.classList.add("-translate-x-1/2");
    }
});

accoutPlaceHolder.addEventListener("mouseover", () => {
    popUpAkun.classList.remove("hidden");
});

accoutPlaceHolder.addEventListener("mouseleave", () => {
    setTimeout(() => {
        if (!popUpAkun.matches(":hover")) {
            popUpAkun.classList.add("hidden");
        }
    }, 100);
});

popUpAkun.addEventListener("mouseleave", () => {
    popUpAkun.classList.add("hidden");
});

popUpAkun.addEventListener("mouseover", () => {
    popUpAkun.classList.remove("hidden");
});


document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('menu-toggle');
    const menuWrapper = document.getElementById('menu-wrapper');
    let showMenu = false;
    menuToggle.addEventListener('click', function () {
        if (showMenu) {
            menuWrapper.classList.add('hidden');
            showMenu = false;
        } else {
            menuWrapper.classList.remove('hidden');
            showMenu = true;
        }
    });
});