import "./bootstrap";
import "./alert";

document.addEventListener("DOMContentLoaded", () => {
    showDetailTask(null);
});
// fungsi untuk menampilkan detail task
async function showDetailTask(taskId = null) {
    const taskDetailContainer = document.getElementById(
        "task-detail-container"
    );
    const currentTaskIdInput = document.getElementById("current-task-id");

    // update hidden input
    currentTaskIdInput.value = taskId || "";

    // jika task id false atau kosong maka tampilkan ini
    if (!taskId) {
        taskDetailContainer.innerHTML = `
        <div class="h-full flex items-center justify-center">
            <div class="text-center">
                <i class="fa-solid fa-eye md:text-9xl text-7xl text-gray-400 mb-4"></i>
                <p class="text-black md:text-lg text-base">Tidak ada task yang dipilih.</p>
                <p class="text-black md:text-lg text-base">Tekan icon mata pada task yang ingin ditampilkan.</p>
            </div>
        </div>`;
        return;
    }

    try {
        // Tampilkan loading state
        taskDetailContainer.innerHTML = `
            <div class="h-full flex items-center justify-center">
                <div class="animate-spin rounded-full h-16 w-16 border-b-2 border-black"></div>
            </div>`;

        const response = await fetch(`/mytasks/${taskId}/subtasks`);
        if (!response.ok) throw new Error("Gagal mengambil data subtasks.");

        // menyisipkan content html
        const html = await response.text();
        taskDetailContainer.innerHTML = html;

        // Update task list styling
        document.querySelectorAll(".task-item").forEach((item) => {
            item.classList.add("shadow-[0px_3px_0px_0px_rgba(0,0,0,1)]");
            item.classList.remove("bg-[#f0f0f0]", "translate-y-[3px]");
            if (item.dataset.taskId === taskId.toString()) {
                item.classList.add("bg-[#f0f0f0]", "translate-y-[3px]");
                item.classList.remove("shadow-[0px_3px_0px_0px_rgba(0,0,0,1)]");
            }
        });
    } catch (error) {
        showAlert("error", error.message);
    }
}
// fungsi untuk tombol mengubah status task
window.toggleTaskStatus = function (taskId) {
    fetch(`/mytasks/${taskId}/toggle`, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            "Content-Type": "application/json",
        },
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                // location.reload(); // Refresh halaman untuk update tampilan
                const taskItem = document.querySelector(
                    `[data-task-id="${taskId}"]`
                );

                const toggleIcon = taskItem.querySelector(
                    ".toggle-task-status"
                );
                const successLable = document.querySelector(
                    `[data-lable-id="${taskId}"]`
                );
                const itemList = taskItem.querySelector(".title-task");
                if (data.is_complete) {
                    itemList.classList.add("line-through", "text-gray-500");
                    toggleIcon.classList.add("fa-circle-check");
                    toggleIcon.classList.remove("fa-circle");
                    successLable.classList.remove("hidden");
                } else {
                    itemList.classList.remove("line-through", "text-gray-500");
                    toggleIcon.classList.remove("fa-circle-check");
                    toggleIcon.classList.add("fa-circle");
                    successLable.classList.add("hidden");
                }
            } else {
                showAlert("error", "Failed to toggle task status.");
            }
        })
        .catch((error) => {
            console.error("Error:", error);
        });
};
// fungsi untuk menghapus task utama
document.addEventListener("click", function (event) {
    if (event.target.closest(".delete-task")) {
        let button = event.target.closest(".delete-task");
        let taskId = button.getAttribute("data-task-id");

        // alert delete task
        Swal.fire({
            title: "Are you sure?",
            text: "This task will be permanently deleted!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
            customClass: {
                popup: "custom-swal-popup",
                title: "custom-swal-title", // Untuk judul
                content: "custom-swal-content", // Untuk teks isi
                confirmButton: "custom-swal-delete-button",
                cancelButton: "custom-swal-cancel-button",
            },
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${taskId}`).submit();
            }
        });
    }
});

// Fungsi untuk menampilkan form edit task
async function showEditTask(taskId) {
    const taskDetailContainer = document.getElementById(
        "task-detail-container"
    );

    try {
        // Tampilkan loading sementara
        taskDetailContainer.innerHTML = `
            <div class="h-full flex items-center justify-center">
                <div class="animate-spin rounded-full h-16 w-16 border-b-2 border-black"></div>
            </div>`;

        // Fetch form edit dari server
        const response = await fetch(`/mytasks/${taskId}/edit`);
        if (!response.ok) throw new Error("Gagal mengambil form edit.");

        const html = await response.text();
        taskDetailContainer.innerHTML = html;
    } catch (error) {
        console.error(error);
    }
}

// fungsi untuk mensubmit hasil edit
async function updateTask(event, taskId) {
    event.preventDefault();

    const form = document.getElementById(`edit-task-form-${taskId}`);
    const formData = new FormData(form);

    try {
        const response = await fetch(`/mytasks/${taskId}`, {
            method: "POST",
            body: formData,
        });

        if (!response.ok) throw new Error("Gagal mengupdate task.");

        // nilai baru dari input
        const updateTitle = form.querySelector('input[name="title"]').value;

        // perbarui title tanpa refresh
        const titleElemen = document.querySelector(
            `.title-task[data-task-id="${taskId}"]`
        );
        if (titleElemen) {
            titleElemen.textContent = updateTitle;
        }
        showDetailTask(taskId); // Kembali ke tampilan detail setelah update
    } catch (error) {
        console.error(error);
    }
}

// =====subtask=====
document.addEventListener("click", async (event) => {
    if (event.target.id === "add-subtask-btn") {
        await handleAddSubtask();
    } else if (event.target.closest(".toggle-complete")) {
        await handleToggleSubtask(event);
    } else if (event.target.closest(".delete-subtask")) {
        await handleDeleteSubtask(event);
    }
});
// fungsi untuk membuat subtask
async function handleAddSubtask() {
    const title = document.getElementById("subtask-title").value.trim();
    const taskId = document.getElementById("current-task-id").value;

    if (!title) {
        showAlert("error", "Judul tidak boleh kosong");
        return;
    }
    fetch(`/mytasks/${taskId}/subtask`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
        body: JSON.stringify({ title: title }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.subtask) {
                // menyisipkan subtask baru tanpa refresh
                document
                    .getElementById("subtasks-container")
                    .insertAdjacentHTML("beforeend", data.html);

                // kosongkan kolong input subtask
                document.getElementById("subtask-title").value = "";
            } else {
                showAlert("error", "gagal menambahkan subtask");
            }
        })
        .catch((error) => showAlert("error", error.message));
}

// fungsi untuk mengganti status toggle subtask
async function handleToggleSubtask(event) {
    const subtaskElement = event.target.closest(".subtask-card");
    // id diambil dari subtask.blade
    const subtaskId = subtaskElement.dataset.id;

    try {
        const response = await fetch(`/subtasks/${subtaskId}`, {
            method: "PATCH",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },
        });

        if (!response.ok) throw new Error("Failed update the subtask");

        // const data = await response.json();

        // ambil ulang html dari server setelah update
        const newSubtaskHtml = await fetch(`/mytasks/${subtaskId}/html`);
        const newHtml = await newSubtaskHtml.text();

        // ganti elemen lama dengan html baru
        subtaskElement.outerHTML = newHtml;
    } catch (error) {
        showAlert("error", error.message);
    }
}
// fungsi untuk hapus subtask
async function handleDeleteSubtask(event) {
    const subtaskElement = event.target.closest(".subtask-card");
    // id diambil dari subtask.blade
    const subtaskId = subtaskElement.dataset.id;

    try {
        const response = await fetch(`/subtask/${subtaskId}`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },
        });

        if (!response.ok) throw new Error("Failed to delete the subtask");
        subtaskElement.remove();
    } catch (error) {
        showAlert("error", error.message);
    }
}

window.showDetailTask = showDetailTask;
window.showEditTask = showEditTask;
window.updateTask = updateTask;
