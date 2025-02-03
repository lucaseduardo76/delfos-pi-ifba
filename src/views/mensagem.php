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
    <title>Aluno</title>
</head>

<body>

    <header>

        <div class="header">
            <a href="main.php" class="logo">
                <img src="../../public/images/Logo Delfos branco.svg">
            </a>
            <div class="buttons">
                <a class="perfil-button notif" href=""><img src="../../public/images/sino-icon.png" alt=""></a>
                <a href="editarPerfilProf.php" class="perfil-button prof"><img src="../../public/images/school-icon.png" alt="">Perfil de
                    professor</a>
                <a href="editarPerfilAluno.php" class="perfil-button">Perfil</a>
                <a class="perfil-button notif" href="../service/logout.php"><img src="../../public/images/login-icon.png" alt=""></a>
            </div>


        </div>

    </header>

    <main>

        <div class="email-container">

            <aside class="menu-sidebar">
                <button class="menu-button" onclick="showFolder('inbox')">Caixa de Entrada</button>
                <button class="menu-button" onclick="showFolder('sent')">Enviados</button>
            </aside>

            <aside class="email-sidebar">
                <input type="text" class="barra-pesquisa" placeholder="Procurando">

                <ul class="email-list">
                    <li class="email-item" data-email-id="email1">
                        <div class="profile-pic"></div>
                        <div class="email-preview">
                            <h3 class="email-title">Obrigado pela Aula</h3>
                            <p class="email-prev">Precisamos confirmar a agenda para...</p>
                        </div>
                        <span class="notificacao">10</span>
                    </li>

                    <li class="email-item" data-email-id="email2">
                        <div class="profile-pic"></div>
                        <div class="email-preview">
                            <h3 class="email-title">Obrigado pela Aula</h3>
                            <p class="email-prev">Precisamos confirmar a agenda para...</p>
                        </div>
                        <span class="notificacao">1</span>
                    </li>

                    <li class="email-item" data-email-id="email3">
                        <div class="profile-pic"></div>
                        <div class="email-preview">
                            <h3 class="email-title">Obrigado pela Aula</h3>
                            <p class="email-prev">Precisamos confirmar a agenda para...</p>
                        </div>
                        <span class="notificacao">1</span>
                    </li>

                </ul>
            </aside>

            <article class="email-content hidden" id="email1">
                <div class="email-header">
                    <div class="email-cab">
                        <div class="email-img">
                            <div class="profile-pic"></div>
                        </div>
                        <div class="email-rmt">
                            <h2>Dúvida sobre o Projeto Delfos</h2>
                            <p><strong>Para:</strong> Felipe Amorim</p>
                        </div>
                    </div>
                    <img src="../../public/images/trash-icon.png" alt="" class="email-delete">
                </div>

                <div class="email-body">
                    <p>Olá, Professor Felipe,</p>
                    <p>
                        Tudo bem? Me chamo Tales Costa e sou estudante/desenvolvedor do projeto Delfus,
                        uma plataforma educacional que busca conectar estudantes e professores para aulas personalizadas e inclusivas.
                    </p>
                    <p>
                        Admiro muito seu conhecimento e gostaria de tirar algumas dúvidas ou contar com sua orientação para aprimorar o projeto.
                        Seria possível agendar um horário para uma breve conversa?
                    </p>
                </div>

                <div class="email-footer">
                    <a href="enviarMensagem.php">Responder</button>
                </div>
            </article>

            <article class="email-content hidden" id="email2">
                <div class="email-header">
                    <div class="email-cab">
                        <div class="email-img">
                            <div class="profile-pic"></div>
                        </div>
                        <div class="email-rmt">
                            <h2>Dúvida sobre o Projeto Delfos</h2>
                            <p><strong>Para:</strong> Felipe Amorim</p>
                        </div>
                    </div>
                    <img src="../../public/images/trash-icon.png" alt="" class="email-delete">
                </div>

                <div class="email-body">
                    <p>AULA 2</p>
                    <p>
                        Tudo bem? Me chamo Tales Costa e sou estudante/desenvolvedor do projeto Delfus,
                        uma plataforma educacional que busca conectar estudantes e professores para aulas personalizadas e inclusivas.
                    </p>
                    <p>
                        Admiro muito seu conhecimento e gostaria de tirar algumas dúvidas ou contar com sua orientação para aprimorar o projeto.
                        Seria possível agendar um horário para uma breve conversa?
                    </p>
                </div>

                <div class="email-footer">
                    <a href="enviarMensagem.php">Responder</button>
                </div>
            </article>

            <article class="email-content hidden" id="email3">
                <div class="email-header">
                    <div class="email-cab">
                        <div class="email-img">
                            <div class="profile-pic"></div>
                        </div>
                        <div class="email-rmt">
                            <h2>Dúvida sobre o Projeto Delfos</h2>
                            <p><strong>Para:</strong> Felipe Amorim</p>
                        </div>
                    </div>
                    <img src="../../public/images/trash-icon.png" alt="" class="email-delete">
                </div>

                <div class="email-body">
                    <p>AULA 3</p>
                    <p>
                        Tudo bem? Me chamo Tales Costa e sou estudante/desenvolvedor do projeto Delfus,
                        uma plataforma educacional que busca conectar estudantes e professores para aulas personalizadas e inclusivas.
                    </p>
                    <p>
                        Admiro muito seu conhecimento e gostaria de tirar algumas dúvidas ou contar com sua orientação para aprimorar o projeto.
                        Seria possível agendar um horário para uma breve conversa?
                    </p>
                </div>

                <div class="email-footer">
                    <a href="enviarMensagem.php">Responder</button>
                </div>
            </article>
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

        <div class="modal-overlay" id="modalConfirmed">
            <div class="modal" id="modalCn">

                <div class="mod-header">
                    <button class="modal-close" id="closeModalCn">✕</button>
                </div>
                <div class="mod-body">
                    <h3>Resposta enviada!</h3>
                    <img src="../../public/images/confirmed-icon.png" alt="">
                </div>

            </div>
        </div>

    </main>

    <script src="../../public/js/mensagens.js"></script>
</body>

</html>