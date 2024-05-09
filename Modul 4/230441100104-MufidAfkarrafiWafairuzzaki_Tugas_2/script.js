let tasks = [];

document.addEventListener("DOMContentLoaded", function() {
    const savedTasks = localStorage.getItem("tasks");
    if (savedTasks) {
        tasks = JSON.parse(savedTasks);
        renderTasks();
    }
});

function addTask() {
    const taskInput = document.getElementById("taskInput");
    const taskText = taskInput.value.trim();
    if (taskText !== "") {
        tasks.push({ text: taskText, completed: false });
        saveTasks();
        renderTasks();
        taskInput.value = "";
    }
}

function editTask(index) {
    const newTaskText = prompt("Ganti Kegiatan :", tasks[index].text);
    if (newTaskText !== null) {
        tasks[index].text = newTaskText.trim();
        saveTasks();
        renderTasks();
    }
}

function toggleTask(index) {
    tasks[index].completed = !tasks[index].completed;
    saveTasks();
    renderTasks();
}

function deleteTask(index) {
    tasks.splice(index, 1);
    saveTasks();
    renderTasks();
}

function saveTasks() {
    localStorage.setItem("tasks", JSON.stringify(tasks));
}

function renderTasks() {
    const taskList = document.getElementById("taskList");
    taskList.innerHTML = "";
    tasks.forEach((task, index) => {
        const li = document.createElement("li");
        if (task.completed) {
            li.innerHTML = `<s>${task.text}</s> ✓`; 
        } else {
            li.textContent = task.text;
        }
        li.addEventListener("dblclick", () => editTask(index));
        
        li.addEventListener("click", () => toggleTask(index));

        const deleteButton = document.createElement("button");
        deleteButton.textContent = "x";
        deleteButton.addEventListener("click", (event) => {
            event.stopPropagation(); 
            deleteTask(index);
        });

        const taskContainer = document.createElement("div");
        taskContainer.classList.add("task-container");
        taskContainer.appendChild(li);
        taskContainer.appendChild(deleteButton);

        taskList.appendChild(taskContainer);
    });
}

const taskInput = document.getElementById("taskInput");
taskInput.addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        addTask();
    }
});
