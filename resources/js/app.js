import "./bootstrap";
import "./alert";

// loading screen
window.addEventListener("load", () => {
    const loadingScreen = document.getElementById("loading-screen");
    if (loadingScreen) {
        setTimeout(() => {
            loadingScreen.classList.add("opacity-0");

            setTimeout(() => {
                loadingScreen.style.display = "none";
            }, 500);
        }, 500);
    }
});
document.addEventListener("DOMContentLoaded", () => {
    showDetailTask(null);
});

// fish eye
function togglePassword() {
    const passwordInput = document.getElementById("password");
    const type =
        passwordInput.getAttribute("type") === "password" ? "text" : "password";
    passwordInput.setAttribute("type", type);
}

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
        <div class="flex-1 font-MadeforDisplay flex flex-col items-center h-full justify-center">
            <div
                class="md:h-32 md:w-32 h-20 w-20 bg-white border-2 border-black rounded-lg shadow-[0_4px_0_0_rgba(0,0,0,1)] flex items-center justify-center mb-10">
                <p class="text-6xl md:text-8xl font-black">?</p>
            </div>
                <p class="text-xl md:text-2xl font-bold mb-2">Tidak ada task yang dipilih</p>
                <div class="flex items-center">
                    <p class="text-sm md:text-lg font-medium text-black/55 text-center text-balance">Tekan salah satu task untuk melihat detail.
                    </p>
            </div>
        </div>
        `;
        return;
    }

    try {
        const response = await fetch(`/mytasks/${taskId}/subtasks`);
        if (!response.ok) throw new Error("Gagal mengambil data subtasks.");
        fetchReminderTask();

        // menyisipkan content html
        const html = await response.text();
        taskDetailContainer.innerHTML = html;

        // Update task list styling
        document.querySelectorAll(".task-item").forEach((item) => {
            item.classList.add("shadow-[0px_3px_0px_0px_rgba(0,0,0,1)]");
            item.classList.remove("bg-[#EAE9E5]", "translate-y-[3px]");
            if (item.dataset.taskId === taskId.toString()) {
                item.classList.add("bg-[#EAE9E5]", "translate-y-[3px]");
                item.classList.remove("shadow-[0px_3px_0px_0px_rgba(0,0,0,1)]");
            }
        });
    } catch (error) {
        showAlert("error", error.message);
    }
}

async function fetchReminderTask() {
    try {
        const response = await fetch(`/mytasks/reminder`);

        if (!response.ok) {
            throw new Error("Gagal mengambil reminder");
        }

        const data = await response.json();

        console.log("late task: ", data.lateTask);

        getLateTask(data.lateTask);
    } catch (error) {
        console.error(error.message);
    }
}

function getLateTask(tasks) {
    tasks.forEach((task) => {
        const deadlineElement = document.querySelector(
            `[data-task-deadline='${task.id}']`
        );

        if (deadlineElement) {
            deadlineElement.classList.add("text-red-500");
            deadlineElement.insertAdjacentText("beforeend", "(Terlambat)");
        }
    });
}

// fungsi untuk tombol mengubah status task
window.toggleTaskStatus = function (taskId) {
    // location.reload();
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
                location.reload(); // Refresh halaman untuk update tampilan
                // icon task check/uncheck
                const toggleIcon = taskItem.querySelector(
                    ".toggle-task-status"
                );

                // satus is_complete
                const statusLable =
                    document.querySelector(".status-lable-task");
                // title task
                const itemList = taskItem.querySelector(".title-task");
                // reminder icon
                const reminderIcon = document.querySelector(
                    `[data-reminder-icon="${taskId}"]`
                );
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
    // soft delete
    if (event.target.closest(".delete-task")) {
        let button = event.target.closest(".delete-task");
        let taskId = button.getAttribute("data-task-id");

        // alert delete task
        Swal.fire({
            title: "Are you sure?",
            text: "This task will be deleted!",
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

    // hard delete
    if (event.target.closest(".force-delete-task")) {
        let button = event.target.closest(".force-delete-task");
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
                document.getElementById(`force-delete-form-${taskId}`).submit();
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
    const form = document.getElementById(`edit-task-form-${taskId}`);
    const formData = new FormData(form);

    try {
        // location.reload();
        const response = await fetch(`/mytasks/${taskId}`, {
            method: "POST",
            body: formData,
        });

        if (!response.ok) throw new Error("Gagal mengupdate task.");

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
window.togglePassword = togglePassword;
