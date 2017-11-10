CREATE TABLE `games_type` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`genre` varchar(255) NOT NULL ,
	PRIMARY KEY (`id`)
);

CREATE TABLE `games` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`visual` varchar(255) NOT NULL,
	`type_id` int(11) NOT NULL,
	`description` TEXT NOT NULL,
	`release_note` DATE NOT NULL,
	`press_note` FLOAT NOT NULL,
	`player_note` FLOAT NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `users` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`email` varchar(255) NOT NULL,
	`password` varchar(255) NOT NULL,
	`premium` bool NOT NULL,
	`admin` bool NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `users_game` (
	`game_id` int(11) NOT NULL,
	`user_id` int(11) NOT NULL
);

CREATE TABLE `comment` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`user_id` int(11) NOT NULL,
	`game_id` int(11) NOT NULL,
	`text` TEXT NOT NULL,
	PRIMARY KEY (`id`)
);

ALTER TABLE `games` ADD CONSTRAINT `games_fk0` FOREIGN KEY (`type_id`) REFERENCES `games_type`(`id`);

ALTER TABLE `users_game` ADD CONSTRAINT `users_game_fk0` FOREIGN KEY (`game_id`) REFERENCES `games`(`id`);

ALTER TABLE `users_game` ADD CONSTRAINT `users_game_fk1` FOREIGN KEY (`user_id`) REFERENCES `Users`(`id`);

ALTER TABLE `comment` ADD CONSTRAINT `comment_fk0` FOREIGN KEY (`user_id`) REFERENCES `Users`(`id`);

ALTER TABLE `comment` ADD CONSTRAINT `comment_fk1` FOREIGN KEY (`game_id`) REFERENCES `games`(`id`);
