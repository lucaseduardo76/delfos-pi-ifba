<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/agenda.css">
    <title>Document</title>
</head>

<body>


    <?php

    require_once("../config/config.php");
    require_once("../models/auth/auth.php");
    require_once("../dao/AgendaDaoMysql.php");
    require_once("../dao/ProfessorDaoMysql.php");
    require_once("../dao/UsuarioDaoMysql.php");

    $auth = new Auth();
    $userInfo = $auth->checkToken($pdo);

    if ($userInfo == false) {
        header("Location: ./login.php");
        exit;
    }

    $uDao = new UsuarioDaoMySql($pdo);
    $pDao = new ProfesorDaoMySql($pdo);
    $aDao = new AgendaDAOMySql($pdo);

    $professor = $pDao->findByUserId($userInfo->getId());
    if (!$professor) {
        header('Location: ./main.php');
        exit;
    }

    $agenda = $aDao->findAllByProfessor($professor->getId());

    function corBola($confirma)
    {
        if ($confirma == 1) {
            return 'g';
        } else if ($confirma == 0) {
            return 'o';
        }
    }

    ?>

    <header>

        <div class="header">
            <a href="main.php" class="logo">
                <img src="../../public/images/Logo Delfos branco.svg">
            </a>
            <div class="buttons">
                <a href="">
                    <div class="perfil-button notif"><img src="../../public/images/sino-icon.png" alt=""></div>
                </a>
                <a href="">
                    <div class="perfil-button"><img src="../../public/images/login-icon.png" alt="">Perfil</div>
                </a>
            </div>
        </div>

    </header>

    <main>

        <div class="tabela-container">
            <table class="tabela-aulas">
                <caption>Agenda Professor</caption>
                <thead>
                    <tr>
                        <th>Dia</th>
                        <th>Mês</th>
                        <th>Nome Aluno</th>
                        <th>Horário</th>
                        <th>Semana</th>
                        <th>Confirmada</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if ($agenda):
                        foreach ($agenda as $aula):
                            list($ano, $mes, $dia) = explode('-', $aula->getData());



                            ?>
                            <tr>
                                <td><?= $dia ?></td>
                                <td><?= $mes ?></td>
                                <td><?= $uDao->findById($aula->getAlunoId())->getNome() ?></td>
                                <td><?= $aula->getHora(); ?></td>
                                <td>Seg</td>
                                <td style="">
                                    <div class="bola <?= corBola($aula->getConfirmada()) ?>"></div>
                                </td>
                                <td>
                                    <div class="acoes">
                                        <img src="../../public/images/eye-icon.png" alt="Visualizar" class="icone">
                                        <img src="../../public/images/delete-icon.png" alt="Excluir" class="icone">
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php else: ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="acoes">
                                    <img src="../../public/images/eye-icon.png" alt="Visualizar" class="icone">
                                    <img src="../../public/images/delete-icon.png" alt="Excluir" class="icone">
                                </div>
                            </td>
                        </tr>

                    <?php endif
                    ?>


            </table>
        </div>


    </main>


</body>

</html>