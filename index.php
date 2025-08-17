<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS protal #59</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        #main {
            flex: 1;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>

<body>
    <?php include('client/layout/header.php') ?>
    <div class="mt-5 pt-3" id="main">

        <?php
        if (isset($_GET['home'])) {
            include('client/template/common/home.php');
        } else if (isset($_GET['notes'])) {
            include('client/template/common/notes.php');
        } else if (isset($_GET['saved'])) {
            include('client/template/common/saved.php');
        } else if (isset($_GET['upload'])) {
            include('client/template/common/upload.php');
        } else if (isset($_GET['login'])) {
            include('client/template/auth/login.php');
        } else if (isset($_GET['register'])) {
            include('client/template/auth/register.php');
        } else {
            include('client/template/common/404.php');
        }

        ?>

    </div>
    <?php include('client/layout/footer.php') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
</body>

</html>