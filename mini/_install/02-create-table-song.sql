CREATE TABLE `mini`.`song` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `track` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
