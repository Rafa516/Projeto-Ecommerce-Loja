-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 02/12/2020 às 07:56
-- Versão do servidor: 5.7.32-0ubuntu0.18.04.1
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_addresses_save` (`pidaddress` INT(11), `pidperson` INT(11), `pdesaddress` VARCHAR(128), `pdescomplement` VARCHAR(32), `pdescity` VARCHAR(32), `pdesstate` VARCHAR(32), `pdescountry` VARCHAR(32), `pdeszipcode` CHAR(8), `pdesdistrict` VARCHAR(32))  BEGIN

	IF pidaddress > 0 THEN
		
		UPDATE tb_addresses
        SET
			idperson = pidperson,
            desaddress = pdesaddress,
            descomplement = pdescomplement,
            descity = pdescity,
            desstate = pdesstate,
            descountry = pdescountry,
            deszipcode = pdeszipcode, 
            desdistrict = pdesdistrict
		WHERE idaddress = pidaddress;
        
    ELSE
		
		INSERT INTO tb_addresses (idperson, desaddress, descomplement, descity, desstate, descountry, deszipcode, desdistrict)
        VALUES(pidperson, pdesaddress, pdescomplement, pdescity, pdesstate, pdescountry, pdeszipcode, pdesdistrict);
        
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_products_save` (IN `pidproduct` INT(11), IN `pdesproduct` VARCHAR(64), IN `pvlprice` DECIMAL(10,2), IN `pvlwidth` DECIMAL(10,2), IN `pvlheight` DECIMAL(10,2), IN `pvllength` DECIMAL(10,2), IN `pvlweight` DECIMAL(10,2), IN `pdesurl` VARCHAR(128), IN `pdescription` TEXT)  BEGIN
	
	IF pidproduct > 0 THEN
		
		UPDATE tb_products
        SET 
			desproduct = pdesproduct,
            vlprice = pvlprice,
            vlwidth = pvlwidth,
            vlheight = pvlheight,
            vllength = pvllength,
            vlweight = pvlweight,
            desurl = pdesurl,
            desdescription = pdescription
        WHERE idproduct = pidproduct;
        
    ELSE
		
		INSERT INTO tb_products (desproduct, vlprice, vlwidth, vlheight, vllength, vlweight, desurl,desdescription) 
        VALUES(pdesproduct, pvlprice, pvlwidth, pvlheight, pvllength, pvlweight, pdesurl,pdescription);
        
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
  `descomplement` varchar(32) DEFAULT NULL,
  `descity` varchar(32) NOT NULL,
  `desstate` varchar(32) NOT NULL,
  `descountry` varchar(32) NOT NULL,
  `deszipcode` char(8) NOT NULL,
  `desdistrict` varchar(32) NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

--
-- Despejando dados para a tabela `tb_avaliactions`
--

INSERT INTO `tb_avaliactions` (`idavaliaction`, `idproduct`, `iduser`, `desurl`, `desproduct`, `desperson`, `desemail`, `rate`, `review`, `dtregister`) VALUES
(13, 201, 22, 'miband5', 'MI band 5 Versão Global', 'Ana Silva', 'ana_silva@gmail.com', '4.0', 'Bom', '2020-11-30 23:28:03');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_brands`
--

CREATE TABLE `tb_brands` (
  `idbrand` int(11) NOT NULL,
  `desbrand` varchar(32) NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tb_brands`
--

INSERT INTO `tb_brands` (`idbrand`, `desbrand`, `dtregister`) VALUES
(15, 'Samsumg', '2020-11-14 13:29:11'),
(16, 'Motorola', '2020-11-14 13:32:37'),
(17, 'LG', '2020-11-14 13:32:44'),
(18, 'Xiaomi', '2020-11-14 13:32:59'),
(19, 'Apple', '2020-11-14 13:33:13');

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
(191, 'uoogoirbgfokrdad5c8htn0375', NULL, NULL, NULL, NULL, '2020-12-02 10:25:48');

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
(70, 168, 200, '2020-11-29 09:56:13', '2020-11-29 12:56:09'),
(71, 169, 200, NULL, '2020-11-29 13:04:58'),
(72, 172, 200, NULL, '2020-11-30 18:59:23'),
(73, 175, 200, NULL, '2020-11-30 19:28:56'),
(74, 176, 200, '2020-11-30 16:54:58', '2020-11-30 19:54:42'),
(75, 176, 200, '2020-11-30 16:55:36', '2020-11-30 19:55:15'),
(76, 182, 201, '2020-11-30 20:19:27', '2020-11-30 23:19:05'),
(77, 182, 197, '2020-11-30 20:19:33', '2020-11-30 23:19:18'),
(78, 182, 201, '2020-11-30 20:37:32', '2020-11-30 23:27:20'),
(79, 183, 196, '2020-12-01 09:33:55', '2020-12-01 12:33:18'),
(80, 183, 196, '2020-12-01 10:38:35', '2020-12-01 13:38:21'),
(81, 188, 200, '2020-12-01 20:36:27', '2020-12-01 23:36:21'),
(82, 188, 195, '2020-12-01 21:15:12', '2020-12-02 00:14:52');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_categories`
--

CREATE TABLE `tb_categories` (
  `idcategory` int(11) NOT NULL,
  `descategory` varchar(32) NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tb_categories`
--

INSERT INTO `tb_categories` (`idcategory`, `descategory`, `dtregister`) VALUES
(90, 'Celulares', '2020-11-14 13:36:48'),
(91, 'Tablets', '2020-11-14 13:36:53'),
(92, 'Relógios', '2020-11-14 13:36:58');

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
(1, 'Em Aberto', '2017-03-13 03:00:00'),
(2, 'Aguardando Pagamento', '2017-03-13 03:00:00'),
(3, 'Pago', '2017-03-13 03:00:00'),
(4, 'Entregue', '2017-03-13 03:00:00');

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
(23, 'Rafael Silva', 'rafaxvi@hotmail.com', 6191441738, '2020-11-29 13:18:19');

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
(230, 195, 'Captura de tela de 2020-11-19 23-07-02.png', '2020-11-20 02:10:08'),
(232, 195, 'Captura de tela de 2020-11-19 23-07-39.png', '2020-11-20 02:11:20'),
(233, 195, 'Captura de tela de 2020-11-19 23-07-29.png', '2020-11-20 02:11:20'),
(234, 195, 'Captura de tela de 2020-11-19 23-07-24.png', '2020-11-20 02:11:20'),
(235, 195, 'Captura de tela de 2020-11-19 23-07-17.png', '2020-11-20 02:11:20'),
(236, 195, 'Captura de tela de 2020-11-19 23-07-13.png', '2020-11-20 02:11:20'),
(237, 195, 'Captura de tela de 2020-11-19 23-07-50.png', '2020-11-20 02:11:29'),
(238, 196, 'Captura de tela de 2020-11-19 23-16-58.png', '2020-11-20 02:19:45'),
(239, 196, 'Captura de tela de 2020-11-19 23-17-14.png', '2020-11-20 02:20:00'),
(240, 196, 'Captura de tela de 2020-11-19 23-17-09.png', '2020-11-20 02:20:00'),
(241, 196, 'Captura de tela de 2020-11-19 23-17-04.png', '2020-11-20 02:20:00'),
(246, 197, 'Captura de tela de 2020-11-19 23-26-43.png', '2020-11-20 02:27:19'),
(247, 197, 'Captura de tela de 2020-11-19 23-27-02.png', '2020-11-20 02:27:45'),
(248, 197, 'Captura de tela de 2020-11-19 23-26-58.png', '2020-11-20 02:27:45'),
(249, 197, 'Captura de tela de 2020-11-19 23-26-54.png', '2020-11-20 02:27:45'),
(250, 197, 'Captura de tela de 2020-11-19 23-26-49.png', '2020-11-20 02:27:45'),
(251, 198, 'Captura de tela de 2020-11-19 23-31-33.png', '2020-11-20 02:32:42'),
(258, 198, 'Captura de tela de 2020-11-19 23-31-51.png', '2020-11-20 02:33:06'),
(259, 198, 'Captura de tela de 2020-11-19 23-31-45.png', '2020-11-20 02:33:06'),
(260, 198, 'Captura de tela de 2020-11-19 23-31-41.png', '2020-11-20 02:33:06'),
(261, 198, 'Captura de tela de 2020-11-19 23-32-25.png', '2020-11-20 02:33:43'),
(262, 198, 'Captura de tela de 2020-11-19 23-32-20.png', '2020-11-20 02:33:43'),
(263, 198, 'Captura de tela de 2020-11-19 23-32-14.png', '2020-11-20 02:33:43'),
(264, 198, 'Captura de tela de 2020-11-19 23-32-06.png', '2020-11-20 02:33:43'),
(265, 198, 'Captura de tela de 2020-11-19 23-32-01.png', '2020-11-20 02:33:43'),
(266, 198, 'Captura de tela de 2020-11-19 23-31-56.png', '2020-11-20 02:33:43'),
(272, 200, 'Captura de tela de 2020-11-20 00-09-09.png', '2020-11-20 03:09:52'),
(275, 200, 'Captura de tela de 2020-11-20 00-09-20.png', '2020-11-20 03:10:12'),
(276, 200, 'Captura de tela de 2020-11-20 00-09-14.png', '2020-11-20 03:10:12'),
(277, 200, 'Captura de tela de 2020-11-20 00-09-36.png', '2020-11-20 03:10:24'),
(278, 200, 'Captura de tela de 2020-11-20 00-09-25.png', '2020-11-20 03:10:24'),
(283, 201, 'Captura de tela de 2020-11-20 00-18-11.png', '2020-11-20 03:18:30'),
(284, 201, 'Captura de tela de 2020-11-20 00-16-02.png', '2020-11-20 03:18:50'),
(285, 201, 'Captura de tela de 2020-11-20 00-16-23.png', '2020-11-20 03:19:00'),
(286, 201, 'Captura de tela de 2020-11-20 00-15-53.png', '2020-11-20 03:19:00'),
(287, 200, 'Captura de tela de 2020-11-20 00-09-14.png', '2020-11-20 12:28:57');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_products`
--

CREATE TABLE `tb_products` (
  `idproduct` int(11) NOT NULL,
  `desproduct` varchar(64) NOT NULL,
  `vlprice` decimal(10,2) NOT NULL,
  `vlwidth` decimal(10,2) NOT NULL,
  `vlheight` decimal(10,2) NOT NULL,
  `vllength` decimal(10,2) NOT NULL,
  `vlweight` decimal(10,2) NOT NULL,
  `desurl` varchar(128) NOT NULL,
  `desdescription` text NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tb_products`
--

INSERT INTO `tb_products` (`idproduct`, `desproduct`, `vlprice`, `vlwidth`, `vlheight`, `vllength`, `vlweight`, `desurl`, `desdescription`, `dtregister`) VALUES
(195, 'Smartphone Samsung Galaxy A01 32GB Azul Octa-Core - 2GB RAM', '809.10', '7.90', '15.30', '5.00', '0.10', 'galaxy_a01', '<h2 class=\"description__product-title\" style=\"text-align: justify; margin: 0px 0px 30px; padding: 0px; border: 0px; font-size: 16px; vertical-align: baseline; background: transparent; clear: both; color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif;\"><b>Smartphone Samsung Galaxy A01 32GB Azul Octa-Core - 2GB RAM Tela 5,7” Câm. Dupla + Câm. Selfie 5MP</b></h2><p class=\"description__text\" style=\"margin-bottom: 30px; padding: 0px; border: 0px; font-size: 16px; vertical-align: baseline; background: transparent; color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif;\"></p><span style=\"color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif; font-size: 16px;\"><div style=\"text-align: justify;\">Tenha uma solução para o seu dia a dia sem deixar nada para trás com o Galaxy A01 da Samsung. Realize fotos especiais e únicas com a câmera dupla na traseira, possibilitando inclusive o foco dinâmico.&nbsp;</div></span><div style=\"text-align: justify;\"><span style=\"color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif; font-size: 16px;\"><br></span></div><div style=\"text-align: justify;\"><span style=\"color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif; font-size: 16px;\">Divirta-se e compartilhe seus momentos especiais ao fotografar com a câmera de selfie de 5MP. A tela de 5,7\" deste smartphone traz uma experiência de visualização imersiva, seja ao ver seus vídeos, fotos ou simplesmente acessar as redes sociais.&nbsp;</span></div><div style=\"text-align: justify;\"><span style=\"color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif; font-size: 16px;\"><br></span></div><div><div style=\"text-align: justify;\"><span style=\"color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif; font-size: 16px;\">Oferece um processador Octa-Core e 2GB de memória RAM para que você tenha tudo ao alcance dos dedos de maneira mais fácil. O armazenamento interno de 32GB entrega muita conveniência para salvar seus documentos de maneira segura. Fique sempre conectado com a tecnologia 4G em um aparelho dual chip! A cor azul destaca o design moderno do produto e combina perfeitamente com seu dia a dia.</span></div><p class=\"description__text\" style=\"margin-bottom: 30px; padding: 0px; border: 0px; font-size: 16px; vertical-align: baseline; background: transparent; color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif;\"></p><p class=\"description__text\" style=\"margin-bottom: 30px; padding: 0px; border: 0px; font-size: 16px; vertical-align: baseline; background: transparent; color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif;\"></p><div><span style=\"color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif; font-size: 16px;\"><br></span></div></div>', '2020-11-20 02:10:07'),
(196, 'iPhone 11 Apple 64GB Preto 6,1” 12MP iOS', '4184.00', '7.57', '15.09', '0.83', '0.10', 'iphone11', '<h2 class=\"description__product-title\" style=\"text-align: justify; margin: 0px 0px 30px; padding: 0px; border: 0px; font-size: 16px; vertical-align: baseline; background: transparent; clear: both; color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif;\"><b>iPhone 11 Apple 64GB Preto 6,1” 12MP iOS</b></h2><p class=\"description__text\" style=\"margin-bottom: 30px; padding: 0px; border: 0px; font-size: 16px; vertical-align: baseline; background: transparent; color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif;\"></p><span style=\"color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif; font-size: 16px;\"><div style=\"text-align: justify;\">Grave vídeos 4K, faça belos retratos e capture paisagens inteiras com o novo sistema de câmera dupla. Tire fotos incríveis com pouca luz usando o modo Noite. Veja cores fiéis em fotos, vídeos e jogos na tela Liquid Retina de 6,1 polegadas***.&nbsp;</div></span><div><div style=\"text-align: justify;\"><font color=\"#404040\" face=\"arial, tahoma, verdana, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></div><div style=\"text-align: justify;\"><span style=\"color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif; font-size: 16px;\">Leve o desempenho sem precedentes do chip A13 Bionic para seus games, realidade aumentada e fotografia. Faça muito e recarregue pouco com a bateria para o dia todo**.&nbsp;</span></div><div style=\"text-align: justify;\"><span style=\"color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif; font-size: 16px;\"><br></span></div><div style=\"text-align: justify;\"><span style=\"color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif; font-size: 16px;\">E conte com resistência à água de até dois metros por até 30 minutos*.Avisos legais:*O iPhone 11 é resistente a respingos, água e poeira e foi testado em condições controladas em laboratório, classificado como IP68 segundo a norma IEC 60529 (profundidade máxima de até dois metros por até 30 minutos).&nbsp;</span></div><div style=\"text-align: justify;\"><span style=\"color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif; font-size: 16px;\"><br></span></div><div style=\"text-align: justify;\"><span style=\"color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif; font-size: 16px;\">A resistência a respingos, água e poeira não é uma condição permanente e pode diminuir com o tempo. Não tente recarregar um iPhone molhado. Veja instruções no Manual do Usuário para limpeza e secagem. Danos decorrentes de contato com líquidos não estão incluídos na garantia.**A duração da bateria varia de acordo com o uso e a configuração.</span></div><div style=\"text-align: justify;\"><span style=\"color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif; font-size: 16px;\"><br></span></div><div style=\"text-align: justify;\"><span style=\"color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif; font-size: 16px;\">&nbsp;Consulte o site do fabricante para obter mais informações.***A tela tem cantos arredondados. Quando medida como um retângulo, a tela do iPhone 11 tem 6,06 polegadas na diagonal. A área real de visualização é menor.****Carregadores sem fio padrão Qi vendidos separadamente.*****Como parte dos esforços da Apple para atingir seus objetivos ambientais, o iPhone 11 não vem com adaptador de energia nem EarPods. Você pode usar o adaptador de energia e os fones de ouvido da Apple que já tenha ou comprar esses acessórios separadamente.</span><br></div></div>', '2020-11-20 02:19:44'),
(197, 'Smartphone Motorola One Fusion + 128GB Tela 6,5”', '1619.10', '8.00', '8.00', '9.00', '0.25', 'motorola-one', '<h2 class=\"description__product-title\" style=\"text-align: justify; margin: 0px 0px 30px; padding: 0px; border: 0px; font-size: 16px; vertical-align: baseline; background: transparent; clear: both; color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif;\"><b>Smartphone Motorola One Fusion + 128GB Tela 6,5” - Qualcomm Snapdragon 730 4GB RAM Sistema Quad Câm 64 MP</b></h2><p class=\"description__text\" style=\"margin-bottom: 30px; padding: 0px; border: 0px; font-size: 16px; vertical-align: baseline; background: transparent; color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif;\"></p><span style=\"color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif; font-size: 16px;\"><div style=\"text-align: justify;\">Conheça o novo motorola one fusion plus, com sistema Quad Câmera de 64 MP, câmera retrátil pop-up e processador de alto desempenho.</div></span>', '2020-11-20 02:27:19'),
(198, 'Smartphone LG K51S 64GB Titânio 4G Octa-Core', '1068.00', '9.00', '17.00', '5.00', '0.15', 'lg-K51S', '<h2 class=\"description__product-title\" style=\"text-align: justify; margin: 0px 0px 30px; padding: 0px; border: 0px; font-size: 16px; vertical-align: baseline; background: transparent; clear: both; color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif;\"><b>Smartphone LG K51S 64GB Titânio 4G Octa-Core - 3GB RAM 6,55” Câm. Quádrupla + Selfie 13MP</b></h2><p class=\"description__text\" style=\"margin-bottom: 30px; padding: 0px; border: 0px; font-size: 16px; vertical-align: baseline; background: transparent; color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif;\"></p><span style=\"color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif; font-size: 16px;\"><div style=\"text-align: justify;\">Para você que não abre mão de ter aparelhos eletrônicos que acompanhem a sua rotina corrida do dia a dia, precisa ter o Smartphone LG K51S na cor titânio.Ele tem tela Hole in Display HD+ de 6,55\", 64GB de memória interna para armazenar vídeos, fotos e vários aplicativos e 3GB de memória RAM para que não tenha travamentos durante o uso.</div></span><div style=\"text-align: justify;\"><span style=\"color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif; font-size: 16px;\"><br></span></div><div style=\"text-align: justify;\"><span style=\"color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif; font-size: 16px;\">Conta com processador Media Tek MT6762 Octa Core, câmera traseira quádrupla de 32MP + 5MP + 2MP + 2MP com Zoom digital de 4x e câmera Selfie de 13MP com flash LED, detector de faces e foco automático, tudo para que você registre todos os momentos da sua vida.Além disso, é Dual Chip pra você usar a tecnologia 4G da operadora da sua escolha, a bateria de 4000mAh dura o dia todo para não te deixar na mão e possui também, o sensor de impressão digital.</span><br></div>', '2020-11-20 02:32:41'),
(200, 'iPad 10,2” 7ª Geração Apple Wi-Fi + Cellular 32GB ', '3750.00', '0.75', '25.00', '17.00', '0.40', 'ipad10', '<h2 class=\"description__product-title\" style=\"text-align: justify; margin: 0px 0px 30px; padding: 0px; border: 0px; font-size: 16px; vertical-align: baseline; background: transparent; clear: both; color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif;\"><b>iPad 10,2” 7ª Geração Apple Wi-Fi + Cellular 32GB - Cinza Espacial</b></h2><p class=\"description__text\" style=\"margin-bottom: 30px; padding: 0px; border: 0px; font-size: 16px; vertical-align: baseline; background: transparent; color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif;\"></p><span style=\"color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif; font-size: 16px;\"><div style=\"text-align: justify;\">A tela Retina de 10,2 polegadas tem mais espaço e formas totalmente novas para você criar, aprender, trabalhar e se divertir. O iPad é compatível com Smart Keyboard e Apple Pencil*, tem mais de um milhão de apps disponíveis na App Store, incluindo os jogos do Apple Arcade. Ele também tem câmeras frontal e traseira, Wi-Fi e 4G LTE**, bateria para o dia todo*** e o iPadOS, que abre um mundo de possibilidades no iPad.&nbsp;</div></span><div style=\"text-align: justify;\"><span style=\"color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif; font-size: 16px;\"><br></span></div><div style=\"text-align: justify;\"><span style=\"color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif; font-size: 16px;\">Totalmente divertido. Incrivelmente iPad.Avisos legaisOs apps estão disponíveis na App Store. Disponibilidade sujeita a mudanças.*Os acessórios são vendidos separadamente. A compatibilidade varia de acordo com a geração.**E ́ preciso ter um plano de dados. LTE de classe Gigabit, 4G LTE Advanced, 4G LTE e chamadas Wi-Fi só estão disponíveis em alguns países e por meio de determinadas operadoras.&nbsp;</span></div><div style=\"text-align: justify;\"><span style=\"color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif; font-size: 16px;\"><br></span></div><div><div style=\"text-align: justify;\"><span style=\"color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif; font-size: 16px;\">As velocidades são baseadas em taxas de transferência teóricas e variam de acordo com as condições e operadoras locais. Para obter detalhes sobre a compatibilidade com LTE, entre em contato com sua operadora e consulte o site do fabricante.***A duração da bateria varia de acordo com o uso e a configuração. Consulte o site do fabricante para obter mais informações.</span></div><p class=\"description__text\" style=\"margin-bottom: 30px; padding: 0px; border: 0px; font-size: 16px; vertical-align: baseline; background: transparent; color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif;\"></p><p class=\"description__text\" style=\"margin-bottom: 30px; padding: 0px; border: 0px; font-size: 16px; vertical-align: baseline; background: transparent; color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif;\"></p><div><span style=\"color: rgb(64, 64, 64); font-family: arial, tahoma, verdana, sans-serif; font-size: 16px;\"><br></span></div></div>', '2020-11-20 03:09:52'),
(201, 'MI band 5 Versão Global', '229.00', '3.00', '4.00', '5.00', '0.10', 'miband5', '<div style=\"text-align: justify;\"><span style=\"font-family: arial; font-size: medium;\">Exibição e design</span></div><font face=\"arial\" size=\"3\"><div style=\"text-align: justify;\">Visor de cor AMOLED de 1,1\".</div><div style=\"text-align: justify;\">126 x 294 Pixels</div><div style=\"text-align: justify;\">Brilho do display: ≥450 nits</div><div style=\"text-align: justify;\">Vidro temperado 2.5D</div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify;\">Capacidade da bateria 125 mAh até 20 dias</div><div style=\"text-align: justify;\">Tempo de recarga: cerca de 2 horas</div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify;\">Resistência à água.</div><div style=\"text-align: justify;\">5 ATM resistente à água até 50 m.</div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify;\">Monitoramento de atividades</div><div style=\"text-align: justify;\">Conte passos, distância, calorias queimadas</div><div style=\"text-align: justify;\">6 modos de treino: Esteira, Exercício, Corrida ao ar livre, ciclismo, caminhada, natação</div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify;\">Monitoramento de saúde</div><div style=\"text-align: justify;\">Monitoramento da frequência cardíaca 24/7</div><div style=\"text-align: justify;\">Alertas de frequência cardíaca</div><div style=\"text-align: justify;\">Monitoramento do sono</div><div style=\"text-align: justify;\">Alertas ociosos</div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify;\">Conectivo</div><div style=\"text-align: justify;\">Bluetooth 5.0</div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify;\">Requisitos do sistema</div><div style=\"text-align: justify;\">Android 5.0, iOS 10.0 e superior.</div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify;\">Outros recursos:</div><div style=\"text-align: justify;\">Despertador</div><div style=\"text-align: justify;\">Temporizador</div><div style=\"text-align: justify;\">Encontre telefone</div><div style=\"text-align: justify;\">Lembrete de eventos</div><div style=\"text-align: justify;\">Modo DND</div><div style=\"text-align: justify;\">Controles de música na pulseira.</div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify;\">O pacote inclui:</div><div style=\"text-align: justify;\">1 pulseira inteligente Mi 5.</div><div style=\"text-align: justify;\">1 alça de pulso.</div><div style=\"text-align: justify;\">1 cabo de carregamento especializado.</div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify;\">Observação: Este Xiaomi Band 5 suporta Inglês e Chinês.</div><div style=\"text-align: justify;\">Xiaomi Band 5 exibe chinês e dígitos. O idioma da banda é o mesmo que o idioma do seu sistema de telefone.</div><div style=\"text-align: justify;\">P: A versão chinesa Xiaomi Mi band 5 não é adequada para uso?</div><div style=\"text-align: justify;\">R: Absolutamente não! A versão chinesa Xiaomi Mi Band 5 também pode ser alterada correspondente com a configuração de idioma do seu smartphone</div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify;\">100% original, versão chinesa, suporte inglês</div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify;\">Você pode mudar o idioma com as dicas abaixo.</div><div style=\"text-align: justify;\">Passo 1: Acenda o seu smartphone</div><div style=\"text-align: justify;\">Passo 2: Encontre as \"Configurações\" e escolha</div><div style=\"text-align: justify;\">Passo 3: Encontre os \"Sistemas\" e escolha</div><div style=\"text-align: justify;\">Passo 4: Encontre os \"Idiomas\" e escolha o idioma que você deseja</div><div style=\"text-align: justify;\">Passo 5: Abra o aplicativo \"MiFit\" e reconecte sua Mi Band 4</div></font>', '2020-11-20 03:16:52');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_productsbrands`
--

CREATE TABLE `tb_productsbrands` (
  `idbrand` int(11) NOT NULL,
  `idproduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tb_productsbrands`
--

INSERT INTO `tb_productsbrands` (`idbrand`, `idproduct`) VALUES
(15, 195),
(19, 196),
(16, 197),
(17, 198),
(19, 200),
(18, 201);

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

--
-- Despejando dados para a tabela `tb_productscarousel`
--

INSERT INTO `tb_productscarousel` (`idcarousel`, `idproduct`, `desurl`, `desproduct`, `vlprice`) VALUES
(1, 195, 'galaxy_a01', 'Smartphone Samsung Galaxy A01 32GB Azul Octa-Core - 2GB RAM', '809.10'),
(1, 196, 'iphone11', 'iPhone 11 Apple 64GB Preto 6,1” 12MP iOS', '4184.00'),
(1, 201, 'miband5', 'MI band 5 Versão Global', '229.00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_productscategories`
--

CREATE TABLE `tb_productscategories` (
  `idcategory` int(11) NOT NULL,
  `idproduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tb_productscategories`
--

INSERT INTO `tb_productscategories` (`idcategory`, `idproduct`) VALUES
(90, 195),
(90, 196),
(90, 197),
(90, 198),
(91, 200),
(92, 201);

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

--
-- Despejando dados para a tabela `tb_rate_brands`
--

INSERT INTO `tb_rate_brands` (`idrate`, `idbrand`, `iduser`, `desbrand`, `desperson`, `desemail`, `rate`, `dtregister`) VALUES
(4, 17, 1, 'LG', 'Rafael Oliveira', 'roliveirarso516@gmail.com', '3.0', '2020-12-01 23:34:47'),
(5, 16, 22, 'Motorola', 'Ana Silva', 'ana_silva@gmail.com', '4.0', '2020-12-02 10:34:11'),
(6, 19, 22, 'Apple', 'Ana Silva', 'ana_silva@gmail.com', '5.0', '2020-12-02 10:34:28'),
(7, 15, 22, 'Samsumg', 'Ana Silva', 'ana_silva@gmail.com', '4.0', '2020-12-02 10:34:43'),
(8, 18, 22, 'Xiaomi', 'Ana Silva', 'ana_silva@gmail.com', '5.0', '2020-12-02 10:35:07');

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
(23, 23, 'rafaxvi@hotmail.com', '$2y$12$xpezZby/V4CeRptDWmRRye8PbUp6Fo.qxE.OeYki9bDPyaS2grZdq', 0, '20201129101119', '2020-11-29 13:18:19');

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
  MODIFY `idaddress` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `idcart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT de tabela `tb_cartsproducts`
--
ALTER TABLE `tb_cartsproducts`
  MODIFY `idcartproduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de tabela `tb_categories`
--
ALTER TABLE `tb_categories`
  MODIFY `idcategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT de tabela `tb_orders`
--
ALTER TABLE `tb_orders`
  MODIFY `idorder` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_ordersstatus`
--
ALTER TABLE `tb_ordersstatus`
  MODIFY `idstatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tb_persons`
--
ALTER TABLE `tb_persons`
  MODIFY `idperson` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `tb_productphotos`
--
ALTER TABLE `tb_productphotos`
  MODIFY `idphoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=288;

--
-- AUTO_INCREMENT de tabela `tb_products`
--
ALTER TABLE `tb_products`
  MODIFY `idproduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT de tabela `tb_rate_brands`
--
ALTER TABLE `tb_rate_brands`
  MODIFY `idrate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
