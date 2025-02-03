<?php


require_once __DIR__ . '/../models/user/User.php';
require_once __DIR__ . '/../models/professor/Professor.php';
require '../config/config.php';
require '../dao/UsuarioDaoMySql.php';
require '../dao/MensagemDaoMysql.php';
require_once("../models/auth/auth.php");

$auth = new Auth();
$usuarioLogado = $auth->checkToken($pdo);

if ($usuarioLogado == false) {
    header("Location: ../views/mensagem.php");
    exit;
}

$uDao = new UsuarioDaoMySql($pdo);

$idEmail = filter_input(INPUT_GET, 'idEmail');
$eDao = new MensagemDaoMySql($pdo);
$email = $eDao->findByIdRemetente($idEmail);


if ($email && $usuarioLogado) {

    if ($email->getRemetente()->getId() != $usuarioLogado->getId()) {
        $_SESSION["avisoDeleteEmail"] = "Você não tem autorização para deletar esse email";
        header('Location: ../views/mensagem.php');
        exit;
    }

    $eDao->deleteByRemetente($email->getId());    
    $_SESSION["avisoDeleteEmail"] = "Email Deletado com sucesso!";

} else {

    $_SESSION["avisoDeleteEmail"] = "Preencha todos os campos";

}

header('Location: ../views/mensagem.php');
exit;

