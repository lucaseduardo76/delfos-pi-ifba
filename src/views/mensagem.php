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
    <link rel="stylesheet" href="../../public/css/mensagem.css">
    <link rel="stylesheet" href="../../public/css/navAgenda.css">
    <script src="../../public/js/navAgenda.js"></script>
    <title>Aluno</title>
</head>

<body>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("sent").addEventListener("click", () => {
                document.getElementById("entrada").style.display = "none";
                document.getElementById("enviada").style.display = "flex";
            })

            document.getElementById("inbox").addEventListener("click", () => {
                document.getElementById("enviada").style.display = "none";
                document.getElementById("entrada").style.display = "flex";
            })
        });
    </script>

    <?php
    require_once("../config/config.php");
    require_once("../models/auth/auth.php");
    require_once("../dao/UsuarioDaoMysql.php");
    require_once("../dao/MensagemDaoMysql.php");
    require_once("../models/user/User.php");

    $auth = new Auth();
    $userInfo = $auth->checkToken($pdo);

    if ($userInfo == false) {
        header("Location: ./telaLogin.php");
        exit;
    }

    $uDao = new UsuarioDaoMySql($pdo);
    $mDao = new MensagemDaoMySql($pdo);
    $emailsRecebido = $mDao->findByDestinatario($userInfo->getId());

    $emailsEnviado = $mDao->findByRemetente($userInfo->getId());

    ?>
    <header>

        <div class="header">
            <a href="main.php" class="logo">
                <img src="../../public/images/Logo Delfos branco.svg">
            </a>
            <div class="buttons">

                <div class="perfil-button notifAgenda" id="agendaButton"><img src="../../public/images/agenda-icon.png"></div>
                <nav id="dropdownMenu" class="hidden">
                    <ul>
                        <li><a href="agendaProfessor.php">Agenda de Professor</a></li>
                        <li><a href="agendaAluno.php">Agenda de Aluno</a></li>
                    </ul>
                </nav>

                <a href="editarPerfilProf.php" class="perfil-button prof"><img src="../../public/images/school-icon.png"
                        alt="">Perfil de
                    professor</a>
                <a href="editarPerfilAluno.php" class="perfil-button">Perfil</a>
                <a class="perfil-button notif" href="../service/logout.php"><img
                        src="../../public/images/login-icon.png" alt=""></a>
            </div>


        </div>

    </header>

    <main>
        <aside class="menu-sidebar">
            <button class="menu-button" id="inbox">Caixa de Entrada</button>
            <button class="menu-button" id="sent">Enviados</button>
        </aside>
        <div class="caixa-entrada" id="entrada">
            <div class="email-container">



                <aside class="email-sidebar">
                    <input type="text" class="barra-pesquisa" placeholder="Procurando">

                    <ul class="email-list">

                        <?php
                        if (!empty($emailsRecebido)):
                            foreach ($emailsRecebido as $email): ?>
                                <li class="email-item" data-email-id="<?= $email->getId() ?>">
                                    <div class="profile-pic">
                                        <img src="<?= $email->getRemetente()->getLinkFoto() ?>" alt="">
                                    </div>
                                    <div class="email-preview">
                                        <h3 class="email-title"><?= $email->getTitulo() ?></h3>
                                        <p class="email-prev"><?= substr($email->getMensagem(), 0, 25) . '...' ?></p>
                                    </div>
                                </li>
                        <?php
                            endforeach;
                        endif; ?>

                    </ul>
                </aside>

                <?php
                if (!empty($emailsRecebido)):
                    foreach ($emailsRecebido as $email): ?>
                        <article class="email-content hidden" id="<?= $email->getId() ?>">
                            <div class="email-header">
                                <div class="email-cab">
                                    <div class="email-img">
                                        <div class="profile-pic">
                                            <img src="<?= $email->getRemetente()->getLinkFoto() ?>" alt="">
                                        </div>
                                    </div>
                                    <div class="email-rmt">
                                        <h2><?= $email->getTitulo() ?></h2>
                                        <p><strong>De:</strong> <?= $email->getRemetente()->getNome() ?></p>
                                    </div>
                                </div>
                                <a href="../service/deleteByDestinatario.php?idEmail=<?= $email->getId() ?>"><img
                                        src="../../public/images/trash-icon.png" alt="" class="email-delete"></a>
                            </div>

                            <div class="email-body">
                                <?= $email->getMensagem() ?>
                            </div>

                            <div class="email-footer">
                                <a href="enviarMensagem.php?idDestinatario=<?= $email->getRemetente()->getId() ?>">Responder</a>
                            </div>
                        </article>
                <?php
                    endforeach;
                endif; ?>


            </div>

            <div class="modal-overlay" id="modalResposta">
                <div class="modal" id="modal">

                    <div class="mod-header">
                        <button class="modal-close" id="closeModal">✕</button>
                    </div>
                    <div class="mod-body">
                        <form>
                            <label>
                                <h3>Resposta para 'Tales Costa'</h3>
                                <textarea class="mod-resposta" rows="15" required></textarea>
                            </label>
                            <button class="modal-confirm" type="submit">Enviar</button>
                        </form>
                    </div>

                </div>
            </div>

        </div>

        <div style="display:none;" class="caixa-enviadas" id="enviada">
            <div class="email-container">



                <aside class="email-sidebar">
                    <input type="text" class="barra-pesquisa" placeholder="Procurando">

                    <ul class="email-list">

                        <?php
                        if (!empty($emailsEnviado)):
                            foreach ($emailsEnviado as $email): ?>
                                <li class="email-item" data-email-id="<?= $email->getId() ?>">
                                    <div class="profile-pic">
                                        <img src="<?= $email->getDestinatario()->getLinkFoto() ?>" alt="">
                                    </div>
                                    <div class="email-preview">
                                        <h3 class="email-title"><?= $email->getTitulo() ?></h3>
                                        <p class="email-prev"><?= substr($email->getMensagem(), 0, 25) . '...' ?></p>
                                    </div>
                                </li>
                        <?php
                            endforeach;
                        endif; ?>

                    </ul>
                </aside>

                <?php
                if (!empty($emailsEnviado)):
                    foreach ($emailsEnviado as $email): ?>
                        <article class="email-content hidden" id="<?= $email->getId() ?>">
                            <div class="email-header">
                                <div class="email-cab">
                                    <div class="email-img">
                                        <div class="profile-pic">
                                            <img src="<?= $email->getDestinatario()->getLinkFoto() ?>" alt="">
                                        </div>
                                    </div>
                                    <div class="email-rmt">
                                        <h2><?= $email->getTitulo() ?></h2>
                                        <p><strong>Para:</strong> <?= $email->getDestinatario()->getNome() ?></p>
                                    </div>
                                </div>
                                <a href="../service/deleteByRemetente.php?idEmail=<?= $email->getId() ?>"><img
                                        src="../../public/images/trash-icon.png" alt="" class="email-delete"></a>

                            </div>

                            <div class="email-body">
                                <?= $email->getMensagem() ?>
                            </div>


                        </article>
                <?php
                    endforeach;
                endif; ?>


            </div>

            <div class="modal-overlay" id="modalResposta">
                <div class="modal" id="modal">

                    <div class="mod-header">
                        <button class="modal-close" id="closeModal">✕</button>
                    </div>
                    <div class="mod-body">
                        <form>
                            <label>
                                <h3>Resposta para 'Tales Costa'</h3>
                                <textarea class="mod-resposta" rows="15" required></textarea>
                            </label>
                            <button class="modal-confirm" type="submit">Enviar</button>
                        </form>
                    </div>

                </div>
            </div>

        </div>

    </main>

    <script src="../../public/js/mensagens.js"></script>


    <?php

    if (!empty($_SESSION['avisoEnviarMensagem']) && $_SESSION['avisoEnviarMensagem']) {
        echo "<script>alert('" . $_SESSION['avisoEnviarMensagem'] . "')</script>";
        $_SESSION['avisoEnviarMensagem'] = '';
    }



    if (!empty($_SESSION['avisoDeleteEmail']) && $_SESSION['avisoDeleteEmail']) {
        echo "<script>alert('" . $_SESSION['avisoDeleteEmail'] . "')</script>";
        $_SESSION['avisoDeleteEmail'] = '';
    }



    ?>
</body>

</html>