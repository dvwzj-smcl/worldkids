<?php
/**
 * Created by PhpStorm.
 * User: devico
 * Date: 3/14/2016
 * Time: 4:08 PM
 */

class ControllerModuleSemiFooter extends Controller {
    public function index($setting) {
        $this->load->language('module/semi_footer'); // loads the language file of semicontact

        //$data['heading_title'] = $this->language->get('heading_title'); // set the heading_title of the module

        //$data['helloworld_value'] = html_entity_decode($this->config->get('helloworld_text_field')); // gets the saved value of helloworld text field and parses it to a variable to use this inside our module view

        if(isset($setting['company_name'][$this->config->get('config_language_id')])) {
            $data['company_name'] = html_entity_decode($setting['company_name'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
        } else {
            $data['company_name'] = 'You must set company name in the module Contact Information!';
        }
        if(isset($setting['address'][$this->config->get('config_language_id')])) {
            $data['address'] = html_entity_decode($setting['address'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
        } else {
            $data['address'] = 'You must set address in the module Contact Information!';
        }
        if(isset($setting['operation_time'][$this->config->get('config_language_id')])) {
            $data['operation_time'] = html_entity_decode($setting['operation_time'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
        } else {
            $data['operation_time'] = 'You must set operation time in the module Contact Information!';
        }
        if(isset($setting['email_title'][$this->config->get('config_language_id')])) {
            $data['email_title'] = html_entity_decode($setting['email_title'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
        } else {
            $data['email_title'] = 'You must set email title in the module Contact Information!';
        }
        if(isset($setting['copyright'][$this->config->get('config_language_id')])) {
            $data['copyright'] = html_entity_decode($setting['copyright'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
        } else {
            $data['copyright'] = 'You must set copyright in the module Contact Information!';
        }

        $data['logo_image'] = html_entity_decode($setting['logo_image']);
        $data['email'] = html_entity_decode($setting['email']);
        $data['line'] = html_entity_decode($setting['line']);
        $data['facebook'] = html_entity_decode($setting['facebook']);
        $data['instagram'] = html_entity_decode($setting['instagram']);
        $data['youtube'] = html_entity_decode($setting['youtube']);
        $data['phone1'] = html_entity_decode($setting['phone1']);
        $data['phone2'] = html_entity_decode($setting['phone2']);
        $data['fax'] = html_entity_decode($setting['fax']);
        $data['contact_button'] = isset($setting['contact_button'])?true:false;


        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/semi_footer.tpl')) {
            return $this->load->view($this->config->get('config_template') . '/template/module/semi_footer.tpl', $data);
        } else {
            return $this->load->view('default/template/module/semi_footer.tpl', $data);
        }
    }
}