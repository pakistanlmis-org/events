/*
Navicat MySQL Data Transfer

Source Server         : beta.lmis
Source Server Version : 50641
Source Host           : 202.83.174.107:3306
Source Database       : calendar

Target Server Type    : MYSQL
Target Server Version : 50641
File Encoding         : 65001

Date: 2019-02-27 11:57:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for event_tasks
-- ----------------------------
DROP TABLE IF EXISTS `event_tasks`;
CREATE TABLE `event_tasks` (
  `pk_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of event_tasks
-- ----------------------------
INSERT INTO `event_tasks` VALUES ('6', '3', '8', '2', '2019-02-26 18:03:15');
INSERT INTO `event_tasks` VALUES ('10', '5', '10', '2', '2019-02-26 18:07:06');
INSERT INTO `event_tasks` VALUES ('11', '6', '11', '2', '2019-02-26 18:07:06');
INSERT INTO `event_tasks` VALUES ('16', '9', '1', '2', '2019-02-27 10:20:58');
INSERT INTO `event_tasks` VALUES ('17', '9', '2', '2', '2019-02-27 10:20:58');
INSERT INTO `event_tasks` VALUES ('20', '8', '1', '2', '2019-02-27 11:54:21');

-- ----------------------------
-- Table structure for events
-- ----------------------------
DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(255) DEFAULT NULL,
  `comments` text,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of events
-- ----------------------------
INSERT INTO `events` VALUES ('3', 'DTC Meeting', '#0071c5', '2018-02-28 00:00:00', '2018-02-28 00:00:00', '1', '1', null, '2019-02-26 18:06:49');
INSERT INTO `events` VALUES ('5', 'DTC Meeting', '#0071c5', '2019-02-07 00:00:00', '2019-02-08 00:00:00', '1', '1', null, '2019-02-27 11:54:46');
INSERT INTO `events` VALUES ('6', 'DTC Meeting', '#0071c5', '2019-02-07 00:00:00', '2019-02-07 00:00:00', '1', '1', null, '2019-02-27 11:54:50');
INSERT INTO `events` VALUES ('8', 'DCC Meeting', '#008000', '2019-02-02 00:00:00', '2019-02-03 00:00:00', '1', '1', 'TEst', '2019-02-27 11:54:21');
INSERT INTO `events` VALUES ('9', 'DTC Meeting', '#0071c5', '2019-02-01 00:00:00', '2019-02-03 00:00:00', '1', '1', 'Test issue', '2019-02-27 11:54:32');
INSERT INTO `events` VALUES ('10', 'DTC Meeting', '#0071c5', '2019-02-28 00:00:00', '2019-02-28 00:00:00', '1', '1', 'Test Agenda for next meeting', '2019-02-27 11:54:38');

-- ----------------------------
-- Table structure for status
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `pk_id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of status
-- ----------------------------
INSERT INTO `status` VALUES ('1', 'Planned', '1', '2019-02-26 15:50:00');
INSERT INTO `status` VALUES ('2', 'Held', '1', '2019-02-26 15:50:02');
INSERT INTO `status` VALUES ('3', 'Open', '2', '2019-02-26 15:50:04');
INSERT INTO `status` VALUES ('4', 'Completed', '2', '2019-02-26 15:50:07');

-- ----------------------------
-- Table structure for tasks
-- ----------------------------
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `pk_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text,
  `type` tinyint(4) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tasks
-- ----------------------------
INSERT INTO `tasks` VALUES ('1', 'Implementation on previous meeting decisions', '2', '2019-02-26 16:34:02');
INSERT INTO `tasks` VALUES ('2', 'Monthly performance shared by all stakeholders', '2', '2019-02-26 16:34:02');
INSERT INTO `tasks` VALUES ('3', 'Stock status of contraceptive commodities shared', '2', '2019-02-26 16:34:03');
INSERT INTO `tasks` VALUES ('4', 'Schedule of outreach camps shared', '2', '2019-02-26 16:34:03');
INSERT INTO `tasks` VALUES ('5', 'Schedule of Advocacy, communication and social mobilization activities shared', '2', '2019-02-26 16:34:04');
INSERT INTO `tasks` VALUES ('6', 'Agenda Items display Here', '1', '2019-02-26 18:02:49');
INSERT INTO `tasks` VALUES ('7', 'Agenda Items display Here, Addition to that we will do this in meeting', '1', '2019-02-26 18:03:15');
INSERT INTO `tasks` VALUES ('8', 'Agenda Items display Here, Addition to that we will do this in meeting', '1', '2019-02-26 18:03:15');
INSERT INTO `tasks` VALUES ('9', 'Agenda Items display Here, Addition to that we will do this in meeting', '1', '2019-02-26 18:05:13');
INSERT INTO `tasks` VALUES ('10', 'Agenda Items display Here, Addition to that we will do this in meeting', '1', '2019-02-26 18:07:06');
INSERT INTO `tasks` VALUES ('11', 'Agenda Items display Here, Addition to that we will do this in meeting', '1', '2019-02-26 18:07:06');
INSERT INTO `tasks` VALUES ('12', 'dsfdfa', '1', '2019-02-26 18:07:22');
INSERT INTO `tasks` VALUES ('13', 'dsfdfaf fadfasdf', '1', '2019-02-26 18:07:42');

-- ----------------------------
-- Table structure for types
-- ----------------------------
DROP TABLE IF EXISTS `types`;
CREATE TABLE `types` (
  `pk_id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of types
-- ----------------------------
INSERT INTO `types` VALUES ('1', 'Events', '2019-02-26 15:49:35');
INSERT INTO `types` VALUES ('2', 'Tasks', '2019-02-26 15:49:41');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `pk_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'ajmal', 'ajmal', '2019-02-26 15:54:25');
SET FOREIGN_KEY_CHECKS=1;
