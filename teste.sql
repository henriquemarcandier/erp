/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : teste

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2025-07-18 20:48:29
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `cupons`
-- ----------------------------
DROP TABLE IF EXISTS `cupons`;
CREATE TABLE `cupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL,
  `valor_desconto` decimal(10,2) NOT NULL,
  `minimo_pedido` decimal(10,2) NOT NULL,
  `validade` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of cupons
-- ----------------------------
INSERT INTO `cupons` VALUES ('1', '321-LOJA-123', '150.00', '50.00', '9999-12-31');

-- ----------------------------
-- Table structure for `estoque`
-- ----------------------------
DROP TABLE IF EXISTS `estoque`;
CREATE TABLE `estoque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `variacao_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `variacao_id` (`variacao_id`),
  CONSTRAINT `estoque_ibfk_1` FOREIGN KEY (`variacao_id`) REFERENCES `variacoes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of estoque
-- ----------------------------
INSERT INTO `estoque` VALUES ('1', '1', '95');
INSERT INTO `estoque` VALUES ('2', '2', '100');
INSERT INTO `estoque` VALUES ('3', '3', '5');

-- ----------------------------
-- Table structure for `pedido_itens`
-- ----------------------------
DROP TABLE IF EXISTS `pedido_itens`;
CREATE TABLE `pedido_itens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) DEFAULT NULL,
  `variacao_id` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `preco_unitario` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pedido_id` (`pedido_id`),
  KEY `variacao_id` (`variacao_id`),
  CONSTRAINT `pedido_itens_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  CONSTRAINT `pedido_itens_ibfk_2` FOREIGN KEY (`variacao_id`) REFERENCES `variacoes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of pedido_itens
-- ----------------------------
INSERT INTO `pedido_itens` VALUES ('1', '1', '3', '1', '15.00');
INSERT INTO `pedido_itens` VALUES ('2', '1', '1', '1', '350.00');
INSERT INTO `pedido_itens` VALUES ('3', '2', '1', '1', '350.00');
INSERT INTO `pedido_itens` VALUES ('4', '2', '3', '1', '15.00');
INSERT INTO `pedido_itens` VALUES ('5', '3', '3', '1', '15.00');
INSERT INTO `pedido_itens` VALUES ('6', '4', '1', '1', '350.00');
INSERT INTO `pedido_itens` VALUES ('7', '5', '3', '1', '50.00');
INSERT INTO `pedido_itens` VALUES ('9', '9', '1', '1', '350.00');
INSERT INTO `pedido_itens` VALUES ('10', '10', '3', '1', '50.00');

-- ----------------------------
-- Table structure for `pedidos`
-- ----------------------------
DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor_total` decimal(10,2) DEFAULT NULL,
  `frete` decimal(10,2) DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `endereco` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pendente',
  `email_cliente` varchar(255) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of pedidos
-- ----------------------------
INSERT INTO `pedidos` VALUES ('1', '215.00', '0.00', '30421108', 'Rua Geraldo Bicalho, Nova Suíssa, Belo Horizonte - MG', 'Pendente', 'henrique.marcandier@gmail.com', '2025-07-18 19:14:44');
INSERT INTO `pedidos` VALUES ('2', '365.00', '0.00', '30421112', 'Rua Zurick, Nova Suíssa, Belo Horizonte - MG', 'Cancelado', 'henrique.marcandier@gmail.com', '2025-07-18 19:30:22');
INSERT INTO `pedidos` VALUES ('3', '35.00', '20.00', '30421108', 'Rua Geraldo Bicalho, Nova Suíssa, Belo Horizonte - MG', 'Concluído', 'henrique.marcandier@gmail.com', '2025-07-18 19:31:11');
INSERT INTO `pedidos` VALUES ('4', '350.00', '0.00', '30421108', 'Rua Geraldo Bicalho, Nova Suíssa, Belo Horizonte - MG', 'Processando', 'henrique.marcandier@gmail.com', '2025-07-18 20:00:49');
INSERT INTO `pedidos` VALUES ('5', '70.00', '20.00', '30421108', 'Rua Geraldo Bicalho, 66, ap 101, Nova Suíssa, Belo Horizonte - MG', 'Enviado', 'henrique.marcandier@gmail.com', '2025-07-18 20:02:29');
INSERT INTO `pedidos` VALUES ('9', '350.00', '0.00', '30421108', 'Rua Geraldo Bicalho, Nova Suíssa, Belo Horizonte - MG', 'Pendente', 'henrique.marcandier@gmail.com', '2025-07-18 20:25:05');
INSERT INTO `pedidos` VALUES ('10', '70.00', '20.00', '30421108', 'Rua Geraldo Bicalho, Nova Suíssa, Belo Horizonte - MG', 'Pendente', 'henrique.marcandier@gmail.com', '2025-07-18 20:31:59');

-- ----------------------------
-- Table structure for `produtos`
-- ----------------------------
DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of produtos
-- ----------------------------
INSERT INTO `produtos` VALUES ('1', 'Téste', '350.00');
INSERT INTO `produtos` VALUES ('2', 'Téste2', '50.00');

-- ----------------------------
-- Table structure for `variacoes`
-- ----------------------------
DROP TABLE IF EXISTS `variacoes`;
CREATE TABLE `variacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `produto_id` (`produto_id`),
  CONSTRAINT `variacoes_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of variacoes
-- ----------------------------
INSERT INTO `variacoes` VALUES ('1', '1', 'Azul');
INSERT INTO `variacoes` VALUES ('2', '1', 'Verde');
INSERT INTO `variacoes` VALUES ('3', '2', 'Azul');
