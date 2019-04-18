<?
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//header('location: index.php');
session_start();
$oldPass = isset($_POST['oldPass']) ? $_POST['oldPass'] : '';
$newPass = isset($_POST['newPass']) ? $_POST['newPass'] : '';
$newRepeatPass = isset($_POST['newRepeatPass']) ? $_POST['newRepeatPass'] : '';
$id = $_SESSION['id'];

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
$query = '';
$query = "SELECT `id`,`login`,`password`,`user_name` FROM users";
$res = mysqli_query($db, $query);


//$row = mysqli_fetch_assoc($res);
$users = [];
while ($row = mysqli_fetch_assoc($res)) {
    $users[] = $row;


}


foreach ($users as $user) {


    $logPass = password_verify($oldPass, $user['password']);
    if ($newPass == $newRepeatPass)
        $newHashPass = password_hash($newPass, PASSWORD_DEFAULT);
    else
        $newHashPass = '';
    if ($user['id'] == $id) {

        if ($logPass == true) {

            $tempUser = $user['login'];
            $queryMod = "UPDATE `users` SET `password`= '$newHashPass'WHERE `id` = $id ";//UPDATE `users` SET `login`='www' WHERE (`id`='71')
            $result = mysqli_query($db, $queryMod);
            mysqli_close($db);
            break;
        }

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
    <pre>
    <form action="lk.php" method="post">
        <input class="form-control" placeholder="Enter old password" autocomplete="off" name="oldPass">
        <input class="form-control" placeholder="Enter new password" type="text" autocomplete="off" name="newPass">
        <input class="form-control" placeholder="Repeat new password" type="text" autocomplete="off"
               name="newRepeatPass">
        <!--        <div>-->
        <!--            <input class="form-check-input" type="checkbox" name="cbRemember">Remember me-->
        <!---->
        <!--        </div>-->
        <button class="btn btn-primary" type="submit">Change password</button>

    </form>


</div>

</body>
</html>
