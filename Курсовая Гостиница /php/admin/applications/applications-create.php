<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once '../../connect/connect.php';

// Проверка авторизации пользователя
if(!isset($_SESSION['user_id'])) {   
header('Location: /user/login.html'); // Перенаправление на страницу входа
exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $phone = preg_replace('![^0-9]+!', '', $_POST['phone']);
  $check_in_date = $_POST['check_in_date'];
  $check_out_date = $_POST['check_out_date'];

  $sql = "INSERT INTO applications (phone, check_in_date, check_out_date) VALUES (?, ?, ?)";

  if ($stmt = mysqli_prepare($conn, $sql)) {
      mysqli_stmt_bind_param($stmt, "sss", $phone, $check_in_date, $check_out_date);

      // Выполнить запрос
      if(mysqli_stmt_execute($stmt)) {
      $message = "Новая заявка: \nТелефон: " . $phone . "\nДата заселения: " . $check_in_date . "\nДата выселения: " . $check_out_date;
      mail('laxe.ambrose@yandex.ru', 'Новая заявка', $message);
      }
  }
  // Close statement
  mysqli_stmt_close($stmt);

  // Закрыть соединение
  mysqli_close($conn);

  // Перенаправить на предыдущую страницу
  header("Location: /");
  exit();
}
