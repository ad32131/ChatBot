<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <?php include_once("../dbcon.php"); ?>
</head>
<body>
<div class="div_notice_zone">
    <div style="height:1px; background-color:#eee;"></div>
    <div style="height:21px; padding:1px 0px; line-height:21px;">
        <table style="width:100%;">
            <tbody>
<?php
$sql = "Select Origin.ChatRoom, Origin.Text AS LAST_TEXT,Origin.Write_Date AS LastDate,Origin.MessageNumber ,Origin.Owner from ChatData AS Origin,(SELECT ChatRoom, MAX(Write_Date) AS LastDate, MAX(MessageNumber) AS MaxNumber From ChatData Group By ChatROOM) AS TA WHERE Origin.ChatRoom = TA.ChatRoom AND Origin.MessageNumber = TA.MaxNumber;";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result);
$total_record = mysqli_num_rows($result);

for ($i=0; $i < $total_record; $i++) {
    mysqli_data_seek($result, $i);
    $row = mysqli_fetch_array($result);
    echo "<tr>";
    if($row['Owner'] == 'Admin'){
        echo "<td style=\"width:240px; text-align:center;\">[$row[ChatRoom]]-[Checked]</td>";
    }
    else{
        echo "<td style=\"width:240px; text-align:center;\">[$row[ChatRoom]]-[NotRead]</td>";
    }
    echo "<td style=\"cursor:pointer;\" onclick=\"location.href='./AdminSideMessage.php?ChatRoom=$row[ChatRoom]';\">$row[LAST_TEXT] $row[MessageNumber]+</td>";
    echo "<td style=\"width:150px; text-align:center;color:#555; font-size:11px;\">$row[LastDate]</td>";
    echo "</tr>";
}

?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
