ALTER TABLE `teacher` ADD `teacher_email` VARCHAR( 60 ) AFTER `teacher_name` ;
ALTER TABLE `teacher` ADD `homepage_image_flash` TINYINT( 3 ) UNSIGNED DEFAULT '0' AFTER `homepage_image` ;
ALTER TABLE `photo_document` ADD `document_file_flash` TINYINT( 3 ) UNSIGNED DEFAULT '0' AFTER `document_file` ;

