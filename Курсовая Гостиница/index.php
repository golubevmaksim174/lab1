<?php
   session_start(); 
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Elite Home</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>

    <body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="57">
        <nav class="navbar navbar-light navbar-expand-lg fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top" style="font-size: 29px;">
                    Elite
                    <p style="font-size: 11px;">Элитный отель</p>
                </a>
                <button data-bs-toggle="collapse" data-bs-target="#navbarResponsive" class="navbar-toggler navbar-toggler-right" type="button" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-align-justify"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="#">О ХОСТЕЛЕ</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">КОНТАКТЫ</a></li>
                        <?php
                            if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true){
                                if(isset($_SESSION["admin"]) && $_SESSION["admin"] === 1){
                                    echo '
                                        <li class="nav-item"><a class="nav-link" href="/admin/applications.php">АДМИН</a></li>
                                    ';
                                } 
                                echo '
                                    <li class="nav-item"><a class="nav-link" href="/user/profile.php">ПРОФИЛЬ</a></li>
                                ';
                            } else {
                                echo '<li class="nav-item"><a class="nav-link" href="/user/login.html">ВХОД</a></li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <header id="header" class="text-center text-white d-flex masthead" style="background: url(&quot;assets/img/fon.jpg&quot;);background-size: cover;">
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-10 col-xl-6 mx-auto">
                        <h1 class="text-uppercase"><strong>Чистота и комфорт!</strong></h1>
                        <hr>
                    
                        <form action="php/admin/applications/applications-create.php" style="padding: 30px;margin: 0px; background:rgba(204, 204, 204, 0.4); border-radius: 30px" method="POST" id="formApplication">
                            <fieldset>
                                <label for="phone" style="display: block;text-align: left;font-size: 16px; font-weight:600;margin-bottom: 0px;margin-top: 20px;">Введите ваш номер телефона:</label>
                                <input class="form-control form-control-lg phone_mask" type="text" style="margin-top: 10px;padding-top: 0;border-radius: 5.6px;" placeholder="+7 (___)-___-__-__" name="phone" id="phone">
                            </fieldset>
                            <fieldset>
                                <label for="check_in_date" style="display: block; text-align: left;font-size: 16px; font-weight:600;margin-bottom: 0px;margin-top: 20px;">Выберите дату заселения:</label>
                                <input name="check_in_date" id="check_in_date" class="form-control form-control-lg" type="date" style="margin: 0;margin-top: 10px;border-radius: 5.6px;">
                            </fieldset>
                            <fieldset>
                                <label for="check_out_date" style="display: block;text-align: left;font-size: 16px ;font-weight:600;margin-bottom: 0px;margin-top: 20px;">Выберите дату выселения:
                </label>
                                <input name="check_out_date" id="check_out_date" class="form-control form-control-lg" type="date" style="margin: 0;margin-top: 10px;border-radius: 5.6px;">
                            </fieldset>
                            <button type="submit" class="btn btn-primary btn-xl" role="button" style="margin-top: 33px;width: 100%;max-width: auto;border-radius: 5.6px;">Забронировать по акции
              </button>
                        </form>
                        <hr>
                    </div>
                </div>
                <div class="col-lg-8 mx-auto">
                    <p class="text-faded mb-5"><strong><span style="color: #fff;">Более&nbsp;</span><span
                            style="color: #F05F40;">500</span><span
                            style="color: #fff;">&nbsp;клиентов нам доверяют
                            ежедневно!</span></strong>
                        <br><strong></p>
                </div>
            </div>
        </header>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/script.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>
        <script>
            document.getElementById('formApplication').onsubmit = function() {
                var now = new Date();
                var today = new Date(now.getFullYear(), now.getMonth(), now.getDate()).toISOString().split('T')[0];
                var input1 = document.getElementById('check_in_date').value;
                var input2 = document.getElementById('check_out_date').value;
                if (input1 < today || input2 < today) {
                    alert("Дата заселения и выселения не может быть раньше сегодняшней даты");
                    return false;
                }
                if (input1 > input2) {
                    alert("Дата заселения не может быть позже даты выселения");
                    return false;
                } else return true;
            }
            $(".phone_mask").click(function() {
                $(this).setCursorPosition(3);
            }).mask("+7(999) 999-99-99");

        </script>
    </body>

    </html>