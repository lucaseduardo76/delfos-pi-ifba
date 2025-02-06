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
    <link rel="stylesheet" href="../../public/css/editarPerfilAluno.css">
    <link rel="stylesheet" href="../../public/css/navAgenda.css">
    <script src="../../public/js/navAgenda.js"></script>
    <style>
        .file-input {
            display: none;
        }

        .upload-btn {
            padding: 10px 20px;
            background-color: #FF4227;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-align: center;
            transition: 0.3s;
        }

        .upload-btn:hover {
            background-color: #FF988a;
        }
    </style>

    <title>Document</title>
</head>

<body>
    <?php

    require_once("../config/config.php");
    require_once("../models/auth/auth.php");
    require_once("../dao/ProfessorDaoMysql.php");
    require_once("../dao/UsuarioDaoMysql.php");
    require_once("../dao/ProfessorDaoMysql.php");
    require_once("../models/user/User.php");

    $auth = new Auth();
    $userInfo = $auth->checkToken($pdo);

    if ($userInfo == false) {
        header("Location: ./telaLogin.php");
        exit;
    }

    $pDao = new ProfesorDaoMySql($pdo);
    $uDao = new UsuarioDaoMySql($pdo);
    $isUserProf = $pDao->findByUserId($userInfo->getId());
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
                        <?php if ($pDao->findByUserId($userInfo->getId())): ?>
                            <li><a href="agendaProfessor.php">Agenda de Professor</a></li>
                        <?php endif; ?>
                        <li><a href="agendaAluno.php">Agenda de Aluno</a></li>
                    </ul>
                </nav>

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

                <a class="perfil-button notif" href="../service/logout.php"><img
                        src="../../public/images/login-icon.png" alt=""></a>
            </div>

        </div>

    </header>

    <main>

        <div>
            <form class="container" action="../service/editarAluno.php" method="post" enctype="multipart/form-data">
                <div class="left-side">
                    <div class="photo-area">
                        <img src="<?= $userInfo->getLinkFoto() ?>" alt="">
                        <h2>Perfil</h2>
                        <label for="file-upload" class="upload-btn">Escolher Foto</label>
                        <input type="file" name="file" id="file-upload" class="file-input" accept="image/png, image/jpeg">

                    </div>

                    <a href="redefinirSenha.php" class="button-prt">Segurança</a>

                </div>

                <div class="right-side">
                    <div class="campo-alteracoes">

                        <label>
                            <h3>Nome Completo:</h3>
                            <input type="text" name="nome" value="<?= $userInfo->getNome() ?>">
                        </label>

                        <label>
                            <h3>Email:</h3>
                            <input type="email" name="email" value="<?= $userInfo->getEmail() ?>">
                        </label>

                        <label>
                            <h3>Telefone:</h3>
                            <input type="text" name="telefone" id="telefone" value="<?= $userInfo->getTelefone() ?>">
                            </br>
                        </label>

                        <input type="submit" value="Salvar alterações">
                    </div>

                </div>
            </form>
        </div>

       

    </main>
    <script>
        document.getElementById("file-upload").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector(".photo-area img").src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        function formatarTelefone(value) {
            value = value.replace(/\D/g, ""); // Remove tudo que não for número

            if (value.length >= 11) {
                // Formato (XX) XXXXX-XXXX para números brasileiros
                return value.replace(/^(\d{2})(\d{5})(\d{4})/, "($1) $2-$3");
            } else if (value.length === 10) {
                // Formato (XX) XXXX-XXXX (para números fixos brasileiros)
                return value.replace(/^(\d{2})(\d{4})(\d{4})/, "($1) $2-$3");
            } else {
                return value; // Mantém outros formatos internacionais sem interferência
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const telefoneInput = document.getElementById("telefone");

            if (telefoneInput) {
                // Formatar o valor inicial se já houver um telefone preenchido
                telefoneInput.value = formatarTelefone(telefoneInput.value);

                telefoneInput.addEventListener("input", function(event) {
                    event.target.value = formatarTelefone(event.target.value);
                });
            }
        });
    </script>

    <?php

    if (!empty($_SESSION['aviso']) && $_SESSION['aviso']) {
        echo "<script>alert('" . $_SESSION['aviso'] . "')</script>";
        $_SESSION['aviso'] = '';
    }

    ?>
</body>

</html>