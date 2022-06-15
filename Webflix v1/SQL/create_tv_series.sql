CREATE TABLE `tv_series` (
 `tv_series_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `tv_series_title` varchar(50) NOT NULL,
 `cover_image` varchar(40) NOT NULL,
 `category` varchar(20) NOT NULL,
 `description` varchar(500) NOT NULL,
 `release_year` varchar(10) NOT NULL,
 `language` varchar(20) NOT NULL,
 `number_of_seasons` varchar(20) NOT NULL,
 `number_of_episodes` varchar(20) NOT NULL,
 `trailer` varchar(300) NOT NULL,
 PRIMARY KEY (`tv_series_id`)
) 











