<?php


require_once __DIR__ . '/../models/user/User.php';
require_once __DIR__ . '/../models/professor/Professor.php';
require '../config/config.php';
require '../dao/UsuarioDaoMySql.php';
require '../dao/ProfessorDaoMysql.php';
require '../dao/AgendaDaoMysql.php';

$uDao = new UsuarioDaoMySql($pdo);
$pDao = new ProfesorDaoMySql($pdo);
$aDao = new AgendaDaoMysql($pdo);

$idAula = filter_input(INPUT_GET, 'aula');
$idProfessor = filter_input(INPUT_GET, 'idProfessor');




if ($idAula && $idProfessor) {

    $professor = $pDao->findById($idProfessor);
    $aula = $aDao->findByid($idAula);
    $usuarioLogado = $uDao->findByToken($_SESSION["token"]);

    if (!$professor || !$aula) {
        $_SESSION["avisoDeleteAula"] = "Problemas internos, dados enviados não existem, consulte o suporte";
        header('Location: ../views/agendaProfessor.php');
        exit;
    }

    if ($aula->getProfessorId() != $idProfessor || $usuarioLogado->getId() != $professor->getUserId()) {
        $_SESSION["avisoDeleteAula"] = "Você não tem autorização para apagar o registro";
        header('Location: ../views/agendaProfessor.php');
        exit;
    }

    if($aula->getConfirmada() == 1){
        $_SESSION["avisoDeleteAula"] = "Essa aula já foi confirmada, não é possivel exclui-la";
        header('Location: ../views/agendaProfessor.php');
        exit;
    }

    $aDao->confirmaAula($aula->getId());
    

} else {

    $_SESSION["avisoDeleteAula"] = "Preencha todos os campos";
   


}

header('Location: ../views/agendaProfessor.php');
exit;

