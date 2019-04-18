<?php
header('location: index.php');
//Сохранение в файл
//if (isset($_POST['task'])) {
//    $task = $_POST['task'];
//}
//if (isset($_POST['deadline'])) {
//    $deadline = $_POST['deadline'];
//}
session_start();

$task = isset($_POST['task']) ? $_POST['task'] : '';
$deadline = isset($_POST['deadline']) ? $_POST['deadline'] : '';
$userId = $_SESSION['id'];





    if (!empty($task) && !empty($deadline)) {



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
        $currDate = time();

        $querySave="insert into `task` (`user_id`,`task`, `deadline`,`creation_date`) values($userId,'$task',$deadline,$currDate)";

        $result = mysqli_query($db,$querySave);


        mysqli_close($db);

}
