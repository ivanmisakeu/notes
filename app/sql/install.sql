
-- creating users table

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) COLLATE 'utf8_general_ci' NOT NULL,
  `mail` varchar(255) COLLATE 'utf8_general_ci' NOT NULL,
  `password` varchar(128) NOT NULL,
  `admin` int(1) DEFAULT 0,
  `token` varchar(128) DEFAULT NULL,
  `deleted` int(1) DEFAULT 0,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL
);

INSERT INTO `users` (`name`, `mail`, `password`, `admin`, `updated`, `created`) VALUES
('ivan.misak', 'admin@ivanmisak.eu', '02a0fabd3538654fb762f75626ebb42c', 1, NOW(), NOW() );

-- creating table migration

CREATE TABLE `migration` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) COLLATE 'utf8_general_ci' NOT NULL,
  `created` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
);

-- creating settings table for store general app data

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) COLLATE 'utf8_general_ci' NOT NULL,
  `value` varchar(255) COLLATE 'utf8_general_ci' DEFAULT NULL,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL
);

INSERT INTO `settings` (`name`, `value`, `updated`, `created`) VALUES
('APP_VERSION',	'1.0', NOW(), NOW() );