-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 
-- Versão do Servidor: 5.5.27
-- Versão do PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `controle_estoque`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_AtualizaEstoque`(IN `id_produto` INT, IN `quantidade_in` INT, IN `opcao` CHAR(1), IN `cod_pedido` INT)
BEGIN
    DECLARE contador INT(11);
  
	CASE opcao 
		WHEN 'S'
			THEN 
				BEGIN
					DECLARE qtd_estoque INT (4);
					SELECT quantidade INTO qtd_estoque FROM estoque WHERE produto = id_produto;
					IF qtd_estoque >= (quantidade_in*-1) THEN
						UPDATE estoque SET quantidade=quantidade + quantidade_in WHERE produto = id_produto;
					ELSE 
						UPDATE estoque SET quantidade=quantidade WHERE produto = id_produto;
					END IF;
				END;

		WHEN 'N'
			THEN INSERT INTO estoque (produto) values (id_produto);
		
		WHEN 'I'
			THEN UPDATE estoque SET quantidade=quantidade + quantidade_in WHERE produto = id_produto;
		
		WHEN 'R'
			THEN UPDATE estoque SET quantidade=quantidade - quantidade_in WHERE produto = id_produto;
			
		ELSE 
			BEGIN 
			END;
	END CASE;
 
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `apresentacao`
--

CREATE TABLE IF NOT EXISTS `apresentacao` (
  `id_apresentacao` int(11) NOT NULL AUTO_INCREMENT,
  `nome_apresentacao` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_apresentacao`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome_categoria` varchar(30) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estrutura stand-in para visualizar `consumo_por_setor`
--
CREATE TABLE IF NOT EXISTS `consumo_por_setor` (
`login` varchar(20)
,`nome_setor` varchar(30)
,`nome_produto` varchar(50)
,`quantidade_pedida` int(4)
);
-- --------------------------------------------------------

--
-- Estrutura stand-in para visualizar `consumo_produto`
--
CREATE TABLE IF NOT EXISTS `consumo_produto` (
`nome_produto` varchar(50)
,`quantidade_pedida` int(4)
,`data_pedido` date
);
-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque`
--

CREATE TABLE IF NOT EXISTS `estoque` (
  `id_estoque` int(11) NOT NULL AUTO_INCREMENT,
  `quantidade` int(4) NOT NULL,
  `produto` int(11) NOT NULL,
  PRIMARY KEY (`id_estoque`),
  KEY `cod_produto` (`produto`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=183 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE IF NOT EXISTS `fornecedor` (
  `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT,
  `cnpj` varchar(14) DEFAULT NULL,
  `razao_social` varchar(100) DEFAULT NULL,
  `telefone` varchar(10) DEFAULT NULL,
  `ativo` char(1) NOT NULL DEFAULT 'S',
  PRIMARY KEY (`id_fornecedor`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `valor_item` decimal(8,2) NOT NULL,
  `quantidade` int(4) NOT NULL,
  `cod_nota` int(11) DEFAULT NULL,
  `cod_produto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_item`),
  KEY `cod_nota` (`cod_nota`),
  KEY `cod_produto` (`cod_produto`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=727 ;

--
-- Gatilhos `item`
--
DROP TRIGGER IF EXISTS `TR_adiciona_estoque`;
DELIMITER //
CREATE TRIGGER `TR_adiciona_estoque` AFTER INSERT ON `item`
 FOR EACH ROW BEGIN 
	CALL SP_AtualizaEstoque(new.cod_produto, new.quantidade, 'I', '');
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `TR_atualiza_item_estoque`;
DELIMITER //
CREATE TRIGGER `TR_atualiza_item_estoque` AFTER UPDATE ON `item`
 FOR EACH ROW BEGIN 
	CALL SP_AtualizaEstoque(new.cod_produto, old.quantidade-new.quantidade, 'I', '');
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `TR_remove_item_estoque`;
DELIMITER //
CREATE TRIGGER `TR_remove_item_estoque` AFTER DELETE ON `item`
 FOR EACH ROW BEGIN
    CALL SP_AtualizaEstoque(old.cod_produto, old.quantidade, 'R', '');
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_pedido`
--

CREATE TABLE IF NOT EXISTS `item_pedido` (
  `id_item_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `quantidade` int(11) NOT NULL,
  `cod_pedido` int(11) NOT NULL,
  `cod_produto` int(11) NOT NULL,
  `flag_baixa` char(1) NOT NULL DEFAULT 'A',
  `obs` varchar(180) NOT NULL,
  PRIMARY KEY (`id_item_pedido`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=458 ;

--
-- Gatilhos `item_pedido`
--
DROP TRIGGER IF EXISTS `TR_altera_pedido_estoque`;
DELIMITER //
CREATE TRIGGER `TR_altera_pedido_estoque` AFTER UPDATE ON `item_pedido`
 FOR EACH ROW BEGIN 
	CALL SP_AtualizaEstoque(new.cod_produto, new.quantidade* -1, new.flag_baixa, new.cod_pedido);
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `nota`
--

CREATE TABLE IF NOT EXISTS `nota` (
  `cod_nota` int(11) NOT NULL AUTO_INCREMENT,
  `numero_nota` varchar(10) NOT NULL,
  `id_fornecedor` int(11) DEFAULT NULL,
  `data_nota` date NOT NULL,
  `fechado` tinyint(1) NOT NULL,
  PRIMARY KEY (`cod_nota`),
  KEY `id_fornecedor` (`id_fornecedor`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=257 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `cod_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `quantidade_pedida` int(4) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `cod_produto` int(11) DEFAULT NULL,
  `data_pedido` date NOT NULL,
  `obs` varchar(180) DEFAULT NULL,
  `flag_baixa` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`cod_pedido`),
  KEY `id_usuario` (`id_usuario`),
  KEY `cod_produto` (`cod_produto`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3801 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `nome_perfil` varchar(15) NOT NULL,
  `nivel` int(11) NOT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;


insert into perfil(nome_perfil, nivel) values('admin', 5);
insert into perfil(nome_perfil, nivel) values('user', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(6) NOT NULL,
  `nome_produto` varchar(50) DEFAULT NULL,
  `qtd_minima` int(4) DEFAULT NULL,
  `unidade` int(11) DEFAULT NULL,
  `categoria` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_produto`),
  KEY `cod_apresentacao` (`unidade`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=102 ;

--
-- Gatilhos `produto`
--
DROP TRIGGER IF EXISTS `TR_cria_estoque`;
DELIMITER //
CREATE TRIGGER `TR_cria_estoque` AFTER INSERT ON `produto`
 FOR EACH ROW BEGIN 
   CALL SP_AtualizaEstoque(new.id_produto, 0, 'N', '');
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `setor`
--

CREATE TABLE IF NOT EXISTS `setor` (
  `id_setor` int(11) NOT NULL AUTO_INCREMENT,
  `nome_setor` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_setor`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;


insert into setor(nome_setor) values('administrador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `senha` varchar(10) NOT NULL,
  `perfil` int(11) DEFAULT NULL,
  `setor` int(11) DEFAULT NULL,
  `ativo` char(1) NOT NULL DEFAULT 'S',
  PRIMARY KEY (`id_usuario`),
  KEY `id_setor` (`setor`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;


insert into usuario(login, senha, perfil, setor, ativo) values('admin', 'admin', 1, 1, 'S');

-- --------------------------------------------------------

--
-- Estrutura stand-in para visualizar `ver_produtos`
--
CREATE TABLE IF NOT EXISTS `ver_produtos` (
`codigo` varchar(6)
,`produto` varchar(50)
,`minimo` int(4)
,`unidade` varchar(30)
);
-- --------------------------------------------------------

--
-- Estrutura stand-in para visualizar `visualizar_estoque`
--
CREATE TABLE IF NOT EXISTS `visualizar_estoque` (
`codigo` varchar(6)
,`produto` varchar(50)
,`quantidade` int(4)
,`minimo` int(4)
,`apresentacao` varchar(30)
);
-- --------------------------------------------------------

--
-- Estrutura stand-in para visualizar `visualizar_notas`
--
CREATE TABLE IF NOT EXISTS `visualizar_notas` (
`cod_nota` int(11)
,`id_item` int(11)
,`numero_nota` varchar(10)
,`data_nota` date
,`fornecedor` varchar(100)
,`nome` varchar(50)
,`quantidade` int(4)
,`valor` decimal(8,2)
,`subtotal` decimal(18,2)
);
-- --------------------------------------------------------

--
-- Estrutura para visualizar `consumo_por_setor`
--
DROP TABLE IF EXISTS `consumo_por_setor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `consumo_por_setor` AS select `u`.`login` AS `login`,`s`.`nome_setor` AS `nome_setor`,`p`.`nome_produto` AS `nome_produto`,`c`.`quantidade_pedida` AS `quantidade_pedida` from (((`pedido` `c` join `produto` `p`) join `usuario` `u`) join `setor` `s`) where ((`c`.`cod_produto` = `p`.`id_produto`) and (`c`.`id_usuario` = `u`.`id_usuario`) and (`u`.`setor` = `s`.`id_setor`)) group by `s`.`nome_setor`,`p`.`nome_produto`;

-- --------------------------------------------------------

--
-- Estrutura para visualizar `consumo_produto`
--
DROP TABLE IF EXISTS `consumo_produto`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `consumo_produto` AS select `p`.`nome_produto` AS `nome_produto`,`c`.`quantidade_pedida` AS `quantidade_pedida`,`c`.`data_pedido` AS `data_pedido` from (`pedido` `c` join `produto` `p`) where (`c`.`cod_produto` = `p`.`id_produto`) group by `c`.`data_pedido`;

-- --------------------------------------------------------

--
-- Estrutura para visualizar `ver_produtos`
--
DROP TABLE IF EXISTS `ver_produtos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ver_produtos` AS select `p`.`codigo` AS `codigo`,`p`.`nome_produto` AS `produto`,`p`.`qtd_minima` AS `minimo`,`a`.`nome_apresentacao` AS `unidade` from (`produto` `p` join `apresentacao` `a`) where (`p`.`unidade` = `a`.`id_apresentacao`) order by `p`.`nome_produto`;

-- --------------------------------------------------------

--
-- Estrutura para visualizar `visualizar_estoque`
--
DROP TABLE IF EXISTS `visualizar_estoque`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `visualizar_estoque` AS select `p`.`codigo` AS `codigo`,`p`.`nome_produto` AS `produto`,`e`.`quantidade` AS `quantidade`,`p`.`qtd_minima` AS `minimo`,`a`.`nome_apresentacao` AS `apresentacao` from ((`produto` `p` join `estoque` `e`) join `apresentacao` `a`) where ((`e`.`produto` = `p`.`id_produto`) and (`p`.`unidade` = `a`.`id_apresentacao`)) order by `p`.`nome_produto`;

-- --------------------------------------------------------

--
-- Estrutura para visualizar `visualizar_notas`
--
DROP TABLE IF EXISTS `visualizar_notas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `visualizar_notas` AS select `n`.`cod_nota` AS `cod_nota`,`i`.`id_item` AS `id_item`,`n`.`numero_nota` AS `numero_nota`,`n`.`data_nota` AS `data_nota`,`f`.`razao_social` AS `fornecedor`,`p`.`nome_produto` AS `nome`,`i`.`quantidade` AS `quantidade`,`i`.`valor_item` AS `valor`,(`i`.`quantidade` * `i`.`valor_item`) AS `subtotal` from (((`nota` `n` join `item` `i`) join `produto` `p`) join `fornecedor` `f`) where ((`n`.`cod_nota` = `i`.`cod_nota`) and (`i`.`cod_produto` = `p`.`id_produto`) and (`n`.`id_fornecedor` = `f`.`id_fornecedor`)) order by `n`.`data_nota`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
