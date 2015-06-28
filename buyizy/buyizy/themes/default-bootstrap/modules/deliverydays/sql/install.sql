CREATE TABLE IF NOT EXISTS `PREFIX_deliverydays_cart` (
  `id_cart` int(10) unsigned NOT NULL,
  `date_delivery` date NOT NULL DEFAULT '1970-01-01',
  `timeframe` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY  (`id_cart`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `PREFIX_deliverydays_exception` (
  `id_deliverydays_exception` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_exception` date NOT NULL DEFAULT '1970-01-01',
  PRIMARY KEY  (`id_deliverydays_exception`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
