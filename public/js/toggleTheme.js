const themeToggle = document.getElementById("theme-toggle");
const lightIcon = document.getElementById("theme-toggle-light");
const darkIcon = document.getElementById("theme-toggle-dark");

// Cek tema dari localStorage
if (localStorage.getItem("theme") === "dark") {
    document.documentElement.classList.add("dark");
    lightIcon.classList.remove("hidden");
    darkIcon.classList.add("hidden");
} else {
    document.documentElement.classList.remove("dark");
    lightIcon.classList.add("hidden");
    darkIcon.classList.remove("hidden");
}

themeToggle.addEventListener("click", function () {
    document.documentElement.classList.toggle("dark");
    if (document.documentElement.classList.contains("dark")) {
        localStorage.setItem("theme", "dark");
        lightIcon.classList.remove("hidden");
        darkIcon.classList.add("hidden");
    } else {
        localStorage.setItem("theme", "light");
        lightIcon.classList.add("hidden");
        darkIcon.classList.remove("hidden");
    }
});
