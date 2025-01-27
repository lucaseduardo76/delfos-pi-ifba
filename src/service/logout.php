<?php

require '../config/config.php';
unset($_SESSION['token']);
header('Location: ../views/login.php');
exit;