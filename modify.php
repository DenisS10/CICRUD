<?
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_COOKIE['auth']) || $_COOKIE['auth'] != 'ok') {

    header('location: login.php');
}
?>

<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="css/style.css" rel="stylesheet">

</head>
<body>
<?

$id = 0;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}


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

$query = "SELECT `task`,`deadline` FROM task WHERE `id` = $id";

$result = mysqli_query($db, $query);


$lines = [];
while ($row = mysqli_fetch_assoc($result)) {
    $lines[] = $row;


}
//echo '<pre>';
//print_r($lines);
//


if ($db) {
    //for ($i = 0; $i < $id; $i++) {
        //$line = fgets($fp);

   // }

    //$lines = explode('&', $line);

   // echo  $lines[0]['task'];
    foreach ($lines as $line) {



?>
<div class="formDivAdd">
    <form action="save.php" method="get">
        <input autocomplete="off" name="id" value="<?= $id ?>" hidden>
        <input autocomplete="off" name="modTask" value="<? if(isset($line['task'])) echo  $line['task']; ?>">
        <input autocomplete="off" name="modDeadline" value="<?if(isset($line['deadline'])) echo  $line['deadline'];?>">
        <button class="btn btn-success" type="submit">Save</button>
    </form>
</div>

</body>
</html><?}}

else
echo 'File not found';
mysqli_close($db);
?>