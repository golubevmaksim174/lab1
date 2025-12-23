<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../connect/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $room_id = $_POST['room_id'];
    $phone = preg_replace('![^0-9]+!', '', $_POST['phone']);
    $email = $_POST['email'];
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];

    // Получаем стоимость за день для указанного room_id из таблицы rooms
    $price_query = "SELECT cost_per_day FROM rooms WHERE id = ?";
    if ($price_stmt = mysqli_prepare($conn, $price_query)) {
        mysqli_stmt_bind_param($price_stmt, "s", $room_id);
        mysqli_stmt_execute($price_stmt);
        $price_result = mysqli_stmt_get_result($price_stmt);
        $price_row = mysqli_fetch_array($price_result, MYSQLI_ASSOC);
        $price = $price_row['cost_per_day'];
        mysqli_stmt_close($price_stmt);
    } else {
        echo "Ошибка: " . mysqli_error($conn);
    }

    $date1 = new DateTime($check_in_date);
    $date2 = new DateTime($check_out_date);
    $interval = $date1->diff($date2);
    $days = $interval->days;
    
    $price = $price * $days;

    $sql = "INSERT INTO bookings (room_id, name, phone, check_in_date, email, check_out_date, price) VALUES (?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssssss", $room_id, $name, $phone, $check_in_date, $email, $check_out_date, $price);

        // Выполняем запрос
        if (mysqli_stmt_execute($stmt)) {
            // Закрываем предложение
            mysqli_stmt_close($stmt);
    
            // Обновляем статус is_occupied в таблице rooms
            $update_sql = "UPDATE rooms SET is_occupied = 1 WHERE id = ?";
            if ($update_stmt = mysqli_prepare($conn, $update_sql)) {
                mysqli_stmt_bind_param($update_stmt, "s", $room_id);

                // Выполняем запрос на обновление
                mysqli_stmt_execute($update_stmt);

                // Закрываем подготовленное выражение
                mysqli_stmt_close($update_stmt);
            } else {
                echo "Ошибка при обновлении статуса комнаты: " . mysqli_error($conn);
            }

            // Закрываем соединение
            mysqli_close($conn);
          
            // Перенаправляем на предыдущую страницу
            header("Location: /admin/bookings.php");
            exit();
        } else {
            echo "Ошибка: " . mysqli_error($conn);
        }
        
    } else {
        echo "Ошибка: " . mysqli_error($conn);
    }
}
?>