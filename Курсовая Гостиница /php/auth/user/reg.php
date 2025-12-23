<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../connect/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //получить данные из формы
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['password_repeat'];
        
        //проверка пароля
        if($password != $confirmPassword){
            exit('Пароли не совпадают');
        }
        
        //шаги по хэшированию пароля могут быть добавлены здесь
        
        //подготовить запрос
        $stmt = $conn->prepare('INSERT INTO users (name, surname, phone, email, password) VALUES (?, ?, ?, ?, ?)');
        
        //привязать параметры запроса
        $stmt->bind_param('sssss', $name, $surname, $phone, $email, $password);
        
        //выполнить запрос
        if($stmt->execute()){
            header("Location: /user/login.html");
            exit;
        } else{
            exit('Ошибка: ' . $conn->error);
        }
        
        $stmt->close();
}

$conn->close();