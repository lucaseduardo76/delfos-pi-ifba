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
        header("Location: ./login.php");
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
        // Função number_format formata o número com 2 casas decimais e separadores de milhar
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }
    ?>


    <header>

        <div class="header">
            <div class="logo">
                <img src="../../public/images/Logo Delfos branco.svg">
            </div>
            <div class="buttons">
                <div class="perfil-button prof"><img src="../../public/images/school-icon.png" alt="">Perfil de
                    professor</div>
                <div class="perfil-button"><img src="../../public/images/login-icon.png" alt="">Perfil</div>
            </div>

        </div>

    </header>

    <main>
        <form method="post" action="./../service/editarProfessor.php" enctype="multipart/form-data">
            <div class="container">
                <div class="left-side">
                    <div class="perfil-foto">
                        <img src="<?= $caminhoFoto ?>" alt="">
                        <h2>Perfil</h2>
                        <input type="file" name="file" accept="image/png, image/jpeg">
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

        input.addEventListener('input', function (event) {
            let value = event.target.value.replace(/\D/g, ''); // Remove tudo que não for número
            value = (value / 100).toFixed(2).replace('.', ','); // Formata como valor monetário
            event.target.value = 'R$ ' + value;
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