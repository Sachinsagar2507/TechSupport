<?php
// refresh.php

include("configuration.php");

// Fetch the latest messages from the database
$fetch = mysqli_query($al, "SELECT * FROM box ORDER BY id DESC");

// Build and return the HTML content for the chat box
$html = '';
while ($f = mysqli_fetch_array($fetch)) {
    $html .= '<div class="teams-message">';
    $html .= '<span class="sender">' . $f['sender'] . '</span>: ';
    $html .= '<span class="msg">' . $f['msg'] . '</span>';
    $html .= '</div>';
}

echo $html;
?>
