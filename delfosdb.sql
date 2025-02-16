-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/02/2025 às 21:01
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `delfosdb`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agenda_aula`
--

CREATE TABLE `agenda_aula` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` varchar(10) NOT NULL,
  `aluno` int(11) NOT NULL,
  `professor` int(11) NOT NULL,
  `confirmada` tinyint(1) NOT NULL DEFAULT 0,
  `dificuldade_aluno` text NOT NULL,
  `link_aula` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `agenda_aula`
--

INSERT INTO `agenda_aula` (`id`, `data`, `hora`, `aluno`, `professor`, `confirmada`, `dificuldade_aluno`, `link_aula`) VALUES
(6, '2025-02-06', '13:00', 14, 509, 0, 'Aqui estamos mais um dia, sobre o olhar saguinario do vigia', NULL),
(8, '2025-02-06', '17:00', 161, 59, 0, 'ASDASDASDDSDD', NULL),
(9, '2025-02-04', '11:00', 161, 59, 0, 'asdsadsd', NULL),
(10, '2025-02-07', '17:00', 161, 59, 0, 'asdasdsads', NULL),
(11, '2025-01-06', '12:00', 161, 59, 0, 'AAAAAAAAAAAAAAAA', NULL),
(12, '2025-02-06', '14:00', 161, 59, 0, 'TESTE DE VEZ', NULL),
(13, '2025-02-06', '14:00', 161, 59, 0, 'asdasdsadasdasda', NULL),
(14, '2025-01-31', '04:00', 161, 59, 0, 'Funfou', NULL),
(16, '2025-02-01', '15:00', 161, 56, 0, 'AAAAAAAAAAAAAAAAAAAAAAAAAA', NULL),
(17, '2025-02-05', '13:00', 14, 505, 2, 'AAAAAAAABBBBBBBBBBCCCCCCC', NULL),
(18, '2025-02-06', '01:00', 14, 511, -1, 'adasdsad', NULL),
(19, '2025-02-18', '13:00', 15, 51, 2, 'Agendando aula', NULL),
(20, '2025-02-03', '21:00', 15, 51, 2, 'Pai, me ensina Python aí na humildade', NULL),
(21, '2025-02-11', '12:00', 15, 50, 2, 'TEAS', 'https://meet.google.com/nrv-vjwo-xxc'),
(22, '2025-02-04', '10:00', 161, 50, 0, 'Aluasdad', 'https://zoom.us/signin?branding=oauth2&client_id=tuPMXopXTuSFD7WJ4vJ2xA&_x_zm_rtaid=yOgaIK6eT12_5CDjeIFtEw.1738706039651.a35d2af935fe5d49dead7045db6cbb8f&_x_zm_rhtaid=107#/login'),
(23, '2025-02-04', '22:00', 161, 50, 2, 'asdasdasd', 'https://zoom.us/signin?branding=oauth2&client_id=tuPMXopXTuSFD7WJ4vJ2xA&_x_zm_rtaid=yOgaIK6eT12_5CDjeIFtEw.1738706039651.a35d2af935fe5d49dead7045db6cbb8f&_x_zm_rhtaid=107#/login'),
(24, '2025-02-05', '13:00', 10, 50, 0, 'Vamos pra logo porra', 'https://meet.google.com'),
(25, '2025-02-05', '18:00', 163, 52, 0, 'Nível um', 'https://meet.google.com/landing'),
(26, '2025-02-05', '20:00', 15, 551, 2, 'Aquela dificuldade lá', 'https://meet.google.com/landing'),
(27, '2025-03-13', '10:00', 166, 520, 1, 'Toda', NULL),
(28, '2025-02-17', '15:00', 168, 52, 1, 'paredes', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `areas`
--

INSERT INTO `areas` (`id`, `nome`) VALUES
(1, 'Matemática'),
(2, 'Português'),
(3, 'Gramática'),
(4, 'Inglês'),
(5, 'Programação'),
(6, 'Física'),
(7, 'Química'),
(8, 'Biologia'),
(9, 'Geografia'),
(10, 'História'),
(11, 'Artes'),
(12, 'Educação Física'),
(13, 'Música'),
(14, 'Filosofia'),
(15, 'Sociologia'),
(16, 'Psicologia'),
(17, 'Economia'),
(18, 'Administração'),
(19, 'Agricultor'),
(20, 'Contabilidade'),
(21, 'Engenharia Civil'),
(22, 'Engenharia Elétrica'),
(23, 'Engenharia Mecânica'),
(24, 'Design Gráfico'),
(25, 'Design de Produto'),
(26, 'Arquitetura'),
(27, 'Publicidade e Propaganda'),
(28, 'Relações Públicas'),
(29, 'Ciências Sociais'),
(30, 'Letras'),
(31, 'Marketing Digital'),
(32, 'Finanças'),
(33, 'Gestão de Pessoas');

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagem_destinatario`
--

CREATE TABLE `mensagem_destinatario` (
  `id` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `corpo` text NOT NULL,
  `remetente` int(11) NOT NULL,
  `destinatario` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `mensagem_destinatario`
--

INSERT INTO `mensagem_destinatario` (`id`, `titulo`, `corpo`, `remetente`, `destinatario`, `data`) VALUES
(1, 'ASdas', 'ASDASDA', 14, 10, '2025-02-03'),
(2, 'Toaadsd', 'ASDASDA', 14, 10, '2025-02-03'),
(3, 'LOREM', '\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"\n\n\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"\n\n\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"', 14, 10, '2025-02-03'),
(8, 'Vamos nessa', 'Enviando outra msg', 14, 10, '2025-02-03'),
(9, 'Ta indo', 'O XINHO È SAFADO', 15, 10, '2025-02-03'),
(10, 'Tu que é', 'Qual foi sacana', 10, 15, '2025-02-03'),
(12, 'Mensagem para dani', 'Hello Dani tudo bem?\r\n', 15, 140, '2025-02-03'),
(13, 'EDu', 'Edu na voz', 15, 131, '2025-02-03'),
(15, 'Fala meu batera', 'Meu brother, a gente consegue adiar pra umas 21:30 ? Tive um B.O aqui...', 15, 10, '2025-02-03'),
(16, 'Rapaz.', 'Cada um com seus problemas gente boa', 10, 15, '2025-02-03'),
(17, 'Isso ai ', 'Boto fé negão', 15, 10, '2025-02-03'),
(18, 'Nossa aula amanhã', 'Prof, tudo certo com nossa aula?', 163, 15, '2025-02-05'),
(19, 'Nossa aula amanhã', 'Vai dar não, tô no reggae', 15, 163, '2025-02-05'),
(20, 'cuidado', 'Professor descarado', 163, 15, '2025-02-05'),
(21, 'Toaadsd', 'asdasdsdasd', 165, 15, '2025-02-15'),
(22, 'Dificuldade', 'Estou com dificuldade na atividade', 166, 130, '2025-02-16');

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagem_remetente`
--

CREATE TABLE `mensagem_remetente` (
  `id` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `corpo` text NOT NULL,
  `remetente` int(11) NOT NULL,
  `destinatario` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `mensagem_remetente`
--

INSERT INTO `mensagem_remetente` (`id`, `titulo`, `corpo`, `remetente`, `destinatario`, `data`) VALUES
(1, 'ASdas', 'ASDASDA', 14, 10, '2025-02-03'),
(2, 'Toaadsd', 'ASDASDA', 14, 10, '2025-02-03'),
(3, 'LOREM', '\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"\n\n\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"\n\n\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"', 14, 10, '2025-02-03'),
(4, 'Toaadsd', 'ENVIANDO MENSAGEM', 14, 10, '2025-02-03'),
(5, 'Toaadsd', 'Envia denovo', 14, 10, '2025-02-03'),
(6, 'Toaadsd', 'Envia denovo', 14, 10, '2025-02-03'),
(7, 'ASdas', 'AGORA SIM PORRA', 14, 10, '2025-02-03'),
(9, 'Ta indo', 'O XINHO È SAFADO', 15, 10, '2025-02-03'),
(11, 'Respondendo essa parada', 'Respondendo aqui para ficar tudo bem', 10, 14, '2025-02-03'),
(12, 'Mensagem para dani', 'Hello Dani tudo bem?\r\n', 15, 140, '2025-02-03'),
(15, 'Fala meu batera', 'Meu brother, a gente consegue adiar pra umas 21:30 ? Tive um B.O aqui...', 15, 10, '2025-02-03'),
(16, 'Rapaz.', 'Cada um com seus problemas gente boa', 10, 15, '2025-02-03'),
(17, 'Isso ai ', 'Boto fé negão', 15, 10, '2025-02-03'),
(18, 'Nossa aula amanhã', 'Prof, tudo certo com nossa aula?', 163, 15, '2025-02-05'),
(19, 'Nossa aula amanhã', 'Vai dar não, tô no reggae', 15, 163, '2025-02-05'),
(20, 'cuidado', 'Professor descarado', 163, 15, '2025-02-05'),
(21, 'Toaadsd', 'asdasdsdasd', 165, 15, '2025-02-15'),
(22, 'Dificuldade', 'Estou com dificuldade na atividade', 166, 130, '2025-02-16');

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor_aluno`
--

CREATE TABLE `professor_aluno` (
  `professor_id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_professor`
--

CREATE TABLE `tb_professor` (
  `id` int(11) NOT NULL,
  `preco_aula` decimal(10,2) NOT NULL,
  `area` int(11) DEFAULT NULL,
  `quantidade_aulas_aplicadas` int(11) NOT NULL,
  `descricao` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_professor`
--

INSERT INTO `tb_professor` (`id`, `preco_aula`, `area`, `quantidade_aulas_aplicadas`, `descricao`, `user_id`, `rating`) VALUES
(50, 10.00, 7, 1, 'Vamo Mudar Aqui Papae', 14, 16),
(51, 459.00, 27, 10, 'Sou Um Dev', 10, 40),
(52, 50.00, 26, 0, 'Aquitetura Por Amor', 15, 25),
(53, 56.65, 4, 0, 'Wf Motores', 18, 0),
(54, 156.00, 2, 25, 'Sou um professor muito bom', 100, 0),
(55, 200.00, 3, 0, 'Especialista Em Matemática Avançada', 101, 150),
(56, 180.00, 5, 20, 'Aulas de física com enfoque em mecânica', 102, 130),
(57, 220.00, 2, 0, 'Professor De Química Orgânica', 103, 140),
(58, 190.00, 4, 0, 'Aulas De Biologia Molecular', 104, 160),
(59, 210.00, 6, 0, 'Professor De História Contemporânea', 105, 170),
(500, 156.00, 2, 25, 'Sou um professor muito bom', 110, 120),
(501, 160.00, 3, 0, 'Especialista Em Gramática', 111, 150),
(502, 180.00, 5, 20, 'Aulas de física com enfoque em mecânica', 112, 130),
(503, 220.00, 2, 40, 'Professor de química orgânica', 113, 140),
(504, 190.00, 4, 35, 'Aulas de biologia molecular', 114, 160),
(505, 210.00, 6, 0, 'Professor De História Contemporânea', 115, 170),
(506, 200.00, 3, 0, 'Especialista Em Matemática Avançada', 116, 150),
(507, 180.00, 5, 20, 'Aulas de física com enfoque em mecânica', 117, 130),
(508, 220.00, 2, 40, 'Professor de química orgânica', 118, 140),
(509, 190.00, 4, 35, 'Aulas de biologia molecular', 119, 160),
(510, 210.00, 6, 25, 'Professor de história contemporânea', 120, 170),
(511, 200.00, 3, 0, 'Especialista Em Matemática Avançada', 121, 150),
(512, 180.00, 5, 20, 'Aulas de física com enfoque em mecânica', 122, 130),
(513, 220.00, 2, 40, 'Professor de química orgânica', 123, 140),
(514, 190.00, 4, 35, 'Aulas de biologia molecular', 124, 160),
(515, 210.00, 6, 25, 'Professor de história contemporânea', 125, 170),
(516, 200.00, 3, 0, 'Especialista Em Matemática Avançada', 126, 150),
(517, 180.00, 5, 0, 'Aulas De Física Com Enfoque Em Mecânica', 127, 130),
(518, 220.00, 2, 40, 'Professor de química orgânica', 128, 140),
(519, 190.00, 4, 35, 'Aulas de biologia molecular', 129, 160),
(520, 210.00, 6, 25, 'Professor de história contemporânea', 130, 170),
(521, 200.00, 3, 0, 'Especialista Em Matemática Avançada', 131, 150),
(522, 180.00, 5, 0, 'Aulas De Física Com Enfoque Em Mecânica', 132, 130),
(523, 220.00, 2, 40, 'Professor de química orgânica', 133, 140),
(524, 190.00, 4, 0, 'Aulas De Biologia Molecular', 134, 160),
(525, 210.00, 6, 0, 'Professor De História Contemporânea', 135, 170),
(526, 200.00, 3, 30, 'Especialista em matemática avançada', 136, 150),
(527, 180.00, 5, 20, 'Aulas de física com enfoque em mecânica', 137, 130),
(528, 220.00, 2, 40, 'Professor de química orgânica', 138, 140),
(529, 190.00, 4, 35, 'Aulas de biologia molecular', 139, 160),
(530, 210.00, 6, 25, 'Professor de história contemporânea', 140, 170),
(531, 200.00, 3, 30, 'Especialista em matemática avançada', 141, 150),
(532, 180.00, 5, 20, 'Aulas de física com enfoque em mecânica', 142, 130),
(533, 220.00, 2, 40, 'Professor de química orgânica', 143, 140),
(534, 190.00, 4, 35, 'Aulas de biologia molecular', 144, 160),
(535, 210.00, 6, 25, 'Professor de história contemporânea', 145, 170),
(536, 200.00, 3, 30, 'Especialista em matemática avançada', 146, 150),
(537, 180.00, 5, 20, 'Aulas de física com enfoque em mecânica', 147, 130),
(538, 220.00, 2, 40, 'Professor de química orgânica', 148, 140),
(539, 190.00, 4, 35, 'Aulas de biologia molecular', 149, 160),
(540, 210.00, 6, 25, 'Professor de história contemporânea', 150, 170),
(541, 200.00, 3, 30, 'Especialista em matemática avançada', 151, 150),
(542, 180.00, 5, 20, 'Aulas de física com enfoque em mecânica', 152, 130),
(543, 220.00, 2, 40, 'Professor de química orgânica', 153, 140),
(544, 190.00, 4, 35, 'Aulas de biologia molecular', 154, 160),
(545, 210.00, 6, 25, 'Professor de história contemporânea', 155, 170),
(546, 200.00, 3, 30, 'Especialista em matemática avançada', 156, 150),
(547, 180.00, 5, 20, 'Aulas de física com enfoque em mecânica', 157, 130),
(548, 220.00, 2, 0, 'Professor De Química Orgânica', 158, 140),
(549, 190.00, 4, 35, 'Aulas de biologia molecular', 159, 160),
(550, 40.00, 4, 0, 'Falando Um Pouco Sobre Abs', 162, 0),
(551, 30.00, 7, 0, 'Sou Legal', 163, 35),
(552, 312.22, 12, 0, 'Comigo Você Irá Melhorar Seu Nível De Futebol Em Outro Patamar! ', 164, 0),
(553, 4.54, 5, 0, 'Knoij', 165, 0),
(554, 50.00, 6, 0, 'Olá Me Chamo Luca, Sou Professor De Física Formado Pela Universidade Federal Do Sul Da Bahia, Tenho 10 Anos De Profissão, Sou Mestre Pela Universidade Estadual De Santa Cruz', 166, 0),
(555, 20.00, 11, 51, 'Prof Junto', 168, 520),
(556, 157.00, 19, 5, 'Fernando Beiramar é Um Empresário Visionário Conhecido Por Sua Atuação Em Diversos Setores Da Economia. Com Um Perfil Empreendedor Arrojado, Ele Construiu Um Império Empresarial Baseado Em Inovação, Estratégia E Diversificação De Negócios.', 169, 25),
(557, 112.00, 17, 0, 'Sou Um Economista Reconhecido Por Sua Atuação Em Análises Financeiras E Estratégias De Mercado. Com Vasta Experiência, Contribuí Para O Desenvolvimento Econômico E Empresarial. Me Destaco Pela Visão Estratégica E Precisão Em Dados.', 170, 0),
(558, 100.00, 7, 0, 'Sou Walter White, Um Químico Apaixonado Pela Ciência E Suas Infinitas Possibilidades. Minha Expertise Em Reações E Síntese Química Me Levou A Caminhos Desafiadores, Onde Precisei Tomar Decisões Extremas. Cada Fórmula Que Crio Reflete Meu Conhecimento E Determinação.', 175, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` varchar(60) NOT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `linkFoto` varchar(100) DEFAULT NULL,
  `token` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_user`
--

INSERT INTO `tb_user` (`id`, `nome`, `email`, `senha`, `telefone`, `linkFoto`, `token`) VALUES
(10, 'Lucas Eduardo', 'Lucas@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981405275', '../uploads/fotoPerfil10.jpg', 'RB07GTwrDH2RfyL7ifuXrrS48$2NUB6nlA4MuUs!fi38sJU9Y6'),
(14, 'Larah Raquel', 'larah@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981521509', '../uploads/fotoPerfil14.jpg', 'DXrDCHAOyNxHy#BbQP5z7NyZcuKJ5R3i@02DkIty20rsOZk8zt'),
(15, 'Joran Joshwa', 'Joran@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '15615615', '../uploads/fotoPerfil15.jpg', 'HSAEqBAJqa$Bsx!J3Xt4Py@NUlKaV0n1!ukUNPoT9c9GRuNzKA'),
(16, 'Alexsander Zanello', 'Alex1@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '123456', 'https://th.bing.com/th/id/OIP.XFLLZJOwMaScypqOg5K1rAHaHa?rs=1&pid=ImgDetMain', 'Y8#Hq74RNSGo8WB2qUeqw3mWXabxPj8PSlKapWxcb7Xd$GzQTP'),
(17, 'Alexsander Zanello', 'Alex2@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981405275', 'https://th.bing.com/th/id/OIP.TZUM9XJpNuzu6Yy4GrYP9QHaHa?rs=1&pid=ImgDetMain', 'yktSx3@Menh$sSnVSEBdSOUST2e01Ps9ne2io!JEGK9DMkhPLn'),
(18, 'Dajuda ', 'Dajuda@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981405276', '../uploads/fotoPerfil18.jpg', 'Yu9QjabU0B3F7PZb#lxvPgat7YMGjmkUL7zm9@56OWTqab@vJ@'),
(100, 'Fabio Dias', 'Fabio@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252247', '../uploads/semPerfil.png', 'SQEX2@bSfTvhyAnqH@Jkj!8cpToyG#cwrL22AArBm@PA7wsVCY'),
(101, 'Ana Silva', 'ana.silva@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252248', '../uploads/fotoPerfil101.jpg', '2PZra0$7dBAX95aWty@IMyHRsIikzWR5XEzuu7eRTE$T0xmJoC'),
(102, 'Carlos Oliveira', 'carlos.oliveira@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252249', '../uploads/fotoPerfil102.jpg', 'me8HR2$Shvnw$WfBqXYKXyK!h2TYUZyy!tlLa1biGTxwPaGk3t'),
(103, 'Mariana Costa', 'mariana.costa@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252250', '../uploads/fotoPerfil103.jpg', '$kl#Afb4#aQSK#NOallvaazj#n!@mtx9dp#ei37g1#Z0aQRq1i'),
(104, 'Pedro Santos', 'pedro.santos@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252251', '../uploads/fotoPerfil104.jpg', 'Pilv5ks7tRfpQvQPVfF626reZV0kXj6iybE3KewZQbwyqle!iX'),
(105, 'Julia Fernandes', 'julia.fernandes@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252252', '../uploads/fotoPerfil105.jpg', 'Sf0LNbcfcs2XrLb36UdNPNDDGd6Nrf4ucuG9AXQZcEw2Av9o!t'),
(110, 'Ana Silva', 'ana@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252248', '../uploads/fotoPerfil110.jpg', 'C3JT1StELge0EP76VAS$Fudu7QS5rwVIJIm8F7MZ6I@!voNR6d'),
(111, 'Carlos Oliveira', 'carlos@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252249', '../uploads/fotoPerfil111.jpeg', 'wQQGLJv0nMtId9hK$GVdLvergvuua7$vie@Kx4naIhJqMe9Okb'),
(112, 'Mariana Costa Dos Santos', 'mariana@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252250', '../uploads/fotoPerfil112.jpg', 'IC9f1wCGQ1022iiWwuprJ4B$qVUAyiITj@eB5Lz1jNdOpLInvW'),
(113, 'Pedro Santos', 'pedro.santos@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252251', '../uploads/semPerfil.png', 'B7$WATxfJcophXkoT91YuZ1!IMFYe7IdbIWW0O!0AwC1Gl85HW'),
(114, 'Julia Fernandes Alves', 'julia@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252252', '../uploads/fotoPerfil114.jpg', 'hen8WT7UCW1Zobg5f99bCjTbj78jcoicZMsldxXvZJ8$AM$bEV'),
(115, 'Lucas Almeida', 'lucas.almeida@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252253', '../uploads/fotoPerfil115.jpg', 'nw60V5ZHEFWpM6@dJsHnWxyjAXJ4XzAcSKjI#iuasjYP7xKN1b'),
(116, 'Fernanda Lima', 'fernanda.lima@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252254', '../uploads/fotoPerfil116.jpg', '94YKG5UjUee!LKJ@B2za2xyI!VVg9QaJqLqFArCWMBZFLyFw2k'),
(117, 'Rafael Souza', 'rafael.souza@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252255', '../uploads/fotoPerfil117.jpg', '71lvZDxosru0UG!8H44@g9M0MSvVaxyI8mOxyak8zVEbQJImIR'),
(118, 'Camila Rocha', 'camila.rocha@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252256', '../uploads/fotoPerfil118.jpg', 'MNNvo#BJ3TaKkCHd7s1Nb5Xk2!CHWBk$RxYWiAwF2IaIAQjmmO'),
(119, 'Bruno Mendes', 'bruno.mendes@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252257', '../uploads/fotoPerfil119.jpg', 'jHxlVF$o@4tl@v8y@iiA99HotORIAw!aFso#jDWFNkiKQuUTQd'),
(120, 'Isabela Castro', 'isabela.castro@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252258', '../uploads/fotoPerfil120.jpg', 'RPP@D7uwX8oIhxIFsqNe!xiUlcnVfcwyk#3#xYNnkwpMJT2FD3'),
(121, 'Thiago Nunes', 'thiago.nunes@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252259', '../uploads/fotoPerfil121.jpg', '$cUTMHyxE0Yh7VqmWQIfRPUW$iFzF46ocVXUOD0EeuHOW3j!KP'),
(122, 'Patrícia Gomes', 'patricia.gomes@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252260', '../uploads/fotoPerfil122.jpg', 'p1A8t9YEntoJbRsw9mNX#SdWBJb!j#tLFv43zzl8JDhWbDwYD9'),
(123, 'Gustavo Barbosa', 'gustavo.barbosa@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252261', '../uploads/fotoPerfil123.jpg', 'zV#212OjU@73VzwNpg7WrmzuSIcSDw3PNrsriQ534VqhpgUCeU'),
(124, 'Amanda Dias', 'amanda.dias@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252262', '../uploads/fotoPerfil124.jpg', 'uLN3QDckBeQeFzQ5fj@9P4YGAPpG!On4qSV1YSOU#McK@XvECa'),
(125, 'Roberto Martins', 'roberto.martins@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252263', '../uploads/fotoPerfil125.jpg', 'Kfsbbq4i0bKONjdlSSwXuo5ene4skHHcaLRr@hb!XlkHtsBeyu'),
(126, 'Larissa Cardoso', 'larissa.cardoso@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252264', '../uploads/fotoPerfil126.jpg', 'YatXxFN$3!kvMpQwZJd@GbNgNFvMWw5PgHBUuiG589Wk@uPR86'),
(127, 'Diego Ribeiro', 'diego.ribeiro@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252265', '../uploads/fotoPerfil127.jpg', 'i!pXHYVYy835@L$8zU5k@j3d!i0kd1nGFA!8zsLx#YwrkLfnV2'),
(128, 'Vanessa Lopes', 'vanessa.lopes@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252266', '../uploads/fotoPerfil128.jpg', 'gKJ7!@b4GxNWBgd0PE3w!Q6CXtg9dIsGX2374euatCkrLpx$jY'),
(129, 'Felipe Correia', 'felipe.correia@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252267', '../uploads/fotoPerfil129.jpg', 'mdaLX7kGFJr7VfWhDtfrEwmst$jIc8CGyrCEEyxIhy4f1JjKU@'),
(130, 'Carolina Neves', 'carolina.neves@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252268', '../uploads/fotoPerfil130.jpg', 'qNnWpWYI8eGb7zB##8uvq6ZuCKwjp#BNggkoAmlne5ORgoyRl4'),
(131, 'Eduardo Pires', 'eduardo.pires@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252269', '../uploads/fotoPerfil131.jpg', 'PiZ!vNsNSgKwxHrKALCbnwzCqrOZ26o8CtwIoAXPdO#hYzrxuB'),
(132, 'Tatiane Araújo', 'tatiane.araujo@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252270', '../uploads/fotoPerfil132.jpg', 'Jr!DGuG9$fAcyYwHrhK9rtZt9fercPFH77V8uikY3Mp4e7aqAl'),
(133, 'Marcos Teixeira', 'marcos.teixeira@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252271', '../uploads/fotoPerfil133.jpg', 'y2npHT@2OguzgMQaGAVVgr3B!34SpsfnCzv9qKAQMUb9xgcGU$'),
(134, 'Aline Monteiro', 'aline.monteiro@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252272', '../uploads/fotoPerfil134.jpg', '$zY$jGc9c45FdEbw!MSjkHLkAC71mpYjW7WNrYmGkMUpUAXoBO'),
(135, 'Ricardo Moreira', 'ricardo.moreira@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252273', '../uploads/fotoPerfil135.jpg', '0k03SmHAA@tjXAvrpI#jhgaXop5uOppOhYUcfKCeCAg6j$RLJj'),
(136, 'Sandra Alves', 'sandra.alves@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252274', '../uploads/fotoPerfil136.jpg', 'kBhJBfWXIiuPkTOVPo4qiyV67lok!Rjabxk7GFMWtewDqUFX#7'),
(137, 'André Cunha', 'andre.cunha@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252275', '../uploads/fotoPerfil137.jpg', 'eciEO621MfSiIKkSej27Iu@JTTjffbdB8i#pE4E9xi964sYREG'),
(138, 'Cláudia Freitas', 'claudia.freitas@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252276', '../uploads/fotoPerfil138.jpg', 'BvNmfc69milOZAVkM0!pQIkFr#!FV9#osKmlfb3Bd5eNxf61nP'),
(139, 'José Carvalho', 'jose.carvalho@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252277', '../uploads/fotoPerfil139.jpg', '9booBIh81wLj8$mgfNSeRZOCj4o4B3PrR2#vO39L7m2wNWCMwE'),
(140, 'Daniela Peixoto', 'daniela.peixoto@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252278', '../uploads/fotoPerfil140.jpg', 'MMQH2kfp0mWEOu@l!!OFUGwX#SeaF@zUmHX1eFxJ1mogVZbj$r'),
(141, 'Rodrigo Guimarães', 'rodrigo.guimaraes@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252279', '../uploads/fotoPerfil141.jpg', '!WPHTKmNqK8YPE34Xe$iVwvuhZ0ngNpNSzjg#8gWnBrDSUXe5L'),
(142, 'Márcia Fonseca', 'marcia.fonseca@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252280', '../uploads/fotoPerfil142.jpg', 'WwYyGcjN0hiQuN45@Qxm3yv8y8Pk8kojuq!zL$QL#5c!84#QV1'),
(143, 'Paulo Machado', 'paulo.machado@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252281', '../uploads/fotoPerfil143.jpg', 'sgk1hMtu!@gFmh3e9$27b3@e3r@2#s6CPAY7VT8@t5kMIsw2zm'),
(144, 'Renata Barros', 'renata.barros@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252282', '../uploads/fotoPerfil144.jpg', '@tt@tHKhRJzu8joe6hMMX$0lltCvNx2djHZzzThm1o@fyd49tC'),
(145, 'Alexandre Costa', 'alexandre.costa@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252283', '../uploads/fotoPerfil145.jpg', 'HIy##xdwc0kbTwrrA!oDi5tBr5#SNijPYctV$szE0W0B5gjQum'),
(146, 'Cristina Rocha', 'cristina.rocha@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252284', '../uploads/fotoPerfil146.jpg', 'ZTSVM@JPtP3shHciFeYKzCQKVRRo6rQthCMuXrYfi69odLBJjJ'),
(147, 'Marcelo Lima', 'marcelo.lima@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252285', '../uploads/fotoPerfil147.jpg', 'gB#ys5oMqemIuWC!zAiSD4NA$@IC69uj@NwHOLHtb7i9o6H7o9'),
(148, 'Luciana Fernandes', 'luciana.fernandes@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252286', '../uploads/fotoPerfil148.jpg', 'YYHVomuXr$vlBebJLtBj@!6h$Y0o8SfCeFTaq$BEeBnG0HZ4vA'),
(149, 'Vitor Santos', 'vitor.santos@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252287', '../uploads/fotoPerfil149.jpg', 'DPl0PVgdx$14sjHdF9iwjyfwvieqFrZcHobvt2GbPtb6YAC9em'),
(150, 'Helena Oliveira', 'helena.oliveira@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252288', '../uploads/fotoPerfil150.jpeg', 'VHGGReCB#zfcn4y9QJ@mQSn7P97GcBDPhJN2crPTIUC@X#9o1C'),
(151, 'Leonardo Souza', 'leonardo.souza@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252289', '../uploads/fotoPerfil151.jpeg', '4BjJ$402ZYn12SskfABtQVQLzvLCGGr@AN17fz8xNUlm1mOmAn'),
(152, 'Beatriz Almeida', 'beatriz.almeida@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252290', '../uploads/fotoPerfil152.jpeg', 'QMt0dnFhZ3is!$8@e5CqbkJLZOuSNqAwt7yEKCGP$0MLcZbyKY'),
(153, 'Roberta Nunes', 'roberta.nunes@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252291', '../uploads/fotoPerfil153.jpg', 'yvSROQT4jXVEUQ2RyUJb3j#Cg45mC#$fRdC0IkNDIoAfXh0qqL'),
(154, 'Fábio Dias', 'fabio.dias@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252292', '../uploads/fotoPerfil154.jpg', '7VkOerkdQnFM#$6rJWA$fg8PClTYO4fL3nFx58D#Dp4JruD9mp'),
(155, 'Patrícia Gomes', 'patricia@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252293', '../uploads/fotoPerfil155.jpg', '52vG2xtj4rWMJ2id4CSwGlmPIbR0l4tjleyfy8AiqZ4I$8qJKD'),
(156, 'Gustavo Barbosa De Jupiter', 'gustavo@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252294', '../uploads/fotoPerfil156.jpg', '6YlCXbDBB3wz1QclfZb58zYW4Pf7zaeUUS4B1x@nrnknN@!sue'),
(157, 'Amanda Dias', 'amanda@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252295', '../uploads/fotoPerfil157.jpeg', 'CQg@TPuXk#h2F9dgpI#XqSDaJ45jl4cYih80D3Xy9v9A2ouaf1'),
(158, 'Roberto Martins', 'roberto@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252296', '../uploads/fotoPerfil158.jpeg', '@yqALBfySL0M22gv1sDlC7cNBRaO8glZjWBL05H1I8BbRKz7MK'),
(159, 'Larissa Cardoso', 'larissa@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981252297', '../uploads/fotoPerfil159.jpg', 'oIqu73t4zf725D@mvb5#H@y5hqfmHyZn#RIzJ5tz6y4jIM4W$w'),
(161, 'Esron', 'Esron@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981405275', '../uploads/fotoPerfil161.jpg', 'pg@4XWwFNL3X$P$TL9qCqbz8V9ZiI1zN6WASdKCbMwbnCUV6fM'),
(162, 'Absolon', 'Absolon@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '1516516516516516', '../uploads/fotoPerfil162.jpg', 'b19h5woa1er$Fr@Ve0daSxyPyfDU!QO$yFCPqQWVaAZzink8fT'),
(163, 'Ianca', 'Ianca_boli@hotmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '22233344', '../uploads/fotoPerfil163.jpg', '8Q9en8eQooRB$kEQDCJNT956@$1Ut2QMplF@Y6emmp3GQ#SV#3'),
(164, 'Neymar', 'Nj@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73981405275', '../uploads/fotoPerfil164.jpg', 'OFFNBJCEXleL3ggz0OAHjGxDJ@cKQJ2FFPL$Xz$OX8VN0ZTvOt'),
(165, 'Hercules', 'Hercules@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '123456789', '../uploads/fotoPerfil165.png', 'JAYkrDuziBj#MFCxJkPNVwTYUIJl2rJVKqwvx4tgpWWDm2KAS$'),
(166, 'Luca Soares Lima', 'Boybrgamer@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '73988904722', '../uploads/fotoPerfil166.png', 'Sy9pBCEhqFmPoBRK6XSALefCo#26K2s5pf!ImesbCjgbdyVcwm'),
(168, 'Robert Narciso', 'Robertnarciso@gmail.com', '$2y$10$A8ADHk1DAM/22TQ6P3N/3uj0Q.Lbtj6BQDSjigEBaWVTfL0i0W7Ty', '654497946', '../uploads/fotoPerfil168.jpg', 'kTfPIZlNvQLHofBdx6Cd!6tZjXLIM@jM00Zbz$hFoAn2dpcmlt'),
(169, 'Fernando Beiramar', 'Fernandinho@gmail.com', '$2y$10$jeraXUEbLwZo9VbpfGA.se9bVw4nYv7kLQxDUGWkczs8iBp7rcrua', '73981145486', '../uploads/fotoPerfil169.jpeg', '2R#TEQLUYtmpawbFjar1RuifZ@TQb1nACZ$4rAA@gT!7QVYzTE'),
(170, 'Fernando Gil', 'Gil.fernando@gmail.com', '$2y$10$20EiGfwPybjmSyd4/NylPepi.8AcZljTemxEJWa6S.0Uf36k3CcDy', '73998251095', '../uploads/fotoPerfil170.jpg', 'k5ra6@PXHdC0e968WG5A7nnQNpNzZsJ5x5klOy0hnn@ewhn5V8'),
(175, 'Walter White', 'Walter.white@gmail.com', '$2y$10$Gp/W6Xo0YvEMwPrwnQJVT.VWmpdkd49kewKciktlqV7Tu1LWJpnQ6', '7394945153', '../uploads/fotoPerfil175.jpg', 'P!WGkyKaD8t!92tfCJlli@QrQ5JLtgfo3!qcpJXoPYur3ubqxy');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agenda_aula`
--
ALTER TABLE `agenda_aula`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_agenda_aluno` (`aluno`),
  ADD KEY `fk_agenda_professor` (`professor`);

--
-- Índices de tabela `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `mensagem_destinatario`
--
ALTER TABLE `mensagem_destinatario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `remetente` (`remetente`),
  ADD KEY `destinatario` (`destinatario`);

--
-- Índices de tabela `mensagem_remetente`
--
ALTER TABLE `mensagem_remetente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `remetente` (`remetente`),
  ADD KEY `destinatario` (`destinatario`);

--
-- Índices de tabela `professor_aluno`
--
ALTER TABLE `professor_aluno`
  ADD PRIMARY KEY (`professor_id`,`aluno_id`),
  ADD KEY `aluno_id` (`aluno_id`);

--
-- Índices de tabela `tb_professor`
--
ALTER TABLE `tb_professor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `fk_area` (`area`);

--
-- Índices de tabela `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agenda_aula`
--
ALTER TABLE `agenda_aula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `mensagem_destinatario`
--
ALTER TABLE `mensagem_destinatario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `mensagem_remetente`
--
ALTER TABLE `mensagem_remetente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `tb_professor`
--
ALTER TABLE `tb_professor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=559;

--
-- AUTO_INCREMENT de tabela `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `agenda_aula`
--
ALTER TABLE `agenda_aula`
  ADD CONSTRAINT `fk_agenda_aluno` FOREIGN KEY (`aluno`) REFERENCES `tb_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_agenda_professor` FOREIGN KEY (`professor`) REFERENCES `tb_professor` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `mensagem_destinatario`
--
ALTER TABLE `mensagem_destinatario`
  ADD CONSTRAINT `mensagem_destinatario_ibfk_1` FOREIGN KEY (`remetente`) REFERENCES `tb_user` (`id`),
  ADD CONSTRAINT `mensagem_destinatario_ibfk_2` FOREIGN KEY (`destinatario`) REFERENCES `tb_user` (`id`);

--
-- Restrições para tabelas `mensagem_remetente`
--
ALTER TABLE `mensagem_remetente`
  ADD CONSTRAINT `mensagem_remetente_ibfk_1` FOREIGN KEY (`remetente`) REFERENCES `tb_user` (`id`),
  ADD CONSTRAINT `mensagem_remetente_ibfk_2` FOREIGN KEY (`destinatario`) REFERENCES `tb_user` (`id`);

--
-- Restrições para tabelas `professor_aluno`
--
ALTER TABLE `professor_aluno`
  ADD CONSTRAINT `professor_aluno_ibfk_1` FOREIGN KEY (`professor_id`) REFERENCES `tb_professor` (`id`),
  ADD CONSTRAINT `professor_aluno_ibfk_2` FOREIGN KEY (`aluno_id`) REFERENCES `tb_user` (`id`);

--
-- Restrições para tabelas `tb_professor`
--
ALTER TABLE `tb_professor`
  ADD CONSTRAINT `fk_area` FOREIGN KEY (`area`) REFERENCES `areas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_professor_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
