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

-- Copiando estrutura para tabela emprega_muriae.cargo
CREATE TABLE IF NOT EXISTS `cargo` (
  `cargo_id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  PRIMARY KEY (`cargo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.cargo: ~70 rows (aproximadamente)
INSERT IGNORE INTO `cargo` (`cargo_id`, `descricao`) VALUES
	(1, 'Assistente Administrativo'),
	(2, 'Analista de Recursos Humanos'),
	(3, 'Auxiliar de Escritório'),
	(4, 'Secretária Executiva'),
	(5, 'Recepcionista'),
	(6, 'Gerente Administrativo'),
	(7, 'Analista Financeiro'),
	(8, 'Auxiliar Contábil'),
	(9, 'Supervisor de Vendas'),
	(10, 'Atendente Comercial'),
	(11, 'Motorista'),
	(12, 'Ajudante de Carga e Descarga'),
	(13, 'Operador de Produção'),
	(14, 'Auxiliar de Serviços Gerais'),
	(15, 'Zelador'),
	(16, 'Porteiro'),
	(17, 'Garçom'),
	(18, 'Cozinheiro'),
	(19, 'Auxiliar de Cozinha'),
	(20, 'Balconista'),
	(21, 'Técnico em Eletrotécnica'),
	(22, 'Técnico em Mecânica'),
	(23, 'Técnico em Enfermagem'),
	(24, 'Técnico em Segurança do Trabalho'),
	(25, 'Eletricista Industrial'),
	(26, 'Mecânico de Manutenção'),
	(27, 'Soldador'),
	(28, 'Operador de Máquinas'),
	(29, 'Encarregado de Produção'),
	(30, 'Inspetor de Qualidade'),
	(31, 'Professor de Educação Infantil'),
	(32, 'Professor de Ensino Fundamental'),
	(33, 'Professor de Matemática'),
	(34, 'Professor de Português'),
	(35, 'Cuidador Escolar'),
	(36, 'Auxiliar de Creche'),
	(37, 'Enfermeiro'),
	(38, 'Fisioterapeuta'),
	(39, 'Psicólogo'),
	(40, 'Nutricionista'),
	(41, 'Desenvolvedor Back-end'),
	(42, 'Desenvolvedor Front-end'),
	(43, 'Analista de Sistemas'),
	(44, 'Técnico de Informática'),
	(45, 'Administrador de Redes'),
	(46, 'Suporte Técnico'),
	(47, 'Cientista de Dados'),
	(48, 'Designer Gráfico'),
	(49, 'Analista de Marketing Digital'),
	(50, 'Gerente de Projetos de TI'),
	(51, 'Caixa'),
	(52, 'Vendedor'),
	(53, 'Repositor de Mercadorias'),
	(54, 'Promotor de Vendas'),
	(55, 'Representante Comercial'),
	(56, 'Operador de Caixa'),
	(57, 'Supervisor de Loja'),
	(58, 'Gerente de Loja'),
	(59, 'Frentista'),
	(60, 'Auxiliar de Estoque'),
	(61, 'Pedreiro'),
	(62, 'Servente de Obras'),
	(63, 'Mestre de Obras'),
	(64, 'Pintor'),
	(65, 'Carpinteiro'),
	(66, 'Encanador'),
	(67, 'Eletricista Residencial'),
	(68, 'Armador de Estrutura'),
	(69, 'Operador de Retroescavadeira'),
	(70, 'Engenheiro Civil');

-- Copiando estrutura para tabela emprega_muriae.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `categoria_id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `icone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.categoria: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela emprega_muriae.categoria_estabelecimento
CREATE TABLE IF NOT EXISTS `categoria_estabelecimento` (
  `estabelecimento_id` int NOT NULL,
  `categoria_id` int NOT NULL,
  PRIMARY KEY (`estabelecimento_id`),
  KEY `idx_categoria_estabelecimento` (`estabelecimento_id`),
  KEY `fk_categoria_estabelecimento_categoria1_idx` (`categoria_id`),
  CONSTRAINT `fk_categoria_estabelecimento_categoria1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`),
  CONSTRAINT `fk_estabelecimento_categoria` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimento` (`estabelecimento_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.categoria_estabelecimento: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela emprega_muriae.cidade
CREATE TABLE IF NOT EXISTS `cidade` (
  `cidade_id` int NOT NULL AUTO_INCREMENT,
  `cidade` varchar(200) NOT NULL,
  `uf` char(2) NOT NULL,
  PRIMARY KEY (`cidade_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.cidade: ~41 rows (aproximadamente)
INSERT IGNORE INTO `cidade` (`cidade_id`, `cidade`, `uf`) VALUES
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
  CONSTRAINT `fk_curriculum_cidade1` FOREIGN KEY (`cidade_id`) REFERENCES `cidade` (`cidade_id`),
  CONSTRAINT `fk_curriculum_pessoa_fisica1` FOREIGN KEY (`pessoa_fisica_id`) REFERENCES `pessoa_fisica` (`pessoa_fisica_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.curriculum: ~0 rows (aproximadamente)

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
  CONSTRAINT `fk_curriculum_escolaridade_curriculum1` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`curriculum_id`),
  CONSTRAINT `fk_curriculum_escolaridade_escolaridade1` FOREIGN KEY (`escolaridade_id`) REFERENCES `escolaridade` (`escolaridade_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  CONSTRAINT `fk_curriculum_experiencia_curriculum1` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`curriculum_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.curriculum_idioma: ~0 rows (aproximadamente)

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
  CONSTRAINT `fk_curriculum_qualificacao_curriculum1` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`curriculum_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.curriculum_qualificacao: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela emprega_muriae.escolaridade
CREATE TABLE IF NOT EXISTS `escolaridade` (
  `escolaridade_id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`escolaridade_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.escolaridade: ~11 rows (aproximadamente)
INSERT IGNORE INTO `escolaridade` (`escolaridade_id`, `descricao`) VALUES
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.estabelecimento: ~0 rows (aproximadamente)

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
INSERT IGNORE INTO `idioma` (`idioma_id`, `descricao`) VALUES
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

-- Copiando estrutura para tabela emprega_muriae.modalidade_trabalho
CREATE TABLE IF NOT EXISTS `modalidade_trabalho` (
  `id_modalidade_trabalho` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_modalidade_trabalho`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.modalidade_trabalho: ~0 rows (aproximadamente)

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
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.pessoa_fisica: ~0 rows (aproximadamente)

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

-- Copiando estrutura para tabela emprega_muriae.tipo_contrato
CREATE TABLE IF NOT EXISTS `tipo_contrato` (
  `id_tipo_contrato` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_tipo_contrato`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.tipo_contrato: ~0 rows (aproximadamente)

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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.usuario: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela emprega_muriae.vaga
CREATE TABLE IF NOT EXISTS `vaga` (
  `vaga_id` int NOT NULL AUTO_INCREMENT,
  `cargo_id` int NOT NULL,
  `descricao` varchar(60) NOT NULL,
  `sobreaVaga` text NOT NULL,
  `dtInicio` date NOT NULL,
  `dtFim` date NOT NULL,
  `estabelecimento_id` int NOT NULL,
  `statusVaga` int NOT NULL COMMENT '1=Pré Vaga; 11=Em aberto; 91=Suspensa; 99=Finalizada;',
  `cidade_cidade_id` int NOT NULL,
  `id_modalidade_trabalho` int NOT NULL,
  `id_tipo_contrato` int NOT NULL,
  PRIMARY KEY (`vaga_id`),
  KEY `fk_vaga_cargo1_idx` (`cargo_id`),
  KEY `fk_vaga_estabelecimento1_idx` (`estabelecimento_id`),
  KEY `fk_vaga_cidade1_idx` (`cidade_cidade_id`),
  KEY `fk_vaga_modalidade_trabalho1_idx` (`id_modalidade_trabalho`),
  KEY `fk_vaga_tipo_contrato1_idx` (`id_tipo_contrato`),
  CONSTRAINT `fk_vaga_cargo1` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`cargo_id`),
  CONSTRAINT `fk_vaga_cidade1` FOREIGN KEY (`cidade_cidade_id`) REFERENCES `cidade` (`cidade_id`),
  CONSTRAINT `fk_vaga_estabelecimento1` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimento` (`estabelecimento_id`),
  CONSTRAINT `fk_vaga_modalidade_trabalho1` FOREIGN KEY (`id_modalidade_trabalho`) REFERENCES `modalidade_trabalho` (`id_modalidade_trabalho`),
  CONSTRAINT `fk_vaga_tipo_contrato1` FOREIGN KEY (`id_tipo_contrato`) REFERENCES `tipo_contrato` (`id_tipo_contrato`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela emprega_muriae.vaga: ~0 rows (aproximadamente)

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
