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

    $professor = $pDao->findByUserId($userInfo->getId());
    if (!$professor) {
        header('Location: ./main.php');
        exit;
    }

    $agenda = $aDao->findAllByProfessor($professor->getId());

    function corBola($confirma)
    {
        if ($confirma == 2) {
            return 'g';
        } else if ($confirma == 1) {
            return 'o';
        } else if ($confirma == 0) {
            return 'b';
        } else if ($confirma == -1) {
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

                <div class="perfil-button notifAgenda" id="agendaButton"><img src="../../public/images/agenda-icon.png">
                </div>
                <nav id="dropdownMenu" class="hidden">
                    <ul>
                        <li><a href="agendaAluno.php">Agenda de Aluno</a></li>
                    </ul>
                </nav>
                <a href="mensagem.php">
                    <div class="perfil-button notif"><img src="../../public/images/email.svg" alt=""></div>
                </a>
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
                <caption>Agenda Professor</caption>
                <thead>
                    <tr>
                        <th>Dia</th>
                        <th>Mês</th>
                        <th>Nome Aluno</th>
                        <th>Horário</th>
                        <th>Semana</th>
                        <th>Confirmada</th>
                        <th>Link Aula</th>
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
                                <td><?= $uDao->findById($aula->getAlunoId())->getNome() ?></td>
                                <td><?= $aula->getHora(); ?></td>
                                <td><?= retornaDiaPelaData($aula->getData()) ?></td>
                                <td style="">
                                    <div class="bola <?= corBola($aula->getConfirmada()) ?>"></div>
                                </td>
                                <td class="exemplo">
                                    <?php if ($aula->getConfirmada() == 2):
                                        if ($aula->getLinkAula() != null && $aula->isHorarioPermitido()):
                                    ?>
                                            <a href="<?= $aula->getLinkAula() ?>" target="_blank" class="link-button" id="linkButton" style="margin-bottom: 10px; background-color: #FA8374;">Ir para Aula</a>
                                           
                                        <?php elseif ($aula->getLinkAula() != null): ?>
                                            <button href="" class="link-button" id="linkButton"
                                                onclick="abrirModalLink('<?= $aula->getId() ?>')">Alterar link</button>
                                        <?php else:  ?>
                                            <button href="" class="link-button" id="linkButton"
                                                onclick="abrirModalLink('<?= $aula->getId() ?>')">Adicionar link</button>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <button href="" class="link-button" id="linkButton" disabled>Adicionar link</button>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="acoes">
                                        <img src="../../public/images/eye-icon.png" alt="Visualizar" class="icone"
                                            onclick="abrirmodal(<?= $aula->getId() ?>)">

                                        <a class="icone" href="./enviarMensagem.php?idDestinatario=<?= $aula->getAlunoId() ?>"><img
                                                class="carta" src="../../public/images/email.svg" alt="Excluir"
                                                class="icone"></a>
                                        <a
                                            href="../service/deleteAula.php?aula=<?= $aula->getId() ?>&idProfessor=<?= $aula->getProfessorId() ?>"><img
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
                    <form>
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

                        <p id="textConf">Deseja confirmar o agendamento ?</p>

                        <div id="botaoConf">
                            <a id="botaoConfirm"
                                href="../service/confirmarAula.php?aula=1&idProfessor=<?= $professor->getId() ?>"
                                id="confirmBtn">Confirmar</a>
                            <a href="../service/rejeitaAula.php?aula=1&idProfessor=<?= $professor->getId() ?>"
                                id="botaoRec" id="recusaBtn">Recusar</a>
                        </div>


                    </form>
                </div>
            </div>
        </div>

        <div class="modal-overlay" id="modalLink">
            <div class="modal" id="modalLk">
                <div class="mod-header">
                    <button class="modal-close" id="closeModalLk">✕</button>
                </div>
                <div class="mod-body">
                    <form method="POST" action="../service/insereLink.php">
                        <h3>Insira o link da reunião: (Zoom ou Meet)</h3>
                        <input type="hidden" name="aulaId" value="" id="aulaIdModal">
                        <input type="link" name="linkAula" id="idLinkHidden" placeholder="Link aqui...">
                        <input type="submit" value="Enviar" id="enviar-submit">
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

    <script>
        document.getElementById("closeModalRg").addEventListener("click", () => {


            document.getElementById("modal").style.opacity = "0";

            const timer = setTimeout(() => {
                document.getElementById("modalRegister").style.display = "none";
                document.getElementById("textArea").innerHTML = "";
                document.getElementById("hora").value = "";
                document.getElementById("data").value = "";
                document.getElementById("idAulaHidden").value = "";
                document.getElementById("aluno").value = "";

            }, 450);



        });


        function abrirmodal(id) {
            const textConfirmacao = (n) => {
                let textConfElement = document.getElementById("textConf");
                let botaoConfElement = document.getElementById("botaoConf");

                if (textConfElement && botaoConfElement) {
                    if (n == 2) {
                        textConfElement.style.display = "none";
                        botaoConfElement.style.display = "none";
                        return "Agendamento Confirmado";
                    } else if (n == 1) {
                        textConfElement.style.display = "block";
                        botaoConfElement.style.display = "block";
                        return "Agendamento Pendente de confirmação";
                    } else if (n == 0) {
                        textConfElement.style.display = "none";
                        botaoConfElement.style.display = "none";
                        return "Agendamento negado";
                    }
                }
                return "";
            };

            for (let aula of listaAulas) {
                if (aula.id == id) {
                    document.getElementById("textArea").innerHTML = aula.dificuldade;
                    document.getElementById("hora").value = aula.hora;
                    document.getElementById("data").value = aula.data;
                    document.getElementById("idAulaHidden").value = aula.id;
                    document.getElementById("conf").value = textConfirmacao(aula.confirmada);
                    document.getElementById("aluno").value = aula.aluno;

                    // Atualiza os links dos botões
                    document.getElementById("botaoConfirm").href = `../service/confirmarAula.php?aula=${id}&idProfessor=<?= $professor->getId() ?>`;
                    document.getElementById("botaoRec").href = `../service/rejeitaAula.php?aula=${id}&idProfessor=<?= $professor->getId() ?>`;
                }
            }

            document.getElementById("modalRegister").style.display = "flex";

            setTimeout(() => {
                document.getElementById("modal").style.opacity = "1";
            }, 10);
        }


        document.addEventListener("keydown", function(event) {
            if (event.key === "Escape") {
                document.getElementById("modal").style.opacity = "0";

                const timer = setTimeout(() => {
                    document.getElementById("modalRegister").style.display = "none";
                    document.getElementById("textArea").innerHTML = "";
                    document.getElementById("hora").value = "";
                    document.getElementById("data").value = "";
                    document.getElementById("idAulaHidden").value = "";
                    document.getElementById("aluno").value = "";
                }, 450);


            }
        });

        document.getElementById("closeModalLk").addEventListener("click", () => {
            document.getElementById("modalLk").style.opacity = "0";

            const timer = setTimeout(() => {
                document.getElementById("modalLink").style.display = "none";
            }, 450);
        });

        const abrirModalLink = (idAula) => {


            document.getElementById("modalLink").style.display = "flex";
            document.getElementById("aulaIdModal").value = idAula;


            const timer = setTimeout(() => {
                document.getElementById("modalLk").style.opacity = "1";
            }, 10);
        };
    </script>

    <?php


    if (!empty($_SESSION['avisoLinkAula']) && $_SESSION['avisoLinkAula']) {
        echo "<script>alert('" . $_SESSION['avisoLinkAula'] . "')</script>";
        $_SESSION['avisoLinkAula'] = '';
    }

    ?>

    <style>
        #dropdownMenu {
            left: 56%;
        }
    </style>

</body>

</html>