// Verifica se un elemento ha overflow
function isTextOverflowing(element) {
    return element.scrollWidth > element.clientWidth;
}

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".alert_description").forEach(el => {
        if (isTextOverflowing(el)) {
            let old = el.innerHTML;

            el.innerHTML = `<a href="#" onclick="alert('${el.textContent}')">${old}</a>`;
        }
    });
});