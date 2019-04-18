<?
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php
header('location: index.php');
//if (isset($_GET['id'])) {
//    $id = $_GET['id'];
//}
//if (isset($_GET['modTask'])) {
//    $modTask = $_GET['modTask'];
//}
//if (isset($_GET['modDeadline'])) {
//    $modDeadline = $_GET['modDeadline'];
//}
$id = isset($_GET['id']) ? $_GET['id'] : '';
$modTask = isset($_GET['modTask']) ? $_GET['modTask'] : '';
$modDeadline = isset($_GET['modDeadline']) ? $_GET['modDeadline'] : '';


if (!empty($modTask) && !empty($modDeadline)) {


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

    $querySave = "UPDATE `task` SET `task` = '$modTask', `deadline` = $modDeadline,`mod_date`=$currDate where id =$id";
    //UPDATE `users` SET `password`= '$newHashPass'WHERE `id` = $id
    echo $querySave;
    $result = mysqli_query($db, $querySave);


    mysqli_close($db);
}


//$workArr = file("table.txt"); // Считываем весь файл в массив

//if (isset($numberOfRecord) && $numberOfRecord > 0) {
//$recordCount--;
//$workArr[$id - 1] = $modTask . '&' . $modDeadline . '&' . PHP_EOL; //Рефакторинг массива
//file_put_contents("table.txt", implode("", $workArr));//Запись нового массива в файл



//unset($file_out[$numberOfRecord]);    //удаляем строчку
 //$numberOfRecord = '';
//}

?>