<?php

/**
 * @Project NUKEVIET 4.x
 * @Author DACLOI.,JSC <saka.dacloi@gmail.com>
 * @Copyright (C) 2023 DACLOI.,JSC. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Tue, 21 Mar 2023 00:28:57 GMT
 */

if (!defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');

$page_title = $lang_module['main'];
$array = [];
$sql = 'SELECT * FROM '. NV_PREFIXLANG . '_' . $module_data . ' ORDER BY weight ASC';

$result = $db->query($sql)->fetchAll();
$num = sizeof($result);

if($num < 1) {
    nv_redirect_location(NV_BASE_ADMINURL. 'index.php?'.NV_LANG_VARIABLE . '='.NV_LANG_DATA. '&'.NV_NAME_VARIABLE.'='.$module_name. '&'.NV_OP_VARIABLE.'=content');
}

$array_status = [
    $lang_module['inactive'],
    $lang_module['active']
];

$xtpl = new XTemplate('main.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('GLANG', $lang_global);
$xtpl->assign('MODULE_NAME', $module_name);

foreach($result as $row){

    $row['url_edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=content&amp;id=' . $row['id'];
    $row['checkss'] = md5($row['id'] . NV_CHECK_SESSION);

    for ($i = 1; $i <= $num; ++$i) {
        $xtpl->assign('WEIGHT', [
            'w' => $i,
            'selected' => ($i == $row['weight']) ? ' selected="selected"' : ''
        ]);

        $xtpl->parse('main.row.weight');
    }

    foreach ($array_status as $key => $val) {
        $xtpl->assign('STATUS', [
            'key' => $key,
            'val' => $val,
            'selected' => ($key == $row['status']) ? ' selected="selected"' : ''
        ]);

        $xtpl->parse('main.row.status');
    }
    
    $row['edit_time'] = nv_date('H:i d/m/y', $row['edit_time']);
    $row['add_time'] = nv_date('H:i d/m/y', $row['add_time']);

    $xtpl->assign('ROW', $row);
    $xtpl->parse('main.row');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
