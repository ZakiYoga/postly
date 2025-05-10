const title = document.querySelector("#title");
const slug = document.querySelector("#slug");

title.addEventListener("change", function () {
    fetch("/dashboard/posts/checkSlug?title=" + encodeURIComponent(title.value))
        .then((response) => response.json())
        .then((data) => (slug.value = data.slug))
        .catch((error) => console.error("Error:", error));
});
