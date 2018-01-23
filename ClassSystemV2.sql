# phpMyAdmin MySQL-Dump
# version 2.5.1
# http://www.phpmyadmin.net/ (download page)
#
# �D��: localhost
# �إߤ��: Dec 25, 2003, 10:48 AM
# ���A������: 3.23.56
# PHP ����: 4.2.2
# ��Ʈw: `newcs`
# --------------------------------------------------------

#
# ��ƪ�榡�G `board`
#
# �إ�: Dec 05, 2003, 09:42 AM
# �̫��s: Dec 18, 2003, 08:24 AM
#

CREATE TABLE `board` (
  `board_id` int(10) unsigned NOT NULL auto_increment,
  `teacher_id` int(10) unsigned NOT NULL default '0',
  `author` varchar(40) default NULL,
  `title` varchar(255) NOT NULL default '',
  `content` text,
  `date_time` datetime default NULL,
  PRIMARY KEY  (`board_id`),
  UNIQUE KEY `Board_id` (`board_id`)
) TYPE=MyISAM AUTO_INCREMENT=13 ;
# --------------------------------------------------------

#
# ��ƪ�榡�G `calendar`
#
# �إ�: Dec 05, 2003, 09:42 AM
# �̫��s: Dec 17, 2003, 11:39 AM
#

CREATE TABLE `calendar` (
  `calendar_id` int(10) unsigned NOT NULL auto_increment,
  `teacher_id` int(10) unsigned NOT NULL default '0',
  `year` int(10) unsigned default NULL,
  `month` tinyint(4) default NULL,
  `day` tinyint(4) default NULL,
  `author` varchar(40) default NULL,
  `content` text,
  `date_time` datetime default NULL,
  PRIMARY KEY  (`calendar_id`),
  UNIQUE KEY `calendar_id` (`calendar_id`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;
# --------------------------------------------------------

#
# ��ƪ�榡�G `discuss_reply`
#
# �إ�: Dec 05, 2003, 09:42 AM
# �̫��s: Dec 22, 2003, 10:03 AM
#

CREATE TABLE `discuss_reply` (
  `reply_id` int(10) unsigned NOT NULL auto_increment,
  `teacher_id` int(10) unsigned NOT NULL default '0',
  `subject_id` int(10) unsigned NOT NULL default '0',
  `reply_content` text,
  `reply_author` varchar(50) default NULL,
  `reply_email` varchar(100) default NULL,
  `reply_picture` varchar(40) default NULL,
  `reply_ip` varchar(16) default NULL,
  `reply_time` datetime default NULL,
  UNIQUE KEY `id` (`reply_id`)
) TYPE=MyISAM AUTO_INCREMENT=8 ;
# --------------------------------------------------------

#
# ��ƪ�榡�G `discuss_subject`
#
# �إ�: Dec 05, 2003, 09:42 AM
# �̫��s: Dec 22, 2003, 10:03 AM
#

CREATE TABLE `discuss_subject` (
  `subject_id` int(10) unsigned NOT NULL auto_increment,
  `teacher_id` int(10) unsigned NOT NULL default '0',
  `subject_title` varchar(255) NOT NULL default '',
  `subject_content` text,
  `subject_author` varchar(40) NOT NULL default '',
  `subject_email` varchar(100) default NULL,
  `subject_picture` varchar(40) default NULL,
  `subject_ip` varchar(16) default NULL,
  `subject_time` datetime default NULL,
  `subject_read` int(10) unsigned default '0',
  `new_reply_time` datetime default NULL,
  `reply_number` int(10) unsigned default '0',
  UNIQUE KEY `id` (`subject_id`)
) TYPE=MyISAM AUTO_INCREMENT=16 ;
# --------------------------------------------------------

#
# ��ƪ�榡�G `document_document`
#
# �إ�: Dec 05, 2003, 09:42 AM
# �̫��s: Dec 18, 2003, 02:18 PM
#

CREATE TABLE `document_document` (
  `document_id` int(10) unsigned NOT NULL auto_increment,
  `teacher_id` int(10) unsigned NOT NULL default '0',
  `folder_id` int(10) unsigned NOT NULL default '0',
  `document_title` varchar(255) NOT NULL default '',
  `document_content` text,
  `document_file` varchar(255) default NULL,
  `document_time` datetime default NULL,
  PRIMARY KEY  (`document_id`),
  KEY `teacher_id` (`teacher_id`),
  KEY `folder_id` (`folder_id`)
) TYPE=MyISAM AUTO_INCREMENT=13 ;
# --------------------------------------------------------

#
# ��ƪ�榡�G `document_folder`
#
# �إ�: Dec 05, 2003, 09:42 AM
# �̫��s: Dec 16, 2003, 04:10 PM
#

CREATE TABLE `document_folder` (
  `folder_id` int(10) unsigned NOT NULL auto_increment,
  `teacher_id` int(10) unsigned NOT NULL default '0',
  `up_folder_id` int(10) unsigned NOT NULL default '0',
  `folder_name` varchar(255) NOT NULL default '',
  `folder_explain` text,
  `folder_time` datetime default NULL,
  PRIMARY KEY  (`folder_id`),
  UNIQUE KEY `file_floder` (`folder_id`),
  KEY `teacher_id` (`teacher_id`)
) TYPE=MyISAM AUTO_INCREMENT=12 ;
# --------------------------------------------------------

#
# ��ƪ�榡�G `link_document`
#
# �إ�: Dec 05, 2003, 09:42 AM
# �̫��s: Dec 18, 2003, 08:22 AM
#

CREATE TABLE `link_document` (
  `document_id` int(10) unsigned NOT NULL auto_increment,
  `teacher_id` int(10) unsigned NOT NULL default '0',
  `folder_id` int(10) unsigned NOT NULL default '0',
  `document_title` varchar(255) NOT NULL default '',
  `document_content` text,
  `document_file` varchar(255) default NULL,
  `document_time` datetime default NULL,
  PRIMARY KEY  (`document_id`),
  KEY `teacher_id` (`teacher_id`),
  KEY `folder_id` (`folder_id`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;
# --------------------------------------------------------

#
# ��ƪ�榡�G `link_folder`
#
# �إ�: Dec 05, 2003, 09:42 AM
# �̫��s: Dec 17, 2003, 03:54 PM
#

CREATE TABLE `link_folder` (
  `folder_id` int(10) unsigned NOT NULL auto_increment,
  `teacher_id` int(10) unsigned NOT NULL default '0',
  `up_folder_id` int(10) unsigned NOT NULL default '0',
  `folder_name` varchar(255) NOT NULL default '',
  `folder_explain` text,
  `folder_time` datetime default NULL,
  PRIMARY KEY  (`folder_id`),
  UNIQUE KEY `file_floder` (`folder_id`),
  KEY `teacher_id` (`teacher_id`)
) TYPE=MyISAM AUTO_INCREMENT=9 ;
# --------------------------------------------------------

#
# ��ƪ�榡�G `message`
#
# �إ�: Dec 05, 2003, 09:42 AM
# �̫��s: Dec 22, 2003, 10:02 AM
#

CREATE TABLE `message` (
  `message_id` int(10) unsigned NOT NULL auto_increment,
  `teacher_id` int(10) unsigned NOT NULL default '0',
  `message_author` varchar(40) default NULL,
  `message_email` varchar(100) default NULL,
  `message_picture` varchar(40) default NULL,
  `message_to` varchar(40) default NULL,
  `message_content` text,
  `message_ip` varchar(20) default NULL,
  `message_time` datetime default NULL,
  `reply_author` varchar(40) default NULL,
  `reply_content` text,
  `reply_time` datetime default NULL,
  PRIMARY KEY  (`message_id`),
  UNIQUE KEY `message_id` (`message_id`),
  KEY `teacher_id` (`teacher_id`)
) TYPE=MyISAM AUTO_INCREMENT=19 ;
# --------------------------------------------------------

#
# ��ƪ�榡�G `photo_document`
#
# �إ�: Dec 18, 2003, 09:23 AM
# �̫��s: Dec 18, 2003, 02:13 PM
# �̫��ˬd: Dec 18, 2003, 09:23 AM
#

CREATE TABLE `photo_document` (
  `document_id` int(10) unsigned NOT NULL auto_increment,
  `teacher_id` int(10) unsigned NOT NULL default '0',
  `folder_id` int(10) unsigned NOT NULL default '0',
  `document_title` varchar(255) NOT NULL default '',
  `document_content` text,
  `document_file` varchar(255) default NULL,
  `document_file_flash` tinyint(3) unsigned default '0',
  `document_time` datetime default NULL,
  PRIMARY KEY  (`document_id`),
  KEY `teacher_id` (`teacher_id`),
  KEY `folder_id` (`folder_id`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;
# --------------------------------------------------------

#
# ��ƪ�榡�G `photo_folder`
#
# �إ�: Dec 05, 2003, 09:42 AM
# �̫��s: Dec 18, 2003, 02:13 PM
#

CREATE TABLE `photo_folder` (
  `folder_id` int(10) unsigned NOT NULL auto_increment,
  `teacher_id` int(10) unsigned NOT NULL default '0',
  `up_folder_id` int(10) unsigned NOT NULL default '0',
  `folder_name` varchar(255) NOT NULL default '',
  `folder_explain` text,
  `folder_time` datetime default NULL,
  PRIMARY KEY  (`folder_id`),
  UNIQUE KEY `file_floder` (`folder_id`),
  KEY `teacher_id` (`teacher_id`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;
# --------------------------------------------------------

#
# ��ƪ�榡�G `teacher`
#
# �إ�: Dec 18, 2003, 09:26 AM
# �̫��s: Dec 25, 2003, 10:13 AM
#

CREATE TABLE `teacher` (
  `teacher_id` int(10) unsigned NOT NULL auto_increment,
  `teacher_account` varchar(40) NOT NULL default '',
  `teacher_password` varchar(40) default NULL,
  `teacher_name` varchar(40) default NULL,
  `teacher_email` varchar(60) default NULL,
  `grade` tinyint(3) unsigned default '6',
  `class_number` tinyint(3) unsigned default '1',
  `homepage_theme` tinyint(3) unsigned default '0',
  `homepage_title` varchar(255) default NULL,
  `homepage_image` varchar(255) default NULL,
  `homepage_image_flash` tinyint(3) unsigned default '0',
  `homepage_describe` text,
  `homepage_counter` int(10) unsigned default '0',
  `class_password` varchar(40) default NULL,
  `manage_password` varchar(40) default NULL,
  `apply_time` datetime default NULL,
  PRIMARY KEY  (`teacher_id`),
  UNIQUE KEY `teacher_account` (`teacher_account`),
  UNIQUE KEY `teacher_id` (`teacher_id`,`teacher_account`)
) TYPE=MyISAM AUTO_INCREMENT=8 ;

