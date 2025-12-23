<?php
session_start();
// Проверка, был ли авторизован пользователь
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true){
    // Если нет, перенаправяем его на главную страницу
    header("location: /index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Профиль</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0"
            style="background: rgb(240,95,64);">
            <div class="container-fluid d-flex flex-column p-0"><a
                    class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0"
                    href="/index.php" style="padding: 0px;width: 125px;">
                    <div class="sidebar-brand-icon rotate-n-15"></div>
                    <div class="sidebar-brand-text mx-3"><span>Elite<br>Элитный отель</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="bron.php"><i
                                class="far fa-calendar-check"></i>&nbsp;Бронирование</a></li>
                    <li class="nav-item"><a class="nav-link active" href="profile.html"><i
                                class="fas fa-user"></i>&nbsp;Профиль</a></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"><a class="nav-link" href="../php/auth/user/logout.php"><i
                                class="fas fa-user-circle"></i><span>Выход</span></a></li>
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
                            <p class="text-primary m-0 fw-bold" style="color: rgb(240,95,64)!important;">Мое бронирование
                            </p><button class="btn btn-primary d-xl-flex justify-content-xl-end" type="button"
                                style="background: rgb(240,95,64);border-width: 0px;" data-bs-toggle="modal"
                                data-bs-target="#modal-1">Добавить бронь</button>
                                <button class="btn btn-primary d-xl-flex justify-content-xl-end" type="button"
                                style="background: rgb(240,95,64);border-width: 0px;" data-bs-toggle="modal"
                                data-bs-target="#modal-1">Редактировать бронь</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable-1" role="grid"
                                aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Имя</th>
                                            <th>Телефон</th>
                                            <th>Комната</th>
                                            <th>Дата заезда</th>
                                            <th>Дата выезда</th>
                                            <th>Стоимость (руб)</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Джон</td>
                                            <td>+7 999 999 99 99</td>
                                            <td>Комната 1</td>
                                            <td>2008/11/28</td>
                                            <td>2008/11/28</td>
                                            <td>1500</td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>