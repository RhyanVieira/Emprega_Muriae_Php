-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           9.1.0 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para emprega_muriae
CREATE DATABASE IF NOT EXISTS `emprega_muriae` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `emprega_muriae`;

-- Copiando estrutura para tabela emprega_muriae.autonomo
CREATE TABLE IF NOT EXISTS `autonomo` (
  `autonomo_id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` char(11) NOT NULL,
  `telefone` char(11) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `descricao_profissional` text NOT NULL COMMENT 'Resumo ou especialização do autônomo',
  `foto_perfil` varchar(255) DEFAULT NULL,
  `cidade_id` int NOT NULL,
  `logradouro` varchar(200) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `bairro` varchar(80) DEFAULT NULL,
  `cep` char(8) DEFAULT NULL,
  PRIMARY KEY (`autonomo_id`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  KEY `fk_autonomo_cidade_idx` (`cidade_id`),
  CONSTRAINT `fk_autonomo_cidade` FOREIGN KEY (`cidade_id`) REFERENCES `cidade` (`cidade_id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.autonomo: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela emprega_muriae.cargo
CREATE TABLE IF NOT EXISTS `cargo` (
  `cargo_id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  `icone` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cargo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.cargo: ~70 rows (aproximadamente)
INSERT INTO `cargo` (`cargo_id`, `descricao`, `icone`) VALUES
	(1, 'Assistente Administrativo', NULL),
	(2, 'Analista de Recursos Humanos', NULL),
	(3, 'Auxiliar de Escritório', NULL),
	(4, 'Secretária Executiva', NULL),
	(5, 'Recepcionista', NULL),
	(6, 'Gerente Administrativo', NULL),
	(7, 'Analista Financeiro', NULL),
	(8, 'Auxiliar Contábil', NULL),
	(9, 'Supervisor de Vendas', NULL),
	(10, 'Atendente Comercial', NULL),
	(11, 'Motorista', NULL),
	(12, 'Ajudante de Carga e Descarga', NULL),
	(13, 'Operador de Produção', NULL),
	(14, 'Auxiliar de Serviços Gerais', NULL),
	(15, 'Zelador', NULL),
	(16, 'Porteiro', NULL),
	(17, 'Garçom', NULL),
	(18, 'Cozinheiro', NULL),
	(19, 'Auxiliar de Cozinha', NULL),
	(20, 'Balconista', NULL),
	(21, 'Técnico em Eletrotécnica', NULL),
	(22, 'Técnico em Mecânica', NULL),
	(23, 'Técnico em Enfermagem', NULL),
	(24, 'Técnico em Segurança do Trabalho', NULL),
	(25, 'Eletricista Industrial', NULL),
	(26, 'Mecânico de Manutenção', NULL),
	(27, 'Soldador', NULL),
	(28, 'Operador de Máquinas', NULL),
	(29, 'Encarregado de Produção', NULL),
	(30, 'Inspetor de Qualidade', NULL),
	(31, 'Professor de Educação Infantil', NULL),
	(32, 'Professor de Ensino Fundamental', NULL),
	(33, 'Professor de Matemática', NULL),
	(34, 'Professor de Português', NULL),
	(35, 'Cuidador Escolar', NULL),
	(36, 'Auxiliar de Creche', NULL),
	(37, 'Enfermeiro', NULL),
	(38, 'Fisioterapeuta', NULL),
	(39, 'Psicólogo', NULL),
	(40, 'Nutricionista', NULL),
	(41, 'Desenvolvedor Back-end', NULL),
	(42, 'Desenvolvedor Front-end', NULL),
	(43, 'Analista de Sistemas', NULL),
	(44, 'Técnico de Informática', NULL),
	(45, 'Administrador de Redes', NULL),
	(46, 'Suporte Técnico', NULL),
	(47, 'Cientista de Dados', NULL),
	(48, 'Designer Gráfico', NULL),
	(49, 'Analista de Marketing Digital', NULL),
	(50, 'Gerente de Projetos de TI', NULL),
	(51, 'Caixa', NULL),
	(52, 'Vendedor', NULL),
	(53, 'Repositor de Mercadorias', NULL),
	(54, 'Promotor de Vendas', NULL),
	(55, 'Representante Comercial', NULL),
	(56, 'Operador de Caixa', NULL),
	(57, 'Supervisor de Loja', NULL),
	(58, 'Gerente de Loja', NULL),
	(59, 'Frentista', NULL),
	(60, 'Auxiliar de Estoque', NULL),
	(61, 'Pedreiro', NULL),
	(62, 'Servente de Obras', NULL),
	(63, 'Mestre de Obras', NULL),
	(64, 'Pintor', NULL),
	(65, 'Carpinteiro', NULL),
	(66, 'Encanador', NULL),
	(67, 'Eletricista Residencial', NULL),
	(68, 'Armador de Estrutura', NULL),
	(69, 'Operador de Retroescavadeira', NULL),
	(70, 'Engenheiro Civil', NULL);

-- Copiando estrutura para tabela emprega_muriae.categoria_auto
CREATE TABLE IF NOT EXISTS `categoria_auto` (
  `categoria_auto_id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `icone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`categoria_auto_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.categoria_auto: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela emprega_muriae.categoria_estab
CREATE TABLE IF NOT EXISTS `categoria_estab` (
  `categoria_estab_id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`categoria_estab_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.categoria_estab: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela emprega_muriae.categoria_vaga
CREATE TABLE IF NOT EXISTS `categoria_vaga` (
  `categoria_vaga_id` int NOT NULL AUTO_INCREMENT,
  `icone` varchar(50) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  PRIMARY KEY (`categoria_vaga_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.categoria_vaga: ~30 rows (aproximadamente)
INSERT INTO `categoria_vaga` (`categoria_vaga_id`, `icone`, `descricao`) VALUES
	(1, 'ti-briefcase', 'Administração'),
	(2, 'ti-bar-chart', 'Vendas e Marketing'),
	(3, 'ti-wallet', 'Finanças e Contabilidade'),
	(4, 'ti-desktop', 'Tecnologia da Informação'),
	(5, 'ti-harddrives', 'Infraestrutura e Suporte'),
	(6, 'ti-ruler-pencil', 'Design e Criação'),
	(7, 'ti-blackboard', 'Educação e Ensino'),
	(8, 'ti-heart', 'Saúde e Enfermagem'),
	(9, 'ti-hummer', 'Engenharia e Construção'),
	(10, 'ti-car', 'Transporte e Logística'),
	(11, 'ti-settings', 'Produção e Operações'),
	(12, 'ti-user', 'Recursos Humanos'),
	(13, 'ti-comments', 'Atendimento ao Cliente'),
	(14, 'ti-shopping-cart', 'Comércio e Varejo'),
	(15, 'ti-clipboard', 'Serviços Administrativos'),
	(16, 'ti-stats-up', 'Consultoria e Planejamento'),
	(17, 'ti-rocket', 'Startups e Inovação'),
	(18, 'ti-light-bulb', 'Pesquisa e Desenvolvimento'),
	(19, 'ti-briefcase', 'Jurídico'),
	(20, 'ti-world', 'Turismo e Hotelaria'),
	(21, 'ti-microphone', 'Comunicação e Mídia'),
	(22, 'ti-book', 'Biblioteconomia e Arquivologia'),
	(23, 'ti-cup', 'Gastronomia e Alimentos'),
	(24, 'ti-paint-bucket', 'Arte e Cultura'),
	(25, 'ti-home', 'Serviços Domésticos'),
	(26, 'ti-plug', 'Eletricista e Manutenção'),
	(27, 'ti-hammer', 'Construção Civil'),
	(28, 'ti-pie-chart', 'Gestão e Estratégia'),
	(29, 'ti-game', 'Entretenimento e Lazer'),
	(30, 'ti-shield', 'Segurança Patrimonial');

-- Copiando estrutura para tabela emprega_muriae.cidade
CREATE TABLE IF NOT EXISTS `cidade` (
  `cidade_id` int NOT NULL AUTO_INCREMENT,
  `cidade` varchar(200) NOT NULL,
  `uf` char(2) NOT NULL,
  PRIMARY KEY (`cidade_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.cidade: ~41 rows (aproximadamente)
INSERT INTO `cidade` (`cidade_id`, `cidade`, `uf`) VALUES
	(1, 'Muriaé', 'MG'),
	(2, 'Rosário da Limeira', 'MG'),
	(3, 'Miradouro', 'MG'),
	(4, 'Vieiras', 'MG'),
	(5, 'Eugenópolis', 'MG'),
	(6, 'Patrocínio do Muriaé', 'MG'),
	(7, 'Barão de Monte Alto', 'MG'),
	(8, 'Palma', 'MG'),
	(9, 'Recreio', 'MG'),
	(10, 'Laranjal', 'MG'),
	(11, 'Cataguases', 'MG'),
	(12, 'Itaperuna', 'RJ'),
	(13, 'Tombos', 'MG'),
	(14, 'Carangola', 'MG'),
	(15, 'Divino', 'MG'),
	(16, 'Fervedouro', 'MG'),
	(17, 'São Francisco do Glória', 'MG'),
	(18, 'Ervália', 'MG'),
	(19, 'Cajuri', 'MG'),
	(20, 'Ubá', 'MG'),
	(21, 'Viçosa', 'MG'),
	(22, 'Guiricema', 'MG'),
	(23, 'Silveirânia', 'MG'),
	(24, 'Leopoldina', 'MG'),
	(25, 'Argirita', 'MG'),
	(26, 'São João Nepomuceno', 'MG'),
	(27, 'Astolfo Dutra', 'MG'),
	(28, 'Dona Euzébia', 'MG'),
	(29, 'Guarani', 'MG'),
	(30, 'Piraúba', 'MG'),
	(31, 'Rio Pomba', 'MG'),
	(32, 'Santo Antônio de Pádua', 'RJ'),
	(33, 'Porciúncula', 'RJ'),
	(34, 'Natividade', 'RJ'),
	(35, 'Italva', 'RJ'),
	(36, 'Laje do Muriaé', 'RJ'),
	(37, 'Cambuci', 'RJ'),
	(38, 'Araponga', 'MG'),
	(39, 'Espera Feliz', 'MG'),
	(40, 'Caparaó', 'MG'),
	(41, 'Manhuaçu', 'MG');

-- Copiando estrutura para tabela emprega_muriae.clique_celular
CREATE TABLE IF NOT EXISTS `clique_celular` (
  `clique_celular_id` int NOT NULL AUTO_INCREMENT,
  `estabelecimento_id` int NOT NULL,
  `visitante_id` int NOT NULL,
  `celular` char(11) NOT NULL,
  `telefone_id` int DEFAULT NULL,
  `data_clique` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`clique_celular_id`),
  KEY `fk_estabelecimento_clique_celular_idx` (`estabelecimento_id`),
  KEY `fk_telefone_clique_celular_idx` (`telefone_id`),
  CONSTRAINT `fk_estabelecimento_clique_celular` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimento` (`estabelecimento_id`),
  CONSTRAINT `fk_telefone_clique_celular` FOREIGN KEY (`telefone_id`) REFERENCES `telefone` (`telefone_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.clique_celular: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela emprega_muriae.clique_telefone
CREATE TABLE IF NOT EXISTS `clique_telefone` (
  `clique_telefone_id` int NOT NULL AUTO_INCREMENT,
  `estabelecimento_id` int NOT NULL,
  `visitante_id` int NOT NULL,
  `telefone` char(11) NOT NULL,
  `telefone_id` int DEFAULT NULL,
  `data_clique` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`clique_telefone_id`),
  KEY `fk_estabelecimento_clique_telefone_idx` (`estabelecimento_id`),
  KEY `fk_telefone_clique_telefone_idx` (`telefone_id`),
  CONSTRAINT `fk_estabelecimento_clique_telefone` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimento` (`estabelecimento_id`),
  CONSTRAINT `fk_telefone_clique_telefone` FOREIGN KEY (`telefone_id`) REFERENCES `telefone` (`telefone_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.clique_telefone: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela emprega_muriae.curriculum
CREATE TABLE IF NOT EXISTS `curriculum` (
  `curriculum_id` int NOT NULL AUTO_INCREMENT,
  `pessoa_fisica_id` int NOT NULL,
  `nome` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `logradouro` varchar(60) NOT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `complemento` varchar(20) DEFAULT NULL,
  `bairro` varchar(50) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `cidade_id` int NOT NULL,
  `celular` varchar(11) NOT NULL,
  `dataNascimento` date NOT NULL,
  `sexo` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'M=Masculino;F=Feminino; O=Outro; N=Não Informado',
  `foto` varchar(100) DEFAULT NULL,
  `email` varchar(120) NOT NULL,
  `apresentacaoPessoal` text,
  `curriculo_arquivo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`curriculum_id`),
  UNIQUE KEY `pessoa_fisica_id` (`pessoa_fisica_id`),
  KEY `fk_curriculum_cidade1_idx` (`cidade_id`),
  KEY `fk_curriculum_pessoa_fisica1_idx` (`pessoa_fisica_id`),
  CONSTRAINT `fk_pesso_fisca_curriculum` FOREIGN KEY (`pessoa_fisica_id`) REFERENCES `pessoa_fisica` (`pessoa_fisica_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.curriculum: ~2 rows (aproximadamente)
INSERT INTO `curriculum` (`curriculum_id`, `pessoa_fisica_id`, `nome`, `logradouro`, `numero`, `complemento`, `bairro`, `cep`, `cidade_id`, `celular`, `dataNascimento`, `sexo`, `foto`, `email`, `apresentacaoPessoal`, `curriculo_arquivo`) VALUES
	(44, 117, 'Rhyan Vieira', 'Rua Francisco Bertoni Benevenute', '39', 'Casa', 'Franscico', '36878000', 18, '32999550336', '2003-06-17', 'M', NULL, 'rhyanmayconsvadm@gmail.com', 'Oi oi', NULL),
	(46, 116, 'Rhyan Vieira', 'Rua Francisco Bertoni Benevenute', '37', 'Casa', 'Franscico', '36878000', 29, '32999550336', '2003-06-17', 'M', NULL, 'rhyanmayconsv@gmail.com', '', NULL);

-- Copiando estrutura para tabela emprega_muriae.curriculum_escolaridade
CREATE TABLE IF NOT EXISTS `curriculum_escolaridade` (
  `curriculum_escolaridade_id` int NOT NULL AUTO_INCREMENT,
  `curriculum_id` int NOT NULL,
  `inicioMes` int NOT NULL,
  `inicioAno` int NOT NULL,
  `fimMes` int NOT NULL,
  `fimAno` int NOT NULL,
  `descricao` varchar(60) NOT NULL,
  `instituicao` varchar(60) NOT NULL,
  `cidade_id` int NOT NULL,
  `escolaridade_id` int NOT NULL,
  PRIMARY KEY (`curriculum_escolaridade_id`),
  KEY `fk_curriculum_escolaridade_cidade1_idx` (`cidade_id`),
  KEY `fk_curriculum_escolaridade_curriculum1_idx` (`curriculum_id`),
  KEY `fk_curriculum_escolaridade_escolaridade1_idx` (`escolaridade_id`),
  CONSTRAINT `fk_curriculum_escolaridade_cidade1` FOREIGN KEY (`cidade_id`) REFERENCES `cidade` (`cidade_id`),
  CONSTRAINT `fk_curriculum_escolaridade_escolaridade1` FOREIGN KEY (`escolaridade_id`) REFERENCES `escolaridade` (`escolaridade_id`),
  CONSTRAINT `fk_escolaridade_curriculum` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`curriculum_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.curriculum_escolaridade: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela emprega_muriae.curriculum_experiencia
CREATE TABLE IF NOT EXISTS `curriculum_experiencia` (
  `curriculum_experiencia_id` int NOT NULL AUTO_INCREMENT,
  `curriculum_id` int NOT NULL,
  `inicioMes` int NOT NULL,
  `inicioAno` int NOT NULL,
  `fimMes` int DEFAULT NULL,
  `fimAno` int DEFAULT NULL,
  `estabelecimento` varchar(60) DEFAULT NULL,
  `cargo_id` int NOT NULL,
  `cargoDescricao` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `atividadesExercidas` text,
  PRIMARY KEY (`curriculum_experiencia_id`),
  KEY `fk_curriculum_experiencia_curriculum1_idx` (`curriculum_id`),
  KEY `fk_curriculum_experiencia_cargo1_idx` (`cargo_id`),
  CONSTRAINT `fk_curriculum_experiencia_cargo1` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`cargo_id`),
  CONSTRAINT `fk_curriculum_experiencia_curriculum1` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`curriculum_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.curriculum_experiencia: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela emprega_muriae.curriculum_idioma
CREATE TABLE IF NOT EXISTS `curriculum_idioma` (
  `curriculum_idioma_id` int NOT NULL AUTO_INCREMENT,
  `curriculum_id` int NOT NULL,
  `idioma_id` int NOT NULL,
  `nivel` int DEFAULT NULL COMMENT '1 = Básico, 2 = Intermediário, 3 = Avançado, 4 = Fluente, 5 = Nativo',
  PRIMARY KEY (`curriculum_idioma_id`) USING BTREE,
  KEY `fk_curriculum_idioma_curriculum` (`curriculum_id`) USING BTREE,
  KEY `fk_curriculum_idioma_idioma` (`idioma_id`) USING BTREE,
  CONSTRAINT `fk_curriculum_idioma_curriculum` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`curriculum_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_curriculum_idioma_idioma` FOREIGN KEY (`idioma_id`) REFERENCES `idioma` (`idioma_id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.curriculum_idioma: ~0 rows (aproximadamente)
INSERT INTO `curriculum_idioma` (`curriculum_idioma_id`, `curriculum_id`, `idioma_id`, `nivel`) VALUES
	(10, 46, 5, 3),
	(11, 46, 35, 5),
	(12, 46, 20, 4);

-- Copiando estrutura para tabela emprega_muriae.curriculum_qualificacao
CREATE TABLE IF NOT EXISTS `curriculum_qualificacao` (
  `curriculum_qualificacao_id` int NOT NULL AUTO_INCREMENT,
  `curriculum_id` int NOT NULL,
  `mes` int NOT NULL,
  `ano` int NOT NULL,
  `cargaHoraria` int NOT NULL,
  `descricao` varchar(60) NOT NULL,
  `instituicao` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`curriculum_qualificacao_id`),
  KEY `fk_curriculum_qualificacao_curriculum1_idx` (`curriculum_id`),
  CONSTRAINT `fk_curriculum_qualificacao_curriculum1` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`curriculum_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.curriculum_qualificacao: ~0 rows (aproximadamente)
INSERT INTO `curriculum_qualificacao` (`curriculum_qualificacao_id`, `curriculum_id`, `mes`, `ano`, `cargaHoraria`, `descricao`, `instituicao`) VALUES
	(9, 46, 1, 2023, 121, 'NR-12', 'IF Sudeste'),
	(10, 46, 4, 2023, 121, 'BNR-45', 'IF Sudeste'),
	(11, 46, 5, 2014, 200, 'Primeiros-Socorros', 'Udemy');

-- Copiando estrutura para tabela emprega_muriae.escolaridade
CREATE TABLE IF NOT EXISTS `escolaridade` (
  `escolaridade_id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`escolaridade_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.escolaridade: ~11 rows (aproximadamente)
INSERT INTO `escolaridade` (`escolaridade_id`, `descricao`) VALUES
	(1, 'Ensino Fundamental Incompleto'),
	(2, 'Ensino Fundamental Completo'),
	(3, 'Ensino Médio Incompleto'),
	(4, 'Ensino Médio Completo'),
	(5, 'Curso Técnico'),
	(6, 'Ensino Superior Incompleto'),
	(7, 'Ensino Superior Completo'),
	(8, 'Pós-graduação'),
	(9, 'Mestrado'),
	(10, 'Doutorado'),
	(11, 'Pós-doutorado');

-- Copiando estrutura para tabela emprega_muriae.estabelecimento
CREATE TABLE IF NOT EXISTS `estabelecimento` (
  `estabelecimento_id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `latitude` char(12) NOT NULL,
  `longitude` char(12) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `cnpj` varchar(18) NOT NULL,
  `razao_social` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `descricao` text,
  `logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`estabelecimento_id`),
  UNIQUE KEY `cnpj` (`cnpj`),
  FULLTEXT KEY `ft_busca` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.estabelecimento: ~1 rows (aproximadamente)
INSERT INTO `estabelecimento` (`estabelecimento_id`, `nome`, `endereco`, `latitude`, `longitude`, `email`, `cnpj`, `razao_social`, `website`, `descricao`, `logo`) VALUES
	(20, 'Rhyan Vieira', 'Rua Francisco Bertoni Benevenute, 35', '-21.1288952', '-42.3669237', 'rhyanmayconsv@gmail.com', '789456123456789456', 'Wwww', '', 'fff', '69082ec4e4400_WhatsApp Image 2025-10-22 at 17.11.16.jpeg');

-- Copiando estrutura para tabela emprega_muriae.favorito
CREATE TABLE IF NOT EXISTS `favorito` (
  `data_favoritado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pessoa_fisica_id` int NOT NULL,
  `vaga_id` int NOT NULL,
  PRIMARY KEY (`pessoa_fisica_id`,`vaga_id`),
  KEY `fk_favoritos_pessoa_fisica1_idx` (`pessoa_fisica_id`),
  KEY `fk_favoritos_vaga1_idx` (`vaga_id`),
  CONSTRAINT `fk_favoritos_pessoa_fisica1` FOREIGN KEY (`pessoa_fisica_id`) REFERENCES `pessoa_fisica` (`pessoa_fisica_id`),
  CONSTRAINT `fk_favoritos_vaga1` FOREIGN KEY (`vaga_id`) REFERENCES `vaga` (`vaga_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.favorito: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela emprega_muriae.idioma
CREATE TABLE IF NOT EXISTS `idioma` (
  `idioma_id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`idioma_id`),
  UNIQUE KEY `descricao` (`descricao`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.idioma: ~40 rows (aproximadamente)
INSERT INTO `idioma` (`idioma_id`, `descricao`) VALUES
	(37, 'Africâner'),
	(4, 'Alemão'),
	(11, 'Árabe'),
	(32, 'Búlgaro'),
	(9, 'Coreano'),
	(33, 'Croata'),
	(18, 'Dinamarquês'),
	(36, 'Eslovaco'),
	(35, 'Esloveno'),
	(2, 'Espanhol'),
	(29, 'Filipino'),
	(19, 'Finlandês'),
	(3, 'Francês'),
	(13, 'Grego'),
	(12, 'Hebraico'),
	(25, 'Hindi'),
	(15, 'Holandês'),
	(22, 'Húngaro'),
	(28, 'Indonésio'),
	(1, 'Inglês'),
	(5, 'Italiano'),
	(8, 'Japonês'),
	(14, 'Latim'),
	(30, 'Malaio'),
	(7, 'Mandarim'),
	(17, 'Norueguês'),
	(39, 'Persa (Farsi)'),
	(20, 'Polonês'),
	(6, 'Português'),
	(23, 'Romeno'),
	(10, 'Russo'),
	(34, 'Sérvio'),
	(16, 'Sueco'),
	(38, 'Swahili'),
	(26, 'Tailandês'),
	(21, 'Tcheco'),
	(24, 'Turco'),
	(31, 'Ucraniano'),
	(40, 'Urdu'),
	(27, 'Vietnamita');

-- Copiando estrutura para tabela emprega_muriae.pessoa_fisica
CREATE TABLE IF NOT EXISTS `pessoa_fisica` (
  `pessoa_fisica_id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cpf` char(11) NOT NULL,
  `data_nascimento` date NOT NULL,
  `resumo_profissional` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `perfil_publico` int NOT NULL COMMENT '1=Público 2=Privado',
  PRIMARY KEY (`pessoa_fisica_id`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.pessoa_fisica: ~3 rows (aproximadamente)
INSERT INTO `pessoa_fisica` (`pessoa_fisica_id`, `nome`, `cpf`, `data_nascimento`, `resumo_profissional`, `perfil_publico`) VALUES
	(116, 'Rhyan Maycon da Silva Vieira', '13854078602', '2003-06-17', 'Eu', 1),
	(117, 'Rhyan Maycon da Silva Vieira', '13854078588', '2003-06-17', 'Eu sou foda', 1),
	(118, 'Rhyan Vieira', '12222222222', '2004-06-17', 'iullulul', 2);

-- Copiando estrutura para tabela emprega_muriae.servico_autonomo
CREATE TABLE IF NOT EXISTS `servico_autonomo` (
  `servico_autonomo_id` int NOT NULL AUTO_INCREMENT,
  `autonomo_id` int NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `categoria_auto_id` int DEFAULT NULL,
  `valor_medio` decimal(10,2) DEFAULT NULL,
  `foto_capa` varchar(255) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '1=Ativo; 2=Inativo; 3=Suspenso',
  PRIMARY KEY (`servico_autonomo_id`),
  KEY `fk_servico_autonomo_autonomo_idx` (`autonomo_id`),
  KEY `fk_servico_autonomo_categoria_idx` (`categoria_auto_id`),
  CONSTRAINT `fk_servico_autonomo_autonomo` FOREIGN KEY (`autonomo_id`) REFERENCES `autonomo` (`autonomo_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_servico_autonomo_categoria_auto` FOREIGN KEY (`categoria_auto_id`) REFERENCES `categoria_auto` (`categoria_auto_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.servico_autonomo: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela emprega_muriae.telefone
CREATE TABLE IF NOT EXISTS `telefone` (
  `telefone_id` int NOT NULL AUTO_INCREMENT,
  `estabelecimento_id` int DEFAULT NULL,
  `usuario_id` int DEFAULT NULL,
  `numero` char(11) NOT NULL,
  `tipo` enum('m','f') NOT NULL,
  PRIMARY KEY (`telefone_id`),
  KEY `fk_estabelecimento_telefone` (`estabelecimento_id`),
  KEY `fk_usuario_telefone_idx` (`usuario_id`),
  CONSTRAINT `fk_estabelecimento_telefone` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimento` (`estabelecimento_id`),
  CONSTRAINT `fk_usuario_telefone` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.telefone: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela emprega_muriae.termodeuso
CREATE TABLE IF NOT EXISTS `termodeuso` (
  `id` int NOT NULL AUTO_INCREMENT,
  `textoTermo` longtext NOT NULL,
  `statusRegistro` int NOT NULL DEFAULT '1' COMMENT '1=Ativo; 2=Inativo; 3=Alterado',
  `rascunho` int DEFAULT '1' COMMENT '1=Sim; 2=Não',
  `usuario_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_termodeuso_usuario1_idx` (`usuario_id`),
  CONSTRAINT `fk_termodeuso_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.termodeuso: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela emprega_muriae.termodeusoaceite
CREATE TABLE IF NOT EXISTS `termodeusoaceite` (
  `termodeuso_id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `dataHoraAceite` datetime NOT NULL DEFAULT (now()),
  PRIMARY KEY (`termodeuso_id`,`usuario_id`),
  KEY `fk_termodeuso_has_usuario_usuario1_idx` (`usuario_id`),
  KEY `fk_termodeuso_has_usuario_termodeuso1_idx` (`termodeuso_id`),
  CONSTRAINT `fk_termodeuso_has_usuario_termodeuso1` FOREIGN KEY (`termodeuso_id`) REFERENCES `termodeuso` (`id`),
  CONSTRAINT `fk_termodeuso_has_usuario_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.termodeusoaceite: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela emprega_muriae.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `usuario_id` int NOT NULL AUTO_INCREMENT,
  `pessoa_fisica_id` int DEFAULT NULL,
  `login` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'A = Anunciante, G = Gestor, CN = Contribuinte normativo, E = Estabelecimento, PF = Pessoa Física',
  `estabelecimento_id` int DEFAULT NULL,
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `login` (`login`),
  KEY `fk_pessoa_fisica_usuario1_idx` (`pessoa_fisica_id`),
  KEY `fk_usuario_estabelecimento1_idx` (`estabelecimento_id`),
  KEY `idx_ativo` (`tipo`),
  CONSTRAINT `fk_pessoa_fisica_usuario1` FOREIGN KEY (`pessoa_fisica_id`) REFERENCES `pessoa_fisica` (`pessoa_fisica_id`),
  CONSTRAINT `fk_usuario_estabelecimento1` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimento` (`estabelecimento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.usuario: ~4 rows (aproximadamente)
INSERT INTO `usuario` (`usuario_id`, `pessoa_fisica_id`, `login`, `senha`, `tipo`, `estabelecimento_id`) VALUES
	(46, 116, 'rhyanmayconsv@gmail.com', '$2y$10$2w/d7GfiFcVbqlUKOxvWteOBt0/DAa3O2MKA5MqqqC0MJXeglrj1e', 'PF', NULL),
	(47, 117, 'teste123@gmail.com', '$2y$10$tdIO8e5hxLTeJRJ8VCftBu44dOIp4TYXXHW2m8mcuglu7tGtjnSSy', 'PF', NULL),
	(48, NULL, 'rhyandouglas1706@gmail.com', '$2y$10$X5lkLCpuhXKLpYKCRRyR9uJaq9cDVwKgZP6h2kMHgS/pseOBFeMeC', 'E', 20),
	(49, 118, 'aline@gmail.com', '$2y$10$N4BbuWbEXZfPXbDv9YVCm.3B3rpLSuLYC7WhEfm5Txo472Lb2YhZy', 'PF', NULL);

-- Copiando estrutura para tabela emprega_muriae.vaga
CREATE TABLE IF NOT EXISTS `vaga` (
  `vaga_id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cargo_id` int NOT NULL,
  `sobreaVaga` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `dtInicio` date NOT NULL,
  `dtFim` date NOT NULL,
  `estabelecimento_id` int NOT NULL,
  `statusVaga` int NOT NULL COMMENT '1=Pré Vaga; 11=Em aberto; 91=Suspensa; 99=Finalizada;',
  `cidade_id` int NOT NULL,
  `modalidade` int NOT NULL COMMENT '1 - Presencial, 2 - Híbrido, 3 - Remoto, 4 - Parcialmente remoto, 5 - A combinar, 6 - Em campo (externo)',
  `vinculo` int NOT NULL COMMENT '1 - CLT, 2 - PJ,   3 - Estágio, 4 - Temporário, 5 - Autônomo, 6 - Trainee, 7 - Freelancer''',
  `nivelExperiencia` int NOT NULL COMMENT '1 = Estágio, 2 = Trainee, 3 = Junior(1-3anos), 4=Pleno(3-5 anos), 5=Senior(5+ anos), 6=Especialista, 7=Gerência ',
  `categoria_vaga_id` int NOT NULL,
  `faixaSal` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`vaga_id`) USING BTREE,
  KEY `fk_vaga_cargo1_idx` (`cargo_id`) USING BTREE,
  KEY `fk_vaga_estabelecimento1_idx` (`estabelecimento_id`) USING BTREE,
  KEY `fk_vaga_cidade1_idx` (`cidade_id`) USING BTREE,
  KEY `fk_vaga_categoria_vaga1_idx` (`categoria_vaga_id`) USING BTREE,
  CONSTRAINT `fk_vaga_cargo1` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`cargo_id`),
  CONSTRAINT `fk_vaga_categoria_vaga_id` FOREIGN KEY (`categoria_vaga_id`) REFERENCES `categoria_vaga` (`categoria_vaga_id`),
  CONSTRAINT `fk_vaga_cidade1` FOREIGN KEY (`cidade_id`) REFERENCES `cidade` (`cidade_id`),
  CONSTRAINT `fk_vaga_estabelecimento1` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimento` (`estabelecimento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.vaga: ~5 rows (aproximadamente)
INSERT INTO `vaga` (`vaga_id`, `descricao`, `cargo_id`, `sobreaVaga`, `dtInicio`, `dtFim`, `estabelecimento_id`, `statusVaga`, `cidade_id`, `modalidade`, `vinculo`, `nivelExperiencia`, `categoria_vaga_id`, `faixaSal`) VALUES
	(8, 'Técnico', 47, 'asdasdasd', '2025-11-09', '2025-11-21', 20, 11, 11, 3, 3, 4, 18, 'A combinar'),
	(9, 'ADS', 45, 'ADS123', '2025-11-01', '2025-11-02', 20, 11, 38, 1, 1, 1, 1, 'A combinar'),
	(10, 'ADS', 45, 'ADS123', '2025-11-01', '2025-11-02', 20, 11, 38, 1, 1, 1, 1, 'A combinar'),
	(11, 'ADS', 49, 'gfdgfdgdg', '2025-11-01', '2025-11-04', 20, 11, 11, 1, 1, 1, 1, 'A combinar'),
	(12, 'Vaguinha Top', 65, 'adasddsdasd', '2025-11-01', '2025-11-03', 20, 11, 14, 1, 1, 1, 19, '1000'),
	(13, 'Macaquinho 123', 20, 'aaaaaaaaaaa', '2025-11-01', '2025-11-01', 20, 11, 14, 1, 1, 1, 29, '10.25'),
	(14, 'teste', 60, 'aaaaaaaaaaaaaa', '2025-11-27', '2025-11-30', 20, 11, 18, 1, 1, 1, 17, '1500'),
	(15, 'Matador de Aluguel', 29, 'Tem que ser negão para matar no escuro.', '2025-12-01', '2025-12-06', 20, 11, 2, 1, 4, 6, 29, '5000');

-- Copiando estrutura para tabela emprega_muriae.vaga_curriculum
CREATE TABLE IF NOT EXISTS `vaga_curriculum` (
  `vaga_id` int NOT NULL,
  `curriculum_id` int NOT NULL,
  `dateCandidatura` datetime NOT NULL,
  PRIMARY KEY (`vaga_id`,`curriculum_id`),
  KEY `fk_vaga_has_curriculum_curriculum1_idx` (`curriculum_id`),
  KEY `fk_vaga_has_curriculum_vaga1_idx` (`vaga_id`),
  CONSTRAINT `fk_vaga_has_curriculum_curriculum1` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`curriculum_id`),
  CONSTRAINT `fk_vaga_has_curriculum_vaga1` FOREIGN KEY (`vaga_id`) REFERENCES `vaga` (`vaga_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.vaga_curriculum: ~0 rows (aproximadamente)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
