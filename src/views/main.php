<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aluno</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/aluno.css">
    <link rel="stylesheet" href="../../public/css/navAgenda.css">
</head>

<body>
    <?php

    require_once("../config/config.php");
    require_once("../models/auth/auth.php");
    require_once("../dao/ProfessorDaoMysql.php");
    require_once("../dao/UsuarioDaoMysql.php");
    require_once("../dao/AreaDao.php");
    require_once("../models/user/User.php");

    $auth = new Auth();
    $userInfo = $auth->checkToken($pdo);

    if ($userInfo == false) {
        header("Location: ./telaLogin.php");
        exit;
    }

    $uDao = new UsuarioDaoMySql($pdo);
    $aDao = new AreaDao($pdo);

    $pDao = new ProfesorDaoMySql($pdo);
    $professor = $pDao->findByUserId($userInfo->getId());
    $todosProfessores = $pDao->findAll();

    function getFoto($caminhoFoto, $usuario, $uDao)
    {
        if (!file_exists($caminhoFoto)) {
            $caminhoFoto = "../uploads/semPerfil.png";
            $usuario->setLinkFoto($caminhoFoto);
            $uDao->update($usuario);
        }

        return $caminhoFoto;
    }




    function selecionarTopProfessores(array $professores, array &$areasSelecionadas): array
    {
        if (empty($professores)) {
            return [];
        }

        // Filtra professores cujas áreas ainda não foram selecionadas
        $professoresDisponiveis = array_filter($professores, fn($professor) => !in_array($professor->getArea(), $areasSelecionadas));

        if (empty($professoresDisponiveis)) {
            return []; // Se todas as áreas já foram escolhidas, retorna vazio
        }

        // Seleciona randomicamente um professor e usa sua área
        $professorAleatorio = $professoresDisponiveis[array_rand($professoresDisponiveis)];
        $areaSelecionada = $professorAleatorio->getArea();

        // Adiciona a área selecionada à lista de áreas já escolhidas
        $areasSelecionadas[] = $areaSelecionada;

        // Filtra os professores pela área selecionada
        $professoresFiltrados = array_filter($professores, fn($professor) => $professor->getArea() === $areaSelecionada);

        // Ordena a lista filtrada pelo rating de forma decrescente
        usort($professoresFiltrados, fn($a, $b) => $b->getRating() <=> $a->getRating());

        // Retorna os primeiros 20 ou toda a lista caso tenha menos de 20
        return array_slice($professoresFiltrados, 0, min(20, count($professoresFiltrados)));
    }

    function selecionaTop(array $professores): array
    {
        if (empty($professores)) {
            return [];
        }

        // Ordena a lista de professores pelo rating de forma decrescente
        usort($professores, fn($a, $b) => $b->getRating() <=> $a->getRating());

        // Seleciona os primeiros 20 professores ou toda a lista caso tenha menos de 20
        $topProfessores = array_slice($professores, 0, min(20, count($professores)));

        // Embaralha a lista para garantir que a seleção seja aleatória
        shuffle($topProfessores);

        return $topProfessores;
    }

    function randomArea($pDao)
    {
        $listaGeral = [];
        $areasSelecionadas = [];

        for ($i = 0; $i < 3; $i++) {
            $topProfessores = selecionarTopProfessores($pDao->findAll(), $areasSelecionadas);
            if (!empty($topProfessores)) {
                $listaGeral[] = $topProfessores;
            }
        }

        return $listaGeral;
    }


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
                        <?php if ($isUserProf): ?>
                            <li><a href="agendaProfessor.php">Agenda de Professor</a></li>
                        <?php endif; ?>
                        <li><a href="agendaAluno.php">Agenda de Aluno</a></li>
                    </ul>
                </nav>

                <a href="mensagem.php" class="perfil-button notif"><img src="../../public/images/email.svg" alt=""></a>
                <?php if (!$professor): ?>
                    <a class="perfil-button prof" href="./novoPerfilProf.php"><img src="../../public/images/school-icon.png"
                            alt="">Seja um professor
                    </a>
                <?php endif; ?>

                <?php if ($professor): ?>
                    <a class="perfil-button prof" href="./editarPerfilProf.php"><img
                            src="../../public/images/school-icon.png" alt="">Perfil do professor
                    </a>
                <?php endif; ?>
                <a href="editarPerfilAluno.php" class="perfil-button">Perfil</a>
                <a class="perfil-button notif" href="../service/logout.php"><img
                        src="../../public/images/login-icon.png" alt=""></a>
            </div>


        </div>

    </header>

    <main>

        <div class="titulo-principal">
            <h1>Escolha os melhores <strong>★★★★★</strong></h1>
        </div>

        <div class="slider-container">

            <button class="slider-btn prev">◀</button>

            <div class="slider">

                <?php foreach (selecionaTop($pDao->findAll()) as $p): ?>
                    <?php
                    $usuario = $uDao->findById($p->getUserId());
                    $rating = $p->getRating() == 0 ? 1 : $p->getRating();
                    if ($usuario):
                        ?>

                        <div class="slider-item">
                            <form action="../service/redirecionaPerfilProf.php" method="GET">
                                <input type="hidden" name="idProf" value="<?= $usuario->getId(); ?>">
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

                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <button class="slider-btn next">▶</button>

        </div>

        <div class="divisoria">
            <div class="divisoria-pilar">
                <img src="../../public/images/Mask group.png" alt="">
            </div>
            <div class="divisoria-wpp">
                <img src="../../public/images/Group 46.png" alt="">
            </div>
        </div>

        <div class="subtitulo">
            <h1>Aprenda com profissionais qualificados</h1>
            <a href="listaMaterias.php" id="botao-link">O que deseja aprender ? <img
                    src="../../public/images/pesquisaIcon.png" alt=""></a>
        </div>

        <?php

        $listaArea = randomArea($pDao);

        ?>


        <?php foreach ($listaArea as $area): ?>
            <div class="slider-container slider-small">


                <h2>Os melhores em <?= $aDao->findById($area[0]->getArea())->getArea(); ?> <strong>★★★★★</strong></h2>

                <button class="slider-btn prev">◀</button>

                <div class="slider">

                    <?php foreach ($area as $p): ?>
                        <?php
                        $usuario = $uDao->findById($p->getUserId());
                        $rating = $p->getRating() == 0 ? 1 : $p->getRating();
                        if ($usuario):
                            ?>
                            <form action="../service/redirecionaPerfilProf.php" method="GET">
                                <input type="hidden" name="idProf" value="<?= $usuario->getId(); ?>">
                                <button type="submit"
                                    style="border: none; background: none; padding: 0; cursor: pointer; width: 100%;">
                                    <div class="slider-item">
                                        <div class="image-container">
                                            <img src="<?= getFoto($usuario->getLinkFoto(), $usuario, $uDao) ?>" alt="foto">
                                            <div class="info">
                                                <p class="name"><?= $usuario->getNome() ?></p>
                                                <p class="subject">Assunto: <?= $aDao->findById($p->getArea())->getArea(); ?></p>
                                                <p class="rating"><?php echo str_repeat('★', round($rating)); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </button>
                            </form>
                        <?php endif; ?>
                    <?php endforeach; ?>

                </div>



                <button class="slider-btn next">▶</button>

            </div>
        <?php endforeach; ?>




        </div>

    </main>

    <script src="../../public/js/sliders.js"></script>
    <script src="../../public/js/navAgenda.js"></script>

</body>

</html>