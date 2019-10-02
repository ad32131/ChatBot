<?php


include_once("./dbcon.php");

$sql = "SELECT ModSwitch FROM BotModSetting;";

$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result);
$total_record = mysqli_num_rows($result);

mysqli_data_seek($result, 0);
$row = mysqli_fetch_array($result);
echo $row[ModSwitch];
?>