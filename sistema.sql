-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/11/2025 às 03:06
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
-- Banco de dados: `sistema`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `filmes`
--

CREATE TABLE `filmes` (
  `idFilmes` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `data_lancamento` int(11) DEFAULT NULL,
  `tempo_filme` varchar(255) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `genero` varchar(100) DEFAULT 'Outros'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `filmes`
--

INSERT INTO `filmes` (`idFilmes`, `nome`, `descricao`, `data_lancamento`, `tempo_filme`, `imagem`, `genero`) VALUES
(1, 'O Poderoso Chefão', 'A saga da família Corleone.', 1972, '175 min', 'uploads/godfather.jpg', 'Outros'),
(2, 'O Poderoso Chefão II', 'Ascensão e queda dos Corleone.', 1974, '202 min', 'uploads/godfather2.jpg', 'Outros'),
(3, 'O Poderoso Chefão III', 'O fim da jornada de Michael.', 1990, '162 min', 'uploads/godfather3.jpg', 'Outros'),
(4, 'Batman: O Cavaleiro das Trevas', 'Batman enfrenta o caos do Coringa.', 2008, '152 min', 'uploads/dark_knight.jpg', 'Outros'),
(5, 'Interestelar', 'Jornada através do espaço e do tempo.', 2014, '169 min', 'uploads/interstellar.jpg', 'Outros'),
(6, 'A Origem', 'Invasão de sonhos e segredos.', 2010, '148 min', 'uploads/inception.jpg', 'Outros'),
(7, 'Matrix', 'A realidade pode ser uma simulação.', 1999, '136 min', 'uploads/matrix.jpg', 'Outros'),
(8, 'Matrix Reloaded', 'Neo enfrenta novos desafios na Matrix.', 2003, '138 min', 'uploads/matrix_reloaded.jpg', 'Outros'),
(9, 'Matrix Revolutions', 'Conclusão da trilogia Matrix.', 2003, '129 min', 'uploads/matrix_revolutions.jpg', 'Outros'),
(10, 'Parasita', 'Sátira social sobre desigualdade.', 2019, '132 min', 'uploads/parasite.jpg', 'Outros'),
(11, 'Cidade de Deus', 'Vida nas favelas do Rio.', 2002, '130 min', 'uploads/cidade_de_deus.jpg', 'Outros'),
(12, 'Os Vingadores', 'Heróis se unem para salvar o mundo.', 2012, '143 min', 'uploads/avengers.jpg', 'Outros'),
(13, 'Vingadores: Era de Ultron', 'Confronto com Ultron.', 2015, '141 min', 'uploads/avengers_ultron.jpg', 'Outros'),
(14, 'Vingadores: Guerra Infinita', 'Batalha contra Thanos.', 2018, '149 min', 'uploads/avengers_infinity_war.jpg', 'Outros'),
(15, 'Vingadores: Ultimato', 'Desfecho épico contra Thanos.', 2019, '181 min', 'uploads/avengers_endgame.jpg', 'Outros'),
(16, 'O Senhor dos Anéis: A Sociedade do Anel', 'Jornada para destruir o Um Anel.', 2001, '178 min', 'uploads/lotr_fellowship.jpg', 'Outros'),
(17, 'O Senhor dos Anéis: As Duas Torres', 'A saga continua.', 2002, '179 min', 'uploads/lotr_two_towers.jpg', 'Outros'),
(18, 'O Senhor dos Anéis: O Retorno do Rei', 'Conclusão da trilogia.', 2003, '201 min', 'uploads/lotr_return_king.jpg', 'Outros'),
(19, 'Star Wars: Uma Nova Esperança', 'O início da saga.', 1977, '121 min', 'uploads/starwars_anh.jpg', 'Outros'),
(20, 'Star Wars: O Império Contra-Ataca', 'A luta se intensifica.', 1980, '124 min', 'uploads/starwars_empire.jpg', 'Outros'),
(21, 'Star Wars: O Retorno de Jedi', 'A queda do Império.', 1983, '132 min', 'uploads/starwars_rotj.jpg', 'Outros'),
(22, 'Star Wars: O Despertar da Força', 'Nova geração de heróis.', 2015, '138 min', 'uploads/starwars_tfa.jpg', 'Outros'),
(23, 'Star Wars: Os Últimos Jedi', 'Conflitos e descobertas.', 2017, '152 min', 'uploads/starwars_tlj.jpg', 'Outros'),
(25, 'Harry Potter e a Pedra Filosofal', 'O começo em Hogwarts.', 2001, '152 min', 'uploads/hp1.jpg', 'Outros'),
(26, 'Harry Potter e a Câmara Secreta', 'Mistérios em Hogwarts.', 2002, '161 min', 'uploads/hp2.jpg', 'Outros'),
(27, 'Harry Potter e o Prisioneiro de Azkaban', 'Novos perigos.', 2004, '142 min', 'uploads/hp3.jpg', 'Outros'),
(28, 'Harry Potter e o Cálice de Fogo', 'Torneio Tribruxo.', 2005, '157 min', 'uploads/hp4.jpg', 'Outros'),
(29, 'Harry Potter e a Ordem da Fênix', 'Resistência contra as trevas.', 2007, '138 min', 'uploads/hp5.jpg', 'Outros'),
(31, 'Harry Potter e as Relíquias da Morte: Parte 1', 'A busca pelas horcruxes.', 2010, '146 min', 'uploads/hp7_1.jpg', 'Outros'),
(32, 'Harry Potter e as Relíquias da Morte: Parte 2', 'Batalha final.', 2011, '130 min', 'uploads/hp7_2.jpg', 'Outros'),
(33, 'Forrest Gump', 'Uma vida extraordinária.', 1994, '142 min', 'uploads/forrest_gump.jpg', 'Outros'),
(34, 'Clube da Luta', 'Rebeldia e identidade.', 1999, '139 min', 'uploads/fight_club.jpg', 'Outros'),
(35, 'Pulp Fiction', 'Histórias entrelaçadas.', 1994, '154 min', 'uploads/pulp_fiction.jpg', 'Outros'),
(36, 'O Resgate do Soldado Ryan', 'Missão na Segunda Guerra.', 1998, '169 min', 'uploads/saving_private_ryan.jpg', 'Outros'),
(37, 'O Pianista', 'Sobrevivência em meio ao horror.', 2002, '150 min', 'uploads/the_pianist.jpg', 'Outros'),
(40, 'O Rei Leão', 'A jornada de Simba.', 1994, '88 min', 'uploads/lion_king.jpg', 'Outros'),
(41, 'Jurassic Park', 'Parque de dinossauros.', 1993, '127 min', 'uploads/jurassic_park.jpg', 'Outros'),
(42, 'O Silêncio dos Inocentes', 'Caça a um serial killer.', 1991, '118 min', 'uploads/silence_of_the_lambs.jpg', 'Outros'),
(43, 'O Exterminador do Futuro 2', 'Futuro e destino.', 1991, '137 min', 'uploads/terminator2.jpg', 'Outros'),
(44, 'Rocky: Um Lutador', 'A luta de Rocky.', 1976, '120 min', 'uploads/rocky.jpg', 'Outros'),
(45, 'Top Gun', 'Pilotos e rivalidades.', 1986, '110 min', 'uploads/top_gun.jpg', 'Outros'),
(46, 'De Volta para o Futuro', 'Viagem no tempo.', 1985, '116 min', 'uploads/back_to_the_future.jpg', 'Outros'),
(47, 'Um Sonho de Liberdade', 'Esperança e amizade.', 1994, '142 min', 'uploads/shawshank.jpg', 'Outros'),
(48, 'Duro de Matar', 'John McClane enfrenta terroristas em LA.', 1988, '132 min', 'uploads/duro_de_matar.jpg', 'Ação'),
(49, 'Mad Max: Estrada da Fúria', 'Furiosa e Max em uma fuga explosiva.', 2015, '120 min', 'uploads/mad_max_estrada_da_f_uria.jpg', 'Ação'),
(50, 'John Wick', 'Ex-assassino busca vingança implacável.', 2014, '101 min', 'uploads/john_wick.jpg', 'Ação'),
(52, 'O Exterminador do Futuro', 'Cyborg viaja no tempo para matar Sarah Connor.', 1984, '107 min', 'uploads/o_exterminador_do_futuro.jpg', 'Ação'),
(53, 'Velocidade Máxima', 'Ônibus com bomba não pode reduzir a velocidade.', 1994, '116 min', 'uploads/velocidade_m_axima.jpg', 'Ação'),
(55, 'Tropa de Elite', 'BOPE combate crime no Rio de Janeiro.', 2007, '115 min', 'uploads/tropa_de_elite.jpg', 'Ação'),
(56, 'Corações de Ferro', 'Tripulação de tanque na Segunda Guerra.', 2014, '134 min', 'uploads/corac_oes_de_ferro.jpg', 'Ação'),
(58, '12 Homens e uma Sentença', 'Jurados discutem veredicto sob tensão.', 1957, '96 min', 'uploads/12_homens_e_uma_sentenca.jpg', 'Drama'),
(60, 'À Espera de um Milagre', 'Milagre inesperado no corredor da morte.', 1999, '189 min', 'uploads/a_espera_de_um_milagre.jpg', 'Drama'),
(61, 'A Rede Social', 'Criação do Facebook e os conflitos legais.', 2010, '120 min', 'uploads/a_rede_social.jpg', 'Drama'),
(63, 'A Vida é Bela', 'Pai protege filho em campo de concentração.', 1997, '116 min', 'uploads/a_vida_e_bela.jpg', 'Drama'),
(64, 'O Substituto', 'Professor enfrenta desafios em escola problemática.', 1996, '105 min', 'uploads/o_substituto.jpg', 'Drama'),
(65, 'O Quarto de Jack', 'Mãe e filho buscam liberdade.', 2015, '118 min', 'uploads/o_quarto_de_jack.jpg', 'Drama'),
(66, 'Réquiem para um Sonho', 'Vidas em espiral por vício e obsessão.', 2000, '102 min', 'uploads/r_equiem_para_um_sonho.jpg', 'Drama'),
(68, 'Monty Python em Busca do Cálice Sagrado', 'Aventura absurda em estilo Python.', 1975, '91 min', 'uploads/monty_python_em_busca_do_c_alice_sagrado.jpg', 'Comédia'),
(69, 'Superbad', 'Amigos tentam aproveitar a noite antes da formatura.', 2007, '113 min', 'uploads/superbad.jpg', 'Comédia'),
(70, 'O Grande Lebowski', 'O Cara se envolve em confusão por engano.', 1998, '117 min', 'uploads/o_grande_lebowski.jpg', 'Comédia'),
(71, 'Feitiço do Tempo', 'Homem preso em loop temporal.', 1993, '101 min', 'uploads/feitico_do_tempo.jpg', 'Comédia'),
(72, 'Meninas Malvadas', 'Novata enfrenta cliques no ensino médio.', 2004, '97 min', 'uploads/meninas_malvadas.jpg', 'Comédia'),
(74, 'Se Beber, Não Case!', 'Despedida de solteiro vira caos em Vegas.', 2009, '100 min', 'uploads/se_beber_n_ao_case.jpg', 'Comédia'),
(75, 'Debi & Lóide', 'Dois amigos atrapalhados em viagem.', 1994, '107 min', 'uploads/debi_l_oide.jpg', 'Comédia'),
(76, 'As Branquelas', 'Agentes se disfarçam em socialites.', 2004, '109 min', 'uploads/as_branquelas.jpg', 'Comédia'),
(78, 'Blade Runner', 'Caçador de replicantes questiona humanidade.', 1982, '117 min', 'uploads/blade_runner.jpg', 'Ficção Científica'),
(79, 'Blade Runner 2049', 'Mistério ameaça equilíbrio entre humanos e replicantes.', 2017, '164 min', 'uploads/blade_runner_2049.jpg', 'Ficção Científica'),
(80, 'Alien, o Oitavo Passageiro', 'Tripulação enfrenta criatura mortal.', 1979, '117 min', 'uploads/alien_o_oitavo_passageiro.jpg', 'Ficção Científica'),
(83, 'A Chegada', 'Linguista tenta se comunicar com alienígenas.', 2016, '116 min', 'uploads/a_chegada.jpg', 'Ficção Científica'),
(85, 'Gattaca', 'Sociedade baseada em genética.', 1997, '106 min', 'uploads/gattaca.jpg', 'Ficção Científica'),
(86, 'District 9', 'Alienígenas segregados na Terra.', 2009, '112 min', 'uploads/district_9.jpg', 'Ficção Científica'),
(87, 'Snowpiercer', 'Humanidade sobrevivente em trem eterno.', 2013, '126 min', 'uploads/snowpiercer.jpg', 'Ficção Científica'),
(88, 'O Exorcista', 'Menina possuída e padre em exorcismo.', 1973, '122 min', 'uploads/o_exorcista.jpg', 'Terror'),
(90, 'O Iluminado', 'Hotel isolado corrói sanidade de escritor.', 1980, '146 min', 'uploads/o_iluminado.jpg', 'Terror'),
(91, 'Corra!', 'Visita à família esconde segredo perturbador.', 2017, '104 min', 'uploads/corra.jpg', 'Terror'),
(92, 'A Hora do Pesadelo', 'Assassino ataca adolescentes em sonhos.', 1984, '91 min', 'uploads/a_hora_do_pesadelo.jpg', 'Terror'),
(96, 'Invocação do Mal', 'Casal investiga assombração em fazenda.', 2013, '112 min', 'uploads/invocac_ao_do_mal.jpg', 'Terror'),
(98, 'La La Land', 'Amor em meio aos sonhos em LA.', 2016, '128 min', 'uploads/la_la_land.jpg', 'Romance'),
(99, 'Diário de uma Paixão', 'Casal vive amor inesquecível.', 2004, '123 min', 'uploads/di_ario_de_uma_paix_ao.jpg', 'Romance'),
(100, 'Orgulho e Preconceito', 'Elizabeth e Darcy em romance clássico.', 2005, '129 min', 'uploads/orgulho_e_preconceito.jpg', 'Romance'),
(109, 'Toy Story', 'Brinquedos vivem grandes aventuras.', 1995, '81 min', 'uploads/toy_story.jpg', 'Animação'),
(110, 'Toy Story 3', 'Despedida emocionante dos brinquedos.', 2010, '103 min', 'uploads/toy_story_3.jpg', 'Animação'),
(111, 'Up: Altas Aventuras', 'Velho voa com casa e balões.', 2009, '96 min', 'uploads/up_altas_aventuras.jpg', 'Animação'),
(112, 'WALL·E', 'Robô solitário descobre amor e esperança.', 2008, '98 min', 'uploads/wall_e.jpg', 'Animação'),
(113, 'Shrek', 'Ogro e burro em jornada cômica.', 2001, '90 min', 'uploads/shrek.jpg', 'Animação'),
(123, 'Onde os Fracos Não Têm Vez', 'Caçada após achado de dinheiro.', 2007, '122 min', 'uploads/onde_os_fracos_n_ao_t_em_vez.jpg', 'Thriller'),
(124, 'Cisne Negro', 'Bailarina mergulha em obsessão.', 2010, '108 min', 'uploads/cisne_negro.jpg', 'Thriller');

-- --------------------------------------------------------

--
-- Estrutura para tabela `review`
--

CREATE TABLE `review` (
  `idReview` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `idFilmes` int(11) DEFAULT NULL,
  `nota` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nome`, `email`, `senha`, `role`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$AVFASh0p1ffXfeUMkvcsV..PBrIF6MR8ipCRd3oULzE9USL2S0q2q', 'admin');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `filmes`
--
ALTER TABLE `filmes`
  ADD PRIMARY KEY (`idFilmes`);

--
-- Índices de tabela `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`idReview`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idFilmes` (`idFilmes`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `filmes`
--
ALTER TABLE `filmes`
  MODIFY `idFilmes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT de tabela `review`
--
ALTER TABLE `review`
  MODIFY `idReview` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`idFilmes`) REFERENCES `filmes` (`idFilmes`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
