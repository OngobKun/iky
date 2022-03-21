CREATE TABLE `peserta_tour` (
 `id` int(100) NOT NULL AUTO_INCREMENT,
 `name` varchar(30) NOT NULL,
 `gender` enum('L','P') NOT NULL,
 `nickname` varchar(50) NOT NULL,
 `server` varchar(5) NOT NULL,
 `idgame` varchar(10) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1