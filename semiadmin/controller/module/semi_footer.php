<?php
/**
 * Created by PhpStorm.
 * User: devico
 * Date: 3/14/2016
 * Time: 11:33 AM
 */

class ControllerModuleSemiFooter extends Controller {
    private $error = array(); // This is used to set the errors, if any.

    public function index() {   // Default function

        // Loading the language file of semi_footer
        $this->load->language('module/semi_footer');

        // Set the title of the page to the heading title in the Language file i.e., Hello World
        $this->document->setTitle(preg_replace('/<b>(.*?)<\/b>/', '$1',$this->language->get('heading_title')));

        $this->document->addStyle('view/stylesheet/blog_latest.css');

        // Load the Setting Model  (All of the OpenCart Module & General Settings are saved using this Model )
        $this->load->model('setting/setting');

        // Start If: Validates and check if data is coming by save (POST) method
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            // Parse all the coming data to Setting Model to save it in database.
            $this->model_setting_setting->editSetting('semi_footer', $this->request->post);

            // To display the success text on data save
            $this->session->data['success'] = $this->language->get('text_success');

            // Redirect to the Module Listing
            $this->response->redirect($this->url->link('module/semi_footer', 'token=' . $this->session->data['token'], 'SSL'));
        }

        /*Assign the language data for parsing it to view*/
        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_edit'] = $this->language->get('text_edit');

        $data['entry_company_name'] = $this->language->get('entry_company_name');
        $data['entry_address'] = $this->language->get('entry_address');
        $data['entry_logo_image'] = $this->language->get('entry_logo_image');
        $data['entry_email'] = $this->language->get('entry_email');
        $data['entry_operation_time'] = $this->language->get('entry_operation_time');
        $data['entry_phone1'] = $this->language->get('entry_phone1');
        $data['entry_phone2'] = $this->language->get('entry_phone2');
        $data['entry_fax'] = $this->language->get('entry_fax');
        $data['entry_facebook'] = $this->language->get('entry_facebook');
        $data['entry_line'] = $this->language->get('entry_line');
        $data['entry_instagram'] = $this->language->get('entry_instagram');
        $data['entry_youtube'] = $this->language->get('entry_youtube');
        $data['entry_contact_button'] = $this->language->get('entry_contact_button');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_email_title'] = $this->language->get('entry_email_title');
        $data['entry_copyright'] = $this->language->get('entry_copyright');

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
        if (isset($this->error['company_name'])) {
            $data['error_company_name'] = $this->error['company_name'];
        } else {
            $data['error_company_name'] = '';
        }
        /*End Block*/
        /*This Block returns the error code if any*/
        if (isset($this->error['address'])) {
            $data['error_address'] = $this->error['address'];
        } else {
            $data['error_address'] = '';
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
            'href'      => $this->url->link('module/semi_footer', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        /* End Breadcrumb Block*/

        $data['action'] = $this->url->link('module/semi_footer', 'token=' . $this->session->data['token'], 'SSL'); // URL to be directed when the save button is pressed

        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'); // URL to be redirected when cancel button is pressed

        /* This block checks, if the company name is set it parses it to view otherwise get the default company name from the database and parse it*/
        if (isset($this->request->post['company_name'])) {
            $data['company_name'] = $this->request->post['company_name'];
        } else {
            $data['company_name'] = $this->config->get('company_name');
        }
        /* End Block*/
        /* This block checks, if the address is set it parses it to view otherwise get the default address from the database and parse it*/
        if (isset($this->request->post['address'])) {
            $data['address'] = $this->request->post['address'];
        } else {
            $data['address'] = $this->config->get('address');
        }
        /* End Block*/
        /* This block checks, if the email is set it parses it to view otherwise get the default email from the database and parse it*/
        if (isset($this->request->post['email'])) {
            $data['email'] = $this->request->post['email'];
        } else {
            $data['email'] = $this->config->get('email');
        }
        /* End Block*/
        /* This block checks, if the operation time is set it parses it to view otherwise get the default operation time from the database and parse it*/
        if (isset($this->request->post['operation_time'])) {
            $data['operation_time'] = $this->request->post['operation_time'];
        } else {
            $data['operation_time'] = $this->config->get('operation_time');
        }
        /* End Block*/
        /* This block checks, if the phone1 is set it parses it to view otherwise get the default phone1 from the database and parse it*/
        if (isset($this->request->post['phone1'])) {
            $data['phone1'] = $this->request->post['phone1'];
        } else {
            $data['phone1'] = $this->config->get('phone1');
        }
        /* End Block*/
        /* This block checks, if the phone2 is set it parses it to view otherwise get the default phone2 from the database and parse it*/
        if (isset($this->request->post['phone2'])) {
            $data['phone2'] = $this->request->post['phone2'];
        } else {
            $data['phone2'] = $this->config->get('phone2');
        }
        /* End Block*/
        /* This block checks, if the fax is set it parses it to view otherwise get the default fax from the database and parse it*/
        if (isset($this->request->post['fax'])) {
            $data['fax'] = $this->request->post['fax'];
        } else {
            $data['fax'] = $this->config->get('fax');
        }
        /* End Block*/
        /* This block checks, if the facebook is set it parses it to view otherwise get the default facebook from the database and parse it*/
        if (isset($this->request->post['facebook'])) {
            $data['facebook'] = $this->request->post['facebook'];
        } else {
            $data['facebook'] = $this->config->get('facebook');
        }
        /* End Block*/
        /* This block checks, if the line is set it parses it to view otherwise get the default line from the database and parse it*/
        if (isset($this->request->post['line'])) {
            $data['line'] = $this->request->post['line'];
        } else {
            $data['line'] = $this->config->get('line');
        }
        /* End Block*/
        /* This block checks, if the instagram is set it parses it to view otherwise get the default instagram from the database and parse it*/
        if (isset($this->request->post['instagram'])) {
            $data['instagram'] = $this->request->post['instagram'];
        } else {
            $data['instagram'] = $this->config->get('instagram');
        }
        /* End Block*/
        /* This block checks, if the youtube is set it parses it to view otherwise get the default youtube from the database and parse it*/
        if (isset($this->request->post['youtube'])) {
            $data['youtube'] = $this->request->post['youtube'];
        } else {
            $data['youtube'] = $this->config->get('youtube');
        }
        /* End Block*/
        /* This block checks, if the fax is set it parses it to view otherwise get the default fax from the database and parse it*/
        if (isset($this->request->post['contact_button'])) {
            $data['contact_button'] = $this->request->post['contact_button'];
        } else {
            $data['contact_button'] = $this->config->get('contact_button');
        }
        /* End Block*/

        $data['modules'] = array();

        /* This block parses the Module Settings to the view*/
        if (isset($this->request->post['semi_footer_module'])) {
            $data['modules'] = $this->request->post['semi_footer_module'];
        } elseif ($this->config->get('semi_footer_module')) {
            $data['modules'] = $this->config->get('semi_footer_module');
        }

        // Layouts
        $this->load->model('design/layout');
        $data['layouts'] = $this->model_design_layout->getLayouts();

        // Languages
        $this->load->model('localisation/language');
        $data['languages'] = $this->model_localisation_language->getLanguages();

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('module/semi_footer.tpl', $data));
    }

    /* Function that validates the data when Save Button is pressed */
    protected function validate() {

        /* Block to check the user permission to manipulate the module*/
        if (!$this->user->hasPermission('modify', 'module/semi_footer')) {
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