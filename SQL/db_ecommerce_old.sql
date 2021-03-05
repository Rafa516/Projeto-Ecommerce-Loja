-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 03/03/2021 às 17:30
-- Versão do servidor: 5.7.33-0ubuntu0.18.04.1
-- Versão do PHP: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_ecommerce`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_addresses_save` (IN `pidaddress` INT(11), IN `pidperson` INT(11), IN `pdesaddress` VARCHAR(128), IN `pdesnumber` VARCHAR(32), IN `pdescomplement` VARCHAR(32), IN `pdescity` VARCHAR(32), IN `pdesstate` VARCHAR(32), IN `pdescountry` VARCHAR(32), IN `pdeszipcode` CHAR(8), IN `pdesdistrict` VARCHAR(32))  BEGIN

	IF pidaddress > 0 THEN
		
		UPDATE tb_addresses
        SET
			idperson = pidperson,
            desaddress = pdesaddress,
            descomplement = pdescomplement,
            descity = pdescity,
            desnumber = pdesnumber,
            desstate = pdesstate,
            descountry = pdescountry,
            deszipcode = pdeszipcode, 
            desdistrict = pdesdistrict
         
		WHERE idaddress = pidaddress;
        
    ELSE
		
		INSERT INTO tb_addresses (idperson, desaddress, descomplement, descity, desnumber, desstate, descountry, deszipcode, desdistrict)
        VALUES(pidperson, pdesaddress, pdescomplement, pdescity, pdesnumber, pdesstate, pdescountry, pdeszipcode, pdesdistrict);
        
        SET pidaddress = LAST_INSERT_ID();
        
    END IF;
    
    SELECT * FROM tb_addresses WHERE idaddress = pidaddress;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_add_rate` (IN `pidbrand` INT(11), IN `piduser` INT(11), IN `pdesbrand` VARCHAR(64), IN `pdesperson` VARCHAR(64), IN `pdesemail` VARCHAR(64), IN `prate` DECIMAL(10,1))  NO SQL
BEGIN

INSERT INTO tb_rate_brands(idbrand,iduser,desbrand, desperson, desemail,rate)
    VALUES(pidbrand,piduser,pdesbrand,pdesperson, pdesemail,prate);

 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_avaliaction_add` (IN `pidproduct` INT(11), IN `piduser` INT(11), IN `pdesurl` VARCHAR(64), IN `pdesproduct` VARCHAR(64), IN `pdesperson` VARCHAR(64), IN `pdesemail` VARCHAR(64), IN `prate` DECIMAL(10,1), IN `preview` TEXT)  NO SQL
BEGIN

INSERT INTO tb_avaliactions (idproduct,iduser,desurl,desproduct, desperson, desemail,rate,review)
    VALUES(pidproduct,piduser,pdesurl,pdesproduct,pdesperson, pdesemail,prate, preview);

 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_brands_save` (IN `pidbrand` INT, IN `pdesbrand` VARCHAR(64))  BEGIN
	
	IF pidbrand > 0 THEN
		
		UPDATE tb_brands
        SET desbrand = pdesbrand
        WHERE idbrand = pidbrand;
        
    ELSE
		
		INSERT INTO tb_brands (desbrand) VALUES(pdesbrand);
        
        SET pidbrand = LAST_INSERT_ID();
        
    END IF;
    
    SELECT * FROM tb_brands WHERE idbrand = pidbrand;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_carts_save` (`pidcart` INT, `pdessessionid` VARCHAR(64), `piduser` INT, `pdeszipcode` CHAR(8), `pvlfreight` DECIMAL(10,2), `pnrdays` INT)  BEGIN

    IF pidcart > 0 THEN
        
        UPDATE tb_carts
        SET
            dessessionid = pdessessionid,
            iduser = piduser,
            deszipcode = pdeszipcode,
            vlfreight = pvlfreight,
            nrdays = pnrdays
        WHERE idcart = pidcart;
        
    ELSE
        
        INSERT INTO tb_carts (dessessionid, iduser, deszipcode, vlfreight, nrdays)
        VALUES(pdessessionid, piduser, pdeszipcode, pvlfreight, pnrdays);
        
        SET pidcart = LAST_INSERT_ID();
        
    END IF;
    
    SELECT * FROM tb_carts WHERE idcart = pidcart;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_categories_save` (`pidcategory` INT, `pdescategory` VARCHAR(64))  BEGIN
	
	IF pidcategory > 0 THEN
		
		UPDATE tb_categories
        SET descategory = pdescategory
        WHERE idcategory = pidcategory;
        
    ELSE
		
		INSERT INTO tb_categories (descategory) VALUES(pdescategory);
        
        SET pidcategory = LAST_INSERT_ID();
        
    END IF;
    
    SELECT * FROM tb_categories WHERE idcategory = pidcategory;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_image_products_add` (IN `pidproduct` INT(11), IN `pnamephoto` VARCHAR(64))  NO SQL
BEGIN

INSERT INTO tb_productphotos (idproduct,namephoto)
    VALUES(pidproduct,pnamephoto);
   

 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_orders_save` (`pidorder` INT, `pidcart` INT(11), `piduser` INT(11), `pidstatus` INT(11), `pidaddress` INT(11), `pvltotal` DECIMAL(10,2))  BEGIN
	
	IF pidorder > 0 THEN
		
		UPDATE tb_orders
        SET
			idcart = pidcart,
            iduser = piduser,
            idstatus = pidstatus,
            idaddress = pidaddress,
            vltotal = pvltotal
		WHERE idorder = pidorder;
        
    ELSE
    
		INSERT INTO tb_orders (idcart, iduser, idstatus, idaddress, vltotal)
        VALUES(pidcart, piduser, pidstatus, pidaddress, pvltotal);
		
		SET pidorder = LAST_INSERT_ID();
        
    END IF;
    
    SELECT * 
    FROM tb_orders a
    INNER JOIN tb_ordersstatus b USING(idstatus)
    INNER JOIN tb_carts c USING(idcart)
    INNER JOIN tb_users d ON d.iduser = a.iduser
    INNER JOIN tb_addresses e USING(idaddress)
    WHERE idorder = pidorder;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_products_save` (IN `pidproduct` INT(11), IN `pdesproduct` VARCHAR(64), IN `pvlprice` DECIMAL(10,2), IN `pdesurl` VARCHAR(128), IN `pdescription` TEXT)  BEGIN
	
	IF pidproduct > 0 THEN
		
		UPDATE tb_products
        SET 
			desproduct = pdesproduct,
            vlprice = pvlprice,
     
            desurl = pdesurl,
            desdescription = pdescription
        WHERE idproduct = pidproduct;
        
    ELSE
		
		INSERT INTO tb_products (desproduct, vlprice, desurl,desdescription) 
        VALUES(pdesproduct, pvlprice,  pdesurl,pdescription);
        
        SET pidproduct = LAST_INSERT_ID();   

        
    END IF;
    
 
    SELECT * FROM tb_products WHERE idproduct = pidproduct;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update_image` (IN `piduser` INT(11), IN `ppicture` VARCHAR(64))  BEGIN
 
    UPDATE tb_users
    SET
        picture = ppicture
      
	WHERE iduser = piduser;
    
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_userspasswordsrecoveries_create` (`piduser` INT, `pdesip` VARCHAR(45))  BEGIN
	
	INSERT INTO tb_userspasswordsrecoveries (iduser, desip)
    VALUES(piduser, pdesip);
    
    SELECT * FROM tb_userspasswordsrecoveries
    WHERE idrecovery = LAST_INSERT_ID();
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_usersupdate_save` (IN `piduser` INT, IN `pdesperson` VARCHAR(64), IN `pdeslogin` VARCHAR(64), IN `pdespassword` VARCHAR(256), IN `pdesemail` VARCHAR(128), IN `pnrphone` BIGINT, IN `pinadmin` TINYINT)  BEGIN
	
    DECLARE vidperson INT;
    
	SELECT idperson INTO vidperson
    FROM tb_users
    WHERE iduser = piduser;
    
    UPDATE tb_persons
    SET 
		desperson = pdesperson,
        desemail = pdesemail,
        nrphone = pnrphone
	WHERE idperson = vidperson;
    
    UPDATE tb_users
    SET
		deslogin = pdeslogin,
        despassword = pdespassword,
        inadmin = pinadmin
      
	WHERE iduser = piduser;
    
    SELECT * FROM tb_users a INNER JOIN tb_persons b USING(idperson) WHERE a.iduser = piduser;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_users_delete` (`piduser` INT)  BEGIN
    
    DECLARE vidperson INT;
    
    SET FOREIGN_KEY_CHECKS = 0;
	
	SELECT idperson INTO vidperson
    FROM tb_users
    WHERE iduser = piduser;
	
    DELETE FROM tb_addresses WHERE idperson = vidperson;
    DELETE FROM tb_addresses WHERE idaddress IN(SELECT idaddress FROM tb_orders WHERE iduser = piduser);
	DELETE FROM tb_persons WHERE idperson = vidperson;
    
    DELETE FROM tb_userslogs WHERE iduser = piduser;
    DELETE FROM tb_userspasswordsrecoveries WHERE iduser = piduser;
    DELETE FROM tb_orders WHERE iduser = piduser;
    DELETE FROM tb_cartsproducts WHERE idcart IN(SELECT idcart FROM tb_carts WHERE iduser = piduser);
    DELETE FROM tb_carts WHERE iduser = piduser;
    DELETE FROM tb_users WHERE iduser = piduser;
    
    SET FOREIGN_KEY_CHECKS = 1;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_users_save` (IN `pdesperson` VARCHAR(64), IN `pdeslogin` VARCHAR(64), IN `pdespassword` VARCHAR(256), IN `pdesemail` VARCHAR(128), IN `pnrphone` BIGINT, IN `pinadmin` TINYINT, IN `ppicture` VARCHAR(64))  BEGIN
	
    DECLARE vidperson INT;
    
	INSERT INTO tb_persons (desperson, desemail, nrphone)
    VALUES(pdesperson, pdesemail, pnrphone);
    
    SET vidperson = LAST_INSERT_ID();
    
    INSERT INTO tb_users (idperson, deslogin, despassword, inadmin,picture)
    VALUES(vidperson, pdeslogin, pdespassword, pinadmin,ppicture);
    
    SELECT * FROM tb_users a INNER JOIN tb_persons b USING(idperson) WHERE a.iduser = LAST_INSERT_ID();
    
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_addresses`
--

CREATE TABLE `tb_addresses` (
  `idaddress` int(11) NOT NULL,
  `idperson` int(11) NOT NULL,
  `desaddress` varchar(128) NOT NULL,
  `desnumber` varchar(32) NOT NULL,
  `descomplement` varchar(32) DEFAULT NULL,
  `descity` varchar(32) NOT NULL,
  `desstate` varchar(32) NOT NULL,
  `descountry` varchar(32) NOT NULL,
  `deszipcode` char(8) NOT NULL,
  `desdistrict` varchar(32) NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tb_addresses`
--

INSERT INTO `tb_addresses` (`idaddress`, `idperson`, `desaddress`, `desnumber`, `descomplement`, `descity`, `desstate`, `descountry`, `deszipcode`, `desdistrict`, `dtregister`) VALUES
(17, 1, 'QR 516 Conjunto C', '10', '', 'Brasília', 'DF', 'Brasil', '72546803', 'Santa Maria', '2021-03-02 23:22:08'),
(18, 1, 'QR 516 Conjunto C', '10', '', 'Brasília', 'DF', 'Brasil', '72546803', 'Santa Maria', '2021-03-02 23:22:20'),
(19, 1, 'QR 516 Conjunto C', '10', '', 'Brasília', 'DF', 'Brasil', '72546803', 'Santa Maria', '2021-03-02 23:22:30'),
(20, 1, 'QR 516 Conjunto C', '10', '', 'Brasília', 'DF', 'Brasil', '72546803', 'Santa Maria', '2021-03-02 23:30:33'),
(21, 1, 'QR 516 Conjunto C', '10', '', 'Brasília', 'DF', 'Brasil', '72546803', 'Santa Maria', '2021-03-03 02:42:31'),
(22, 1, 'QR 516 Conjunto C', '', '', 'Brasília', 'DF', 'Brasil', '72546803', 'Santa Maria', '2021-03-03 19:17:06'),
(23, 1, 'QR 516 Conjunto C', '', '', 'Brasília', 'DF', 'Brasil', '72546803', 'Santa Maria', '2021-03-03 19:18:18'),
(24, 1, 'QR 516 Conjunto C', '', '', 'Brasília', 'DF', 'Brasil', '72546803', 'Santa Maria', '2021-03-03 19:18:26'),
(25, 1, 'QR 516 Conjunto C', '', '', 'Brasília', 'DF', 'Brasil', '72546803', 'Santa Maria', '2021-03-03 19:18:34');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_avaliactions`
--

CREATE TABLE `tb_avaliactions` (
  `idavaliaction` int(11) NOT NULL,
  `idproduct` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `desurl` varchar(64) NOT NULL,
  `desproduct` varchar(64) NOT NULL,
  `desperson` varchar(64) NOT NULL,
  `desemail` varchar(64) NOT NULL,
  `rate` decimal(10,1) NOT NULL,
  `review` text NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_brands`
--

CREATE TABLE `tb_brands` (
  `idbrand` int(11) NOT NULL,
  `desbrand` varchar(32) NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_carousel`
--

CREATE TABLE `tb_carousel` (
  `idcarousel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tb_carousel`
--

INSERT INTO `tb_carousel` (`idcarousel`) VALUES
(1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_carts`
--

CREATE TABLE `tb_carts` (
  `idcart` int(11) NOT NULL,
  `dessessionid` varchar(64) NOT NULL,
  `iduser` int(11) DEFAULT NULL,
  `deszipcode` char(8) DEFAULT NULL,
  `vlfreight` decimal(10,2) DEFAULT NULL,
  `nrdays` int(11) DEFAULT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tb_carts`
--

INSERT INTO `tb_carts` (`idcart`, `dessessionid`, `iduser`, `deszipcode`, `vlfreight`, `nrdays`, `dtregister`) VALUES
(168, 'rqi4tql9orpmmuq2lm7e94omau', NULL, NULL, NULL, NULL, '2020-11-29 12:54:50'),
(169, 'f05hhcbrhc1shmb9kila50cgj2', NULL, NULL, NULL, NULL, '2020-11-29 12:55:29'),
(170, '58h2v5eu94qqng0scl5co2t6qv', NULL, NULL, NULL, NULL, '2020-11-29 13:02:46'),
(171, 'i8iltoke09ul46ci15t6v2bsrj', NULL, NULL, NULL, NULL, '2020-11-29 13:18:23'),
(172, 'uje9du5vtmcn490iev6a0r3smv', NULL, '72546803', '110.94', 2, '2020-11-30 18:59:18'),
(173, 'qs77s994c4d16stbcfq2vsbtir', NULL, NULL, NULL, NULL, '2020-11-30 18:59:33'),
(174, 'donui68ogr09hf5vgrru53eej2', NULL, NULL, NULL, NULL, '2020-11-30 19:23:00'),
(175, '9i9l4q3ig0fvrpdvoli0tqd5hb', NULL, '72546803', '110.94', 2, '2020-11-30 19:28:35'),
(176, 'sb5cnaprgpoj8fhu442ko3svol', NULL, NULL, NULL, NULL, '2020-11-30 19:33:56'),
(177, 'lkvbifo87ol73afq5lhkvhoob4', NULL, NULL, NULL, NULL, '2020-11-30 20:17:27'),
(178, 'od3g63me1akgfvv0bb89ujrib3', NULL, NULL, NULL, NULL, '2020-11-30 20:24:02'),
(179, 'q54kb9k24jlt6nktmp2ajnbqhe', NULL, NULL, NULL, NULL, '2020-11-30 20:26:57'),
(180, '59trgp6bp1q3jmq767ji5o6cnc', NULL, NULL, NULL, NULL, '2020-11-30 20:40:11'),
(181, 'ib9cdj6ceovfdvvrajh9840nvb', NULL, NULL, NULL, NULL, '2020-11-30 22:22:14'),
(182, '421sbesooenduf6g4mfsviu42p', NULL, NULL, NULL, NULL, '2020-11-30 22:59:41'),
(183, 'l33k2qtrqj6p3kuf2kh5jj87re', NULL, '72546803', '0.00', 0, '2020-12-01 12:32:36'),
(184, 'd1vmg4qb1ebggqe35pkusm9cho', NULL, NULL, NULL, NULL, '2020-12-01 13:27:52'),
(185, 'cdl5fkn0s47fhp97iep2r95b6r', NULL, NULL, NULL, NULL, '2020-12-01 13:42:46'),
(186, 'apcuu39ut730cl3j308hg86sf1', NULL, NULL, NULL, NULL, '2020-12-01 14:30:59'),
(187, 'b3qeovbs0ulpd63k60r7f5mjjv', NULL, NULL, NULL, NULL, '2020-12-01 18:04:36'),
(188, '605vn8mdjjfdmikpjf6b4ltcio', NULL, '72546834', '0.00', 0, '2020-12-01 18:35:23'),
(189, 'u51dmpka8cn6tgclm5v91vv6cq', NULL, NULL, NULL, NULL, '2020-12-02 00:12:50'),
(190, '65oui9f4qqlet8k2h3a4bf91mk', NULL, NULL, NULL, NULL, '2020-12-02 00:15:22'),
(191, 'uoogoirbgfokrdad5c8htn0375', NULL, NULL, NULL, NULL, '2020-12-02 10:25:48'),
(192, 'tleg4piajb5hc6vce4hcu5lgr7', NULL, NULL, NULL, NULL, '2021-03-02 01:40:33'),
(193, '2ilhei2i23p29e48r0oco8h7r3', NULL, NULL, NULL, NULL, '2021-03-02 01:56:34'),
(194, 'qhrlaamoq5bmlkpul4km3mqjm0', NULL, NULL, NULL, NULL, '2021-03-02 02:14:24'),
(195, 'cjt2lcf3jql9in91i2uujvnkt0', NULL, NULL, NULL, NULL, '2021-03-02 13:18:12'),
(196, 'gqraq8hqvocsolln2hftq7b0fs', NULL, NULL, NULL, NULL, '2021-03-02 13:50:52'),
(197, 'cna3kmg3nn3i84ei3m0jh235o6', NULL, NULL, NULL, NULL, '2021-03-02 14:23:03'),
(198, 'trbrmlsgltnrpncsdpuke9ol3e', NULL, NULL, NULL, NULL, '2021-03-02 14:23:42'),
(199, 'daf5trcntj9a5lceg36012kimu', NULL, '72546803', NULL, NULL, '2021-03-02 15:25:36'),
(200, 'aeejgeanpg6l32orqpp69f5vni', NULL, NULL, NULL, NULL, '2021-03-03 15:11:32'),
(201, 'iv4dj0c15sbsndv60k7ui7k6ta', NULL, '72546820', NULL, NULL, '2021-03-03 15:17:13');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_cartsproducts`
--

CREATE TABLE `tb_cartsproducts` (
  `idcartproduct` int(11) NOT NULL,
  `idcart` int(11) NOT NULL,
  `idproduct` int(11) NOT NULL,
  `dtremoved` datetime DEFAULT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tb_cartsproducts`
--

INSERT INTO `tb_cartsproducts` (`idcartproduct`, `idcart`, `idproduct`, `dtremoved`, `dtregister`) VALUES
(93, 196, 204, '2021-03-02 11:11:52', '2021-03-02 14:11:36'),
(94, 196, 204, '2021-03-02 11:12:06', '2021-03-02 14:11:56'),
(95, 196, 204, NULL, '2021-03-02 14:12:15'),
(96, 198, 204, NULL, '2021-03-02 14:25:27'),
(97, 199, 204, '2021-03-02 13:47:56', '2021-03-02 15:25:44'),
(98, 199, 204, '2021-03-02 13:47:56', '2021-03-02 16:46:43'),
(99, 199, 204, '2021-03-02 14:14:24', '2021-03-02 16:48:03'),
(100, 199, 204, '2021-03-02 14:14:24', '2021-03-02 17:14:22'),
(101, 199, 204, '2021-03-02 15:28:39', '2021-03-02 17:14:28'),
(102, 199, 204, '2021-03-02 15:29:24', '2021-03-02 18:28:42'),
(103, 199, 204, '2021-03-02 19:09:33', '2021-03-02 18:29:33'),
(104, 199, 204, '2021-03-02 19:09:33', '2021-03-02 20:02:55'),
(105, 199, 204, '2021-03-02 20:17:44', '2021-03-02 22:12:27'),
(106, 199, 204, NULL, '2021-03-02 23:17:41'),
(107, 201, 204, NULL, '2021-03-03 19:15:18');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_categories`
--

CREATE TABLE `tb_categories` (
  `idcategory` int(11) NOT NULL,
  `descategory` varchar(32) NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_orders`
--

CREATE TABLE `tb_orders` (
  `idorder` int(11) NOT NULL,
  `idcart` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idstatus` int(11) NOT NULL,
  `idaddress` int(11) NOT NULL,
  `vltotal` decimal(10,2) NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tb_orders`
--

INSERT INTO `tb_orders` (`idorder`, `idcart`, `iduser`, `idstatus`, `idaddress`, `vltotal`, `dtregister`) VALUES
(10, 201, 1, 1, 22, '34.90', '2021-03-03 19:17:06'),
(11, 201, 1, 1, 23, '34.90', '2021-03-03 19:18:19'),
(12, 201, 1, 1, 24, '34.90', '2021-03-03 19:18:26'),
(13, 201, 1, 1, 25, '34.90', '2021-03-03 19:18:34');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_ordersstatus`
--

CREATE TABLE `tb_ordersstatus` (
  `idstatus` int(11) NOT NULL,
  `desstatus` varchar(32) NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tb_ordersstatus`
--

INSERT INTO `tb_ordersstatus` (`idstatus`, `desstatus`, `dtregister`) VALUES
(1, 'Em Aberto', '2017-03-13 06:00:00'),
(2, 'Aguardando Pagamento', '2017-03-13 06:00:00'),
(3, 'Pago', '2017-03-13 06:00:00'),
(4, 'Entregue', '2017-03-13 06:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_persons`
--

CREATE TABLE `tb_persons` (
  `idperson` int(11) NOT NULL,
  `desperson` varchar(64) NOT NULL,
  `desemail` varchar(128) DEFAULT NULL,
  `nrphone` bigint(20) DEFAULT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tb_persons`
--

INSERT INTO `tb_persons` (`idperson`, `desperson`, `desemail`, `nrphone`, `dtregister`) VALUES
(1, 'Rafael Oliveira', 'roliveirarso516@gmail.com', 61991441738, '2017-03-01 03:00:00'),
(21, 'João', 'joao@gmail.com', 6191441738, '2020-11-24 23:06:01'),
(22, 'Ana Silva', 'ana_silva@gmail.com', 6191441738, '2020-11-26 00:08:25'),
(23, 'Rafael Silva', 'rafaxvi@hotmail.com', 6191441738, '2020-11-29 13:18:19'),
(25, 'Instituto Federal de Brasília', 'joaoo@gmail.com', 6191441738, '2021-03-03 15:17:07');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_productphotos`
--

CREATE TABLE `tb_productphotos` (
  `idphoto` int(11) NOT NULL,
  `idproduct` int(11) NOT NULL,
  `namephoto` varchar(64) NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tb_productphotos`
--

INSERT INTO `tb_productphotos` (`idphoto`, `idproduct`, `namephoto`, `dtregister`) VALUES
(296, 204, 'Captura de tela de 2021-03-02 10-59-49.png', '2021-03-02 14:00:29'),
(297, 204, 'Captura de tela de 2021-03-02 11-02-07.png', '2021-03-02 14:03:10'),
(298, 204, 'Captura de tela de 2021-03-02 11-02-26.png', '2021-03-02 14:03:10'),
(299, 204, 'Captura de tela de 2021-03-02 11-02-33.png', '2021-03-02 14:03:10'),
(300, 204, 'Captura de tela de 2021-03-02 11-02-45.png', '2021-03-02 14:03:10');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_products`
--

CREATE TABLE `tb_products` (
  `idproduct` int(11) NOT NULL,
  `desproduct` varchar(64) NOT NULL,
  `vlprice` decimal(10,2) NOT NULL,
  `desurl` varchar(128) NOT NULL,
  `desdescription` text NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tb_products`
--

INSERT INTO `tb_products` (`idproduct`, `desproduct`, `vlprice`, `desurl`, `desdescription`, `dtregister`) VALUES
(204, 'Caneta Esferográfica 1.0mm Cristal Azul Bic CX 50 UN', '34.90', '333', '<p style=\"margin-bottom: 1rem; color: rgb(33, 37, 41); font-family: -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" font-size:=\"\" 16px;\"=\"\"><b><font size=\"3\">Caneta Esferográfica Cristal Dura + que proporciona uma escrita macia e durável, até 2Km! Ponta média 1,0mm.</font></b></p><p style=\"margin-bottom: 1rem; color: rgb(33, 37, 41); font-family: -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" font-size:=\"\" 16px;\"=\"\"><font size=\"3\">Caneta esferográfica clássica e favorita em milhares de lares, escritórios e escolas no mundo. Possui corpo hexagonal que assegura o conforto na escrita e transparente para visualização da tinta Tinta de alta qualidade, que seca rapidamente evitando borrões na escrita. Maior Durabilidade: Escreve até 2 Km. Escrita macia. Fabricada com a quantidade certa de matéria-prima para uso prolongado e seguro. Não contém PVC. Possui tampa da mesma cor da tinta e também é ventilada em conformidade com padrão ISO. Ponta Bola de Tungstênio, esfera perfeita e muito resistente. 100% das esferográficas são feitas por um processo altamente controlado. Perfeitamente esféricas, elas são quase mais duras do que o diamante. A BIC fez o sucesso da esferográfica. Desde seus inícios em 1950, a Companhia vem aperfeiçoando as máquinas e os processos de fabricação necessários para produzir canetas de alta qualidade e produzidas em massa.</font></p><hr style=\"overflow: visible; margin-top: 1rem; margin-bottom: 1rem; border-top-color: rgba(0, 0, 0, 0.1); color: rgb(33, 37, 41); font-family: -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" font-size:=\"\" 16px;\"=\"\"><p style=\"margin-bottom: 1rem; color: rgb(33, 37, 41); font-family: -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" font-size:=\"\" 16px;\"=\"\"><span style=\"font-weight: bolder;\"><u><font size=\"3\">Diferenciadores:</font></u></span></p><ul style=\"margin-bottom: 1rem; padding-left: 1.1rem; color: rgb(33, 37, 41); font-family: -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" font-size:=\"\" 16px;\"=\"\"><li><font size=\"3\">A clássica caneta esferográfica, líder mundial.</font></li><li><font size=\"3\">Favorita em milhares de lares, escritórios e escolas.</font></li><li><font size=\"3\">Corpo Hexagonal.</font></li><li><font size=\"3\">Ponta média 1,0mm com esfera de tungstênio.</font></li></ul>', '2021-03-02 13:54:22');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_productsbrands`
--

CREATE TABLE `tb_productsbrands` (
  `idbrand` int(11) NOT NULL,
  `idproduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_productscarousel`
--

CREATE TABLE `tb_productscarousel` (
  `idcarousel` int(11) NOT NULL,
  `idproduct` int(11) NOT NULL,
  `desurl` varchar(64) NOT NULL,
  `desproduct` varchar(64) NOT NULL,
  `vlprice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_productscategories`
--

CREATE TABLE `tb_productscategories` (
  `idcategory` int(11) NOT NULL,
  `idproduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_rate_brands`
--

CREATE TABLE `tb_rate_brands` (
  `idrate` int(11) NOT NULL,
  `idbrand` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `desbrand` varchar(32) NOT NULL,
  `desperson` varchar(64) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `desemail` varchar(64) NOT NULL,
  `rate` decimal(10,1) NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_users`
--

CREATE TABLE `tb_users` (
  `iduser` int(11) NOT NULL,
  `idperson` int(11) NOT NULL,
  `deslogin` varchar(64) NOT NULL,
  `despassword` varchar(256) NOT NULL,
  `inadmin` tinyint(4) NOT NULL DEFAULT '0',
  `picture` varchar(64) NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tb_users`
--

INSERT INTO `tb_users` (`iduser`, `idperson`, `deslogin`, `despassword`, `inadmin`, `picture`, `dtregister`) VALUES
(1, 1, 'admin', '$2y$12$hKaYkmysAUxuw4gYLdTL3eyB7eVzwt4.mK4gGCQUYMD0X/YNzINrG', 1, '20201117031147', '2017-03-13 03:00:00'),
(21, 21, 'joao@gmail.com', '$2y$12$BearaH8iHARnvZ/xT4CweugUpr7Q8TLQxeOnBZcI.nCl162FxmnUy', 0, '20201124081101', '2020-11-24 23:06:01'),
(22, 22, 'ana_silva@gmail.com', '$2y$12$No/luGs9Fy2LqjUleFURiuGcQladO9AFgp4tpld4Fn8PLFqeZupYm', 0, '20201125091125', '2020-11-26 00:08:25'),
(23, 23, 'rafaxvi@hotmail.com', '$2y$12$xpezZby/V4CeRptDWmRRye8PbUp6Fo.qxE.OeYki9bDPyaS2grZdq', 0, '20201129101119', '2020-11-29 13:18:19'),
(25, 25, 'joaoo@gmail.com', '$2y$12$jo6NuRFR1JTNlKfVi83u2uN5QaOOjrdeXYk7caSTsXbszdXATfQ.u', 0, '20210303120307', '2021-03-03 15:17:07');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_userslogs`
--

CREATE TABLE `tb_userslogs` (
  `idlog` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `deslog` varchar(128) NOT NULL,
  `desip` varchar(45) NOT NULL,
  `desuseragent` varchar(128) NOT NULL,
  `dessessionid` varchar(64) NOT NULL,
  `desurl` varchar(128) NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_userspasswordsrecoveries`
--

CREATE TABLE `tb_userspasswordsrecoveries` (
  `idrecovery` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `desip` varchar(45) NOT NULL,
  `dtrecovery` datetime DEFAULT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tb_userspasswordsrecoveries`
--

INSERT INTO `tb_userspasswordsrecoveries` (`idrecovery`, `iduser`, `desip`, `dtrecovery`, `dtregister`) VALUES
(6, 1, '127.0.0.1', '2020-11-02 21:28:09', '2020-11-03 00:27:06'),
(7, 1, '127.0.0.1', '2020-11-02 21:29:15', '2020-11-03 00:28:53'),
(8, 23, '127.0.0.1', NULL, '2020-11-29 13:18:27'),
(9, 23, '127.0.0.1', '2020-11-29 10:39:42', '2020-11-29 13:33:55');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `tb_addresses`
--
ALTER TABLE `tb_addresses`
  ADD PRIMARY KEY (`idaddress`),
  ADD KEY `fk_addresses_persons_idx` (`idperson`);

--
-- Índices de tabela `tb_avaliactions`
--
ALTER TABLE `tb_avaliactions`
  ADD PRIMARY KEY (`idavaliaction`),
  ADD KEY `idproduct` (`idproduct`),
  ADD KEY `iduser` (`iduser`);

--
-- Índices de tabela `tb_brands`
--
ALTER TABLE `tb_brands`
  ADD PRIMARY KEY (`idbrand`),
  ADD KEY `idbrand` (`idbrand`);

--
-- Índices de tabela `tb_carousel`
--
ALTER TABLE `tb_carousel`
  ADD PRIMARY KEY (`idcarousel`),
  ADD KEY `idcarousel` (`idcarousel`);

--
-- Índices de tabela `tb_carts`
--
ALTER TABLE `tb_carts`
  ADD PRIMARY KEY (`idcart`),
  ADD KEY `FK_carts_users_idx` (`iduser`),
  ADD KEY `dessessionid` (`dessessionid`);

--
-- Índices de tabela `tb_cartsproducts`
--
ALTER TABLE `tb_cartsproducts`
  ADD PRIMARY KEY (`idcartproduct`),
  ADD KEY `FK_cartsproducts_carts_idx` (`idcart`),
  ADD KEY `fk_cartsproducts_products_idx` (`idproduct`);

--
-- Índices de tabela `tb_categories`
--
ALTER TABLE `tb_categories`
  ADD PRIMARY KEY (`idcategory`);

--
-- Índices de tabela `tb_orders`
--
ALTER TABLE `tb_orders`
  ADD PRIMARY KEY (`idorder`),
  ADD KEY `FK_orders_users_idx` (`iduser`),
  ADD KEY `fk_orders_ordersstatus_idx` (`idstatus`),
  ADD KEY `fk_orders_carts_idx` (`idcart`),
  ADD KEY `fk_orders_addresses_idx` (`idaddress`);

--
-- Índices de tabela `tb_ordersstatus`
--
ALTER TABLE `tb_ordersstatus`
  ADD PRIMARY KEY (`idstatus`);

--
-- Índices de tabela `tb_persons`
--
ALTER TABLE `tb_persons`
  ADD PRIMARY KEY (`idperson`);

--
-- Índices de tabela `tb_productphotos`
--
ALTER TABLE `tb_productphotos`
  ADD PRIMARY KEY (`idphoto`),
  ADD KEY `idproduct` (`idproduct`);

--
-- Índices de tabela `tb_products`
--
ALTER TABLE `tb_products`
  ADD PRIMARY KEY (`idproduct`),
  ADD KEY `idproduct` (`idproduct`);

--
-- Índices de tabela `tb_productsbrands`
--
ALTER TABLE `tb_productsbrands`
  ADD PRIMARY KEY (`idbrand`,`idproduct`),
  ADD KEY `fk_productsbrands_products_idx` (`idproduct`) USING BTREE;

--
-- Índices de tabela `tb_productscarousel`
--
ALTER TABLE `tb_productscarousel`
  ADD PRIMARY KEY (`idcarousel`,`idproduct`),
  ADD KEY `fk_productscarousel_products_idx` (`idproduct`) USING BTREE;

--
-- Índices de tabela `tb_productscategories`
--
ALTER TABLE `tb_productscategories`
  ADD PRIMARY KEY (`idcategory`,`idproduct`),
  ADD KEY `fk_productscategories_products_idx` (`idproduct`);

--
-- Índices de tabela `tb_rate_brands`
--
ALTER TABLE `tb_rate_brands`
  ADD PRIMARY KEY (`idrate`),
  ADD KEY `idbrand` (`idbrand`,`iduser`),
  ADD KEY `fk_rate_brands_users` (`iduser`);

--
-- Índices de tabela `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`iduser`),
  ADD KEY `FK_users_persons_idx` (`idperson`);

--
-- Índices de tabela `tb_userslogs`
--
ALTER TABLE `tb_userslogs`
  ADD PRIMARY KEY (`idlog`),
  ADD KEY `fk_userslogs_users_idx` (`iduser`);

--
-- Índices de tabela `tb_userspasswordsrecoveries`
--
ALTER TABLE `tb_userspasswordsrecoveries`
  ADD PRIMARY KEY (`idrecovery`),
  ADD KEY `fk_userspasswordsrecoveries_users_idx` (`iduser`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `tb_addresses`
--
ALTER TABLE `tb_addresses`
  MODIFY `idaddress` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `tb_avaliactions`
--
ALTER TABLE `tb_avaliactions`
  MODIFY `idavaliaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `tb_brands`
--
ALTER TABLE `tb_brands`
  MODIFY `idbrand` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `tb_carts`
--
ALTER TABLE `tb_carts`
  MODIFY `idcart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT de tabela `tb_cartsproducts`
--
ALTER TABLE `tb_cartsproducts`
  MODIFY `idcartproduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT de tabela `tb_categories`
--
ALTER TABLE `tb_categories`
  MODIFY `idcategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT de tabela `tb_orders`
--
ALTER TABLE `tb_orders`
  MODIFY `idorder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `tb_ordersstatus`
--
ALTER TABLE `tb_ordersstatus`
  MODIFY `idstatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tb_persons`
--
ALTER TABLE `tb_persons`
  MODIFY `idperson` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `tb_productphotos`
--
ALTER TABLE `tb_productphotos`
  MODIFY `idphoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT de tabela `tb_products`
--
ALTER TABLE `tb_products`
  MODIFY `idproduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT de tabela `tb_rate_brands`
--
ALTER TABLE `tb_rate_brands`
  MODIFY `idrate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `tb_userslogs`
--
ALTER TABLE `tb_userslogs`
  MODIFY `idlog` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_userspasswordsrecoveries`
--
ALTER TABLE `tb_userspasswordsrecoveries`
  MODIFY `idrecovery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `tb_addresses`
--
ALTER TABLE `tb_addresses`
  ADD CONSTRAINT `fk_addresses_persons` FOREIGN KEY (`idperson`) REFERENCES `tb_persons` (`idperson`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `tb_avaliactions`
--
ALTER TABLE `tb_avaliactions`
  ADD CONSTRAINT `fk1_avaliactions_users` FOREIGN KEY (`iduser`) REFERENCES `tb_users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_avaliactions_products` FOREIGN KEY (`idproduct`) REFERENCES `tb_products` (`idproduct`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_carts`
--
ALTER TABLE `tb_carts`
  ADD CONSTRAINT `fk_carts_users` FOREIGN KEY (`iduser`) REFERENCES `tb_users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `tb_cartsproducts`
--
ALTER TABLE `tb_cartsproducts`
  ADD CONSTRAINT `fk_cartsproducts_carts` FOREIGN KEY (`idcart`) REFERENCES `tb_carts` (`idcart`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cartsproducts_products` FOREIGN KEY (`idproduct`) REFERENCES `tb_products` (`idproduct`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_orders`
--
ALTER TABLE `tb_orders`
  ADD CONSTRAINT `fk_orders_addresses` FOREIGN KEY (`idaddress`) REFERENCES `tb_addresses` (`idaddress`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orders_carts` FOREIGN KEY (`idcart`) REFERENCES `tb_carts` (`idcart`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orders_ordersstatus` FOREIGN KEY (`idstatus`) REFERENCES `tb_ordersstatus` (`idstatus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orders_users` FOREIGN KEY (`iduser`) REFERENCES `tb_users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `tb_productphotos`
--
ALTER TABLE `tb_productphotos`
  ADD CONSTRAINT `fk_productphotos_products` FOREIGN KEY (`idproduct`) REFERENCES `tb_products` (`idproduct`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_productsbrands`
--
ALTER TABLE `tb_productsbrands`
  ADD CONSTRAINT `fk_productsbrands_brands` FOREIGN KEY (`idbrand`) REFERENCES `tb_brands` (`idbrand`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_productsbrands_products` FOREIGN KEY (`idproduct`) REFERENCES `tb_products` (`idproduct`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_productscarousel`
--
ALTER TABLE `tb_productscarousel`
  ADD CONSTRAINT `fk_productscarousel_carousel` FOREIGN KEY (`idcarousel`) REFERENCES `tb_carousel` (`idcarousel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_productscarousel_products` FOREIGN KEY (`idproduct`) REFERENCES `tb_products` (`idproduct`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_productscategories`
--
ALTER TABLE `tb_productscategories`
  ADD CONSTRAINT `fk_productscategories_categories` FOREIGN KEY (`idcategory`) REFERENCES `tb_categories` (`idcategory`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_productscategories_products` FOREIGN KEY (`idproduct`) REFERENCES `tb_products` (`idproduct`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_rate_brands`
--
ALTER TABLE `tb_rate_brands`
  ADD CONSTRAINT `fk_rate_brands_brands` FOREIGN KEY (`idbrand`) REFERENCES `tb_brands` (`idbrand`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rate_brands_users` FOREIGN KEY (`iduser`) REFERENCES `tb_users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_users`
--
ALTER TABLE `tb_users`
  ADD CONSTRAINT `fk_users_persons` FOREIGN KEY (`idperson`) REFERENCES `tb_persons` (`idperson`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_userslogs`
--
ALTER TABLE `tb_userslogs`
  ADD CONSTRAINT `fk_userslogs_users` FOREIGN KEY (`iduser`) REFERENCES `tb_users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `tb_userspasswordsrecoveries`
--
ALTER TABLE `tb_userspasswordsrecoveries`
  ADD CONSTRAINT `fk_userspasswordsrecoveries_users` FOREIGN KEY (`iduser`) REFERENCES `tb_users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
