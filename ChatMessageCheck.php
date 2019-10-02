<?php


include_once("./dbcon.php");
if(empty(!$_GET[ChatRoom])) {
    $sql = "SELECT Owner,Text FROM ChatData where ChatRoom = \"$_GET[ChatRoom]\" and MessageNumber = \"$_GET[msg_no]\"";
}else{
    $sql = "SELECT Owner,Text FROM ChatData where ChatRoom = \"$_SERVER[REMOTE_ADDR]\" and MessageNumber = \"$_GET[msg_no]\"";
}
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result);
$total_record = mysqli_num_rows($result);

for ($i=0; $i < $total_record; $i++) {
    mysqli_data_seek($result, $i);
    $row = mysqli_fetch_array($result);
    if($row[Owner] == "Admin") {
        echo "<span class style><span id='chat-bot'>$row[Owner]: </span>$row[Text]</span><br>";
    }
    elseif ($row[Owner] == "Guest"){
        echo "<span class style><span id='chat-user'>$row[Owner]: </span>$row[Text]</span><br>";
    }
}
?>