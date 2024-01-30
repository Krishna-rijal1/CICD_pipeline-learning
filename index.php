<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Todo App (PHP)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .todo-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        li input {
            margin-right: 10px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="todo-container">
        <h1>Todo List (PHP)</h1>
        <form method="post">
            <input type="text" name="taskInput" placeholder="Add a new task">
            <button type="submit" name="addTask">Add Task</button>
        </form>

        <ul>
            <?php
            // Display existing tasks
            $tasks = file('tasks.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($tasks as $task) {
                echo '<li><input type="checkbox">' . htmlspecialchars($task) . '</li>';
            }

            if (isset($_POST['addTask'])) {
                // Add new task
                $newTask = trim($_POST['taskInput']);
                if (!empty($newTask)) {
                    file_put_contents('tasks.txt', $newTask . PHP_EOL, FILE_APPEND | LOCK_EX);
                }
                // Refresh the page to show the updated task list
                header('Location: ' . $_SERVER['PHP_SELF']);
                exit;
            }
            ?>
        </ul>
    </div>
</body>
</html>
