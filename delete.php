<?php
header('location: index.php');
$file_out = file("table.txt"); // Считываем весь файл в массив //var_dump($file_out);
//echo '<pre>';
//print_r($_GET);
if (isset($_GET['numberOfRecord']))
    $numberOfRecord = $_GET['numberOfRecord'];
else
    $numberOfRecord = '';

//print_r($file_out);

//echo  '<br>';
if ($numberOfRecord > 0) {
    //$numberOfRecord--;
  //  print_r('$numberOfRecord = '.$numberOfRecord.PHP_EOL);

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
    $numberOfRecordMod=intval($numberOfRecord);

    $queryDel="DELETE FROM task WHERE id = $numberOfRecordMod";

    $result = mysqli_query($db,$queryDel);



    mysqli_close($db);

//    unset($file_out[$numberOfRecord]);    //удаляем строчку
    $numberOfRecord = '';

    //print_r($file_out);
   // exit();
}
//file_put_contents("table.txt", implode("", $file_out));