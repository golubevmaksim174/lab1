<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../connect/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем ID записи для удаления из тела запроса
    $contents = file_get_contents('php://input');
    $request = json_decode($contents, true);
    $del_id = mysqli_real_escape_string($conn, $request['del_id']);
  
    // Создаем запрос на удаление записи с даннм ID
    $delsql = "DELETE FROM rooms WHERE id='{$del_id}'";
  
    // Если запрос выполнен успешно, возвращаем "YES", в противном случае - "NO"
    if (mysqli_query($conn, $delsql)) {
      echo "YES";
    } else {
      echo "NO";
    }
  }
  mysqli_close($conn);