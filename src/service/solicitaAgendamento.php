<?php
require_once __DIR__ . '/../models/user/User.php';
require_once __DIR__ . '/../models/professor/Professor.php';
require_once __DIR__ . '/../models/agenda/Agenda.php';
require '../config/config.php';
require '../dao/UsuarioDaoMySql.php';
require '../dao/ProfessorDaoMysql.php';
require '../dao/AgendaDaoMysql.php';

$uDao = new UsuarioDaoMySql($pdo);
$pDao = new ProfesorDaoMySql($pdo);
$aDao = new AgendaDaoMysql($pdo);

$idProfessor = filter_input(INPUT_POST, 'idProf');
$data = filter_input(INPUT_POST, 'data');
$hora = filter_input(INPUT_POST, 'hora');
$aluno = $uDao->findByToken($_SESSION['token']);
$dificuldadeAluno = filter_input(INPUT_POST, 'dificuldade');

if ($idProfessor && $data && $hora && $aluno && $dificuldadeAluno) {
    date_default_timezone_set('America/Sao_Paulo');
    $dataHoraAtual = strtotime(date('Y-m-d H:i'));
    $dataHoraAgendamento = strtotime("$data $hora");

    if ($dataHoraAgendamento < $dataHoraAtual) {
        $_SESSION['avisoAgendamento'] = 'A data e horário devem ser futuros!';
        header('Location: ../views/perfilProf.php');
        exit;
    }

    if (!$pDao->findById($idProfessor)) {
        $_SESSION['avisoAgendamento'] = 'Professor Não encontrado';
        header('Location: ../views/perfilProf.php');
        exit;
    }

    $agenda = new Agenda();
    $agenda->setAlunoId($aluno->getId());
    $agenda->setData($data);
    $agenda->setHora($hora);
    $agenda->setDificuldadeAluno($dificuldadeAluno);
    $agenda->setProfessorId($idProfessor);
    $agenda->setConfirmada(0);
    $aDao->insert($agenda);
    $_SESSION['verifyAgendamento'] = true;
} else {
    $_SESSION['avisoAgendamento'] = 'Preencha todos os campos';
}

header('Location: ../views/perfilProf.php');
exit;
