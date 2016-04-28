<?php
/**
 * Created by PhpStorm.
 * User: devico
 * Date: 3/14/2016
 * Time: 11:33 AM
 */

class ControllerModuleSemiDownloadOrder extends Controller {
    private $error = array(); // This is used to set the errors, if any.

    public function index() {   // Default function

        // Loading the language file of semi_footer
        $this->load->language('module/semi_download_order');

        // Set the title of the page to the heading title in the Language file i.e., Hello World
        $this->document->setTitle(preg_replace('/<b>(.*?)<\/b>/', '$1',$this->language->get('heading_title')));

        //$this->document->addStyle('view/bower_components/semantic/dist/semantic.min.css');
        //$this->document->addScript('view/bower_components/semantic/dist/semantic.min.js');

        // Load the Setting Model  (All of the OpenCart Module & General Settings are saved using this Model )
        $this->load->model('setting/setting');

        // Start If: Validates and check if data is coming by save (POST) method
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            // Parse all the coming data to Setting Model to save it in database.
            if(isset($this->request->post['mode']) && $this->request->post['mode']=='remove'){
                $module = $this->config->get('semi_download_order_module');
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
                $this->model_setting_setting->editSetting('semi_download_order', array('semi_download_order_module'=>$module));
            }else{
                //echo "<pre>";
                //print_r($this->request->post);
                //echo "</pre>";
                //die();
                $this->model_setting_setting->editSetting('semi_download_order', $this->request->post);
            }

            // To display the success text on data save
            $this->session->data['success'] = $this->language->get('text_success');

            // Redirect to the Module Listing
            $this->response->redirect($this->url->link('module/semi_download_order', 'token=' . $this->session->data['token'], 'SSL'));
        }

        /*Assign the language data for parsing it to view*/
        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_edit'] = $this->language->get('text_edit');

        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_thumbnail_image'] = $this->language->get('entry_thumbnail_image');
        $data['entry_link_download'] = $this->language->get('entry_link_download');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');

        $this->load->model('tool/image');
        $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

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

        /*This Block returns the error code if any*/
        if (isset($this->error['thumbnail_image'])) {
            //$data['thumbnail_image'] = $this->error['thumbnail_image'];
        } else {
            //$data['thumbnail_image'] = '';
        }
        /*End Block*/
        /*This Block returns the error code if any*/
        if (isset($this->error['file'])) {
            //$data['file'] = $this->error['file'];
        } else {
            //$data['file'] = '';
        }
        /*End Block*/


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
            'href'      => $this->url->link('module/semi_download_order', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        /* End Breadcrumb Block*/

        $data['action'] = $this->url->link('module/semi_download_order', 'token=' . $this->session->data['token'], 'SSL'); // URL to be directed when the save button is pressed

        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'); // URL to be redirected when cancel button is pressed

        /* This block checks, if the company name is set it parses it to view otherwise get the default company name from the database and parse it*/
        if (isset($this->request->post['thumbnail_image'])) {
            //$data['thumbnail_image'] = $this->request->post['thumbnail_image'];
        } else {
            //$data['thumbnail_image'] = $this->config->get('thumbnail_image');
        }
        /* End Block*/
        /* This block checks, if the company name is set it parses it to view otherwise get the default company name from the database and parse it*/
        if (isset($this->request->post['file'])) {
            //$data['file'] = $this->request->post['file'];
        } else {
            //$data['file'] = $this->config->get('file');
        }
        /* End Block*/

        $data['module'] = array();

        /* This block parses the Module Settings to the view*/
        if (isset($this->request->post['semi_download_order_module'])) {
            $data['module'] = $this->request->post['semi_download_order_module'];
        } elseif ($this->config->get('semi_download_order_module')) {
            $data['module'] = $this->config->get('semi_download_order_module');
        }

        if(!isset($data['module'][0])){
            $data['module'][0] = array('position'=>'content_top','layout_id'=>17,'links'=>array(),'sort_order'=>null,'status'=>1);
        }
        //$data['file_count'] = count($data['module']);

        // Layouts
        $this->load->model('design/layout');
        $data['layouts'] = $this->model_design_layout->getLayouts();

        // Languages
        $this->load->model('localisation/language');
        $data['languages'] = $this->model_localisation_language->getLanguages();

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('module/semi_download_order.tpl', $data));
    }

    /* Function that validates the data when Save Button is pressed */
    protected function validate() {

        /* Block to check the user permission to manipulate the module*/
        if (!$this->user->hasPermission('modify', 'module/semi_download_order')) {
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