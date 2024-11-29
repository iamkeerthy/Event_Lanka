<?php
session_start();
if (isset($_SESSION['error'])) {
    echo '<div class="error-msg">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo '<div class="success-msg">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
}

?>
