<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../connect/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $cost_per_day = $_POST['cost_per_day'];

    $sql = "INSERT INTO rooms (cost_per_day) VALUES (?)";

    if($stmt = mysqli_prepare($conn, $sql)){
        
        mysqli_stmt_bind_param($stmt, "i", $param_cost_per_day);

        $param_cost_per_day = $cost_per_day;

        if(mysqli_stmt_execute($stmt)){
            header("Location: /admin/rooms.php"); //Добавляем перенаправление на страницу rooms.php
            exit(); //Выходим из скрипта после перенаправления чтобы остановить выполнение последующего кода
        } else{
            echo "Что-то пошло не так. Пожалуйста, попробуйте еще раз.";
        }
       mysqli_stmt_close($stmt);
    }
}
mysqli_close($conn);
?>