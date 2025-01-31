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

                        echo '<script> let listaAulas = []; </script>';

                        foreach ($agenda as $aula):
                            echo '<script>
                                        listaAulas.push({
                                            id: ' . $aula->getId() . ',
                                            dificuldade: "' . $aula->getDificuldadeAluno() . '",
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
                                <td>Seg</td>
                                <td style="">
                                    <div class="bola <?= corBola($aula->getConfirmada()) ?>"></div>
                                </td>
                                <td>
                                    <div class="acoes">
                                        <img src="../../public/images/eye-icon.png" alt="Visualizar" class="icone"
                                            onclick="abrirmodal(<?= $aula->getId() ?>)">
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
                                    <img src="../../public/images/delete-icon.png" alt="Excluir" class="icone">
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
                        <input type="hidden" name="idProfessor" id="id" value="<?= $professor->getId() ?>">
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

                        <input id="botaoConf" type="submit" value="Confirmar" id="confirmBtn">
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

                document.getElementById("textConf").style.display = "block";
                document.getElementById("botaoConf").style.opacity = 1;
            }, 450);



        });


        function abrirmodal(id) {

            const textConfirmacao = (n) => {
                if (n == 1) {
                    document.getElementById("textConf").style.display = "none";
                    document.getElementById("botaoConf").style.opacity = 0;
                    return "Agendamento Confirmado"

                } else if (n == 0) {
                    return "Agendamento Pendente de confirmação"
                }
            }

            for (let aula of listaAulas) {
                if (aula.id == id) {
                    document.getElementById("textArea").innerHTML = aula.dificuldade;
                    document.getElementById("hora").value = aula.hora;
                    document.getElementById("data").value = aula.data;
                    document.getElementById("idAulaHidden").value = aula.id;
                    document.getElementById("conf").value = textConfirmacao(aula.confirmada);                    
                    document.getElementById("aluno").value = aula.aluno;

                }
            }



            document.getElementById("modalRegister").style.display = "flex";

            const timer = setTimeout(() => {
                document.getElementById("modal").style.opacity = "1";
            }, 10);
        }

        

    </script>

</body>

</html>