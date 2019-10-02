<?php


include_once("./dbcon.php");
if(empty(!$_GET[ChatRoom])){
    $sql = "SELECT MAX(MessageNumber) AS TA FROM ChatData where ChatRoom = \"$_GET[ChatRoom]\" ORDER BY MessageNumber";
}
else{
    $sql = "SELECT MAX(MessageNumber) AS TA FROM ChatData where ChatRoom = \"$_SERVER[REMOTE_ADDR]\" ORDER BY MessageNumber";
}
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result);
$total_record = mysqli_num_rows($result);

for ($i=0; $i < $total_record; $i++) {
    mysqli_data_seek($result, $i);
    $row = mysqli_fetch_array($result);
    echo $row[TA];
}
?>