GRANT ALL PRIVILEGES ON *.* TO mentora@"%" IDENTIFIED BY 'mentora';

SET NAMES 'utf8';
CREATE DATABASE IF NOT EXISTS `mentora` DEFAULT CHARSET=utf8;

USE `mentora`;

CREATE TABLE IF NOT EXISTS `ma_user`(
    `id`                bigint(20)  NOT NULL AUTO_INCREMENT,
    `password`          VARCHAR(32) NOT NULL DEFAULT "",
    `name`              VARCHAR(32) NOT NULL DEFAULT "",
    `phone`             VARCHAR(32) NOT NULL DEFAULT "",
    `email`             VARCHAR(64) NOT NULL DEFAULT "",
    `pic`               VARCHAR(128) NOT NULL DEFAULT "",
    `company`           VARCHAR(32) NOT NULL DEFAULT "",
    `job`               VARCHAR(32) NOT NULL DEFAULT "",
    `open`              boolean NOT NULL DEFAULT 0,
    `weibo`             VARCHAR(128) NOT NULL DEFAULT "",
    `weixin`            VARCHAR(64) NOT NULL DEFAULT "",
    `linkedin`          VARCHAR(64) NOT NULL DEFAULT "",
    `github`            VARCHAR(64) NOT NULL DEFAULT "",
    `status`            bigint(20) unsigned DEFAULT 0,
    `ctime`             bigint(20) unsigned DEFAULT 0,
    `mtime`             bigint(20) unsigned DEFAULT 0,
    `deleted`           tinyint(1) DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE KEY `phone`(`phone`),
    UNIQUE KEY `email`(`email`)
) AUTO_INCREMENT=1680001 ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO ma_user VALUES (888, 'f447b20a7fcbf53a5d5be013ea0b15af', 'linzhengwei', '13488876471', 'davidcrown@126.com', 'http://b.hiphotos.baidu.com/image/pic/item/4a36acaf2edda3cc6d78e9b702e93901203f928c.jpg', "xiaomi", 'Software Engineer', 1, 'http://www.weibo.com/u/1741632722', '517746825', 'storyseeker', 'https://github.com/storyseeker/mentora', 1, 1439277814, 1439277814, 0);

INSERT INTO ma_user VALUES (999, 'f447b20a7fcbf53a5d5be013ea0b15af' ,'panyan', '15801532327', 'storyseeker@163.com', 'http://b.hiphotos.baidu.com/image/pic/item/4a36acaf2edda3cc6d78e9b702e93901203f928c.jpg', "xiaomi", 'Software Engineer', 1, 'http://www.weibo.com/u/1741632722', '517746825', 'storyseeker', 'https://github.com/storyseeker/mentora', 1, 1439577814, 1439577814, 0);

CREATE TABLE IF NOT EXISTS `ma_team`(
    `id`                bigint(20)  NOT NULL AUTO_INCREMENT,
    `owner`             bigint(20)  NOT NULL DEFAULT 888,
    `flag`              int(8) NOT NULL DEFAULT 0,
    `name`              VARCHAR(32) NOT NULL DEFAULT "",
    `mission`           VARCHAR(128) NOT NULL DEFAULT "",
    `logo`              VARCHAR(128) NOT NULL DEFAULT "",
    `intro`             VARCHAR(128) NOT NULL DEFAULT "",
    `company`           VARCHAR(32) NOT NULL DEFAULT "",
    `domain`            VARCHAR(32) NOT NULL DEFAULT "",
    `stage`             VARCHAR(32) NOT NULL DEFAULT "",
    `size`              VARCHAR(64) NOT NULL DEFAULT "",
    `address`           VARCHAR(64) NOT NULL DEFAULT "",
    `status`            bigint(20) unsigned DEFAULT 0,
    `ctime`             bigint(20) unsigned DEFAULT 0,
    `mtime`             bigint(20) unsigned DEFAULT 0,
    `deleted`           tinyint(1) DEFAULT 0,
    PRIMARY KEY (`id`),
    KEY `owner`(`owner`, `flag`)
) AUTO_INCREMENT=1680001 ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO ma_team(id, owner, flag, name, mission, mtime, ctime) VALUES(888, 888, 0, 'MySpace', 'Record and Share My Growths', 1439577814, 1439577814);
INSERT INTO ma_team(id, owner, flag, name, mission, mtime, ctime) VALUES(889, 888, 1, 'MyMate', 'Follow and Share My Growths With My Closest Friends', 1439577814, 1439577814);
