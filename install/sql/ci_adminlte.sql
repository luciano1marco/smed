-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 23 jan. 2019 à 10:58
-- Version du serveur :  5.7.21
-- Version de PHP :  7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;

--
-- Base de données :  `ci_adminlte`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin_preferences`
--

DROP TABLE IF EXISTS `admin_preferences`;
CREATE TABLE IF NOT EXISTS `admin_preferences` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `user_panel` tinyint(1) NOT NULL DEFAULT '0',
  `sidebar_form` tinyint(1) NOT NULL DEFAULT '0',
  `messages_menu` tinyint(1) NOT NULL DEFAULT '0',
  `notifications_menu` tinyint(1) NOT NULL DEFAULT '0',
  `tasks_menu` tinyint(1) NOT NULL DEFAULT '0',
  `user_menu` tinyint(1) NOT NULL DEFAULT '1',
  `ctrl_sidebar` tinyint(1) NOT NULL DEFAULT '0',
  `transition_page` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin_preferences`
--

INSERT INTO `admin_preferences` (`id`, `user_panel`, `sidebar_form`, `messages_menu`, `notifications_menu`, `tasks_menu`, `user_menu`, `ctrl_sidebar`, `transition_page`) VALUES
(1, 0, 0, 0, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `bgcolor` char(7) NOT NULL DEFAULT '#607D8B',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `bgcolor`) VALUES
(1, 'admin', 'Administrator', '#F44336'),
(2, 'members', 'General User', '#2196F3');

-- --------------------------------------------------------

--
-- Structure de la table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `public_preferences`
--

DROP TABLE IF EXISTS `public_preferences`;
CREATE TABLE IF NOT EXISTS `public_preferences` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `transition_page` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `public_preferences`
--

INSERT INTO `public_preferences` (`id`, `transition_page`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `admin` int DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `admin`) VALUES
(1,'127.0.0.1','administrator','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com','',NULL, NULL, NULL, 1268889823, NULL, 1, 'Admin', 'istrator', 'ADMIN', '0', '1'),
(270,'1','Karine Ferreira Sanches','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo33','0','karine@email.com','',null,null,null,11/03/2021,'07/03/2021',1,'Karine','Ferreira Sanches','ped-educacao_ambiental','(00) 0000-0003','0'),						
(70,'1','Luciane Nickel','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo34','0','lucianeenickel@gmail.com','',null,null,null,27/04/2020,'15/05/2023',1,'Luciane','Nickel','porto_seguro','(53) 8135-7298','0'),					
(69,'1','Mirian Daniela Buchweitz Schelee','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo35','0','sme@email.com','',null,null,null,09/01/2018,'08/05/2023',1,'Mirian Daniela','Buchweitz Schelee','barao_do_rio_branco','(00) 0000-0001','0'),						
(93,'1','Secretaria de Município da Educação','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36','0','smed@email.com','',null,null,null,10/04/2023,'10/04/2023',1,'Secretaria','de Município da Educação','smed.matriculas','(00) 0000-0000','0'),						
(83,'1','Angelo José Rodrigues Mesa','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo37','0','angelo@email.com','',null,null,null,09/01/2018,'15/05/2023',1,'Angelo José','Rodrigues Mesa','mate_amargo','(00) 0000-0000','0'),						
(84,'1','Eleonora Arrieche Marines Pinheiro','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo38','0','peixotoprimo@yahoo.com.br','',null,null,null,07/02/2018,'12/05/2023',1,'Eleonora','Arrieche Marines Pinheiro','peixoto_primo','(00) 0000-0000','0'),						
(71,'1','Irma Kristina Kerr','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo39','0','wandarochamartins@gmail.com','',null,null,null,13/06/2019,'12/05/2023',1,'Irma','Kristina Kerr','wanda_rocha','(53) 9109-6922','0'),						
(81,'1','Vani Maria Monteiro da Silva','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo40','0','vaninhamon@gmail.com','',null,null,null,07/02/2018,'12/05/2023',1,'Vani Maria','Monteiro da Silva','quinta','(53) 9945-4526','0'),						
(82,'1','Arleti Truquijo Melo ','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo41','0','arletimelo@bol.com.br','',null,null,null,17/10/2013,'12/05/2023',1,'Arleti','Truquijo Melo','arletimelo','(53) 3236-1790','0'),						
(86,'1','Elisabete Domingues Brasil Roig','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo42','0','elisabete@email.com','',null,null,null,10/01/2018,'11/05/2023',1,'Elisabete','Domingues Brasil Roig','buchholz','(00) 0000-0000','0'),						
(85,'1','Andrea Santiago Escovar','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo43','0','dekasantiago@hotmail.com','',null,null,null,17/10/2013,'11/05/2023',1,'Andrea','Santiago Escovar','helena_small','(53) 8134-0482','0'),						
(87,'1','Denise Santos','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo44','0','escolasantana@hotmail.com','',null,null,null,16/08/2022,'15/05/2023',1,'Denise','Santos','santana','(53) 8429-8173','0'),						
(88,'1','Fabiana Simões Machado','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo45','0','fabiana@email.com','',null,null,null,09/01/2018,'12/05/2023',1,'	Fabiana','Simões Machado','franca_pinto','(00) 0000-0000','0'),						
(96,'1','Cláudia Figueiredo Antunes Louzada','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo46','0','claudiaantuneslouzada@yahoo.com.br','',null,null,null,22/10/2014,'15/05/2023',1,'Cláudia','Figueiredo Antunes Louzada','admar_correa','(53) 9996-3696','0'),						
(97,'1','Janice Dias Almeida','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo47','0','janice@email.com','',null,null,null,09/01/2018,'12/05/2023',1,'Janice','Dias Almeida','altamir_lacerda','(00) 0000-0000','0'),						
(98,'1','Roberta Freitas Teixeira','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo48','0','rob@vetorial.net','',null,null,null,09/01/2014,'15/05/2023',1,'Roberta','Freitas Teixeira','anselmo_dias_lopes','(53) 9942-9112','0'),						
(99,'1','Joze Fonseca Quintana','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo49','0','joze@email.com','',null,null,null,30/10/2014,'15/05/2023',1,'Joze','Fonseca Quintana','antonio_carlos_lopes','(53) 8409-4945','0'),						
(100,'1','Fernanda da Fonseca Pereira','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo50','0','fernanda@email.com','',null,null,null,16/03/2021,'11/05/2023',1,'Fernanda','da Fonseca Pereira','caic','(53) 9953-8563','0'),						
(101,'1','Rosa Maria Casanova','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo51','0','rosa@email.com','',null,null,null,17/10/2013,'12/05/2023',1,'Rosa Maria','Casanova','cipriano','(00) 0000-0000','0'),						
(102,'1','Rosangela Meireles Costa','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo52','0','rosangela@email.com','',null,null,null,05/02/2018,'11/05/2023',1,'Rosangela','Meireles Costa','clemente_pinto','(00) 0000-0000','0'),						
(103,'1','Márcia Regina Moraes Bastos','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo53','0','marcia@email.com','',null,null,null,10/08/2021,'12/05/2023',1,'Márcia Regina','Moraes Bastos','dolores_garcia','(53) 8413-7962','0'),						
(104,'1','Laura Conceição Viokboldt Ferreira','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo54','0','laura@email.com','',null,null,null,17/10/2013,'15/05/2023',1,'Laura Conceição','Viokboldt Ferreira','dompedrosegundo','(53) 9938-5305','0'),						
(105,'1','Naraci Jardim Porto','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo55','0','naraci@email.com','',null,null,null,11/08/2022,'12/05/2023',1,'Naraci','Jardim Porto','jayme_monteiro','(00) 0000-0000','0'),						
(106,'1','Claudete Nóbrega dos Santos de Ávila','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo56','0','claudeteavila@bol.com.br','',null,null,null,17/10/2013,'15/05/2023',1,'Claudete','Nóbrega dos Santos de Ávila','manoel_mano','(53) 9122-2753','0'),						
(107,'1','Deise Donatti Maciel','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo57','0','claudete@email.com','',null,null,null,05/11/2015,'15/05/2023',1,'Deise','Donatti Maciel','marilia_rodrigues','(53) 9118-5678','0'),						
(108,'1','Marília Chaves Carvalho','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo58','0','marilia@email.com','',null,null,null,09/01/2018,'09/05/2023',1,'Marília','Chaves Carvalho','olavo_bilac','(00) 0000-0000','0'),						
(109,'1','Tanise Silva Dias','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo59','0','cristiane.jlima@hotmail.com','',null,null,null,24/10/2013,'12/05/2023',1,'Tanise','Silva Dias','ramiz_galvao','(53) 9161-5074','0'),						
(110,'1','Gina Gutterres da Silva','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo60','0','ginagsilva@yahoo.com.br','',null,null,null,16/12/2021,'12/05/2023',1,'Gina','Gutterres da Silva','oscar_moraes','(00) 0000-0000','0'),						
(111,'1','Ana Lúcia Pereira','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo61','0','analuc.pereira@hotmail.com','',null,null,null,26/10/2015,'15/05/2023',1,'Ana ','Lúcia Pereira','roque_aita','(53) 9176-6306','0'),						
(112,'1','Elizabete Laurino Guimarães','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo62','0','elizabete@email.com','',null,null,null,17/10/2013,'10/05/2023',1,'Elizabete','Laurino Guimarães','rui_poester','(00) 0000-0000','0'),						
(113,'1','Ana Lúcia de Oliveira Pires','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo63','0','aninha.rg@hotmail.com','',null,null,null,13/05/2020,'04/05/2023',1,'Ana Lúcia','de Oliveira Pires','viriato_correa','(53) 8126-5566','0'),						
(114,'1','Jayme Azevedo de Freitas','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo64','0','jayme@email.com','',null,null,null,09/01/2018,'12/05/2023',1,'Jayme','Azevedo de Freitas','zelly_esmeraldo','(00) 0000-0000','0'),						
(115,'1','Zenilda Meireles','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo65','0','prof.ze_meireles@hotmail.com','',null,null,null,27/09/2016,'11/05/2023',1,'Zenilda','Meireles','zenir_braga','(53) 9931-7282','0'),						
(116,'1','Liciane Gautério da Costa','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo66','0','liciane@email.com','',null,null,null,09/01/2018,'15/05/2023',1,'Liciane','Gautério da Costa','maria_da_graca_reyes','(00) 0000-0000','0'),						
(117,'1','Viviane Oliveira Soares','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo67','0','vivisoaresrg@gmail.com','',null,null,null,24/10/2014,'09/05/2023',1,'Viviane ','Oliveira Soares','castelo_branco','(53) 8403-6818','0'),						
(118,'1','Eloiza Jurema Gama Bastos','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo68','0','elo.bastos@terra.com.br','',null,null,null,24/10/2013,'05/05/2023',1,'Eloiza Jurema','Gama Bastos','daisy_pagel','(53) 9945-1716','0'),						
(119,'1','Cláudia Silva','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo69','0','claudia@email.com','',null,null,null,17/10/2013,'10/05/2023',1,'Cláudia','Silva','eva_mann','(53) 8412-9575','0'),						
(20,'1','Joice Borges Abreu','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo70','0','emeylyons@hotmail.com','',null,null,null,16/11/2017,'10/05/2023',1,'Joice','Borges Abreu','lyons_club','(53) 9931-6767','0'),						
(121,'1','Andreia Ferreira da Silva','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo71','0','andreia@email.com','',null,null,null,09/01/2018,'10/05/2023',1,'Andreia','Ferreira da Silva','navegantes','(00) 0000-0000','0'),						
(122,'1','Luciane Gomes Ferreira','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo72','0','lucinhagomes@zipmail.com','',null,null,null,26/02/2015,'15/05/2023',1,'Luciane','Gomes Ferreira','querencia','(53) 9106-6717','0'),						
(123,'1','Marzi Ribeiro Vasconcelos','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo73','0','marzididi68@gmail.com','',null,null,null,24/10/2013,'13/05/2023',1,'Marzi','Ribeiro Vasconcelos','tia_luizinha','(53) 8143-2039','0'),						
(124,'1','Danielle Paladino Petrone','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo74','0','danielle@email.com','',null,null,null,09/01/2018,'12/05/2023',1,'Danielle','Paladino Petrone','vovo_zoquinha','(00) 0000-0000','0'),						
(125,'1','Graciele Lopes Ribeiro','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo75','0','gracieleribeiro@ymail.com','',null,null,null,12/02/2014,'12/05/2023',1,'Graciele','Lopes Ribeiro','maria_da_gloria','(53) 8436-7273','0'),						
(291,'1','Margareth Teixeira','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo76','0','margareth@email.com','',null,null,null,20/03/2023,'12/05/2023',1,'Margareth','Teixeira','margot','(00) 0000-0000','0'),						
(173,'1','Marizete Xavier de Lima','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo77','0','marizete@email.com','',null,null,null,11/03/2021,'12/05/2023',1,'Marizete','Xavier de Lima','marizete','(00) 0000-0000','0'),						
(265,'1','Bread Soares Estevam','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo78','0','bread@email.com','',null,null,null,11/03/2021,'07/03/2021',1,'Bread','Soares Estevam','ped-busca_ativa','(00) 0000-0000','0'),						
(127,'1','Teresinha Morales','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo79','0','teresinha@email.com','',null,null,null,11/03/2021,'24/10/2013',1,'Teresinha','Morales','teresinha','(00) 0000-0000','0'),						
(228,'1','Chirly Machane César Duarte','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo80','0','chirlyduarte2014@gmail.com','',null,null,null,19/03/2021,'	25/04/2023',1,'Chirly','Machane César Duarte','verenice_goncalves','(53) 9971-9021','0'),						
(129,'1','Josiele da Silva Silveira','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo81','0','josi_hist@yahoo.com.br','',null,null,null,28/05/2020,'10/05/2023',1,'Josiele','da Silva Silveira','assis_brasil','(53) 9129-4329','0'),						
(130,'1','Fabrícia Rabassa Brahm','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo82','0','fabricia@email.com','',null,null,null,10/03/2021,'10/05/2023',1,'Fabrícia','Rabassa Brahm','bento_goncalves','(00) 0000-0000','0'),						
(131,'1','Janete Joanol da Silveira Mastrantonio','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo83','0','jjmastrantonio@yahoo.com.br','',null,null,null,12/03/2015,'15/05/2023',1,'Janete','Joanol da Silveira Mastrantonio','coriolano_benicio','(53) 9982-7252','0'),						
(132,'1','Jorge Antonio de Oliveira Satt','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo84','0','jorge@email.com','',null,null,null,07/11/2013,'15/05/2023',1,'Jorge Antonio','de Oliveira Satt','joao_de_oliveira','(00) 0000-0000','0'),						
(133,'1','Maria Cristina Sayão Canary','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo85','0','crissayao@hotmail.com','',null,null,null,11/03/2015,'10/05/2023',1,'Maria Cristina','Sayão Canary','sao_joao_batista','(53) 8419-3783','0'),						
(134,'1','Aline Pereira Schimit','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo86','0','aline@email.com','',null,null,null,07/02/2018,'15/05/2023',1,'Aline','Pereira Schimit','sao_miguel','(00) 0000-0000','0'),						
(135,'1','Denise Remédios Gonçalves','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo87','0','denise@email.com','',null,null,null,04/03/2020,'10/05/2023',1,'Denise','Remédios Gonçalves','valdir_castro','(00) 0000-0000','0'),						
(221,'1','Fabiane de Oliveira Prestes','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo88','0','emeifraternidade@gmail.com','',null,null,null,06/10/2015,'15/05/2023',1,'Fabiane','de Oliveira Prestes','fraternidade2','(53) 3230-6469','0'),						
(226,'1','Roselle Rodrigues','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo89','0','rosellentm@gmail.com','',null,null,null,19/11/2015,'12/05/2023',1,'Roselle','Rodrigues','deborah_sayao','(53) 9133-9646','0'),						
(312,'1','Daniele Ruiz da Silva','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo90','0','nei.smed.rg@gmail.com','',null,null,null,11/05/2023,'13/05/2023',1,'Daniele','Ruiz da Silva','ped-educacao.infantil','(00) 0000-0000','0'),						
(293,'1','Paola da Silva Pias','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo91','0','paolapiasrs@gmail.com','',null,null,null,16/02/2023,'13/03/2023',1,'Paola','da Silva Pias','pias-nos','(00) 0000-0000','0'),						
(147,'1','Sheila Azevedo','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo92','0','sheila@email.com','',null,null,null,10/03/2015,'09/05/2023',1,'Sheila','Azevedo','humberto_campos','(00) 0000-0000','0'),						
(149,'1','Simone Lemos da Silveira','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo93','0','cesamrg@gmail.com','',null,null,null,01/06/2017,'03/06/2019',1,'Simone','	Lemos da Silveira','cesam','(53) 3231-5514','0'),						
(150,'1','Eli da Silva Barbosa','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo94','0','mansaodapaz@vetorial.net','',null,null,null,06/10/2014,'11/05/2023',1,'Eli','da Silva Barbosa','mansao_da_paz','(53) 3231-1030','0'),						
(151,'1','Gilsilene Gil Machado','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo95','0','ecm@vetorial.net','',null,null,null,06/10/2014,'20/04/2023',1,'Gilsilene','Gil Machado','coracao_de_maria','(53) 3232-1081','0'),						
(152,'1','Cláudia Franz Vieira','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo96','0','claudiafranz@email.com','',null,null,null,09/01/2018,'15/05/2023',1,'Cláudia','Franz Vieira','augusto_duprat','(00) 0000-0000','0'),						
(309,'1','Mariusa Borges Gomes','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo97','0','centraldematriculasmariusa@gmail.com','',null,null,null,26/04/2023,'09/05/2023',1,'Mariusa','Borges Gomes','central.mari','(53) 9955-2155','0'),						
(154,'1','Lino Mayer','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo98','0','pe.mayer@hotmail.com','',null,null,null,06/10/2014,'04/12/2017',1,'Lino','Mayer','sao_luiz_gonzaga','(53) 3232-9231','0'),						
(155,'1','Gláucia de Oliveira Pinho','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo99','0','glauop@gmail.com','',null,null,null,17/09/2020,'24/11/2020',1,'Gláucia','de Oliveira Pinho','jose_alvares','(53) 9129-1975','0'),						
(156,'1','Claudia Marchand Palacio Gibbon','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo100','0','ejsol@vetorial.net','',null,null,null,06/10/2014,'28/10/2014',1,'Claudia','Marchand Palacio Gibbon','jardim_do_sol','(53) 2125-3500','0'),						
(157,'1','Patrícia Xavier Figueiredo','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo101','0','patricia@email.com','',null,null,null,01/08/2022,'02/05/2023',1,'Patrícia','Xavier Figueiredo','liberato_salzano','(00) 0000-0000','0'),						
(301,'1','Daiana Tesser Winter','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo102','0','daiana.winterr@iogrande.rs.gov.br','',null,null,null,23/03/2023,'10/05/2023',1,'Daiana','Tesser Winter','nae_daiana_winter','(00) 0000-0000','0'),						
(159,'1','Serena Diva Reichert','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo103','0','financeirocristoreirg@gmail.com','',null,null,null,10/04/2017,'10/04/2017',1,'Serena','Diva Reichert','cristo_rei','(00) 0000-0000','0'),						
(160,'1','Edilene Freitas Pouzada','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo104','0','albaolinto19@gmail.com','',null,null,null,25/09/2019,'07/05/2023',1,'Edilene','Freitas Pouzada','alba_olinto','	(53) 9900-3887','0'),						
(161,'1','Debora Pedroso Porto','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo105','0','dedeprof@yahoo.com.br','',null,null,null,13/11/2020,'11/05/2023',1,'Debora','Pedroso Porto','argemiro','(53) 9932-4816','0'),						
(162,'1','Maria de Fátima Carvalho Dias','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo106','0','mariadefatima@email.com','',null,null,null,06/10/2014,'06/05/2023',1,'Maria de Fátima','Carvalho Dias','coracao_ilha','(00) 0000-0000','0'),						
(163,'1','Sicero Agostinho Miranda','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo107','0','sicero@email.com','',null,null,null,24/11/2021,'12/05/2023',1,'Sicero','Agostinho Miranda','cristovao','(53) 9128-8838','0'),						
(164,'1','Vanessa Ribeiro','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo108','0','vanessa@email.com','',null,null,null,06/10/2014,'08/05/2023',1,'Vanessa','Ribeiro','pedro_osorio','(00) 0000-0000','0'),						
(165,'1','Bernadete Marin de Oliveira Moraes','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo109','0','bernadete@email.com','',null,null,null,23/03/2015,'12/05/2023',1,'Bernadete','Marin de Oliveira Moraes','lucia_luzzardi','(53) 3231-4359','0'),						
(166,'1','Michele Freitas de Lima','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo110','0','chelylyma@gmail.com','',null,	null,null,04/03/2015,'25/04/2023',1,'Michele','Freitas de Lima','franklin','(00) 0000-0000','0'),						
(167,'1','Marisa da Silva Saad','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo111','0','marisa@email.com','',null,null,null,07/12/2016,'04/05/2023',1,'Marisa','da Silva Saad','belas_artes','(00) 0000-0000','0'),						
(168,'1','Ana Arlete Rubira Fabres','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo112','0','escolaalcidesmaia@gmail.com','',null,null,null,02/08/2022,'12/05/2023',1,'Ana Arlete','Rubira Fabres','alcides_maia','(00) 0000-0000','0'),						
(169,'1','Marilice Oleiro Lopes','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo113','0','mariliceoleirolopes29@gmail.com','',null,null,null,07/10/2014,'09/05/2023',1,'Marilice','Oleiro Lopes','apolinario','(00) 0000-0000','0'),						
(170,'1','Vivian Gonçalves Paes','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo114','0','vivipaes@gmail.com','',null,null,null,14/05/2018,'10/05/2023',1,'Vivian','Gonçalves Paes','luiza_tavares','(53) 9990-8663','0'),						
(307,'1','USUÁRIO TESTE','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo115','0','ntmsmed@gmail.com','',null,null,null,12/05/2023,'12/05/2023',1,'USUÁRIO','TESTE','usuario.teste','(53) 9927-8300','0'),						
(172,'1','Aline Araújo Minasi','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo116','0','alinearaujominasi@yahoo.com.br','',null,null,null,14/10/2014,'12/05/2023',1,'Aline','Araújo Minasi','renascer','(53) 9931-5828','0'),						
(174,'1','Leandro Ferreira','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo117','0','androle.ferreira@gmail.com','',null,null,null,06/04/2023,'04/03/2023',1,'Leandro','Ferreira','leandro','(53) 8114-3565','0'),						
(306,'1','Fabiana Portanova Laborde','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo118','0','flaborde17@gmail.com','',null,null,null,19/04/2023,'24/04/2023',1,'Fabiana','Portanova Laborde','ntm.fabiana','(53) 8427-4324','0'),						
(176,'1','Maria do Carmo Pinto Arana de Aguiar','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo119','0','mariadocarmo@hotmail.com','',null,null,null,10/08/2022,'15/05/2023',1,'Maria do Carmo','Pinto Arana de Aguiar','maria_angelica','(00) 0000-0000','0'),						
(253,'1','Priscila Oliveira da Silva','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo120','0','pri0823@yahoo.com.br','',null,null,null,06/04/2023,'12/05/2023',1,'Priscila','Oliveira da Silva','central.priscila','(00) 0000-0000','0'),						
(178,'1','Denise Bastos das Neves','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo121','0','denise.neves@riogrande.rs.gov.br','',null,null,null,13/03/2020,'15/05/2023',1,'Denise','Bastos das Neves','sylvia_centeno','(53) 9114-7797','0'),						
(287,'1','Marlei dos Santos Costa','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo122','0','marlei@email.com','',null,null,null,12/09/2022,'12/09/2022',1,'Marlei','dos Santos Costa','mat-marlei','(00) 0000-0000','0'),						
(288,'1','Ana Luiza Kosinski de Boer','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo123','0','analuiza@email.com','',null,null,null,06/04/2023,'11/05/2023',1,'	Ana Luiza','Kosinski de Boer','central.ana','(00) 0000-0000','0'),						
(180,'1','Maria de Lourdes São Bento','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo124','0','mariadelourdes@email.com','',null,null,null,17/12/2014,'26/02/2015',1,'Maria de Lourdes','São Bento','smed_escolas','(00) 0000-0000','0'),						
(308,'1','Samira Terroso Feijó','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo125','0','samiraterroso@hotmail.com','',null,null,null,19/04/2023,'19/04/2023',1,'Samira','Terroso Feijó','ntm.samira','(53) 9942-7028','0'),						
(305,'1','Marco Antonio Nunes Louro','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo126','0','marcosmedrg@gmail.com','',null,null,null,10/04/2023,'12/05/2023',1,'Marco Antonio','Nunes Louro','smed','(53) 9153-0026','0'),						
(276,'1','Lilian Melo Rodrigues Reinhardt','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo127','0','lilian@email.com','',null,null,null,30/12/2022,'12/05/2023',1,'Lilian','Melo Rodrigues Reinhardt','rh-lilian','(00) 0000-0000','0'),						
(310,'1','Cleusa Maria Pires Morales','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo128','0','cleusa.morales@hotmail.com','',null,null,null,27/04/2023,'12/05/2023',1,'Cleusa Maria','Pires Morales','rh-cleusa-morales','(00) 0000-0000','0'),						
(292,'1','homero-gabinete','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo129','0','homero_fazio@gmail.com.br','',null,null,null,06/01/2023,'17/04/2023',1,'homero','gabinete','homero-gabinete','(53) 984287900','0'),						
(303,'1','Fábio Alexandre Dziekaniak','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo130','0','fabitodz@gmail.com','',null,null,null,04/04/2023,'13/04/2023',1,'Fábio','Alexandre Dziekaniak','ped-fabio-alexandre','(00) 0000-0000','0'),						
(234,'1','Josiane David Satt','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo131','0','josianefreitasdavid@gmail.com','',null,null,null,04/04/2016,'08/05/2023',1,'Josiane','David Satt','eliezer_rios','(53) 8443-0491','0'),						
(273,'1','Thais Mespaque Pinto','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo132','0','thais@email.com','',null,null,null,11/03/2021,'24/04/2021',1,'Thais','Mespaque Pinto','ped-anos_iniciais','(00) 0000-0000','0'),						
(199,'1','Elizabeth Coelho Sanchez','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo133','0','elizabeths.smec@riogrande.rs.gov.br','',null,null,null,26/04/2023,'15/05/2023',1,'Elizabeth','Coelho Sanchez','Central.beth','(53) 9948-6022','0'),						
(200,'1','Roberta Torres Bugs','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo134','0','emefnilodafonseca@gmail.com','',null,null,null,02/06/2017,'12/03/2023',1,'Roberta','Torres Bugs','nilo_da_fonseca','(00) 0000-0000','0'),						
(207,'1','Bruna Mendonça Limons','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo135','0','bruna.limons@riogrande.rs.gov.br','',null,null,null,12/06/2015,'05/03/2021',1,'Bruna','Mendonça Limons','nae_bruna_limons','(53) 8408-5880','0'),						
(202,'1','Maria Auxiliadora Terra Duarte','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo136','0','doratduarte@gmail.com','',null,null,null,31/03/2020,'11/05/2023',1,'Maria','Auxiliadora Terra Duarte','carmen_baldino','(53) 9961-7695','0'),						
(302,'1','Pamela Altamor','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo137','0','pamelaaltamor@gmail.com','',null,null,null,04/04/2023,'04/04/2023',1,'Pamela','Altamor','ped-pamela-altamor','(00) 0000-0000','0'),						
(266,'1','Elisângela Gonçalves Macedo','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo138','0','elisangela@email.com','',null,null,null,11/03/2021,'07/03/2021',1,'Elisângela','Gonçalves Macedo','ped-diversidade_inclusao','(00) 0000-0000','0'),						
(222,'1','Escola Maria Montessori','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo139','0','elidabenitesrg@gmail.com','',null,null,null,25/08/2016,'13/03/2020',1,'Escola Maria','Montessori','maria_montessori','53 91610267','0'),						
(311,'1','andre.mendes','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo140','0','andre.mendes@riogrande.rs.gov.br','',null,null,null,04/05/2023,'22/05/2023',1,'andre','mendes','info.andre','(53) 9130-7353','0'),						
(298,'1','Raquel Lempek Trindade','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo141','0','raquellempek@gmail.com','',null,null,null,20/03/2023,'25/04/2023',1,'Raquel','Lempek Trindade','nae_raquel_trindade','(00) 0000-0000','0'),						
(299,'1','Giovana Ribeiro Pegoraro','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo142','0','giovana.pegoraro@riogrande.rs.gov.br','',null,null,null,20/03/2023,'10/05/2023',1,'Giovana','Ribeiro Pegoraro','nae_giovana_pegoraro','(00) 0000-0000','0'),						
(209,'1','Flavia Scattolin','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo143','0','flavia.scattolin@riogrande.rs.gov.br','',null,null,null,12/06/2015,'10/05/2023',1,'Flavia','Scattolin','nae_flavia_scattolin','(53) 8484-1632','0'),						
(210,'1','Flavia Luciane Pinheiro Gonzales','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo144','0','flavia.pinheiro@riogrande.rs.gov.br','',null,null,null,02/03/2020,'04/03/2021',1,'Flavia Luciane','Pinheiro Gonzales','paulo_freire','(53) 8114-4079','0'),						
(290,'1','Arlete Amaral Corrêa','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo145','0','arlete.acorrea1@gmail.com','',null,null,null,16/12/2022,'02/05/2023',1,'Arlete','Amaral Corrêa','arlete.correa','(53) 9132-1050','0'),						
(295,'1','Izete Maria Pinheiro','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo146','0','izetesmec@riogrande.rs.gov.br','',null,null,null,24/02/2023,'24/02/2023',1,'Izete Maria','Pinheiro','rh-izete','(00) 0000-0000','0'),						
(289,'1','matriculas','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo147','0','matriculas@email.com','',null,null,null,23/09/2022,'06/04/2023',1,'matriculas','matriculas','matriculas','(00) 0000-0000','0'),						
(280,'1','Natália Cardoso Salomão','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo148','0','natalia@email.com','',null,null,null,21/07/2021,'28/04/2023',1,'Natália','Cardoso Salomão','nae-nathalia','(00) 0000-0000','0'),						
(215,'1','Suelen Xavier Dias Conde','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo149','0','suelen@email.com','',null,null,null,25/08/2015,'09/05/2023',1,'Suelen','Xavier Dias Conde','nae_suelen_conde','(00) 0000-0000','0'),						
(297,'1','Sandra Regina Rodrigues Ongaratto','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo150','0','emefauroracadaval53@gmail.com','',null,null,null,06/03/2023,'01/05/2023',1,'Sandra Regina','Rodrigues Ongaratto','aurora_cadaval','(00) 0000-0000','0'),						
(240,'1','Juliana Canary Costa de Oliveira','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo151','0','judeoliveira80@hotmail.com','',null,null,null,21/08/2017,'12/05/2023',1,'Juliana','Canary Costa de Oliveira','rh-juliana','(53) 9995-8870','0'),						
(227,'1','Roseane Correa Rosenhein','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo152','0','roseane@email.com','',null,null,null,09/01/2018,'11/05/2023',1,'Roseane','Correa Rosenhein','nilza_goncalves','(00) 0000-0000','0'),						
(274,'1','Lisiane Maria Gressler do Amaral','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo153','0','lisiane@email.com','',null,null,null,11/03/2021,'12/05/2023',1,'Lisiane Maria','Gressler do Amaral','rh-lisiane','(00) 0000-0000','0'),						
(269,'1','Karine Dias Pinto','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo154','0','karine@email.com','',null,null,null,11/03/2021,'07/03/2021',1,'Karine','Dias Pinto','ped-educacao_integral','(00) 0000-0000','0'),						
(268,'1','Joelma Madruga Furtado','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo155','0','joelma@email.com','',null,null,null,11/03/2021,'12/05/2023',1,'Joelma ','Madruga Furtado','ped-anos_finais','(00) 0000-0000','0'),						
(282,'1','Karina Balenti da Silva','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo156','0','karina@email.com','',null,null,null,20/03/2023,'23/03/2023',1,'Karina','Balenti da Silva','gabinete_karina','(00) 0000-0000','0'),						
(283,'1','Andrea Moita Monteiro','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo157','0','andreamoita@email.com','',null,null,null,20/03/2023,'10/10/2022',1,'Andrea','Moita Monteiro','gabinete_andrea','(00) 0000-0000','0'),						
(284,'1','Sinatra Silveira de Barros','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo158','0','sinatra@email.com','',null,null,null,05/08/2022,'13/05/2023',1,'Sinatra','Silveira de Barros','escola_viva','(00) 0000-0000','0'),						
(254,'1','Ana Paula Miranda da Silveira','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo159','0','anapaula@email.com','',null,null,null,15/04/2019,'12/05/2023',1,'Ana Paula','Miranda da Silveira','rh-ana_paula','(00) 0000-0000','0'),						
(262,'1','Vânia Pinto Cerqueira','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo160','0','vania@email.com','',null,null,null,07/03/2021,'30/09/2021',1,'Vânia','Pinto Cerqueira','ped-superintendente','(00) 0000-0000','0'),						
(263,'1','Arlete Amaral Correa','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo161','0','arlete@email.com','',null,null,null,07/03/2021,'07/03/2021',1,'Arlete','Amaral Correa','ped-gerente','(00) 0000-0000','0'),						
(264,'1','Angela Atalla','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo162','0','angela@emil.com','',null,null,null,11/03/2021,'28/10/2022',1,'Angela','Atalla','ped-educacao_infantil','(00) 0000-0000','0'),						
(238,'1','Vlademir Amaral da Silva','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo163','0','vlademir@email.com','',null,null,null,09/08/2018,'29/03/2023',1,'Vlademir','Amaral da Silva ','rh-vlademir','(00) 0000-0000','0'),						
(277,'1','Henrique Bernardelli','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo164','0','henrique.bernardelli@riogrande.rs.gov.br','',null,null,null,04/01/2023,'11/01/2023',1,'Henrique','Bernardelli','henrique','(00) 0000-0000','0'),						
(241,'1','Claudinei de Oliveira Costa','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo165','0','claudinei@email.com','',null,null,null,03/11/2021,'24/04/2023',1,'Claudinei','de Oliveira Costa','ney_amado_costa','(00) 0000-0000','0 '),						
(242,'1','Roselis Marques','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo166','0','roselis@email.com','',null,null,null,05/08/2022,'10/05/2023',1,'Roselis','Marques','miguel_couto','(00) 0000-0000','0'),						
(256,'1','Magda Lucas','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo167','0','magda@email.com','',null,null,null,02/07/2019,'12/05/2023',1,'Magda','Lucas','rh-magda','(00) 0000-0000','0'),						
(271,'1','Silvia Soares','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo168','0','silvia@email.com','',null,null,null,11/03/2021,'18/04/2022',1 ,'Silvia','Soares','ped-eja','(00) 0000-0000','0'),						
(304,'1','Marlei dos Santos Costa','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo169','0','marleicosta2010@hotmail.com','',null,null,null,10/04/2023,'10/04/2023',1,'Marlei','dos Santos Costa','central.marlei','(53) 8455-7310','0'),						
(257,'1','Vania Bandeira Reginato','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo170','0','vaniabandeira@email.com	','',null,null,null,11/03/2021,'25/11/2020',1,'Vania','Bandeira Reginato','rh-vania','(00) 0000-0000','0'),						
(278,'1','Juliana Goulart Zilli','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo171','0','juliana@email.com','',null,null,null,20/03/2023,'04/08/2021',1,'Juliana','Goulart Zilli','adm-juliana','(00) 0000-0000','0'),						
(251,'1','Lídia Oliveira Dias','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo172','0','lidiaoliveiradias@gmail.com','',null,null,null,07/11/2018,'11/05/2023',1,'Lídia','Oliveira Dias','alcides_barcelos','(53) 8467-4068','0'),						
(261,'1','Marcia Helena Branco de Mattos','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo173','0','marciahsmec@riogrande.rs.gov.br','',null,null,null,16/03/2021,'11/05/2023',1,'Marcia Helena','Branco de Mattos','rh-marcia','(00) 0000-0000','0'),						
(313,'1','Paola Reyer Marques','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo174','0','nucleoanosiniciaismed@gmail.com','',null,null,null,11/05/2023,'15/05/2023',1,'Paola','Reyer Marques','ped-anos.iniciais','(00) 0000-0000','0 '),						
(314,'1','LUCIANO CORREA MARCO','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo175','0','luciano1marco@gmail.com','',null,null,null,22/05/2023,'22/05/2023',1,'LUCIANO','CORREA MARCO','info.luciano','(53) 8432-1028','0'),						
(315,'1','Teste da silva','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo176','0','teste@teste.com','',null,null,null,22/05/2023,'22/05/2023',1,'Teste','da silva','info.teste','932323232','0');																																											

-- --------------------------------------------------------

--
-- Structure de la table `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

-- menu dinamico

CREATE TABLE menusection (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	descricao VARCHAR(50)
);

INSERT INTO menusection (descricao) VALUES ('Seção de Menu');

CREATE TABLE menuitens (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	controller VARCHAR(30) NOT NULL,
	descricao VARCHAR(50) NOT NULL,
  icone varchar(30),
  section int
);

INSERT INTO menuitens (controller, descricao, icone, section) VALUES
('license', 'Licenças', 'fa fa-legal', 1);

CREATE TABLE menugroups (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	grupo INT,
	menu INT
);

INSERT INTO menugroups(grupo, menu) VALUES
(2, 1);