async function openDetails(id) {
    let rightModal = document.querySelector(".task_details");
    let right_modal = document.querySelector(".right_modal");
    rightModal.setAttribute("aria-hidden", false);
    const apiUrl = `${root}/api/get_task/${id}`;
    fetch_data(apiUrl,"GET").then(tasks => {
        const task = tasks.data;

        // set value to task details modal
        document.querySelector('#d_task_name').innerHTML = task.task_name;
        document.querySelector('#d_task_status').innerHTML = task.task_status;
        document.querySelector('#d_task_date').innerHTML = `${formatDate(task.estimation_from)} - ${formatDate(task.estimation_to)}`;
        document.querySelector('#d_task_type').innerHTML = task.task_type;
        document.querySelector('#d_task_prior').innerHTML = task.priority;
        document.querySelector('#d_task_desc').innerHTML = task.description;
        document.querySelector('#task_id').value = id;

        // Add action of task details form
        document.querySelector('#task_details_form')
            .setAttribute("action",`${root}/update_task/${id}`);
        
        $prior = {'Low': "low", 'High': "high", 'Medium': "md",};
        $type = {'Bug': "error", 'Feature': "info", 'Improvement': "success",};
        
        document.querySelector('#type_color').className = "type";
        document.querySelector('#prior_color').className = "priority";

        document.querySelector('#type_color').classList.add($type[task.task_type]);
        document.querySelector('#prior_color').classList.add($prior[task.priority]);
    })

    // Close modal
    right_modal.addEventListener('click', function(event) {
        if(event.target === event.currentTarget) {
            closeTaskDetails();
        }
    });

}

// Date Formatting
function formatDate(inputDate) {

    const date = new Date(`${inputDate}`);

    const formattedDate = `${date.getDate()} ${date.toLocaleString('en-US', { month: 'short' })} ${date.getFullYear()}`;
    
    return formattedDate;
}

// Delete Task
const deleteTask = id => {
    let query = confirm("Do you want to delete task?");
    const apiUrl = `${root}/api/delete_task/${id}`;
    fetch_data(apiUrl, "DELETE").then(task => {
        if(task.data) {
            window.location.reload();
        }
    });
}

const fetch_data = async (apiUrl, method) => {
    try {
        const response = await fetch(apiUrl, {
            method,
            headers: {
                'Content-Type': 'application/json',
            },
        });
    
        if (response.ok) {
            const data = await response.json();
            return data;
        } else {
            console.error('Failed to fetch task:', response.status);
        }
    } catch (error) {
        console.error('Error fetching task:', error);
    }
}



function openAddTask() {
    let addTask = document.querySelector('.openTask');
    addTask.addEventListener('click', function(event) {
        if(event.target === event.currentTarget) {
            closeAddTask();
        }
    })
    addTask.setAttribute("aria-hidden", false);
}

const closeAddTask = () => {
    let addTask = document.querySelector('.openTask');
    addTask.setAttribute("aria-hidden", true);
}
const closeTaskDetails = () => {
    let addTask = document.querySelector('.task_details');
    addTask.setAttribute("aria-hidden", true);
}

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        closeAddTask();
        closeTaskDetails();
    }
});