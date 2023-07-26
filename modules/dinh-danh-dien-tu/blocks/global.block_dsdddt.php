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

if (!nv_function_exists('nv_news_block_dsdddt')) {
    /**
     * nv_block_config_dddt()
     *
     * @param string $module
     * @param array  $data_block
     * @param array  $lang_block
     * @return string
     */
    function nv_block_config_dddt($module, $data_block, $lang_block)
    {

        $html = '<div class="form-group">';
        $html .= '	<label class="control-label col-sm-6">' . $lang_block['numrow'] . ':</label>';
        $html .= '	<div class="col-sm-18"><input type="text" name="config_numrow" class="form-control" value="' . $data_block['numrow'] . '"/></div>';
        $html .= '</div>';
        $html = '<div class="form-group">';
        $html .= '	<label class="control-label col-sm-6">Dữ liệu ngày:</label>';
        $html .= '	<div class="col-sm-18"><input type="date" name="config_dl_date" class="form-control" value="' . $data_block['dl_date'] . '"/></div>';
        $html .= '</div>';
        return $html;
    }

    /**
     * nv_block_config_dddt_submit()
     *
     * @param string $module
     * @param array  $lang_block
     * @return array
     */
    function nv_block_config_dddt_submit($module, $lang_block)
    {
        global $nv_Request;
        $return = [];
        $return['error'] = [];
        $return['config'] = [];
        $return['config']['numrow'] = $nv_Request->get_int('config_numrow', 'post', 0);
        $return['config']['dl_date'] = $nv_Request->get_string('config_dl_date', 'post', '');
        return $return;
    }

    /**
     * nv_news_block_dsdddt()
     *
     * @param array  $block_config
     * @param string $mod_data
     * @return string
     */
    function nv_news_block_dsdddt($block_config)
    {
        global $nv_Cache, $module_info, $db_slave, $module_config, $global_config, $site_mods;

        $module = $block_config['module'];
        $numrow = (isset($block_config['numrow'])) ? $block_config['numrow'] : 20;
       
        //var_dump($block_config);die;
        $db_slave->sqlreset()
            ->select('donvi, dulieu_1, dulieu_2, dulieu_3, dulieu_4, dulieu_5, dulieu_6, weight')
            ->from(NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] )
            ->where('status= 1')
            ->order('weight ASC')
            ->limit($numrow);
        $result = $db_slave->query($db_slave->sql());
		//var_dump($result);die;
        $array_block_dsdddt = [];
        while (list( $donvi, $dulieu_1, $dulieu_2, $dulieu_3, $dulieu_4, $dulieu_5, $dulieu_6, $weight) = $result->fetch(3)) {
            $array_block_dsdddt[] = [
                'donvi' => $donvi,
                'dulieu_1' => $dulieu_1,
                'dulieu_2' => $dulieu_2,
                'dulieu_3' => $dulieu_3,
                'dulieu_4' => $dulieu_4,
                'dulieu_5' => $dulieu_5,
                'dulieu_6' => $dulieu_6,
				'weight' => $weight
                
            ];
        }

        if (file_exists(NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/dinh-danh-dien-tu/block_dsdddt.tpl')) {
            $block_theme = $module_info['template'];
        } else {
            $block_theme = 'default';
        }
        $xtpl = new XTemplate('block_dsdddt.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/dinh-danh-dien-tu');
        $xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);
        $xtpl->assign('TEMPLATE', $block_theme);
        $xtpl->assign('KETQUA_NGAY', $block_config['dl_date']);

        foreach ($array_block_dsdddt as $array_dsdddt) {
			
            $array_dsdddt['dulieu_5'] = intval($array_dsdddt['dulieu_5']);
            $array_dsdddt['dulieu_5'] = ($array_dsdddt['dulieu_5'] / 100);
            $xtpl->assign('CONTENT', $array_dsdddt);

            $xtpl->parse('main.loop');
        }

        $xtpl->parse('main');
        return $xtpl->text('main');
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_news_block_dsdddt($block_config);
}
