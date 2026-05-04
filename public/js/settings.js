//Toast handling
function showToast(message, isError = false) {
    let toastEl;

    const toastContainer = document.getElementById('liveToastMsg');
    const toastBody = document.getElementById('toastBodyMsg');

    if (!toastContainer) return;
    toastBody.innerHTML = isError ? `<i class="fas fa-exclamation-circle me-2"></i> ${message}` : `<i class="fas fa-check-circle me-2"></i> ${message}`;
    toastContainer.style.display = 'block';
    if (!toastEl) {
        toastEl = new bootstrap.Toast(toastContainer.querySelector('.toast'), { delay: 2800, autohide: true });
    } else {
        toastEl.dispose();
        toastEl = new bootstrap.Toast(toastContainer.querySelector('.toast'), { delay: 2800, autohide: true });
    }
    toastEl.show();
    setTimeout(() => {
        if (toastContainer.style.display !== 'none') toastContainer.style.display = 'none';
    }, 3000);
}

document.addEventListener("DOMContentLoaded", () => {
    // DOM elements
    const confirmDeleteCheck = document.getElementById('confirmDeleteCheck');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    const deleteBtn = document.getElementById('deleteBtn');

    deleteBtn.addEventListener('click', function () {
        confirmDeleteCheck.checked = false;
        confirmDeleteBtn.disabled = true;
    });

    // delete account modal checkbox logic
    if (confirmDeleteCheck && confirmDeleteBtn) {
        confirmDeleteCheck.addEventListener('change', function () {
            confirmDeleteBtn.disabled = !this.checked;
        });
    }
});