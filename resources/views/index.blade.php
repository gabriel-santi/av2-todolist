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

        .save {
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

        .overlay-edit,
        .overlay-new {
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
        }

        .task-window {
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

        .task-window h3 {
            position: relative;
            margin: 0;
            padding: 0;
            color: var(--dark-blue);
        }

        .task-window h3::after {
            content: '';

            position: absolute;

            width: 20%;
            height: 2px;
            bottom: -5px;
            left: 0;

            background-color: var(--dark-blue);
        }

        .cancel-save,
        .cancel-edit {
            border: 1px solid red;
            color: red;
        }

        .cancel-save:hover,
        .cancel-edit:hover {
            border: 1px solid #fff;
            background-color: red;
            color: #fff;
        }

        #deadline{
            width: 39px;
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
            background-color: #fff;
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

        .card-desc{
            font-family: Verdana, sans-serif;
            margin: 10px 0 30px 0;
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

        .card-date {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            margin: 0;
            font-size: 14px;
            color: var(--dark-grey);
        }

        .card-options button {
            padding: 10px;
            color: #000747;
            background-color: transparent;
            border: none;
        } 

        .btn-edit{
            border-right: 1px solid var(--dark-blue) !important;
        }

        .btn-edit:hover{
            background-color: #b0afff;
        }

        .btn-delete:hover{
            background-color: rgba(255, 0, 0, 0.3);
        }

    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
    <div class="overlay-new">
        <form id="form-new" class="task-window">
            <h3>Adicionar tarefa</h3>
            <input type="text" name="task" id="task" autocomplete="off" placeholder="Título da tarefa"
                required>
            <textarea id="desc" name="desc" cols="30" rows="10" placeholder="Adicione um descrição" required></textarea>
            <label for="deadline">Prazo:</label>
            <input type="datetime-local" name="deadline" id="deadline" autocomplete="off" placeholder="Adicione um prazo"
                required>
            <div class="btns">
                <button class="btn cancel-save">Cancelar</button>
                <input type="submit" class="btn save" value="Salvar" id="save">
            </div>
        </form>
    </div>

    <div class="overlay-edit">
        <form id="form-edit" class="task-window">
            <h3>Editar tarefa</h3>
            <input type="hidden" id="task-id">
            <input type="text-edit" name="task" id="task-edit" autocomplete="off" placeholder="Título da tarefa" required>
            <textarea id="desc-edit" name="desc" cols="30" rows="10" placeholder="Adicione um descrição"
                required></textarea>
            <label for="deadline">Prazo:</label>
            <input type="datetime-local" name="deadline" id="deadline-edit" autocomplete="off" placeholder="Prazo" required>
            <div class="btns">
                <button class="btn cancel-edit">Cancelar</button>
                <input type="submit" class="btn save" value="Salvar" id="edit">
            </div>
        </form>
    </div>
    <!-- END HIDDEN ELEMENTS -->

    <script>

        //INTERFACE
        $('.overlay-new').hide();
        $('.overlay-edit').hide();

        $('.add').on('click', () => {
            $('.overlay-new').show();
        })

        $('.cancel-save').on('click', () => {
            $('.overlay-new').hide();
        });
        $('.cancel-edit').on('click', () => {
            $('.overlay-edit').hide();
        });

        $('#save').on('click', () => {
            saveTask();
        });

        $('#edit').on('click', () => {
            edit()
        })

        //FUNCTIONS
        function formatDate(dateUnformated){
            
            // example of date not formated:    2022-06-22T16:42
            const DateAndHour = dateUnformated.split('T');
            [date, hour] = DateAndHour;
            date = date.split('-').reverse().join('/');
            date = `(${date})`;

            dateFormated = `${hour} ${date}`;
            return dateFormated;
        }

        function initialyze() {
            getTasks();
        }
        initialyze()

        function getTasks() {
            $.ajax({
                type: "GET",
                url: "http://127.0.0.1:8000/todolist",
                success: function (data) {
                    const tasksElement = document.querySelector(".container-cards");
                    if (data.length > 0) {
                        tasksElement.innerHTML = "";
                        for (let i = 0; i < data.length; i++) {
                                tasksElement.innerHTML += `
                                    <div class="card">
                                            <div class="card-text">
                                                <h4 class="card-title">${data[i].title}</h4>  
                                                <p class="card-desc">${data[i].description}</p>                      
                                                <p class="card-date">
                                                    <b>Prazo:</b> ${data[i].deadline}
                                                </p>
                                            </div >
                                        <div class="card-options">
                                            <button class="btn-edit" onclick="openEditModal(${data[i].id})">Editar</button>
                                            <button class="btn-delete" onclick="deleteTask(${data[i].id})">
                                                Deletar
                                            </button>
                                        </div>
                                    </div >`
                        }
                    } else {
                        tasksElement.innerHTML = 'Adicione alguma tarefa';
                    }
                },
                error: function (error) {
                    //alert(`Error ${error}`);
                    console.log("error\n",error);
                }
            })
        }

        function saveTask() {
            const title = document.getElementById('task').value;
            const desc = document.getElementById('desc').value;
            let deadline = document.getElementById('deadline').value;
            deadline = formatDate(deadline);

            if(title && desc && deadline){
                $.ajax({
                    type: "POST",
                    url: "/todolist",
                    data: {
                        title: title,
                        description: desc,
                        deadline: deadline
                    },
                    success: function (data) {
                        getTasks();
                    },
                    error: function (error) {
                        alert(`Error ${error}`);
                    }
                })
            }
        }

        function deleteTask(id) {
            $.ajax({
                type: "DELETE",
                url: `/todolist/${id}`,
                success: function (data) {
                    getTasks();
                },
                error: function (error) {
                    alert(`Error ${error}`);
                }
            })
        }

        function openEditModal(id) {
            $('.overlay-edit').show();
            $('#task-id').val(id);

            $.ajax({
                type: "GET",
                url: `/todolist/${id}`,
                success: function (data) {
                    $('#task-edit').val(data.title);
                    $('#desc-edit').val(data.description);
                    $('#deadline-edit').val(data.deadline);
                },
                error: function (error) {
                    alert(`Error ${error}`);
                }
            })
        }

        function edit() {
            const title = document.getElementById('task-edit').value;
            const desc = document.getElementById('desc-edit').value;
            const deadline = document.getElementById('deadline-edit').value;
            const id = $('#task-id').val();

            if(title && desc && deadline){
                $.ajax({
                    type: "PUT",
                    url: `/todolist/${id}`,
                    data: {
                        title: title,
                        description: desc,
                        deadline: deadline
                    },
                    success: function (data) {
                        getTasks();
                    },
                    error: function (error) {
                        alert(`Error ${error}`);
                    }
                })
            }
        }
    </script>
</body>

</html>