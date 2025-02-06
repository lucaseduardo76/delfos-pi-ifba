<?php


require_once __DIR__ . '/../models/user/User.php';
require_once __DIR__ . '/../models/professor/Professor.php';
require '../config/config.php';
require '../dao/UsuarioDaoMySql.php';

$uDao = new UsuarioDaoMySql($pdo);

$senhaAntiga = filter_input(INPUT_POST, 'antiga');
$senhaNova = filter_input(INPUT_POST, 'nova');




if ($senhaAntiga && $senhaNova) {
    $usuario = $uDao->findByToken($_SESSION['token']);
    if (!$usuario) {
        header('Location: ./logout.php');
        exit;
    }

    if (strlen($senhaNova) < 8) {
        $_SESSION['aviso'] = 'Senha deve ter minimo 8 caracteres!';
        header('Location: ../views/geral/conta.php');
        exit;
    }

    if (password_verify($senhaAntiga, $usuario->getSenha())) {
        $newHash = password_hash($senhaNova, PASSWORD_DEFAULT);

        $usuario->setSenha($newHash);
        $uDao->update($usuario);

        $_SESSION['aviso'] = 'Senha alterada com sucesso!';
    } else {
        $_SESSION['aviso'] = 'Senha incorreta!';
    }
} else {

    $_SESSION["aviso"] = "Preencha todos os campos";
}

header('Location: ../views/redefinirSenha.php');
exit;
