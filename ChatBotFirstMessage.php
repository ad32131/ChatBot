<?php


include_once("./dbcon.php");
$sql = "SELECT Message FROM ChatBotFirstMessage";
$result = mysqli_query($connect, $sql);
mysqli_data_seek($result, 0);
$row = mysqli_fetch_array($result);
echo "<span class style><span id='chat-bot'> </span>$row[Message]</span><br>";
?>