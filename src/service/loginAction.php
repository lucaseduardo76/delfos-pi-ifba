<?php
require '../models/user/User.php';
require '../config/config.php';
require '../dao/UsuarioDaoMySql.php';

$uDao = new UsuarioDaoMySql($pdo);

$email = ucwords(strtolower(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)));
$pass = filter_input(INPUT_POST, 'senha');

if ($email && $pass) {
    $u = $uDao->findByEmail($email);

    if ($u) {
        $hash = $u->getSenha();

        if (password_verify($pass, $hash)) {
            $_SESSION['token'] = $u->getToken();
            header('Location: ../views/mainAluno.php');
            exit;
           
        } else {
            $_SESSION['aviso'] = 'Email e/ou senha incorretos';
            header('Location: ../views/login.php');
            exit;
        }
    } else {
        $_SESSION['aviso'] = 'Email e/ou senha incorretos';
        header('Location: ../views/login.php');
        exit;
    }
} else {
    $_SESSION['aviso'] = 'Preencha todos os campos';
    header('Location: ../views/login.php');
    exit;
}
