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
    <link rel="stylesheet" href="../../public/css/navAgenda.css">
    <script src="../../public/js/navAgenda.js"></script>
    <script src="../../public/js/agendaAluno.js"></script>
    <title>Document</title>
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
        header("Location: ./telaLogin.php");
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
            return 'b';
        }  else if ($confirma == -1) {
            return 'r';
        }
    }

    $isUserProf = $pDao->findByUserId($userInfo->getId());

    ?>

    <header>

        <div class="header">
            <a href="main.php" class="logo">
                <img src="../../public/images/Logo Delfos branco.svg">
            </a>
            <div class="buttons">
                <?php if ($isUserProf): ?>
                    <div class="perfil-button notifAgenda" id="agendaButton"><img src="../../public/images/agenda-icon.png">
                    </div>
                    <nav id="dropdownMenu" class="hidden">
                        <ul>

                            <li><a href="agendaProfessor.php">Agenda de Professor</a></li>

                        </ul>
                    </nav>
                <?php endif; ?>
                <a href="mensagem.php" class="perfil-button notif"><img src="../../public/images/email.svg" alt=""></a>
                <?php if (!$isUserProf): ?>
                    <a class="perfil-button prof" href="./novoPerfilProf.php"><img src="../../public/images/school-icon.png"
                            alt="">Seja um professor
                    </a>
                <?php endif; ?>

                <?php if ($isUserProf): ?>
                    <a class="perfil-button prof" href="./editarPerfilProf.php"><img
                            src="../../public/images/school-icon.png" alt="">Perfil do professor
                    </a>
                <?php endif; ?>
                <a href="editarPerfilAluno.php">
                    <div class="perfil-button">Perfil</div>
                </a>
                <a class="perfil-button notif" href="../service/logout.php"><img
                        src="../../public/images/login-icon.png" alt=""></a>
            </div>
        </div>

        <div class="menu-toggle" id="menuToggle">
                &#9776;
            </div>

            <div class="buttons-mob" id="buttonsMob">

                <?php if (!$isUserProf): ?>
                    <a href="">Seja um professor</a>
                <?php endif; ?>

                <?php if ($isUserProf): ?>
                    <a href="">Agenda de Professor</a>
                    <a href="">Perfil do Professor</a>
                <?php endif; ?>    

                <a href="">Agenda de Aluno</a>
                <a href="">Mensagens</a>
                <a href="">Perfil</a>
                <a href="">Sair</a>
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
                        <th>Ir para aula</th>
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
                                <td><a href="../service/redirecionaPerfilProf.php?idProf=<?= $uDao->findById($pDao->findById($aula->getProfessorId())->getUserId())->getId() ?>"><?= $uDao->findById($pDao->findById($aula->getProfessorId())->getUserId())->getNome() ?></a>
                                </td>
                                <td><?= $aula->getHora(); ?></td>
                                <td><?= retornaDiaPelaData($aula->getData()) ?></td>
                                <td style="">
                                    <div class="bola <?= corBola($aula->getConfirmada()) ?>"></div>
                                </td>
                                <td>
                                    <?php if ($aula->getConfirmada() == 2 && $aula->getLinkAula() != null): ?>
                                        <?php if ($aula->isHorarioPermitido()): ?>
                                            <a href="<?= $aula->getLinkAula() ?>" target="_blank" class="link-button" style="margin-bottom: 10px; background-color: #FA8374;">Abrir reunião</a>
                                        <?php else: ?>
                                            <a href="" class="link-button">Fora do horário</a>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <a href="" class="link-button">Sem link</a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="acoes">
                                        <img src="../../public/images/eye-icon.png" alt="Visualizar" class="icone"
                                            onclick="abrirmodal(<?= $aula->getId() ?>)">

                                        <a
                                            class="icone" href="./enviarMensagem.php?idDestinatario=<?= $pDao->findById($aula->getProfessorId())->getUserId() ?>"><img
                                                class="carta" src="../../public/images/email.svg" alt="Excluir"
                                                class="icone"></a>


                                        <a
                                            href="../service/deleteAula.php?aula=<?= $aula->getId() ?>&idAluno=<?= $aula->getAlunoId() ?>"><img
                                                src="../../public/images/delete-icon.png" alt="Excluir" class="icone"></a>

                                        <?php if($aula->getConfirmada() == 2 && $aula->isHorarioPermitidoToFinalizar()): ?>
                                        <div onclick="checkAula('<?= $aula->getId() ?>')" class="check" id="check"><img src="../../public/images/check-icon.png"></div>
                                        <?php endif; ?>

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

        <div class="modal-overlay" id="modalCheck">
            <div class="modal" id="modalCh">
                <div class="mod-header">
                    <button class="modal-close" id="closeModalCh">✕</button>
                </div>
                <div class="mod-body">
                    <h3>A aula foi encerrada!</h3>

                    <form class="mod-rating" action="../service/avaliaProfessor.php" method="post">

                        <label>
                            <h4>Avalie a aula:</h4>

                            <div class="star-rating">
                                <span class="star" data-value="1">&#9733;</span>
                                <span class="star" data-value="2">&#9733;</span>
                                <span class="star" data-value="3">&#9733;</span>
                                <span class="star" data-value="4">&#9733;</span>
                                <span class="star" data-value="5">&#9733;</span>
                            </div>

                            <!-- Input escondido para armazenar a avaliação -->
                            <input type="hidden" name="avaliacao" id="avaliacaoInput" value="5">
                            <input type="hidden" name="idAula" id="idAulaConluida">
                        </label>

                        <label>
                            <h4>Observação (Opc.):</h4>
                            <textarea rows="7"></textarea>
                        </label>

                        <input type="submit" value="Avaliar" id="checkConfirm">
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

    <style>
        #dropdownMenu {
            left: 56%;
        }
    </style>

    <script src="../../public/js/avaliacao.js"></script>

</body>

</html>