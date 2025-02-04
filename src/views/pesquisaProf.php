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
    <link rel="stylesheet" href="../../public/css/professorPorMateria.css">
    <link rel="stylesheet" href="../../public/css/navAgenda.css">
    <script src="../../public/js/navAgenda.js"></script>
    <title>Document</title>
</head>

<body>

    <?php

    require_once("../config/config.php");
    require_once("../models/auth/auth.php");
    require_once("../dao/AreaDao.php");
    require_once("../dao/ProfessorDaoMysql.php");
    require_once("../dao/ProfessorDaoMysql.php");

    $auth = new Auth();
    $userInfo = $auth->checkToken($pdo);

    if ($userInfo == false) {
        header("Location: ./telaLogin.php");
        exit;
    }

    $aDao = new AreaDao($pdo);
    $pDao = new ProfesorDaoMySql($pdo);
    $uDao = new UsuarioDaoMySql($pdo);

    $nome = filter_input(INPUT_GET, "nome");

    if ($nome == "" || !$nome) {
        $_SESSION["avisoListaMateria"] = "Pesquisa inválida";
        header("Location: ./listaMaterias.php");
        exit;
    }


    function ordenarProfessoresPorRating(array $professores): array
    {
        usort($professores, function ($a, $b) {
            return $b->getRating() <=> $a->getRating();
        });

        return $professores;
    }


    function getFoto($caminhoFoto, $usuario, $uDao)
    {
        if (!file_exists($caminhoFoto)) {
            $caminhoFoto = "../uploads/semPerfil.png";
            $usuario->setLinkFoto($caminhoFoto);
            $uDao->update($usuario);
        }

        return $caminhoFoto;
    }

    $isUserProf = $pDao->findByUserId($userInfo->getId());
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
                        <?php if($isUserProf): ?>
                        <li><a href="agendaProfessor.php">Agenda de Professor</a></li>
                        <?php endif; ?>
                        <li><a href="agendaAluno.php">Agenda de Aluno</a></li>
                    </ul>
                </nav>

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

    <div class="titulo">
        <h1>Resultados por '<?= ucWords($nome) ?>'</h1>
    </div>

    <main>

        <?php
        $professores = ordenarProfessoresPorRating($pDao->findByName($nome));
        if ($professores):
            foreach ($professores as $p):


                $usuario = $uDao->findById($p->getUserId());
                $rating = $p->getRating() == 0 ? 1 : $p->getRating();
                if ($usuario):
        ?>

                    <div class="slider-item">
                        <form action="../service/redirecionaPerfilProf.php" method="GET">
                            <input type="hidden" name="idProf" value="<?= $usuario->getId() ?>">
                            <button type="submit" style="border: none; background: none; padding: 0; cursor: pointer;">
                                <div class="image-container">
                                    <img src="<?= getFoto($usuario->getLinkFoto(), $usuario, $uDao) ?>" alt="foto">
                                    <div class="info">
                                        <p class="name"><?= $usuario->getNome() ?></p>
                                        <p class="subject">Assunto: <?= $aDao->findById($p->getArea())->getArea(); ?></p>
                                        <p class="rating"><?php echo str_repeat('★', round($rating)); ?></p>
                                    </div>
                                </div>
                            </button>
                        </form>
                    </div>
            <?php
                endif;
            endforeach;
        else:
            ?>
            <h1>Não encontramos!</h1>
        <?php endif; ?>

</body>

</html>