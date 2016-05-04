-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.1.10-MariaDB - mariadb.org binary distribution
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица cheks.check_table
CREATE TABLE IF NOT EXISTS `check_table` (
  `check_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `product_name` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `price` float DEFAULT NULL,
  `guarantee` date DEFAULT NULL,
  `buyingdate` date DEFAULT NULL,
  `filecheck` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`check_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Дамп данных таблицы cheks.check_table: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `check_table` DISABLE KEYS */;
INSERT INTO `check_table` (`check_id`, `user_id`, `product_name`, `price`, `guarantee`, `buyingdate`, `filecheck`) VALUES
	(11, 2, 't5', 5, '2016-04-05', '2016-04-05', 'nevilpic.jpg'),
	(12, 2, 't6', 45, '2016-04-06', '2016-04-06', 'johanpic.jpg');
/*!40000 ALTER TABLE `check_table` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
