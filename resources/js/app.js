import "./bootstrap";
import "./alert";

// window.toggleTaskStatus = function (taskId) {
//     fetch(`/mytasks/${taskId}/toggle`, {
//         method: "POST",
//         headers: {
//             "X-CSRF-TOKEN": document
//                 .querySelector('meta[name="csrf-token"]')
//                 .getAttribute("content"),
//             "Content-Type": "application/json",
//         },
//     })
//         .then((response) => response.json())
//         .then((data) => {
//             if (data.success) {
//                 location.reload(); // Refresh halaman untuk update tampilan
//             } else {
//                 alert("Failed to toggle task status.");
//             }
//         })
//         .catch((error) => {
//             console.error("Error:", error);
//         });
// };

function updateTaskStatus(taskId, isComplete) {
    const taskElement = document.querySelector(`[data-task-id="${taskId}"]`);
    if (!taskElement) return;

    const icon = taskElement.querySelector(".fa-regular");
    const title = taskElement.querySelector("p");

    if (isComplete) {
        icon.classList.replace("fa-circle", "fa-circle-check");
        title.classList.add("line-through");
    } else {
        icon.classList.replace("fa-circle-check", "fa-circle");
        title.classList.remove("line-through");
    }
}

document.addEventListener("DOMContentLoaded", () => {
    showDetailTask(null);
});

async function showDetailTask(taskId = null) {
    const taskDetailContainer = document.getElementById(
        "task-detail-container"
    );
    const currentTaskIdInput = document.getElementById("current-task-id");

    if (!taskId) {
        currentTaskIdInput.value = null;
        taskDetailContainer.innerHTML = `
        <div class="h-full flex items-center justify-center">
            <div class="text-center">            
            <i class="fa-solid fa-eye text-9xl text-gray-400 mb-4"></i>
                <p class="text-black text-lg">Tidak ada task yang dipilih.</p>
                <p class="text-black text-lg">Tekan icon mata pada task yang ingin ditampilkan.</p>
            </div>
        </div>`;
        return;
    }
    currentTaskIdInput.value = taskId;
    try {
        const response = await fetch(`/mytasks/${taskId}/subtasks`);
        if (!response.ok) throw new Error("Gagal mengambil data subtasks.");

        const taskData = await response.json();
        renderTaskDetail(taskData);
    } catch (error) {
        alert(error.message);
    }
}
// funsgi untuk merender bagian detail task, yg di dalamnya akan diisi subtask
function renderTaskDetail(taskData) {
    const taskDetailContainer = document.getElementById(
        "task-detail-container"
    );
    taskDetailContainer.innerHTML = `
    
    <div class="flex-grow-1 p-4">
        <div class="mb-3">
            <p class="text-xl font-medium me-2">Detail Task</p>
        </div>
        <h1 id="task-title" class="text-3xl font-semibold capitalize">${
            taskData.title
        }</h1>
        <div class="mt-4">
            <p class="text-lg font-medium mb-2">Description</p>
            <p id="task-desc" class="text-base font-normal ">${
                taskData.description
            }</p>
        </div>

        <div class="mt-4 ">
            <p class="text-lg font-medium mb-2">Tasks</p>

            <div id="subtasks-container">
                ${
                    taskData.subtasks.length
                        ? taskData.subtasks.map(renderSubtask).join("")
                        : ``
                }
            </div>
        </div>
    </div>
    <div class="sticky bottom-0 p-4 bg-white">
        <div class="flex items-center gap-3">
            <input type="text" id="subtask-title"
                class="border-2 border-black w-full p-2 rounded-lg outline-none placeholder:text-black"
                placeholder="Add new subtask">
            <button id="add-subtask-btn" class="bg-black text-white p-2 px-4 rounded-lg">+Add</button>
        </div>
    </div>


    `;
}

document.addEventListener("click", async (event) => {
    if (event.target.id === "add-subtask-btn") {
        await handleAddSubtask();
    } else if (event.target.closest(".toggle-complete")) {
        await handleToggleSubtask(event);
    } else if (event.target.closest(".delete-subtask")) {
        await handleDeleteSubtask(event);
    }
});
// fungsi untuk menambah subtask baru
async function handleAddSubtask() {
    const title = document.getElementById("subtask-title").value.trim();
    const taskId = document.getElementById("current-task-id").value;

    if (!title) return alert("Title cannot be empty");
    if (!taskId) return alert("Please select the task");

    try {
        const response = await fetch(`/mytasks/${taskId}/subtask`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },
            body: JSON.stringify({ title }),
        });

        if (!response.ok) throw new Error("Failed create new subtask");

        const data = await response.json();
        document
            .getElementById("subtasks-container")
            .insertAdjacentHTML("beforeend", renderSubtask(data.subtask));
        document.getElementById("subtask-title").value = "";

        // cek dan update staus dari subtask
        if (data.task) {
            updateTaskStatus(data.task.id, data.task.is_complete);
        }
    } catch (error) {
        alert(error.message);
    }
}
// fungsi untuk mengganti status toggle
async function handleToggleSubtask(event) {
    const subtaskElement = event.target.closest(".subtask-card");
    const subtaskId = subtaskElement.dataset.id;

    try {
        const response = await fetch(`/subtask/${subtaskId}`, {
            method: "PATCH",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },
        });

        if (!response.ok) throw new Error("Failed update the subtask");

        const data = await response.json();
        subtaskElement.outerHTML = renderSubtask({
            id: subtaskId,
            title: subtaskElement.querySelector("p").textContent,
            is_complete: data.is_complete,
        });

        if (data.task) {
            updateTaskStatus(data.task.id, data.task.is_complete);
        }
    } catch (error) {
        alert(error.massage);
    }
}
// fungsi untuk hapus subtask
async function handleDeleteSubtask(event) {
    const subtaskElement = event.target.closest(".subtask-card");
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

        const data = await response.json();
        subtaskElement.remove();

        // update parent status
        if (data.task) {
            updateTaskStatus(data.task.id, data.task.is_complete);
        }
        // if (!document.querySelector("#subtasks-container").children.length) {
        //     document.getElementById(
        //         "subtasks-container"
        //     ).innerHTML = `<p class="text-white bg-black text-center">Tidak ada subtask. function delete</p>`;
        // }
    } catch (error) {
        alert(error.message);
    }
}
// fungsi sebagai template dari subtask
function renderSubtask(subtask) {
    return `
        <div class="subtask-card flex justify-between py-2 px-4 mb-5 border-2 rounded-lg border-black shadow-[0px_5px_0px_0px_rgba(0,0,0,1)]" data-id="${
            subtask.id
        }">
            <div class="flex">
                <button class="toggle-complete flex items-center">
                    ${
                        subtask.is_complete
                            ? '<i class="text-xl fa-regular fa-circle-check"></i>'
                            : '<i class="text-xl fa-regular fa-circle"></i>'
                    }
                </button>
                <p class="mx-2 font-medium capitalize ${
                    subtask.is_complete ? "line-through text-gray-600" : ""
                }">
                    ${subtask.title}</p>
            </div>
            <div class="flex">
                <div class="flex h-full">
                    <button class="delete-subtask flex h-full items-center">
                        <i class="fa-regular fa-circle-xmark text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    `;
}

window.showDetailTask = showDetailTask;
