<?php

require_once __DIR__ . '/../models/user/User.php';
require_once __DIR__ . '/../models/mensagem/Mensagem.php';
require '../config/config.php';
require '../dao/UsuarioDaoMySql.php';
require '../dao/AgendaDaoMysql.php';
require '../dao/ProfessorDaoMysql.php';

$uDao = new UsuarioDaoMySql($pdo);
$aDao = new AgendaDaoMysql($pdo);
$pDao = new ProfesorDaoMysql($pdo);

$idAula = filter_input(INPUT_POST, 'idAula');
$avaliacao = filter_input(INPUT_POST, 'avaliacao');
$alunoUsuario = $uDao->findByToken($_SESSION['token']);

if ($idAula && $avaliacao && $alunoUsuario) {

    $aula = $aDao->findById($idAula);

    if ($aula->getAlunoId() != $alunoUsuario->getId()) {
        $_SESSION['avisoDeleteAula'] = "Usuario não tem permissão para efetuar requisição";
        header('Location: ../views/agendaAluno.php');
        exit;
    }

    
    $professor = $pDao->findById($aula->getProfessorId());

    $professor->setRating($professor->getRating() + $avaliacao);
    $professor->setQuantidadeAulasAplicadas($professor->getQuantidadeAulasAplicadas() + 1);
    $pDao->update($professor);

    $aDao->finalizaAula($aula->getId());

} else {
    $_SESSION['avisoDeleteAula'] = "Preencha todos os campos";
}

header('Location: ../views/agendaAluno.php');
exit;
