<?php

/**
 * NukeViet Content Management System
 * @version 4.x
 * @author VINADES.,JSC <contact@vinades.vn>
 * @copyright (C) 2009-2021 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://github.com/nukeviet The NukeViet CMS GitHub project
 */

if (!defined('NV_ADMIN')) {
    exit('Stop!!!');
}

/**
 * Note:
 * 	- Module var is: $lang, $module_file, $module_data, $module_upload, $module_theme, $module_name
 * 	- Accept global var: $db, $db_config, $global_config
 */

$sth = $db->prepare('INSERT INTO ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . " (id, donvi, dulieu_1, dulieu_2, dulieu_3, dulieu_4, dulieu_5, dulieu_6, weight, admin_id, add_time, edit_time, status) VALUES (1, 'CAH Thanh Liêm', '2463', '29707', '32170', '108443', '297', '76273', 1, 1, " . NV_CURRENTTIME . ', ' . NV_CURRENTTIME . ', 1)');
$sth->execute();
$sth = $db->prepare('INSERT INTO ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . " (id, donvi, dulieu_1, dulieu_2, dulieu_3, dulieu_4, dulieu_5, dulieu_6, weight, admin_id, add_time, edit_time, status) VALUES (2, 'CAH Kim Bảng', '1677', '23624', '25301', '11669', '227', '86368', 1, 1, " . NV_CURRENTTIME . ', ' . NV_CURRENTTIME . ', 1)');
$sth->execute();
$sth = $db->prepare('INSERT INTO ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . " (id, donvi, dulieu_1, dulieu_2, dulieu_3, dulieu_4, dulieu_5, dulieu_6, weight, admin_id, add_time, edit_time, status) VALUES (3, 'CATP Phủ Lý', '5504', '23885', '29389', '130726', '225', '101337', 1, 1, " . NV_CURRENTTIME . ', ' . NV_CURRENTTIME . ', 1)');
$sth->execute();
$sth = $db->prepare('INSERT INTO ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . " (id, donvi, dulieu_1, dulieu_2, dulieu_3, dulieu_4, dulieu_5, dulieu_6, weight, admin_id, add_time, edit_time, status) VALUES (4, 'CATX Duy Tiên', '1881', '21308', '23189', '111283', '208', '88094', 1, 1, " . NV_CURRENTTIME . ', ' . NV_CURRENTTIME . ', 1)');
$sth->execute();
$sth = $db->prepare('INSERT INTO ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . " (id, donvi, dulieu_1, dulieu_2, dulieu_3, dulieu_4, dulieu_5, dulieu_6, weight, admin_id, add_time, edit_time, status) VALUES (5, 'CAH Bình Lục', '4790', '21732', '26522', '129087', '205', '102565', 1, 1, " . NV_CURRENTTIME . ', ' . NV_CURRENTTIME . ', 1)');
$sth->execute();
$sth = $db->prepare('INSERT INTO ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . " (id, donvi, dulieu_1, dulieu_2, dulieu_3, dulieu_4, dulieu_5, dulieu_6, weight, admin_id, add_time, edit_time, status) VALUES (6, 'CAH Lý Nhân', '2861', '30750', '33611', '172331', '195', '138720', 1, 1, " . NV_CURRENTTIME . ', ' . NV_CURRENTTIME . ', 1)');
$sth->execute();
$sth = $db->prepare('INSERT INTO ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . " (id, donvi, dulieu_1, dulieu_2, dulieu_3, dulieu_4, dulieu_5, dulieu_6, weight, admin_id, add_time, edit_time, status) VALUES (7, 'Tổng cộng', '19176', '151006', '170182', '763539', '223', '593357', 1, 1, " . NV_CURRENTTIME . ', ' . NV_CURRENTTIME . ', 1)');
$sth->execute();


