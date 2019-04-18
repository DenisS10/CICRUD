<?
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//header('location: index.php');
$login = isset($_POST['login']) ? $_POST['login'] : '';
$pass = isset($_POST['pass']) ? $_POST['pass'] : '';
$cbRemember = isset($_POST['cbRemember']) ? $_POST['cbRemember'] : '';


$db = mysqli_connect('site.local',
    'root',
    '',
    'Tasks'
);
if (!$db) {
    echo $db->errno . ' ' . $db->error . ' ';
    print_r($db->error_list);
    //exit();
}
$query='';
$query = "SELECT `id`,`login`,`password`,`user_name` FROM users";
$res = mysqli_query($db, $query);




//$row = mysqli_fetch_assoc($res);
$users = [];
while ($row = mysqli_fetch_assoc($res)) {
    $users[] = $row;


}








foreach ($users as $user) {


$logPass = password_verify($pass,$user['password']);





    if ($login == $user['login'] && $logPass == true) {
        if ($cbRemember == 'on') {


            session_start();
            $_SESSION['id'] = $user['id'];
            //$_SESSION['auth'] = 'ok';

            //session_write_close();
            setcookie('auth', 'ok', time() + 60 * 60 * 24 * 7);
            header('location: index.php');
        } else {
            $_SESSION['auth'] = 'ok';
            setcookie('auth', 'ok', time() + 60 * 60);
            //header('location: index.php');
        }
        print_r($_SESSION);
    }
}
?>
<html>
<head>
    <meta charset="utf-8">
    <title>table</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<div class="form-row align-items-center formDivLogin">
    <?= '<pre>' ?>
    <form action="login.php" method="post">
        <input class="form-control" placeholder="Enter login" name="login">
        <input class="form-control" placeholder="Enter password" type="password" autocomplete="off" name="pass"><br>
        <div>
            <input class="form-check-input" type="checkbox" name="cbRemember">Remember me

        </div>
        <button class="btn btn-primary" type="submit">Login</button>
        <a href="signup.php">Sign up</a>
    </form>


</div>

</body>
</html>
