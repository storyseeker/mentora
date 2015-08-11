GRANT ALL PRIVILEGES ON *.* TO mentora@"%" IDENTIFIED BY 'mentora';

SET NAMES 'utf8';
CREATE DATABASE IF NOT EXISTS `mentora` DEFAULT CHARSET=utf8;

USE `mentora`;

CREATE TABLE IF NOT EXISTS `ma_user`(
    `id`                bigint(20)  NOT NULL AUTO_INCREMENT,
    `name`              VARCHAR(32)  NOT NULL DEFAULT "",
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

INSERT INTO ma_user VALUES (888, 'linzhengwei', '13488876471', 'davidcrown@126.com', 'http://b.hiphotos.baidu.com/image/pic/item/4a36acaf2edda3cc6d78e9b702e93901203f928c.jpg', "xiaomi", 'Software Engineer', 1, 'http://www.weibo.com/u/1741632722', '517746825', 'storyseeker', 1, 1439277814, 1439277814, 0);
