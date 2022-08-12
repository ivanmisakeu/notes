
-- note element

CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_note_category` INT(11) DEFAULT 1 NOT NULL,
  `name` varchar(255) COLLATE 'utf8_general_ci' NOT NULL,
  `content` TEXT COLLATE 'utf8_general_ci' DEFAULT NULL,
  `deleted` INT(1) DEFAULT 0,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL
);

-- note categories

CREATE TABLE IF NOT EXISTS `note_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) COLLATE 'utf8_general_ci' NOT NULL,
  `description` TEXT COLLATE 'utf8_general_ci' DEFAULT NULL,
  `deleted` INT(1) DEFAULT 0,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL
);

INSERT INTO `note_categories` (`id`, `name`, `updated`, `created`) VALUES
('1', 'Home', NOW(), NOW() );

-- note tags

CREATE TABLE IF NOT EXISTS `note_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) COLLATE 'utf8_general_ci' NOT NULL,
  `deleted` INT(1) DEFAULT 0,
  `created` datetime NOT NULL
);

CREATE TABLE IF NOT EXISTS `note_tag_rels` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_note` INT(11) NOT NULL,
  `id_note_tag` INT(11),
  `created` datetime NOT NULL
);