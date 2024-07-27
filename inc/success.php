<?php
require_once 'inc/conn.php';
if (isset($_SESSION['success'])) {
    ?>
        <div class="alert alert-success"><?php echo $_SESSION['success']; ?></div>
    <?php
}
unset($_SESSION['success']);
?>