<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация пользователя</title>
        <style>
        body {
            background-image: url('котики.jpg'); 
            background-size: cover;
            font-family: 'Arial', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        h2 {
            text-align: center;
            color: #45a049;
        }

        form {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['full_name']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['dob'])) {
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $dob = $_POST['dob'];
        echo "<p>Регистрация успешно завершена!</p>";
    } else {
        echo "<p>Пожалуйста, заполните все поля формы.</p>";
    }
}
?>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="full_name">
    <h2>Регистрация пользователя</h2> <br>
    ФИО:</label>
    <input type="text" name="full_name" required><br>

    <label for="username">Логин:</label>
    <input type="text" name="username" required><br>

    <label for="password">Пароль:</label>
    <input type="password" name="password" required><br>

    <label for="dob">Дата рождения:</label>
    <input type="date" name="dob" required><br>

    <input type="submit" value="Зарегистрироваться">
</form>

</body>
</html>
