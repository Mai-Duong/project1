<!-- admin -->
<?php
include '../lib/session.php';
Session::checkSession();
?>
<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="css/table/demo_page.css" rel="stylesheet" type="text/css" />
    <!--  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-+" crossorigin="anonymous">


    <!-- Thong ke -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

    
    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script type="text/javascript" src="js/table/table.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            setSidebarHeight();
        });
    </script>

    <!-- Thong ke -->
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <!-- fomat date -->
    <!-- Example: Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include jQuery UI library -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


</head>

<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">
                    <!-- <img src="C:\xampp\htdocs\website_mvc\images\logog9.png" alt="" /> -->
                </div>
                <div class="floatleft middle">
                    <h1>LAPTOP Thai Nguyen</h1>
                    <p>GROUP 9</p>
                </div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="img/img-profile.jpg" alt="Profile Pic" />
                    </div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Xin chào 
                                <?php echo Session::get('adminName') ?>
                            </li>

                            <?php
                            if (isset($_GET['action']) && $_GET['action'] == 'logout') {
                                Session::destroy();
                            }
                            ?>

                            <li><a href="?action=logout">Đăng xuất</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="index.php"><span>Thống kê</span></a> </li>
                <li class="ic-form-style"><a href="taikhoan.php"><span>Tài khoản</span></a></li>
                <li class="ic-typography"><a href="changepassword.php"><span>Thay đổi mật khẩu</span></a></li>
                <li class="ic-typography"><a href="contact.php"><span>Quản lý thông tin liên hệ</span></a></li>

                <!-- <li> <input type="text" placeholder="Tìm kiếm...."> </li>
                <li> <input type="button" value="Tìm kiếm" class="btn success"> </li> -->
                <!-- <li class="ic-grid-tables"><a href="inbox.php"><span>Inbox</span></a></li> -->
                <!-- <li class="ic-charts"><a href=""><span>Visit Website</span></a></li> -->
            </ul>

            <style>
                /* Định dạng menu chính */
                ul.nav.main {
                    list-style: none;
                    padding: 0;
                    margin: 0;
                }

                ul.nav.main li {
                    display: inline-block;
                    margin-right: 10px;
                }

                /* Định dạng các liên kết */
                ul.nav.main li a {
                    text-decoration: none;
                    padding: 5px 10px;
                    /* background-color: #3498db; */
                    color: #fff;
                    border-radius: 5px;
                    /* transition: background-color 0.3s ease; */
                }

                /* ul.nav.main li a:hover {
                    background-color: #2980b9;
                } */

                /* Định dạng ô tìm kiếm */
                ul.nav.main li input[type="text"] {
                    padding: 5px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    margin-top: 15px;
                    margin-left: 300px;
                }

                ul.nav.main li input[type="button"] {
                    padding: 5px 10px;
                    background-color: black;
                    color: #fff;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    margin-top: 12px;
                    width: 90px;
                    size: 20px;
                }

                ul.nav.main li input[type="button"]:hover {
                    background-color: #219a52;
                }
            </style>
        </div>
        <div class="clear">
        </div>