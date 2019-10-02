<?php
include_once ("./dbcon.php");

if(empty(!$_POST[ChatRoom])) {
    $sql = "SELECT MAX(MessageNumber) AS CTA FROM ChatData WHERE ChatRoom = \"$_POST[ChatRoom]\"";
}
else{
    $sql = "SELECT MAX(MessageNumber) AS CTA FROM ChatData WHERE ChatRoom = \"$_SERVER[REMOTE_ADDR]\"";
}
$result = mysqli_query($connect, $sql);
mysqli_data_seek($result, 0);
$row = mysqli_fetch_array($result);

$MSG_NUMBER =  $row[CTA];

if(empty(!$_POST[ChatRoom])) {
    $sql = "INSERT INTO ChatData (MessageNumber, ChatRoom, Text, Owner, Write_Date) VALUES ($MSG_NUMBER+1,\"$_POST[ChatRoom]\",\"$_POST[Text]\",\"$_POST[Owner]\", now());";
}
else{
    $sql = "INSERT INTO ChatData (MessageNumber, ChatRoom, Text, Owner, Write_Date) VALUES ($MSG_NUMBER+1,\"$_SERVER[REMOTE_ADDR]\",\"$_POST[Text]\",\"$_POST[Owner]\", now());";
}
$result = mysqli_query($connect, $sql);


?>