<?php
// Assume you have the database connection and other required code here
include("configuration.php");

$fetch = mysqli_query($al, "SELECT * FROM box ORDER BY id DESC");
while ($f = mysqli_fetch_array($fetch)) {
    echo '<div class="teams-message">';
    echo '<span class="sender">' . $f['sender'] . '</span>:';
    echo '<span class="msg">' . $f['msg'] . '</span>';
    echo '</div>';
}
?>
