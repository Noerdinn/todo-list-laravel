import Swal from "sweetalert2";
window.Swal = Swal; // Agar bisa digunakan di Blade

// alert serba success
window.showAlert = function (type, message) {
    Swal.fire({
        icon: type, // Bisa: 'success', 'error', 'warning', 'info'
        title: type === "success" ? "Success" : "Oops!",
        text: message,
        confirmButtonColor: "#3085d6",
        background: "#f8f9fa",
        scrollbarPadding: false, // Mencegah pergeseran layout
        customClass: {
            popup: "custom-swal-popup", // Untuk modal utama
            title: "custom-swal-title", // Untuk judul
            content: "custom-swal-content", // Untuk teks isi
            confirmButton: "custom-swal-button", // Untuk tombol
        },
    });
};

// // alert delete task
// document.addEventListener("DOMContentLoaded", function () {
//     document.querySelectorAll(".delete-task").forEach((button) => {
//         button.addEventListener("click", function () {
//             let taskId = this.getAttribute("data-task-id");
//             Swal.fire({
//                 title: "Are you sure?",
//                 text: "This task will be permanently deleted!",
//                 icon: "warning",
//                 showCancelButton: true,
//                 confirmButtonColor: "#d33",
//                 cancelButtonColor: "#3085d6",
//                 confirmButtonText: "Yes, delete it!",
//                 cancelButtonText: "Cancel",
//                 customClass: {
//                     popup: "custom-swal-popup",
//                     title: "custom-swal-title", // Untuk judul
//                     content: "custom-swal-content", // Untuk teks isi
//                     confirmButton: "custom-swal-delete-button",
//                     cancelButton: "custom-swal-cancel-button",
//                 },
//             }).then((result) => {
//                 if (result.isConfirmed) {
//                     document.getElementById(`delete-form-${taskId}`).submit();
//                 }
//             });
//         });
//     });
// });

// alert logout akun
document.addEventListener("DOMContentLoaded", function () {
    document
        .getElementById("logout-btn")
        .addEventListener("click", function (event) {
            event.preventDefault();

            Swal.fire({
                title: "Are you sure?",
                text: "You will be logged out!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, log out!",
                cancelButtonText: "Cancel",
                customClass: {
                    popup: "custom-swal-popup",
                    title: "custom-swal-title", // Untuk judul
                    confirmButton: "custom-swal-delete-button",
                    cancelButton: "custom-swal-cancel-button",
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("logout-form").submit();
                }
            });
        });
});
