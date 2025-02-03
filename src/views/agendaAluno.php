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

    <link rel="stylesheet" href="../../public/css/style.css">
    <title>Document</title>

    <script src="../../public/js/agendaAluno.js"></script>
</head>

<body>


    <?php

    require_once("../config/config.php");
    require_once("../models/auth/auth.php");
    require_once("../dao/AgendaDaoMysql.php");
    require_once("../dao/ProfessorDaoMysql.php");
    require_once("../dao/UsuarioDaoMysql.php");
    require_once("../script/retornaDiaPelaData.php");

    $auth = new Auth();
    $userInfo = $auth->checkToken($pdo);

    if ($userInfo == false) {
        header("Location: ./login.php");
        exit;
    }

    $uDao = new UsuarioDaoMySql($pdo);
    $pDao = new ProfesorDaoMySql($pdo);
    $aDao = new AgendaDAOMySql($pdo);


    $agenda = $aDao->findAllByAluno($userInfo->getId());

    function corBola($confirma)
    {
        if ($confirma == 2) {
            return 'g';
        } else if ($confirma == 1) {
            return 'o';
        } else if ($confirma == 0) {
            return 'r';
        }
    }

    ?>

    <header>

        <div class="header">
            <a href="main.php" class="logo">
                <img src="../../public/images/Logo Delfos branco.svg">
            </a>
            <div class="buttons">

                <a href="mensagem.php" class="perfil-button notif"><img src="../../public/images/email.svg" alt=""></a>
                <a class="perfil-button prof" href="./editarPerfilProf.php"><img
                        src="../../public/images/school-icon.png" alt="">Perfil do professor
                </a>
                <a href="editarPerfilAluno.php">
                    <div class="perfil-button">Perfil</div>
                </a>
                <a class="perfil-button notif" href="../service/logout.php"><img
                        src="../../public/images/login-icon.png" alt=""></a>
            </div>
        </div>

    </header>

    <main>

        <div class="tabela-container">
            <table class="tabela-aulas">
                <caption>Agenda Aluno</caption>
                <thead>
                    <tr>
                        <th>Dia</th>
                        <th>Mês</th>
                        <th>Nome Professor</th>
                        <th>Horário</th>
                        <th>Semana</th>
                        <th>Confirmada</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if ($agenda):

                        usort($agenda, function ($a, $b) {
                            // Primeiro critério: 'confirmada' (1 primeiro, 0 depois)
                            if ($a->getConfirmada() != $b->getConfirmada()) {
                                return $b->getConfirmada() - $a->getConfirmada(); // Ordem decrescente
                            }

                            // Segundo critério: 'data' (ordem crescente)
                            return strtotime($a->getData()) - strtotime($b->getData());
                        });

                        echo '<script> let listaAulas = []; </script>';

                        foreach ($agenda as $aula):
                            echo '<script>
                                        listaAulas.push({
                                            id: ' . $aula->getId() . ',
                                            dificuldade: `' . $aula->getDificuldadeAluno() . '`,
                                            hora: "' . $aula->getHora() . '",
                                            data: "' . $aula->getData() . '",
                                            confirmada: ' . $aula->getConfirmada() . ',
                                            aluno: "' . $uDao->findById($aula->getAlunoId())->getNome() . '"

                                        });
                                    </script>';
                            list($ano, $mes, $dia) = explode('-', $aula->getData());
                            ?>
                            <tr>
                                <td><?= $dia ?></td>
                                <td><?= $mes ?></td>
                                <td><?= $uDao->findById($pDao->findById($aula->getProfessorId())->getUserId())->getNome() ?>
                                </td>
                                <td><?= $aula->getHora(); ?></td>
                                <td><?= retornaDiaPelaData($aula->getData()) ?></td>
                                <td style="">
                                    <div class="bola <?= corBola($aula->getConfirmada()) ?>"></div>
                                </td>
                                <td>
                                    <div class="acoes">
                                        <img src="../../public/images/eye-icon.png" alt="Visualizar" class="icone"
                                            onclick="abrirmodal(<?= $aula->getId() ?>)">

                                        <a
                                            href="./enviarMensagem.php?idDestinatario=<?= $pDao->findById($aula->getProfessorId())->getUserId() ?>"><img
                                                class="carta" src="../../public/images/email.svg" alt="Excluir"
                                                class="icone"></a>


                                        <a
                                            href="../service/deleteAula.php?aula=<?= $aula->getId() ?>&idAluno=<?= $aula->getAlunoId() ?>"><img
                                                src="../../public/images/delete-icon.png" alt="Excluir" class="icone"></a>



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
                                </div>
                            </td>
                        </tr>

                    <?php endif
                    ?>

            </table>
        </div>


        <div class="modal-overlay" id="modalRegister">
            <div class="modal" id="modal">
                <div class="mod-header">
                    <button class="modal-close" id="closeModalRg">✕</button>
                </div>
                <div class="mod-body">
                    <form action="../service/confirmarAula.php" method="GET">
                        <input type="hidden" name="aula" id="idAulaHidden">

                        <label class="mod-inputs">
                            <h4>Dificuldade do Aluno</h4>
                            <textarea name="dificuldade" rows="8" style="width: 250px; resize: none;" disabled
                                id="textArea"></textarea>
                        </label>

                        <label>
                            <h4>Nome Aluno</h4>
                            <input id="aluno" name="nome" type="text" step="3600" value="" disabled>
                        </label>

                        <label>
                            <h4>Marcada para as</h4>
                            <input id="hora" name="hora" type="time" step="3600" value="" disabled>
                        </label>

                        <label>
                            <h4>no dia</h4>
                            <input id="data" name="data" type="date" value="" disabled>
                        </label>

                        <label>
                            <h4>Confirmação</h4>
                            <input id="conf" name="conf" type="text" value="" disabled>
                        </label>

                    </form>
                </div>
            </div>
        </div>


    </main>
    <?php

    if (!empty($_SESSION['avisoDeleteAula']) && $_SESSION['avisoDeleteAula']) {
        echo "<script>alert('" . $_SESSION['avisoDeleteAula'] . "')</script>";
        unset($_SESSION['avisoDeleteAula']);
    }

    ?>



</body>

</html>