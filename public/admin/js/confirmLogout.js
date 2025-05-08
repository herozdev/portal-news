/**
 * Confirm with user before logging them out.
 *
 * @param {Event} event
 */
function confirmLogout(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Confirm Logout',
        text: 'Are you sure you want to logout?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Logout'
    }).then((result) => {
        if (result.value) {
            document.getElementById('logout-form').submit();
        }
    });
}