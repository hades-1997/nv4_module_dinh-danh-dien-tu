<?php

/**
 * NukeViet Content Management System
 * @version 4.x
 * @author VINADES.,JSC <contact@vinades.vn>
 * @copyright (C) 2009-2023 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://github.com/nukeviet The NukeViet CMS GitHub project
 */

if (!defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');

$id = $nv_Request->get_int('id', 'post,get', 0);
$copy = $nv_Request->get_int('copy', 'get,post', 0);

if ($id) {
    $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id;
    $row = $db->query($sql)->fetch();

    if (empty($row)) {
        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name);
    }

    $page_title = $lang_module['edit'];
    $action = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;id=' . $id;
} else {
    $page_title = $lang_module['add'];
    $action = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
}

if ($nv_Request->get_int('save', 'post') == '1') {
    $row['donvi'] = $nv_Request->get_title('donvi', 'post', '');
    $row['dulieu_1'] = $nv_Request->get_title('dulieu_1', 'post', '');
    $row['dulieu_2'] = $nv_Request->get_title('dulieu_2', 'post', '');
    $row['dulieu_3'] = $nv_Request->get_title('dulieu_3', 'post', '');
    $row['dulieu_4'] = $nv_Request->get_title('dulieu_4', 'post', '');
    $row['dulieu_5'] = $nv_Request->get_title('dulieu_5', 'post', '');
    $row['dulieu_6'] = $nv_Request->get_title('dulieu_6', 'post', '');
    
   
    if ($row['donvi'] == '' && $row['dulieu_1'] == '' && $row['dulieu_2'] == ''&& $row['dulieu_3'] == ''&& $row['dulieu_4'] == ''&& $row['dulieu_5'] == ''&& $row['dulieu_6'] == '') {
        $error = $lang_module['empty_donvi'];
    }else {
        
        if ($id) {
            $_sql ='UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET donvi = :donvi, dulieu_1 = :dulieu_1, dulieu_2 = :dulieu_2, dulieu_3 = :dulieu_3, dulieu_4 = :dulieu_4, dulieu_5 = :dulieu_5, dulieu_6 = :dulieu_6,  edit_time = ' . NV_CURRENTTIME . ' WHERE id=' . $id;
        } else {
            if ($page_config['news_first']) {
                $weight = 1;
            } else {
                $weight = $db->query('SELECT MAX(weight) FROM ' . NV_PREFIXLANG . '_' . $module_data)->fetchColumn();
                $weight = (int) $weight + 1;
            }

            $_sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . ' (
                donvi, dulieu_1, dulieu_2, dulieu_3, dulieu_4, dulieu_5, dulieu_6, weight,admin_id, add_time, edit_time, status
            ) VALUES (
                :donvi, :dulieu_1, :dulieu_2, :dulieu_3, :dulieu_4, :dulieu_5, :dulieu_6, ' . $weight . ',' . $admin_info['admin_id'] . ', ' . NV_CURRENTTIME . ', ' . NV_CURRENTTIME . ', 1
            )';
        }

        
        try {
            $sth = $db->prepare($_sql);
            $sth->bindParam(':donvi', $row['donvi'], PDO::PARAM_STR);
            $sth->bindParam(':dulieu_1', $row['dulieu_1'], PDO::PARAM_STR);
            $sth->bindParam(':dulieu_2', $row['dulieu_2'], PDO::PARAM_STR);
            $sth->bindParam(':dulieu_3', $row['dulieu_3'], PDO::PARAM_INT);
            $sth->bindParam(':dulieu_4', $row['dulieu_4'], PDO::PARAM_STR);
            $sth->bindParam(':dulieu_5', $row['dulieu_5'], PDO::PARAM_STR);
            $sth->bindParam(':dulieu_6', $row['dulieu_6'], PDO::PARAM_STR);
            $sth->execute();

            if ($sth->rowCount()) {
                if ($id and !$copy) {
                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Edit', 'ID: ' . $id, $admin_info['userid']);
                } else {
                    if ($page_config['news_first']) {
                        $id = $db->lastInsertId();
                        $db->query('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET weight=weight+1 WHERE id!=' . $id);
                    }

                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Add', ' ', $admin_info['userid']);
                }

                $nv_Cache->delMod($module_name);
                nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name);
            } else {
                $error = $lang_module['errorsave'];
            }
        } catch (PDOException $e) {
            trigger_error(print_r($e, true));
            $error = $lang_module['errorsave'];
        }
    }

} elseif (empty($id)) {
    $row['donvi'] = '';
    $row['dulieu_1'] = '';
    $row['dulieu_2'] = '';
    $row['dulieu_3'] = '';
    $row['dulieu_4'] = '';
    $row['dulieu_5'] = '';
    $row['dulieu_6'] = '';
}


$xtpl = new XTemplate('content.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('GLANG', $lang_global);
$xtpl->assign('FORM_ACTION', $action);
$xtpl->assign('UPLOADS_DIR_USER', NV_UPLOADS_DIR . '/' . $module_upload);
$xtpl->assign('ISCOPY', $copy);
$xtpl->assign('ROW', $row);


$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $lang_module['content'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
