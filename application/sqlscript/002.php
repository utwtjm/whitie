CREATE TABLE `groups` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` VARCHAR( 50 ) NOT NULL ,
`description` TEXT NOT NULL ,
`type` CHAR( 1 ) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE `permissions` (
`id` INT NOT NULL ,
`name` INT NOT NULL
) ENGINE = InnoDB;

CREATE TABLE `groups_permissions` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`group_id` INT NOT NULL ,
`user_id` BIGINT NOT NULL
) ENGINE = InnoDB;

CREATE TABLE `users_groups` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`user_id` BIGINT NOT NULL ,
`group_id` INT NOT NULL
) ENGINE = InnoDB;

ALTER TABLE `groups_permissions` CHANGE `user_id` `permission_id` BIGINT( 20 ) NOT NULL ;

ALTER TABLE `permissions` CHANGE `id` `id` INT( 11 ) NOT NULL AUTO_INCREMENT ;

INSERT INTO `groups` (
`id` ,
`name` ,
`description` ,
`type`
)
VALUES (
NULL , '管理員', '管理員群組', '1'
);

INSERT INTO `groups` (
`id` ,
`name` ,
`description` ,
`type`
)
VALUES (
NULL , '註冊會員', '註冊會員群組', '2'
);


INSERT INTO `groups` (
`id` ,
`name` ,
`description` ,
`type`
)
VALUES (
NULL , '訪客', '訪客群組', '3'
);



