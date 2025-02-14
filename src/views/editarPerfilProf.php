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
    <link rel="stylesheet" href="../../public/css/editarPerfilProf.css">
    <link rel="stylesheet" href="../../public/css/navAgenda.css">
    <script src="../../public/js/navAgenda.js"></script>
    <style>
      
        #dropdownMenu {
            left: 68%;
        }
        

        .file-input {
            display: none;
            margin-top: 10px;
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
    require_once("../dao/AreaDao.php");
    require_once("../dao/UsuarioDaoMysql.php");
    require_once("../models/user/User.php");
    require_once("../dao/ProfessorDaoMysql.php");
    require_once("../models/professor/Professor.php");
    $auth = new Auth();
    $userInfo = $auth->checkToken($pdo);

    if ($userInfo == false) {
        header("Location: ./telaLogin.php");
        exit;
    }

    $pDao = new ProfesorDaoMySql($pdo);

    $areaDao = new AreaDao($pdo);
    $areas = $areaDao->findAll();

    $uDao = new UsuarioDaoMySql($pdo);
    $usuario = $uDao->findByToken($_SESSION["token"]);

    $caminhoFoto;

    if ($usuario->getLinkFoto() != null) {
        $caminhoFoto = $usuario->getLinkFoto();
    }

    if (!file_exists($caminhoFoto)) {
        $caminhoFoto = "../uploads/semPerfil.png";
        $usuario->setLinkFoto($caminhoFoto);
        $uDao->update($usuario);
    }

    $pDao = new ProfesorDaoMySql($pdo);
    $professor = $pDao->findByUserId($userInfo->getId());

    if (!$professor) {
        header("Location: ./novoPerfilProf.php");
        exit;
    }

    function formatarParaReais(float $valor): string
    {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }
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
                <a href="mensagem.php" class="perfil-button notif"><img src="../../public/images/email.svg" alt=""></a>
                <a href="editarPerfilAluno.php" class="perfil-button">Perfil</a>
                <a class="perfil-button notif" href="../service/logout.php"><img src="../../public/images/login-icon.png" alt=""></a>
            </div>
        </div>
    </header>

    <main>
        <form method="post" action="./../service/editarProfessor.php" enctype="multipart/form-data">
            <div class="container">
                <div class="left-side">
                    <div class="perfil-foto">
                        <img id="preview-img" src="<?= $userInfo->getLinkFoto() ?>" alt="">
                        <h2>Perfil</h2>
                        <label for="file-upload" class="upload-btn">Escolher Foto</label>
                        <input type="file" id="file-upload" name="file" class="file-input" accept="image/png, image/jpeg">

                    </div>
                </div>
                <div class="right-side">
                    <label>
                        <h3>Assuntos que você ensina:</h3>
                        <select name="materia" id="materia" required>
                            <option value="" disabled selected>Selecione a sua área de ensino</option>
                            <?php foreach ($areas as $area): ?>
                                <option value="<?= $area->getId() ?>" <?= $area->getId() == $professor->getArea() ? 'selected' : '' ?>>
                                    <?= $area->getArea() ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </label>
                    <label>
                        <h3>Valor da aula:</h3>
                        <input type="text" id="preco" name="preco" placeholder="R$ 0,00"
                            value="<?= formatarParaReais($professor->getPrecoAula()) ?>" required>
                    </label>
                    <label>
                        <h3>Sobre você:</h3>
                        <textarea rows="5" name="sobre" required
                            placeholder="Fale sobre você..."><?= $professor->getDescricao() ?></textarea>
                    </label>
                    <button class="button-prt" type="submit">Salvar Alterações</button>
                </div>
            </div>
        </form>
    </main>

    <script>
        const input = document.getElementById('preco');
        input.addEventListener('input', function(event) {
            let value = event.target.value.replace(/\D/g, '');
            value = (value / 100).toFixed(2).replace('.', ',');
            event.target.value = 'R$ ' + value;
        });

        document.getElementById("file-upload").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById("preview-img").src = e.target.result;
                };
                reader.readAsDataURL(file);
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