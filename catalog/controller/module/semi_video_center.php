<?php
/**
 * Created by PhpStorm.
 * User: devico
 * Date: 3/14/2016
 * Time: 4:08 PM
 */

class ControllerModuleSemiVideoCenter extends Controller {
    public function index($setting) {
        $this->load->language('module/semi_video_center'); // loads the language file of semicontact

        //$data['thumbnail_image'] = html_entity_decode($setting['thumbnail_image']);
        //$data['link_download'] = html_entity_decode($setting['link_download']);
        $data['column_class'] = $setting['column_class'];

        $chunks = array_chunk($setting['links'], $setting['show_item']);
        $data['links'] = $chunks[0];

        //print_r($setting);

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/semi_video_center.tpl')) {
            return $this->load->view($this->config->get('config_template') . '/template/module/semi_video_center.tpl', $data);
        } else {
            return $this->load->view('default/template/module/semi_video_center.tpl', $data);
        }
    }
}