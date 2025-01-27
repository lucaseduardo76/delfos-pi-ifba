<?php

require_once __DIR__ . '/../models/user/User.php';
require '../config/config.php';
require '../dao/UsuarioDaoMySql.php';

$uDao = new UsuarioDaoMySql($pdo);

$nome = ucwords(strtolower(filter_input(INPUT_POST, 'nome')));
$email = ucwords(strtolower(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)));
$cpf = ucwords(strtolower(filter_input(INPUT_POST, 'cpf')));
$senha = ucwords(strtolower(filter_input(INPUT_POST, 'senha')));
$telefone = filter_input(INPUT_POST, 'telefone');


if ($nome && $email && $cpf && $senha && $telefone) {
    $emailInvalido = $uDao->findByEmail($email);

    if ($emailInvalido) {
        $_SESSION["aviso"] = 'Email já existe em nosso sistema';
        echo 'email ja existe';
        header('Location: ../views/login.php');
        exit;
    }


    if (strlen($senha) < 8) {

        $_SESSION['conteudo'] = [
            'nome' => $nome,
            'email' => $email,
            'cpf' => $cpf
        ];

        $_SESSION["aviso"] = 'Senha deve ter no minimo 8 caracteres';
        echo 'senha pequena';
        header('Location: ../views/login.php');
        exit;
    }

    $hash = password_hash($senha, PASSWORD_DEFAULT);

    $u = new User();
    $u->setEmail($email);
    $u->setnome($nome);
    $u->setcpf($cpf);
    $u->setsenha($hash);
    $u->setTelefone($telefone);

    $uDao->insert($u);
    $_SESSION['verifyCad'] = true;
} else {

    $_SESSION["aviso"] = "Preencha todos os campos";

}


header('Location: ../views/login.php');
exit;