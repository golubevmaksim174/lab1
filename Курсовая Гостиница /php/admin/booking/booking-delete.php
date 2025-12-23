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

        // Получаем значение room_id перед удалением записи
        $sql = "SELECT room_id FROM bookings WHERE id='{$del_id}'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $room_id = $row['room_id'];

        // Создаем запрос на удаление записи с даннм ID
        $delsql = "DELETE FROM bookings WHERE id='{$del_id}'";

        // Если запрос выполнен успешно, возвращаем "YES", в противном случае - "NO"
        if (mysqli_query($conn, $delsql)) {
            // Запрос на изменение is_occupied в таблице rooms
            $room_update_query = "UPDATE rooms SET is_occupied = 0 WHERE id='{$room_id}'";
            mysqli_query($conn, $room_update_query);
            echo "YES";
        } else {
            echo "NO";
        }
    }
  mysqli_close($conn);
?>