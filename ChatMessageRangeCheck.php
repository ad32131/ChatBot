<?php


include_once("./dbcon.php");
if(empty($_GET[StartIndex])) exit();
if(empty($_GET[MaxIndex])) exit();

$StartIndex = $_GET[StartIndex] -1;
$MaxIndex = $_GET[MaxIndex];

if(empty(!$_GET[ChatRoom])) {
    $sql = "SELECT Owner,Text FROM ChatData where ChatRoom = \"$_GET[ChatRoom]\" and $StartIndex < MessageNumber AND MessageNumber <= $MaxIndex ORDER BY MessageNumber";
}else{
    $sql = "SELECT Owner,Text FROM ChatData where ChatRoom = \"$_SERVER[REMOTE_ADDR]\" and $StartIndex < MessageNumber AND MessageNumber <= $MaxIndex ORDER BY MessageNumber";
}
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result);
$total_record = mysqli_num_rows($result);

for ($i=0; $i < $total_record; $i++) {
    mysqli_data_seek($result, $i);
    $row = mysqli_fetch_array($result);
    if($row[Owner] == "Admin") {
        echo "<span class= 'current-msg' style ><span id='chat-bot'>$row[Owner]: </span>$row[Text]</span><br>";
    }
    elseif ($row[Owner] == "Guest"){
        echo "<span class= 'current-msg' style><span id='chat-user'>$row[Owner]: </span>$row[Text]</span><br>";
    }
}
?>