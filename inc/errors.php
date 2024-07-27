<?php
require_once 'inc/conn.php';
if (isset($_SESSION['errors'])) {
    foreach ($_SESSION['errors'] as $error) {?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php
    }
}
unset($_SESSION['errors']);
?>