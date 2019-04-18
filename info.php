<?php
//echo phpinfo();
//$files = scandir(__DIR__);
//
//echo '<pre>';
//print_r ($files);
////echo time();
?>
<html>
<head>
    <title>Test</title>
</head>
<body>

<div><span id="timer"></span></div>
<script type="text/javascript"><!--
    var t=<??>; /* Даём 20 секунд */
    function refr_time()
    {
        if (t>0)
        {
            t--;
            document.getElementById('timer').innerHTML=t;
        } else
        {
            clearInterval(tm);
            location.href='info.php?timer=1';
        }
    }
    var tm=setInterval('refr_time();',1000);
    --></script>
<?
echo '<pre>';
print_r($_GET);
echo '</pre>';
;?>

</body>
</html>
