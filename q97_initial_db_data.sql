-- 
-- Disable foreign keys (until the end of this script)
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Set SQL mode
-- 
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 
-- Set chars encoding (which a client will be send to a server)
--
SET NAMES 'utf8';

-- 
-- Set default database
--
USE test;

--
-- category table
--
DROP TABLE IF EXISTS category;
CREATE TABLE category (
  cid INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  enabled TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (cid),
  INDEX IDX_category_enabled (enabled)
)
ENGINE = INNODB
AUTO_INCREMENT = 5
AVG_ROW_LENGTH = 4096
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- products table
--
DROP TABLE IF EXISTS products;
CREATE TABLE products (
  pid INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  PRIMARY KEY (pid)
)
ENGINE = INNODB
AUTO_INCREMENT = 8
AVG_ROW_LENGTH = 2730
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- junction table
--
DROP TABLE IF EXISTS junction;
CREATE TABLE junction (
  pid INT(11) UNSIGNED NOT NULL,
  cid INT(11) UNSIGNED NOT NULL,
  INDEX IDX_junction_cid (cid),
  CONSTRAINT FK_junction_category_cid FOREIGN KEY (cid)
    REFERENCES category(cid) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FK_junction_products_pid FOREIGN KEY (pid)
    REFERENCES products(pid) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AVG_ROW_LENGTH = 1260
CHARACTER SET utf8
COLLATE utf8_general_ci;

-- 
-- Data for category table
--
INSERT INTO category VALUES
(1, 'Sale', 0),
(2, 'Electronics', 0),
(3, 'Home', 1),
(4, 'Office', 1);

-- 
-- Data for products table
--
INSERT INTO products VALUES
(1, 'PC'),
(2, 'TV'),
(3, 'Desk'),
(4, 'Pen'),
(5, 'Pencil'),
(6, 'Couch'),
(7, 'Other');

-- 
-- Data for junction table
--
INSERT INTO junction VALUES
(1, 1),
(2, 1),
(1, 2),
(2, 2),
(1, 3),
(2, 3),
(6, 3),
(1, 4),
(3, 4),
(4, 4),
(5, 4),
(6, 4),
(6, 4);

-- 
-- Return previous SQL mode
-- 
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

-- 
-- Turn (on) foreign keys
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;