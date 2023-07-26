<?php

/**
 * NukeViet Content Management System
 * @version 4.x
 * @author VINADES.,JSC <contact@vinades.vn>
 * @copyright (C) 2009-2021 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://github.com/nukeviet The NukeViet CMS GitHub project
 */

 if (!defined('NV_MAINFILE')) {
    exit('Stop!!!');
}

$page_title = $lang_module['import'];
$array = array();
$save = $nv_Request->get_title('save', 'post,get', 0);

$base_url= NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=import';
$xtpl = new XTemplate('import.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('GLANG', $lang_global);
$xtpl->assign('FORM_ACTION', $base_url);
$xtpl->assign('link_file', NV_BASE_SITEURL . 'modules/'. $module_file.'/danhsachmau.xlsx');



if($save > 0)
{
    require_once(NV_ROOTDIR . '/modules/'. $module_file .'\vendor\autoload.php');
    $filename = NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload . '/';
    if  (!file_exists($filename)) {
        mkdir(NV_UPLOADS_DIR . '/' . $module_upload .  '/', 0777);
    } 
    if (file_exists($filename . '/' . $_FILES["file"]["name"]))
        unlink($filename .'/'. $_FILES["file"]["name"]);
    move_uploaded_file($_FILES["file"]["tmp_name"],$filename .'/'. $_FILES["file"]["name"]); 
    $file = $filename. $_FILES["file"]["name"]; // file du  
    /**  Identify the type of $inputFileName  **/
    $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file);
    /**  Create a new Reader of the type that has been identified  **/
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
    /**  Load $inputFileName to a Spreadsheet Object  **/
    $spreadsheet = $reader->load($file);
    /**  Convert Spreadsheet Object to an Array for ease of use  **/
    $schdeules = $spreadsheet->getActiveSheet()->toArray();

    $row['donvi'] = '';
    $row['dulieu_1'] = '';
    $row['dulieu_2'] = '';
    $row['dulieu_3'] = '';
    $row['dulieu_4'] = '';
    $row['dulieu_5'] = '';
    $row['dulieu_6'] = '';
    
    foreach( $schdeules as $key => $single_schedule )
    {               
        if($key > 0) {
            
            foreach( $single_schedule as $key => $row )
            {
                $row['donvi'] = $single_schedule[0];
                $row['dulieu_1'] = $single_schedule[1];
                $row['dulieu_2'] = $single_schedule[2];
                $row['dulieu_3'] = $single_schedule[3];
                $row['dulieu_4'] = $single_schedule[4];
                $row['dulieu_5'] = $single_schedule[5];
                $row['dulieu_6'] = $single_schedule[6];
            }
            
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
            
            try {
                $sth = $db->prepare($_sql);
                $sth->bindParam(':donvi', $single_schedule[0], PDO::PARAM_STR);
                $sth->bindParam(':dulieu_1', $single_schedule[1], PDO::PARAM_STR);
                $sth->bindParam(':dulieu_2', $single_schedule[2], PDO::PARAM_STR);
                $sth->bindParam(':dulieu_3', $single_schedule[3], PDO::PARAM_INT);
                $sth->bindParam(':dulieu_4', $single_schedule[4], PDO::PARAM_STR);
                $sth->bindParam(':dulieu_5', $single_schedule[5], PDO::PARAM_STR);
                $sth->bindParam(':dulieu_6', $single_schedule[6], PDO::PARAM_STR);
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
                    
                } else {
                    $error = $lang_module['errorsave'];
                }
            } catch (PDOException $e) {
                trigger_error(print_r($e, true));
                $error = $lang_module['errorsave'];
            }
        }
        
    }
    nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name);
   
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
