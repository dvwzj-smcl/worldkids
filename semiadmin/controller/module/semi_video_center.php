<?php
/**
 * Created by PhpStorm.
 * User: devico
 * Date: 3/14/2016
 * Time: 11:33 AM
 */

class ControllerModuleSemiVideoCenter extends Controller {
    private $error = array(); // This is used to set the errors, if any.

    public function index() {   // Default function

        // Loading the language file of semi_footer
        $this->load->language('module/semi_video_center');

        // Set the title of the page to the heading title in the Language file i.e., Hello World
        $this->document->setTitle(preg_replace('/<b>(.*?)<\/b>/', '$1',$this->language->get('heading_title')));

        $this->document->addStyle('view/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->document->addScript('view/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->document->addScript('view/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');

        // Load the Setting Model  (All of the OpenCart Module & General Settings are saved using this Model )
        $this->load->model('setting/setting');

        // Start If: Validates and check if data is coming by save (POST) method
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            // Parse all the coming data to Setting Model to save it in database.
            /*
            if(isset($this->request->post['mode']) && $this->request->post['mode']=='remove'){
                $module = $this->config->get('semi_video_center_module');
                //echo "before<pre>";
                //print_r($module);
                //echo "</pre>";
                $links = $module[0]['links'];
                unset($links[$this->request->post['index']]);
                $links = array_values($links);
                $module[0]['links'] = $links;
                //echo "after<pre>";
                //print_r($module);
                //echo "</pre>";
                //die();
                $this->model_setting_setting->editSetting('semi_video_center', array('semi_video_center_module'=>$module));
            }else{
                //echo "<pre>";
                //print_r($this->request->post);
                //echo "</pre>";
                //die();
                $this->model_setting_setting->editSetting('semi_video_center', $this->request->post);
            }
            */
            $post = $this->request->post;
            $module = $this->config->get('semi_video_center_module');
            if(isset($this->request->get['mode']) && $this->request->get['mode']=='edit_module'){
                $links = isset($module[0]['links']) ? $module[0]['links'] : array();
                $post['links'] = $links;
                $module[0] = $post;
                $this->model_setting_setting->editSetting('semi_video_center', array('semi_video_center_module'=>$module));
            }else if(isset($this->request->get['mode']) && $this->request->get['mode']=='add_row'){
                if(!isset($module[0])) {
                    $module[0] = array(
                        'position' => 'content_top',
                        'layout_id' => 99999,
                        'links' => array(),
                        'sort_order' => null,
                        'column_class' => 'col-md-4',
                        'show_item' => 4,
                        'status' => 1
                    );
                }
                $uniqid = uniqid();
                $module[0]['links'][$uniqid] = array(
                    'uniqid'=> $uniqid,
                    'link_video' => $post['link_video'],
                    'status' => $post['status'],
                    'sort_order' => $post['sort_order']
                );
                uasort($module[0]['links'], 'compare_sort_order');
                /*
                echo "<pre>";
                print_r($module);
                echo "</pre>";
                die();
                */
                $this->model_setting_setting->editSetting('semi_video_center', array('semi_video_center_module'=>$module));
            }else if(isset($this->request->get['mode']) && $this->request->get['mode']=='edit_row'){
                $uniqid = $post['uniqid'];
                if(isset($module[0]['links'][$uniqid])) {
                    $module[0]['links'][$uniqid] = $post;
                }
                uasort($module[0]['links'], 'compare_sort_order');
                $this->model_setting_setting->editSetting('semi_video_center', array('semi_video_center_module'=>$module));
            }else if(isset($this->request->get['mode']) && $this->request->get['mode']=='remove_row'){
                $uniqid = $post['uniqid'];
                if(isset($module[0]['links'][$uniqid])){
                    unset($module[0]['links'][$uniqid]);
                }
                uasort($module[0]['links'], 'compare_sort_order');
                $this->model_setting_setting->editSetting('semi_video_center', array('semi_video_center_module'=>$module));
            }

            // To display the success text on data save
            $this->session->data['success'] = $this->language->get('text_success');

            // Redirect to the Module Listing
            $this->response->redirect($this->url->link('module/semi_video_center', 'token=' . $this->session->data['token'], 'SSL'));
        }

        /*Assign the language data for parsing it to view*/
        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_edit'] = $this->language->get('text_edit');

        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_link_download'] = $this->language->get('entry_link_download');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $data['entry_column_class'] = $this->language->get('entry_column_class');
        $data['entry_show_item'] = $this->language->get('entry_show_item');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        /*This Block returns the warning if any*/
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        /*End Block*/

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        /* Making of Breadcrumbs to be displayed on site*/
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_module'),
            'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('module/semi_video_center', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        /* End Breadcrumb Block*/

        $data['action'] = $this->url->link('module/semi_video_center', 'token=' . $this->session->data['token'], 'SSL'); // URL to be directed when the save button is pressed
        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'); // URL to be redirected when cancel button is pressed

        $data['module'] = array();

        /* This block parses the Module Settings to the view*/
        if (isset($this->request->post['semi_video_center_module'])) {
            $data['module'] = $this->request->post['semi_video_center_module'];
        } elseif ($this->config->get('semi_video_center_module')) {
            $data['module'] = $this->config->get('semi_video_center_module');
        }

        if(!isset($data['module'][0])){
            $data['module'][0] = array(
                'position' => 'content_top',
                'layout_id' => 99999,
                'links' => array(),
                'sort_order' => null,
                'column_class' => 'col-md-4',
                'show_item' => 4,
                'status' => 1
            );
        }
        //$data['file_count'] = count($data['module']);

        // Layouts
        $this->load->model('design/layout');
        $data['layouts'] = $this->model_design_layout->getLayouts();

        // Multistore
        $data['stores'] = array();
        $this->load->model('setting/store');
        $results = $this->model_setting_store->getStores();

        $data['stores'][] = array(
            'name' => 'Default',
            'href' => '',
            'store_id' => 0
        );

        foreach ($results as $result) {
            $data['stores'][] = array(
                'name' => $result['name'],
                'href' => $result['url'],
                'store_id' => $result['store_id']
            );
        }

        // Languages
        $this->load->model('localisation/language');
        $data['languages'] = $this->model_localisation_language->getLanguages();

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        if(isset($this->request->get['mode']) && $this->request->get['mode']=='edit_module'){
            $this->response->setOutput($this->load->view('module/semi_video_center/edit_module.tpl', $data));
        }else if(isset($this->request->get['mode']) && $this->request->get['mode']=='add_row'){
            $this->response->setOutput($this->load->view('module/semi_video_center/add_row.tpl', $data));
        }else if(isset($this->request->get['mode']) && $this->request->get['mode']=='edit_row'){
            $data['link'] = $data['module'][0]['links'][$this->request->get['uniqid']];
            $this->response->setOutput($this->load->view('module/semi_video_center/edit_row.tpl', $data));
        }else{
            $data['links'] = array();
            foreach($data['module'][0]['links'] as $link){
                $data['links'][] = $link;
            }
            $this->response->setOutput($this->load->view('module/semi_video_center/index.tpl', $data));
        }
    }

    /* Function that validates the data when Save Button is pressed */
    protected function validate() {

        /* Block to check the user permission to manipulate the module*/
        if (!$this->user->hasPermission('modify', 'module/semi_video_center')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        /* End Block*/

        // /* Block to check if the company name is properly set to save into database, otherwise the error is returned*/
        // if (!$this->request->post['company_name']) {
        //    $this->error['company_name'] = $this->language->get('error_code');
        // }
        // /* End Block*/
        // /* Block to check if the address is properly set to save into database, otherwise the error is returned*/
        // if (!$this->request->post['address']) {
        //    $this->error['address'] = $this->language->get('error_code');
        // }
        // /* End Block*/

        /*Block returns true if no error is found, else false if any error detected*/
        if (!$this->error) {
            return true;
        } else {
            return false;
        }
        /* End Block*/
    }
    /* End Validation Function*/
}

function compare_sort_order($a, $b){
    return strnatcmp($a['sort_order'], $b['sort_order']);
}