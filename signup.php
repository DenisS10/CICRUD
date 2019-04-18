<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//header('location: index.php');
//Сохранение в файл
//if (isset($_POST['task'])) {
//    $task = $_POST['task'];
//}
//if (isset($_POST['deadline'])) {
//    $deadline = $_POST['deadline'];
//}
//print_r($_POST);

$signLogin = isset($_POST['signLogin']) ? $_POST['signLogin'] : '';
$signPass = isset($_POST['signPass']) ? $_POST['signPass'] : '';
$signName = isset($_POST['signName']) ? $_POST['signName'] : '';

///////////////////////////////////////////////////////////////////////////////////////
if (!empty($signLogin) && !empty($signPass) && !empty($signName)) {
    $db = mysqli_connect('site.local',
        'root',
        '',
        'Tasks'
    );
    if (!$db) {
        echo $db->errno . ' ' . $db->error . ' ';
        print_r($db->error_list);
        exit();
    }


    $query = "SELECT `id`,`login` FROM users";
    $res = mysqli_query($db, $query);


//$row = mysqli_fetch_assoc($res);
    $signLoginCheck = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $signLoginCheck[] = $row;
//        echo '<pre>';
//        print_r($row);
//        echo '</pre>';

    }

    foreach ($signLoginCheck as $siItem) {


        if ($signLogin == $siItem['login']) {
            //sleep(5);
            ?><html>

<head>
    <meta charset="utf-8">
    <title>table</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/custom.js"></script>

</head>
<body>
<div class="form-row align-items-center formDivLogin">
    <pre>
    <form action="signup.php" method="post">
        <input class="form-control" placeholder="Enter nickname" autocomplete="off" name="signName">
        <input class="form-control" placeholder="Enter login" name="signLogin">
        <p style="color: red;">Человек с таким логином уже есть</p>
        <input class="form-control" placeholder="Enter password" type="password" autocomplete="off" name="signPass">


        <button class="btn btn-primary" type="submit">Sign UP!</button>

    </form>


</div>
</body>
</html><?

            exit();

        }
    }

    $currDate = time();
    $signHashPass = password_hash($signPass, PASSWORD_DEFAULT);
    $res = mysqli_query($db,
        "insert into users(login, password, user_name,first_time) values('$signLogin','$signHashPass','$signName','$currDate')"
    );


    mysqli_close($db);
    header('location: login.php');

}
/////////////////////////////////////////////////////////////////////////////////////////////

//if (!empty($task) && !empty($deadline)) {
//
//
//
//        $fw = fopen("table.txt", 'a');
//        $str = $task . '&' . $deadline . '&' . PHP_EOL;
//        fwrite($fw, $str);
//        fclose($fw);
//    }?>
<html>

<head>
    <meta charset="utf-8">
    <title>table</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/custom.js"></script>

</head>
<body>
<div class="form-row align-items-center formDivLogin">
    <?= '<pre>' ?>
    <form action="signup.php" method="post">
        <input class="form-control" placeholder="Enter nickname" autocomplete="off" name="signName">
        <input class="form-control" placeholder="Enter login" name="signLogin">
        <input class="form-control" placeholder="Enter password" type="password" autocomplete="off" name="signPass">


        <button class="btn btn-primary" type="submit">Sign UP!</button>

    </form>


</div>
</body>
</html>

