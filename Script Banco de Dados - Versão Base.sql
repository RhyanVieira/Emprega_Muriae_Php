-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema emprega_muriae
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema emprega_muriae
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `emprega_muriae` DEFAULT CHARACTER SET utf8mb4 ;
USE `emprega_muriae` ;

-- -----------------------------------------------------
-- Table `emprega_muriae`.`cargo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emprega_muriae`.`cargo` (
  `cargo_id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`cargo_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emprega_muriae`.`estabelecimento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emprega_muriae`.`estabelecimento` (
  `estabelecimento_id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  `endereco` VARCHAR(200) NULL,
  `latitude` CHAR(12) NOT NULL,
  `longitude` CHAR(12) NOT NULL,
  `email` VARCHAR(150) NULL,
  `cnpj` VARCHAR(18) NOT NULL,
  `razao_social` VARCHAR(255) NOT NULL,
  `nome_fantasia` VARCHAR(255) NOT NULL,
  `website` VARCHAR(255) NULL DEFAULT NULL,
  `descricao` TEXT NULL DEFAULT NULL,
  `logo` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`estabelecimento_id`),
  UNIQUE INDEX `cnpj` (`cnpj` ASC) VISIBLE,
  FULLTEXT INDEX `ft_busca` (`nome`) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emprega_muriae`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emprega_muriae`.`categoria` (
  `categoria_id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `descricao` TEXT NULL,
  `icone` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`categoria_id`),
  UNIQUE INDEX `nome` (`nome` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 41
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emprega_muriae`.`categoria_estabelecimento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emprega_muriae`.`categoria_estabelecimento` (
  `estabelecimento_id` INT NOT NULL,
  `categoria_id` INT NOT NULL,
  INDEX `idx_categoria_estabelecimento` (`estabelecimento_id` ASC) VISIBLE,
  PRIMARY KEY (`estabelecimento_id`),
  INDEX `fk_categoria_estabelecimento_categoria1_idx` (`categoria_id` ASC) VISIBLE,
  CONSTRAINT `fk_estabelecimento_categoria`
    FOREIGN KEY (`estabelecimento_id`)
    REFERENCES `emprega_muriae`.`estabelecimento` (`estabelecimento_id`),
  CONSTRAINT `fk_categoria_estabelecimento_categoria1`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `emprega_muriae`.`categoria` (`categoria_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emprega_muriae`.`cidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emprega_muriae`.`cidade` (
  `cidade_id` INT NOT NULL AUTO_INCREMENT,
  `cidade` VARCHAR(200) NOT NULL,
  `uf` CHAR(2) NOT NULL,
  PRIMARY KEY (`cidade_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emprega_muriae`.`pessoa_fisica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emprega_muriae`.`pessoa_fisica` (
  `pessoa_fisica_id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  `cpf` CHAR(11) NOT NULL,
  `data_nascimento` DATE NOT NULL,
  `resumo_profissional` TEXT NULL DEFAULT NULL,
  `perfil_publico` INT NOT NULL,
  PRIMARY KEY (`pessoa_fisica_id`),
  UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emprega_muriae`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emprega_muriae`.`usuario` (
  `usuario_id` INT NOT NULL AUTO_INCREMENT,
  `pessoa_fisica_id` INT NULL,
  `login` VARCHAR(50) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `tipo` CHAR(2) NOT NULL COMMENT 'A = Anunciante, G = Gestor, CN = Contribuinte normativo',
  `estabelecimento_id` INT NULL DEFAULT NULL,
  `email` VARCHAR(255) NOT NULL,
  `ativo` TINYINT(1) NOT NULL DEFAULT 1,
  `foto_perfil` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`usuario_id`),
  UNIQUE INDEX `email` (`email` ASC) VISIBLE,
  INDEX `fk_pessoa_fisica_usuario1_idx` (`pessoa_fisica_id` ASC) VISIBLE,
  INDEX `fk_usuario_estabelecimento1_idx` (`estabelecimento_id` ASC) VISIBLE,
  INDEX `idx_email` (`email` ASC) VISIBLE,
  INDEX `idx_ativo` (`ativo` ASC, `tipo` ASC) VISIBLE,
  CONSTRAINT `fk_pessoa_fisica_usuario1`
    FOREIGN KEY (`pessoa_fisica_id`)
    REFERENCES `emprega_muriae`.`pessoa_fisica` (`pessoa_fisica_id`),
  CONSTRAINT `fk_usuario_estabelecimento1`
    FOREIGN KEY (`estabelecimento_id`)
    REFERENCES `emprega_muriae`.`estabelecimento` (`estabelecimento_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emprega_muriae`.`telefone`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emprega_muriae`.`telefone` (
  `telefone_id` INT NOT NULL AUTO_INCREMENT,
  `estabelecimento_id` INT NULL DEFAULT NULL,
  `usuario_id` INT NULL DEFAULT NULL,
  `numero` CHAR(11) NOT NULL,
  `tipo` ENUM('m', 'f') NOT NULL,
  PRIMARY KEY (`telefone_id`),
  INDEX `fk_estabelecimento_telefone` (`estabelecimento_id` ASC) VISIBLE,
  INDEX `fk_usuario_telefone_idx` (`usuario_id` ASC) VISIBLE,
  CONSTRAINT `fk_estabelecimento_telefone`
    FOREIGN KEY (`estabelecimento_id`)
    REFERENCES `emprega_muriae`.`estabelecimento` (`estabelecimento_id`),
  CONSTRAINT `fk_usuario_telefone`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `emprega_muriae`.`usuario` (`usuario_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emprega_muriae`.`clique_celular`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emprega_muriae`.`clique_celular` (
  `clique_celular_id` INT NOT NULL AUTO_INCREMENT,
  `estabelecimento_id` INT NOT NULL,
  `visitante_id` INT NOT NULL,
  `celular` CHAR(11) NOT NULL,
  `telefone_id` INT NULL DEFAULT NULL,
  `data_clique` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`clique_celular_id`),
  INDEX `fk_estabelecimento_clique_celular_idx` (`estabelecimento_id` ASC) VISIBLE,
  INDEX `fk_telefone_clique_celular_idx` (`telefone_id` ASC) VISIBLE,
  CONSTRAINT `fk_estabelecimento_clique_celular`
    FOREIGN KEY (`estabelecimento_id`)
    REFERENCES `emprega_muriae`.`estabelecimento` (`estabelecimento_id`),
  CONSTRAINT `fk_telefone_clique_celular`
    FOREIGN KEY (`telefone_id`)
    REFERENCES `emprega_muriae`.`telefone` (`telefone_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emprega_muriae`.`clique_telefone`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emprega_muriae`.`clique_telefone` (
  `clique_telefone_id` INT NOT NULL AUTO_INCREMENT,
  `estabelecimento_id` INT NOT NULL,
  `visitante_id` INT NOT NULL,
  `telefone` CHAR(11) NOT NULL,
  `telefone_id` INT NULL DEFAULT NULL,
  `data_clique` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`clique_telefone_id`),
  INDEX `fk_estabelecimento_clique_telefone_idx` (`estabelecimento_id` ASC) VISIBLE,
  INDEX `fk_telefone_clique_telefone_idx` (`telefone_id` ASC) VISIBLE,
  CONSTRAINT `fk_estabelecimento_clique_telefone`
    FOREIGN KEY (`estabelecimento_id`)
    REFERENCES `emprega_muriae`.`estabelecimento` (`estabelecimento_id`),
  CONSTRAINT `fk_telefone_clique_telefone`
    FOREIGN KEY (`telefone_id`)
    REFERENCES `emprega_muriae`.`telefone` (`telefone_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emprega_muriae`.`curriculum`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emprega_muriae`.`curriculum` (
  `curriculum_id` INT NOT NULL AUTO_INCREMENT,
  `pessoa_fisica_id` INT NOT NULL,
  `logradouro` VARCHAR(60) NOT NULL,
  `numero` VARCHAR(10) NULL DEFAULT NULL,
  `complemento` VARCHAR(20) NULL DEFAULT NULL,
  `bairro` VARCHAR(50) NOT NULL,
  `cep` VARCHAR(8) NOT NULL,
  `cidade_id` INT NOT NULL,
  `celular` VARCHAR(11) NOT NULL,
  `dataNascimento` DATE NOT NULL,
  `sexo` CHAR(1) NOT NULL COMMENT 'M=Masculino;F=Feminino',
  `foto` VARCHAR(100) NULL DEFAULT NULL,
  `email` VARCHAR(120) NOT NULL,
  `apresentacaoPessoal` TEXT NULL DEFAULT NULL,
  `curriculo_arquivo` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`curriculum_id`),
  INDEX `fk_curriculum_cidade1_idx` (`cidade_id` ASC) VISIBLE,
  INDEX `fk_curriculum_pessoa_fisica1_idx` (`pessoa_fisica_id` ASC) VISIBLE,
  CONSTRAINT `fk_curriculum_cidade1`
    FOREIGN KEY (`cidade_id`)
    REFERENCES `emprega_muriae`.`cidade` (`cidade_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_curriculum_pessoa_fisica1`
    FOREIGN KEY (`pessoa_fisica_id`)
    REFERENCES `emprega_muriae`.`pessoa_fisica` (`pessoa_fisica_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emprega_muriae`.`escolaridade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emprega_muriae`.`escolaridade` (
  `escolaridade_id` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`escolaridade_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emprega_muriae`.`curriculum_escolaridade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emprega_muriae`.`curriculum_escolaridade` (
  `curriculum_escolaridade_id` INT NOT NULL AUTO_INCREMENT,
  `curriculum_id` INT NOT NULL,
  `inicioMes` INT NOT NULL,
  `inicioAno` INT NOT NULL,
  `fimMes` INT NOT NULL,
  `fimAno` INT NOT NULL,
  `descricao` VARCHAR(60) NOT NULL,
  `instituicao` VARCHAR(60) NOT NULL,
  `cidade_id` INT NOT NULL,
  `escolaridade_id` INT NOT NULL,
  PRIMARY KEY (`curriculum_escolaridade_id`),
  INDEX `fk_curriculum_escolaridade_cidade1_idx` (`cidade_id` ASC) VISIBLE,
  INDEX `fk_curriculum_escolaridade_curriculum1_idx` (`curriculum_id` ASC) VISIBLE,
  INDEX `fk_curriculum_escolaridade_escolaridade1_idx` (`escolaridade_id` ASC) VISIBLE,
  CONSTRAINT `fk_curriculum_escolaridade_cidade1`
    FOREIGN KEY (`cidade_id`)
    REFERENCES `emprega_muriae`.`cidade` (`cidade_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_curriculum_escolaridade_curriculum1`
    FOREIGN KEY (`curriculum_id`)
    REFERENCES `emprega_muriae`.`curriculum` (`curriculum_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_curriculum_escolaridade_escolaridade1`
    FOREIGN KEY (`escolaridade_id`)
    REFERENCES `emprega_muriae`.`escolaridade` (`escolaridade_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emprega_muriae`.`curriculum_experiencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emprega_muriae`.`curriculum_experiencia` (
  `curriculum_experiencia_id` INT NOT NULL AUTO_INCREMENT,
  `curriculum_id` INT NOT NULL,
  `inicioMes` INT NOT NULL,
  `inicioAno` INT NOT NULL,
  `fimMes` INT NULL DEFAULT NULL,
  `fimAno` INT NULL DEFAULT NULL,
  `estabelecimento` VARCHAR(60) NULL DEFAULT NULL,
  `cargo_id` INT NULL DEFAULT NULL,
  `cargoDescricao` VARCHAR(50) NULL DEFAULT NULL,
  `atividadesExercidas` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`curriculum_experiencia_id`),
  INDEX `fk_curriculum_experiencia_curriculum1_idx` (`curriculum_id` ASC) VISIBLE,
  INDEX `fk_curriculum_experiencia_cargo1_idx` (`cargo_id` ASC) VISIBLE,
  CONSTRAINT `fk_curriculum_experiencia_cargo1`
    FOREIGN KEY (`cargo_id`)
    REFERENCES `emprega_muriae`.`cargo` (`cargo_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_curriculum_experiencia_curriculum1`
    FOREIGN KEY (`curriculum_id`)
    REFERENCES `emprega_muriae`.`curriculum` (`curriculum_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emprega_muriae`.`curriculum_qualificacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emprega_muriae`.`curriculum_qualificacao` (
  `curriculum_qualificacao_id` INT NOT NULL AUTO_INCREMENT,
  `curriculum_id` INT NOT NULL,
  `mes` INT NOT NULL,
  `ano` INT NOT NULL,
  `cargaHoraria` INT NOT NULL,
  `descricao` VARCHAR(60) NOT NULL,
  `estabelecimento` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`curriculum_qualificacao_id`),
  INDEX `fk_curriculum_qualificacao_curriculum1_idx` (`curriculum_id` ASC) VISIBLE,
  CONSTRAINT `fk_curriculum_qualificacao_curriculum1`
    FOREIGN KEY (`curriculum_id`)
    REFERENCES `emprega_muriae`.`curriculum` (`curriculum_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emprega_muriae`.`modalidade_trabalho`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emprega_muriae`.`modalidade_trabalho` (
  `id_modalidade_trabalho` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_modalidade_trabalho`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `emprega_muriae`.`tipo_contrato`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emprega_muriae`.`tipo_contrato` (
  `id_tipo_contrato` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_tipo_contrato`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `emprega_muriae`.`vaga`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emprega_muriae`.`vaga` (
  `vaga_id` INT NOT NULL AUTO_INCREMENT,
  `cargo_id` INT NOT NULL,
  `descricao` VARCHAR(60) NOT NULL,
  `sobreaVaga` TEXT NOT NULL,
  `dtInicio` DATE NOT NULL,
  `dtFim` DATE NOT NULL,
  `estabelecimento_id` INT NOT NULL,
  `statusVaga` INT NOT NULL COMMENT '1=Pré Vaga; 11=Em aberto; 91=Suspensa; 99=Finalizada;',
  `cidade_cidade_id` INT(11) NOT NULL,
  `id_modalidade_trabalho` INT NOT NULL,
  `id_tipo_contrato` INT NOT NULL,
  PRIMARY KEY (`vaga_id`),
  INDEX `fk_vaga_cargo1_idx` (`cargo_id` ASC) VISIBLE,
  INDEX `fk_vaga_estabelecimento1_idx` (`estabelecimento_id` ASC) VISIBLE,
  INDEX `fk_vaga_cidade1_idx` (`cidade_cidade_id` ASC) VISIBLE,
  INDEX `fk_vaga_modalidade_trabalho1_idx` (`id_modalidade_trabalho` ASC) VISIBLE,
  INDEX `fk_vaga_tipo_contrato1_idx` (`id_tipo_contrato` ASC) VISIBLE,
  CONSTRAINT `fk_vaga_cargo1`
    FOREIGN KEY (`cargo_id`)
    REFERENCES `emprega_muriae`.`cargo` (`cargo_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vaga_estabelecimento1`
    FOREIGN KEY (`estabelecimento_id`)
    REFERENCES `emprega_muriae`.`estabelecimento` (`estabelecimento_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vaga_cidade1`
    FOREIGN KEY (`cidade_cidade_id`)
    REFERENCES `emprega_muriae`.`cidade` (`cidade_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vaga_modalidade_trabalho1`
    FOREIGN KEY (`id_modalidade_trabalho`)
    REFERENCES `emprega_muriae`.`modalidade_trabalho` (`id_modalidade_trabalho`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vaga_tipo_contrato1`
    FOREIGN KEY (`id_tipo_contrato`)
    REFERENCES `emprega_muriae`.`tipo_contrato` (`id_tipo_contrato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emprega_muriae`.`favorito`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emprega_muriae`.`favorito` (
  `data_favoritado` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `pessoa_fisica_id` INT NOT NULL,
  `vaga_id` INT NOT NULL,
  INDEX `fk_favoritos_pessoa_fisica1_idx` (`pessoa_fisica_id` ASC) VISIBLE,
  INDEX `fk_favoritos_vaga1_idx` (`vaga_id` ASC) VISIBLE,
  PRIMARY KEY (`pessoa_fisica_id`, `vaga_id`),
  CONSTRAINT `fk_favoritos_pessoa_fisica1`
    FOREIGN KEY (`pessoa_fisica_id`)
    REFERENCES `emprega_muriae`.`pessoa_fisica` (`pessoa_fisica_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_favoritos_vaga1`
    FOREIGN KEY (`vaga_id`)
    REFERENCES `emprega_muriae`.`vaga` (`vaga_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emprega_muriae`.`termodeuso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emprega_muriae`.`termodeuso` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `textoTermo` LONGTEXT NOT NULL,
  `statusRegistro` INT NOT NULL DEFAULT 1 COMMENT '1=Ativo; 2=Inativo; 3=Alterado',
  `rascunho` INT(11) NULL DEFAULT 1 COMMENT '1=Sim; 2=Não',
  `usuario_id` INT(11) NOT NULL,
  INDEX `fk_termodeuso_usuario1_idx` (`usuario_id` ASC) VISIBLE,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_termodeuso_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `emprega_muriae`.`usuario` (`usuario_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emprega_muriae`.`termodeusoaceite`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emprega_muriae`.`termodeusoaceite` (
  `termodeuso_id` INT NOT NULL,
  `usuario_id` INT NOT NULL,
  `dataHoraAceite` DATETIME NOT NULL,
  PRIMARY KEY (`termodeuso_id`, `usuario_id`),
  INDEX `fk_termodeuso_has_usuario_usuario1_idx` (`usuario_id` ASC) VISIBLE,
  INDEX `fk_termodeuso_has_usuario_termodeuso1_idx` (`termodeuso_id` ASC) VISIBLE,
  CONSTRAINT `fk_termodeuso_has_usuario_termodeuso1`
    FOREIGN KEY (`termodeuso_id`)
    REFERENCES `emprega_muriae`.`termodeuso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_termodeuso_has_usuario_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `emprega_muriae`.`usuario` (`usuario_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `emprega_muriae`.`vaga_curriculum`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emprega_muriae`.`vaga_curriculum` (
  `vaga_id` INT NOT NULL,
  `curriculum_id` INT NOT NULL,
  `dateCandidatura` DATETIME NOT NULL,
  PRIMARY KEY (`vaga_id`, `curriculum_id`),
  INDEX `fk_vaga_has_curriculum_curriculum1_idx` (`curriculum_id` ASC) VISIBLE,
  INDEX `fk_vaga_has_curriculum_vaga1_idx` (`vaga_id` ASC) VISIBLE,
  CONSTRAINT `fk_vaga_has_curriculum_curriculum1`
    FOREIGN KEY (`curriculum_id`)
    REFERENCES `emprega_muriae`.`curriculum` (`curriculum_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vaga_has_curriculum_vaga1`
    FOREIGN KEY (`vaga_id`)
    REFERENCES `emprega_muriae`.`vaga` (`vaga_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
