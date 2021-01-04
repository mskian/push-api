CREATE TABLE `tokens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` varchar(500) NOT NULL,
  `token` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `userid` (`userid`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;