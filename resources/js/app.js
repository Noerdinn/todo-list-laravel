import "./bootstrap";

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
                location.reload(); // Refresh halaman untuk update tampilan
            } else {
                alert("Failed to toggle task status.");
            }
        })
        .catch((error) => {
            console.error("Error:", error);
        });
};

function showDetailTask(taskId) {
    $.ajax({
        url: `/tasks/${taskId}/subtasks`, // Mengambil data dari route
        type: "GET",
        dataType: "json",
        success: function (response) {
            // Ganti judul & deskripsi task utama
            $("#task-title").text(response.title);
            $("#task-desc").text(response.description);

            // Kosongkan dulu subtasks sebelumnya
            let subtasksContainer = $("#subtasks-container");
            subtasksContainer.empty();

            if (response.subtasks.length > 0) {
                // Tambahkan subtasks ke dalam container
                response.subtasks.forEach((subtask) => {
                    let statusIcon = subtask.is_complete
                        ? '<i class="text-xl fa-regular fa-circle-check"></i>'
                        : '<i class="text-xl fa-regular fa-circle"></i>';

                    let subtaskItem = `
                        <div class="flex justify-between py-2 px-4 mb-5 border-2 rounded-lg border-black shadow">
                            <div class="flex">
                                <button class="flex items-center">${statusIcon}</button>
                                <p class="mx-2 font-medium capitalize">${subtask.title}</p>
                            </div>
                        </div>`;

                    subtasksContainer.append(subtaskItem);
                });
            } else {
                subtasksContainer.append(
                    '<p class="text-gray-500">Tidak ada subtask.</p>'
                );
            }
        },
        error: function () {
            alert("Gagal mengambil data subtasks.");
        },
    });
}

// agar function bisa di panggil di blade
window.showDetailTask = showDetailTask;
