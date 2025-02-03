<?php

require '../config/config.php';
unset($_SESSION['token']);
header('Location: ../views/telaLogin.php');
exit;