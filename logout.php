<?php

session_start();
session_unset();
session_destroy();
unset($_SESSION['Admin']);

echo '<script>location.href="admin/login.php"</script>';
?>