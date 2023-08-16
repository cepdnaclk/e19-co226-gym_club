<?php
@include 'config.php';

$main = $_POST["main"];
$second = $_POST["second"];

$sql = "SELECT *
        FROM `chat`
        WHERE send_uid IN ('$main', '$second')
        AND rec_uid IN ('$main', '$second')
        ORDER BY `time` ASC;";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Access individual elements of the $row array
        $id = $row['msg_id'];
        $send_uid = $row['send_uid'];
        $rec_uid = $row['rec_uid'];
        $message = $row['msg_cont'];
        $time = $row['time'];
        
        // Echo the desired elements
        if ($send_uid == $main) {
            echo "<div class='bubble sent'>$message</div>";
        }else{
            echo "<div class='bubble recv'>$message</div>";
        }
        /* echo "ID: $id<br>";
        echo "Send UID: $send_uid<br>";
        echo "Receive UID: $rec_uid<br>";
        echo "Message: $message<br>";
        echo "Time: $time<br><br>"; */
    }
}
?>

<!-- UPDATE `chat`
SET `read_by` = '1'
WHERE `rec_uid` = 'main'; -->