/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : teste

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2025-07-21 02:02:29
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `cupons`
-- ----------------------------
DROP TABLE IF EXISTS `cupons`;
CREATE TABLE `cupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL,
  `desconto` decimal(5,2) NOT NULL,
  `valor_desconto` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tipo` enum('percentual','valor') NOT NULL,
  `validade` date NOT NULL,
  `minimo_pedido` decimal(10,2) NOT NULL DEFAULT 0.00,
  `ativo` tinyint(1) DEFAULT 1,
  `criado_em` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of cupons
-- ----------------------------
INSERT INTO `cupons` VALUES ('1', '321-LOJA-123', '0.00', '300.00', 'percentual', '9999-12-31', '150.00', '1', '2025-07-20 18:06:55');

-- ----------------------------
-- Table structure for `estoque`
-- ----------------------------
DROP TABLE IF EXISTS `estoque`;
CREATE TABLE `estoque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `variacao_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of estoque
-- ----------------------------
INSERT INTO `estoque` VALUES ('1', '1', '999994');
INSERT INTO `estoque` VALUES ('2', '2', '999998');
INSERT INTO `estoque` VALUES ('3', '3', '999997');

-- ----------------------------
-- Table structure for `pedido_itens`
-- ----------------------------
DROP TABLE IF EXISTS `pedido_itens`;
CREATE TABLE `pedido_itens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) NOT NULL,
  `variacao_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco_unitario` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of pedido_itens
-- ----------------------------
INSERT INTO `pedido_itens` VALUES ('1', '1', '1', '1', '500.00');
INSERT INTO `pedido_itens` VALUES ('2', '2', '2', '1', '149.00');
INSERT INTO `pedido_itens` VALUES ('3', '3', '3', '1', '50.00');
INSERT INTO `pedido_itens` VALUES ('4', '4', '3', '1', '50.00');
INSERT INTO `pedido_itens` VALUES ('5', '5', '1', '1', '500.00');
INSERT INTO `pedido_itens` VALUES ('6', '6', '1', '1', '500.00');
INSERT INTO `pedido_itens` VALUES ('7', '6', '2', '1', '149.00');
INSERT INTO `pedido_itens` VALUES ('8', '6', '3', '1', '50.00');
INSERT INTO `pedido_itens` VALUES ('9', '7', '1', '1', '500.00');
INSERT INTO `pedido_itens` VALUES ('10', '8', '1', '1', '500.00');
INSERT INTO `pedido_itens` VALUES ('11', '9', '1', '1', '500.00');
INSERT INTO `pedido_itens` VALUES ('12', '10', '3', '1', '50.00');
INSERT INTO `pedido_itens` VALUES ('13', '10', '1', '1', '500.00');

-- ----------------------------
-- Table structure for `pedidos`
-- ----------------------------
DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_nome` varchar(100) NOT NULL,
  `email_cliente` varchar(100) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `status` enum('Pendente','Processando','Enviado','Cancelado','Concluído') DEFAULT 'Pendente',
  `cupom_aplicado` varchar(255) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `frete` decimal(10,2) NOT NULL DEFAULT 0.00,
  `desconto` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `criado_em` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of pedidos
-- ----------------------------
INSERT INTO `pedidos` VALUES ('1', '', 'henrique.marcandier@gmail.com', '30421108', 'Rua Geraldo Bicalho, Nova Suíssa, Belo Horizonte - MG', 'Concluído', '321-LOJA-123', '500.00', '0.00', '300.00', '200.00', '2025-07-20 18:07:58');
INSERT INTO `pedidos` VALUES ('2', '', 'henrique.marcandier@gmail.com', '30421108', 'Rua Geraldo Bicalho, Nova Suíssa, Belo Horizonte - MG', 'Pendente', '', '149.00', '15.00', '0.00', '164.00', '2025-07-20 18:14:03');
INSERT INTO `pedidos` VALUES ('3', '', 'henrique.marcandier@gmail.com', '30421108', 'Rua Geraldo Bicalho, Nova Suíssa, Belo Horizonte - MG', 'Pendente', '', '50.00', '20.00', '0.00', '70.00', '2025-07-20 18:15:29');
INSERT INTO `pedidos` VALUES ('4', '', 'henrique.marcandier@gmail.com', '30421108', 'Rua Geraldo Bicalho, Nova Suíssa, Belo Horizonte - MG', 'Pendente', '', '50.00', '20.00', '0.00', '70.00', '2025-07-20 18:16:22');
INSERT INTO `pedidos` VALUES ('5', '', 'henrique.marcandier@gmail.com', '30421108', 'Rua Geraldo Bicalho, Nova Suíssa, Belo Horizonte - MG', 'Pendente', '321-LOJA-123', '500.00', '0.00', '300.00', '200.00', '2025-07-20 18:49:34');
INSERT INTO `pedidos` VALUES ('6', '', 'henrique.marcandier@gmail.com', '30421108', 'Rua Geraldo Bicalho, Nova Suíssa, Belo Horizonte - MG', 'Pendente', '321-LOJA-123', '699.00', '0.00', '300.00', '399.00', '2025-07-20 21:19:53');
INSERT INTO `pedidos` VALUES ('7', '', 'henrique.marcandier@gmail.com', '30421108', 'Rua Geraldo Bicalho, Nova Suíssa, Belo Horizonte - MG', 'Concluído', '', '500.00', '0.00', '0.00', '500.00', '2025-07-20 21:22:34');
INSERT INTO `pedidos` VALUES ('8', '', 'henrique.marcandier@gmail.com', '30421108', 'Rua Geraldo Bicalho, Nova Suíssa, Belo Horizonte - MG', 'Cancelado', '321-LOJA-123', '500.00', '0.00', '300.00', '200.00', '2025-07-20 21:24:45');
INSERT INTO `pedidos` VALUES ('9', '', 'henrique.marcandier@gmail.com', '30421108', 'Rua Geraldo Bicalho, Nova Suíssa, Belo Horizonte - MG', 'Enviado', '321-LOJA-123', '500.00', '0.00', '300.00', '200.00', '2025-07-21 01:35:11');
INSERT INTO `pedidos` VALUES ('10', '', 'henrique.marcandier@gmail.com', '30421108', 'Rua Geraldo Bicalho, Nova Suíssa, Belo Horizonte - MG', 'Processando', '321-LOJA-123', '550.00', '0.00', '300.00', '250.00', '2025-07-21 01:47:34');

-- ----------------------------
-- Table structure for `produtos`
-- ----------------------------
DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL DEFAULT 0.00,
  `ativo` tinyint(1) DEFAULT 1,
  `criado_em` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of produtos
-- ----------------------------
INSERT INTO `produtos` VALUES ('1', 'Teste', null, '500.00', '1', '2025-07-20 18:05:32');
INSERT INTO `produtos` VALUES ('2', 'Teste2', null, '149.00', '1', '2025-07-20 18:05:59');
INSERT INTO `produtos` VALUES ('3', 'Teste3', null, '50.00', '1', '2025-07-20 18:06:20');

-- ----------------------------
-- Table structure for `variacoes`
-- ----------------------------
DROP TABLE IF EXISTS `variacoes`;
CREATE TABLE `variacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of variacoes
-- ----------------------------
INSERT INTO `variacoes` VALUES ('1', '1', 'Téste', '0.00');
INSERT INTO `variacoes` VALUES ('2', '2', 'Preto', '0.00');
INSERT INTO `variacoes` VALUES ('3', '3', 'Vermelho', '0.00');
