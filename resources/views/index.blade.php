<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de tarefas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800&family=Playfair+Display&family=Quicksand:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --dark-blue: #000b76;
            --light-blue: #c6c8db;
            --light-grey: #b8b8b8;
            --dark-grey: #505050;
            --green: #00e900;
            --red: #ff0000;
        }

        body {
            margin: 0;
            padding: 0;
            position: relative;
            height: 100vh;
        }

        * {
            font-family: 'Orbitron', sans-serif;
            box-sizing: border-box;
            transition: .3s;
        }

        button {
            cursor: pointer;
        }

        .bg-img {
            z-index: -1;
            position: absolute;
            bottom: 0;
            right: 0;
            width: 100vw;
        }

        header {
            width: 100vw;
            text-align: center;
            padding: 5px;
            box-shadow: rgba(0, 0, 0, 0.253) 0px 5px 5px;
        }

        header h1 {
            color: var(--dark-blue);
        }

        .container {
            width: 80vw;
            height: 80vh;
            margin: 20px auto;
            padding: 20px;
            border-radius: 3px;

            background-color: rgba(148, 148, 148, 0.233);
            backdrop-filter: blur(2px);

            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--dark-blue);
        }

        input:focus,
        textarea:focus {
            outline: 0;
            box-shadow: 0 0 8px #000c76af;
        }

        #add {
            width: 20%;
            margin: 0 auto;
        }

        #save{
            cursor: pointer;
            width: 20%;
        }

        .btn {
            font-size: 16px;
            color: var(--dark-blue);
            background-color: #fff;
            border: 1px solid var(--dark-blue);
            padding: 10px;
        }

        .btn:hover {
            background-color: var(--dark-blue);
            color: #fff;
            border: 1px solid #fff;
        }

        .overlay {
            width: 100vw;
            height: 100vh;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;

            background-color: #00000085;

            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;

            display: none;
        }

        .new-task-window {
            background-color: var(--light-blue);

            padding: 50px;
            width: 50%;
            margin: 0 auto;
            border-radius: 3px;

            display: flex;
            flex-direction: column;
            gap: 20px;

            box-shadow: 0 0 15px rgba(0, 0, 0, 0.616);
        }

        .new-task-window h3 {
            position: relative;
            margin: 0;
            padding: 0;
            color: var(--dark-blue);
        }

        .new-task-window h3::after {
            content: '';

            position: absolute;

            width: 20%;
            height: 2px;
            bottom: -5px;
            left: 0;

            background-color: var(--dark-blue);
        }

        .cancel {
            border: 1px solid red;
            color: red;
        }

        .cancel:hover {
            border: 1px solid #fff;
            background-color: red;
            color: #fff;
        }

        .container-cards {
            overflow-y: scroll;

            padding: 20px;
            margin: 20px auto;

            width: 90%;
            max-height: 85%;

            display: flex;
            flex-flow: row wrap;
            justify-content: space-around;
            gap: 50px;
        }

        .container-cards::-webkit-scrollbar {
            width: 10px;
        }

        .container-cards::-webkit-scrollbar-thumb {
            background-color: #b0afff;
            border-radius: 10px;
        }

        .container-cards::-webkit-scrollbar-track {
            background-color: #000b76;
            border-radius: 10px;
        }

        .card {
            border-radius: 3px;
            background-color: #f3f3f3;
            border: 1px solid var(--dark-blue);

            padding: 20px;
            min-height: 10vh;
            width: 100%;

            position: relative;

            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: flex-start;

            animation: show .2s ease-out;
        }

        @keyframes show {
            0% {
                opacity: 0;
            }

            50% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .card-text {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            word-break: break-all;
        }

        .card-title {
            font-size: 20px;
            margin: 0;
            color: var(--dark-blue);
        }

        .card-options {
            position: absolute;
            top: 0;
            right: 0;
            display: flex;
            flex-flow: row;
            align-items: flex-start;
            justify-content: center;
        }

        .card-options button {
            padding: 10px;
            background-color: transparent;
            border: none;
        }

        .card-options button:hover {
            background-color: #b0afff;
        }

        .card-options img {
            width: 35px;
        }

        .card-date {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            margin: 0;
            font-size: 14px;
            color: var(--dark-grey);
        }

        .message {
            margin: 0;
            color: red;
            font-size: 14px;
            display: none;
        }
    </style>
</head>

<body>

    <header>
        <h1>To-do list</h1>
    </header>

    <section>
        <svg class="bg-img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#000b76" fill-opacity="1"
                d="M0,64L48,85.3C96,107,192,149,288,149.3C384,149,480,107,576,117.3C672,128,768,192,864,192C960,192,1056,128,1152,122.7C1248,117,1344,171,1392,197.3L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
            </path>
        </svg>
        <div class="container">
            <button id="add" class="btn add">Adicionar</button>
            <div class="container-cards">
            </div>
        </div>
    </section>

    <!-- HIDDEN ELEMENTS -->
    <div class="overlay">
        <form class="new-task-window">
            <h3>Adicionar tarefa</h3>
            <input type="text" name="task" id="task" autocomplete="off" placeholder="Título da tarefa" autofocus required>
            <textarea id="desc" name="desc" cols="30" rows="10" placeholder="Adicione um descrição" required></textarea>
            <input type="text" name="deadline" id="deadline" autocomplete="off" placeholder="Prazo" required>
            <p class="message error-add">* Preencha todos os campos antes de salvar!</p>
            <div class="btns">
                <button id="cancel" class="btn cancel">Cancelar</button>
                <input type="submit" class="btn save" value="Salvar" id="save">
            </div>
        </form>
    </div>
    <!-- END HIDDEN ELEMENTS -->

    <script>
        let tasks = [];
        function renderTasks() {
            const containerCards = document.querySelector('.container-cards')
            containerCards.innerHTML = '';

            tasks.forEach(taskObj => {
                containerCards.innerHTML += `
                <div class="card" id="${taskObj.id}">
                        <div class="card-text">
                            <h4 class="card-title">${taskObj.task}</h4>  
                            <p class="card-desc">${taskObj.description}</p>                      
                            <p class="card-date">
                                <b>Criado:</b> ${taskObj.date}
                                <br>
                                <b>Última atualização:</b> ${taskObj.deadline}</p>
                            <p class="message error-edit">*Preencha todos os campos!</p>
                        </div >
                    <div class="card-options">
                        <button class="btn-edit" onclick="openEditBox(${taskObj.id})">
                            Editar
                        </button>
                        <button class="btn-delete" onclick="removeTask(${taskObj.id})">
                            Deletar
                        </button>
                    </div>
                </div >
                `
            })
        }

        //ELEMENTS TO BE MANIPULATED
        const buttonAdd = document.querySelector("#add");
        const buttonCloseModal = document.querySelector('#cancel');
        const overlay = document.querySelector('.overlay');
        const inputTask = document.querySelector('#task');
        const inputDesc = document.querySelector('#desc');
        const inputDeadline = document.querySelector('#deadline');
        const AddErrorMessage = document.querySelector('.error-add');
        const btnSave = document.querySelector('#save');

        //TOGGLE WINDOW FOR ADD TASKS
        function openAddModal() {
            overlay.style.display = 'flex';
            inputTask.focus();
        }

        function closeAddModal() {
            overlay.style.display = 'none';
            inputTask.value = '';
            inputDesc.value = '';
            inputDeadline.value = '';
        }

        buttonAdd.addEventListener('click', openAddModal);
        buttonCloseModal.addEventListener('click', closeAddModal);

        //VALIDATE ADD INPUTS
        function validateAddInput() {
            if (inputTask.value.trim().length > 0 
            && inputDesc.value.trim().length > 0 
            && inputDeadline.value.trim().length >0) {
                addNewTask();
                closeInvalidAddInput();
                closeAddModal();
            } else {
                showInvalidAddInput()
            }
        }

        function showInvalidAddInput() {
            AddErrorMessage.style.display = 'block';
        }

        function closeInvalidAddInput() {
            AddErrorMessage.style.display = 'none';
        }

        //ADD NEW TASKS
        function addNewTask() {
            const task = inputTask.value;
            const description = inputDesc.value;
            const dateString = formatDate();
            const deadline = inputDeadline.value;
            const id = idGenerator();

            tasks.push({ task, description, date: dateString, deadline, id });
            renderTasks();
        }

        function formatDate() {
            const date = new Date();
            const year = date.getFullYear();
            const month = date.getMonth();
            const day = date.getDate();
            let minutes = date.getMinutes();
            let hour = date.getHours();

            if (minutes < 10) {
                minutes = `0${minutes}`;
            }
            if (hour < 10) {
                hour = `0${hour}`
            }

            return `${day}/${month}/${year} - ${hour}:${minutes}`
        }

        function idGenerator() {
            return Date.now();
        }

        btnSave.addEventListener('click', validateAddInput);
        inputTask.addEventListener('keydown', e => {
            if (e.key == "Enter") {
                inputDesc.focus();
            }
        })
        inputDesc.addEventListener('keydown', e => {
            if(e.key == "Enter"){
                inputDeadline.focus();
            }
        })
        inputDeadline.addEventListener('keydown', e => {
            if (e.key == "Enter") {
                validateAddInput();
            }
        })
        

        //TASK OPTIONS FUNCTIONS ====================================

        function removeTask(id) {
            tasks = tasks.filter(task => task.id != id);
            renderTasks();
        }

        function openEditBox(id) {
            const [taskObj] = tasks.filter(task => task.id == id);
            const cardElement = document.getElementById(`${id}`);
            const cardTitle = cardElement.querySelector('.card-title');
            const cardDesc = cardElement.querySelector('.card-desc');

            cardTitle.innerHTML = `<input type='text' class='edit-box-title' value='${taskObj.task}'>`
            cardDesc.innerHTML = `<textarea class='edit-box-desc' cols='50' rows='5'>${taskObj.description}</textarea>`

            const editTaskElement = cardTitle.querySelector('.edit-box-title');
            const editDescElement = cardDesc.querySelector('.edit-box-desc');
            editTaskElement.focus();

            editTaskElement.addEventListener('keydown', e => {
                if (e.key == 'Enter') {
                    editDescElement.focus();
                }
            })

            editDescElement.addEventListener('keydown', e => {
                if (e.key == 'Enter') {
                    if (editTaskElement.value.trim().length > 0 && editDescElement.value.trim().length > 0) {
                        const task = editTaskElement.value;
                        const desc = editDescElement.value;
                        editTask(task, desc, id);
                        closeInvalidEditError(cardElement);
                    } else {
                        showInvalidEditError(cardElement);
                    }
                }
            })
        }

        function showInvalidEditError(element) {
            element.querySelector('.message').style.display = 'block';
        }

        function closeInvalidEditError(element) {
            element.querySelector('.message').style.display = 'none';
        }

        function editTask(task, desc, id) {
            tasks.forEach(taskObj => {
                if (taskObj.id == id) {
                    taskObj.task = task;
                    taskObj.description = desc;
                    taskObj.lastChange = formatDate();
                }
            });
            renderTasks();
        }
    </script>
</body>

</html>