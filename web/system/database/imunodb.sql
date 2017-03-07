CREATE TABLE `Users` (
	`user_id` INT NOT NULL AUTO_INCREMENT,
	`login_activated` bool NOT NULL UNIQUE DEFAULT '0',
	`email` varchar(255) NOT NULL,
	`password` varchar(255) NOT NULL,
	`first_name` varchar(255) NOT NULL,
	`last_name` varchar(255) NOT NULL,
	`city` varchar(255) NOT NULL,
	`country` varchar(255) NOT NULL,
	PRIMARY KEY (`user_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Admins` (
	`admin_id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL,
	PRIMARY KEY (`admin_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Contributors` (
	`contrib_id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL,
	`institution` varchar(255) NOT NULL,
	`field_study` varchar(255) NOT NULL,
	`phone` varchar(255) NOT NULL,
	PRIMARY KEY (`contrib_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Send_mail` (
	`send_mail_id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL,
	`email_marketing` bool NOT NULL DEFAULT '1',
	PRIMARY KEY (`send_mail_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Mutations` (
	`mutation_id` INT NOT NULL AUTO_INCREMENT,
	`gene_id` INT NOT NULL,
	`type` varchar(255) NOT NULL,
	`inheritance` varchar(255) NOT NULL,
	`site` varchar(255) NOT NULL,
	`c_dna` varchar(255) NOT NULL,
	`protein` varchar(255) NOT NULL,
	`article_id` INT NOT NULL,
	PRIMARY KEY (`mutation_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Bibliography` (
	`article_id` INT NOT NULL AUTO_INCREMENT,
	`title` varchar(255) NOT NULL,
	`authors` varchar(255) NOT NULL,
	`publication_year` year NOT NULL,
	`doi` varchar(255) NOT NULL,
	PRIMARY KEY (`article_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Synonyms` (
	`synon_id` INT NOT NULL AUTO_INCREMENT,
	`gene_id` INT NOT NULL,
	`synonymous` varchar(255) NOT NULL,
	PRIMARY KEY (`synon_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Genes` (
	`gene_id` INT NOT NULL AUTO_INCREMENT,
	`gene_name` varchar(255) NOT NULL,
	PRIMARY KEY (`gene_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Pacients` (
	`pacient_id` INT NOT NULL AUTO_INCREMENT,
	`mutation_id` INT NOT NULL,
	`disease_id` INT NOT NULL,
	`country_id` INT NOT NULL,
	`omim_phenotype` int NOT NULL,
	PRIMARY KEY (`pacient_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Submissions` (
	`submission_id` INT NOT NULL AUTO_INCREMENT,
	`contrib_id` INT NOT NULL,
	`date` DATE NOT NULL,
	`time` TIMESTAMP NOT NULL,
	`title` varchar(255) NOT NULL,
	`authors` varchar(255) NOT NULL,
	`publication_year` year NOT NULL,
	`doi` varchar(255) NOT NULL,
	`comment` varchar(255) NOT NULL,
	PRIMARY KEY (`submission_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Diseases` (
	`disease_id` INT NOT NULL AUTO_INCREMENT,
	`disease_name` varchar(255) NOT NULL ,
	PRIMARY KEY (`disease_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Countries` (
	`country_id` INT NOT NULL AUTO_INCREMENT,
	`country_name` varchar(255) NOT NULL,
	PRIMARY KEY (`country_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `Admins` ADD CONSTRAINT `Admins_fk0` FOREIGN KEY (`user_id`) REFERENCES `Users`(`user_id`);

ALTER TABLE `Contributors` ADD CONSTRAINT `Contributors_fk0` FOREIGN KEY (`user_id`) REFERENCES `Users`(`user_id`);

ALTER TABLE `Send_mail` ADD CONSTRAINT `Send_mail_fk0` FOREIGN KEY (`user_id`) REFERENCES `Users`(`user_id`);

ALTER TABLE `Mutations` ADD CONSTRAINT `Mutations_fk0` FOREIGN KEY (`gene_id`) REFERENCES `Genes`(`gene_id`);

ALTER TABLE `Mutations` ADD CONSTRAINT `Mutations_fk1` FOREIGN KEY (`article_id`) REFERENCES `Bibliography`(`article_id`);

ALTER TABLE `Synonyms` ADD CONSTRAINT `Synonyms_fk0` FOREIGN KEY (`gene_id`) REFERENCES `Genes`(`gene_id`);

ALTER TABLE `Pacients` ADD CONSTRAINT `Pacients_fk0` FOREIGN KEY (`mutation_id`) REFERENCES `Mutations`(`mutation_id`);

ALTER TABLE `Pacients` ADD CONSTRAINT `Pacients_fk1` FOREIGN KEY (`disease_id`) REFERENCES `Diseases`(`disease_id`);

ALTER TABLE `Pacients` ADD CONSTRAINT `Pacients_fk2` FOREIGN KEY (`country_id`) REFERENCES `Countries`(`country_id`);

ALTER TABLE `Submissions` ADD CONSTRAINT `Submissions_fk0` FOREIGN KEY (`contrib_id`) REFERENCES `Contributors`(`contrib_id`);

