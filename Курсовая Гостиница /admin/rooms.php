<?php
session_start();
// Проверка, был ли авторизован пользователь
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true){
    // Если нет, перенаправляем его на главную страницу
    header("location: /index.php");
    exit;
}
// Проверка, является ли пользователь админом
if($_SESSION["admin"] !== 1){
    // Если нет, перенаправляем его на страницу профиля
    header("location: /index.php");
    exit;
}
// Если пользователь является админом, он может открыть эту страницу
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Комнаты</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
    <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0"
            style="background: rgb(240,95,64);">
            <div class="container-fluid d-flex flex-column p-0"><a
                    class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="/index.php"
                    style="padding: 0px;width: 125px;">
                    <div class="sidebar-brand-icon rotate-n-15"></div>
                    <div class="sidebar-brand-text mx-3"><span>Elite<br>Элитный отель</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item">
                        <a class="nav-link" href="applications.php">
                            <i class="far fa-user-circle"></i>
                            <span>Комнаты</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="bookings.php">
                            <i class="fas fa-table"></i>
                            <span>Бронирование</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="clients.html"><i class="far fa-user"></i><span>Клиенты</span></a></li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="rooms.php">
                            <i class="fas fa-table"></i>
                            <span>Комнаты</span>
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../php/auth/user/logout.php"><i
                                class="far fa-user-circle"></i><span>Выход</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0"
                        id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
              
                <div class="container-fluid">
                    <div class="card shadow">
                        <div class="card-header d-xl-flex justify-content-between align-items-xl-center py-3">
                            <p class="text-primary m-0 fw-bold" style="color: rgb(240,95,64)!important;">Комнаты</p>
                            <button class="btn btn-primary d-xl-flex justify-content-xl-end" type="button"
                                style="background: rgb(240,95,64);border-width: 0px;" data-bs-toggle="modal"
                                data-bs-target="#modal-1">Добавить комнату</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Стоимость в сутки</th>
                                            <th>Статус</th>
                                            <th class="text-center">Примечание</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    require_once '../php/connect/connect.php';
                                    $sql = "SELECT * FROM rooms ORDER BY id DESC";// Запрос для выборки всех заявок
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $occupiedText = $row['is_occupied'] ? '<span class="text-warning font-weight-bold">Занята</span>' : '<span class="text-success font-weight-bold">Свободна</span>';
                                            echo "
                                                <tr>
                                                <td>" . $row['id'] . "</td>
                                                <td>" . $row['cost_per_day'] . "</td>
                                                <td>" . $occupiedText . "</td>
                                                <td style='text-align: center;'>
                                                    <button type='button' name='delete' id='" . $row["id"] . "' class='delete btn btn-primary'><i class='far fa-trash-alt'></i></button>
                                                </td>
                                                </tr>
                                            ";
                                        }
                                    } else {
                                        echo 'Не найдено не одной комнаты. Самое время добавить новую!';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" role="dialog" tabindex="-1" id="modal-1">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Добавить комнату</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="../php/admin/rooms/rooms-create.php" method="POST">
                                <div class="modal-body" style="border-color: rgb(133, 135, 150);border-top-color: rgb(133,;border-right-color: 135,;border-bottom-color: 150);border-left-color: 135,;">
                                        <input class="form-control" type="number" placeholder="Введите стоимость в сутки" style="width: 100%;height: 38px;padding: 0px;margin-top: 10px;border-radius: 5.6px;padding-right: 12px;padding-left: 11px;border-width: 1px;border-color: var(--bs-gray-500);" name="cost_per_day">
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">Закрыть</button>
                                    <button class="btn btn-primary" type="submit" style="background: rgb(240,95,64);border-width: 0px;">Сохранить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Курсовая работа - Мулякова Наталья Ивановна © SOHO
                            HOSTEL 2023-2024</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/script.min.js"></script>

    <!-- Удаление заявки  -->
    <script>
        document.querySelectorAll(".delete").forEach(button =>
            button.addEventListener("click", function() {
                let confirmation = window.confirm("Вы уверены, что хотите удалить эту запись?");
                if (confirmation) {
                    let del_id = this.id;
                    let $ele = this.parentNode.parentNode;
                    fetch("../php/admin/rooms/rooms-delete.php", {
                            method: "POST",
                            body: JSON.stringify({
                                del_id
                            }),
                            headers: {
                                "Content-type": "application/json; charset=UTF-8"
                            }
                        })
                        .then(response => response.text())
                        .then(data => {
                            if (data == "YES") {
                                $ele.style.display = "none";
                            } else {
                                alert("Не удалось удалить строку");
                            }
                        });
                }
            })
        );
    </script>
</body>

</html>