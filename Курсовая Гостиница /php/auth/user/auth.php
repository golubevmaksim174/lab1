<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../connect/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //получить данные из формы
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    //подготовить запрос
    $stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
    
    //привязать параметры запроса
    $stmt->bind_param('s', $email);
    
    //выполнить запрос и сохранить результат
    $stmt->execute();
    $result = $stmt->get_result();
    
    //проверяем есть ли пользователь с таким email
    if($result->num_rows === 0){
        exit('Не найден пользователь с таким email');
    } else{
        //получаем данные пользователя
        $user = $result->fetch_assoc();
        
        //проверяем пароль
        if($password === $user['password']){
            // если пароль верный, запускаем сессию и сохраняем данные пользователя
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['logged_in'] = true;
            $_SESSION['admin'] = $user['admin'];
            header("Location: /user/profile.php"); //перенаправить на страницу профиля
            exit; 
        } else{
            exit('Неправильный пароль');
        }
    }
    
    $stmt->close();
}

$conn->close();