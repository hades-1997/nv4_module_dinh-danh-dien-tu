<?php

/**
 * NukeViet Content Management System
 * @version 4.x
 * @author VINADES.,JSC <contact@vinades.vn>
 * @copyright (C) 2009-2021 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://github.com/nukeviet The NukeViet CMS GitHub project
 */

if (!defined('NV_IS_FILE_MODULES')) {
    exit('Stop!!!');
}

$sql_drop_module = [];

$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . ';';

$sql_create_module = $sql_drop_module;

$sql_create_module[] = 'CREATE TABLE ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . " (
    id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
    donvi varchar(250) NOT NULL,
    dulieu_1 varchar(250) NOT NULL,
    dulieu_2 varchar(250) NOT NULL,
    dulieu_3 varchar(250) NOT NULL,
    dulieu_4 varchar(250) NOT NULL,
    dulieu_5 varchar(250) NOT NULL,
    dulieu_6 varchar(250) NOT NULL,
    weight smallint(4) NOT NULL DEFAULT '0',
    admin_id mediumint(8) unsigned NOT NULL DEFAULT '0',
    add_time int(11) NOT NULL DEFAULT '0',
    edit_time int(11) NOT NULL DEFAULT '0',
    status tinyint(1) unsigned NOT NULL DEFAULT '0',
    PRIMARY KEY (id)
   ) ENGINE=MyISAM";
   