CREATE TABLE `movies` (
 `movie_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `movie_title` varchar(50) NOT NULL,
 `cover_image` varchar(40) NOT NULL,
 `category` varchar(20) NOT NULL,
 `description` varchar(500) NOT NULL,
 `language` varchar(20) NOT NULL,
 `movie_duration` varchar(20) NOT NULL,
 `trailer` varchar(300) NOT NULL,
 PRIMARY KEY (`movie_id`)
)












