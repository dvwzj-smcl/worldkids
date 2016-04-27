<?php
class ControllerAccountPayconfirm extends Controller {
	private $error = array();

	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/payconfirm', '', 'SSL');

			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$this->load->language('account/payconfirm');

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->load->language('account/payconfirm');

		    $this->load->model('localisation/payconfirm_destination');
		    $this->load->model('localisation/payconfirm_method');
            $destination = $this->model_localisation_payconfirm_destination->getTotalPayconfirmDestinations();
            $method = $this->model_localisation_payconfirm_method->getTotalPayconfirmMethods();

            if ($destination > 0) {
		      $select_destination = $this->model_localisation_payconfirm_destination->getPayconfirmDestinationDescriptions($this->request->post['payconfirm_destination_id']);
            }
            if ($method > 0) {
		      $select_method = $this->model_localisation_payconfirm_method->getPayconfirmMethodDescriptions($this->request->post['payconfirm_method_id']);
            }
            
            $this->load->model('checkout/order');

            $comment  = $this->language->get('heading_title') . "\n\n";
            $comment .= $this->language->get('entry_sender') . ": " . $this->request->post['sender'] . "\n";
            $comment .= $this->language->get('entry_date_transfer') . ": " . date($this->language->get('date_format_short'), strtotime($this->request->post['date_transfer'])) . "\n";

            if ($destination > 0) {
              $comment .= $this->language->get('entry_destination') . ": " . $select_destination[$this->config->get('config_language_id')]['name'] . "\n";
            }
            if ($method > 0) {
              $comment .= $this->language->get('entry_transfer_method') . ": " . $select_method[$this->config->get('config_language_id')]['name'] . "\n";
            }

            $comment .= $this->language->get('entry_amount') . ": " . $this->request->post['amount'] . "\n";

            if ($this->request->post['filename']) {
              $comment .= $this->language->get('entry_filename') . ": " . $this->request->post['filename'] . "\n";
            }

            $select_confirms = $this->request->post['sum_confirm_order'];
            $total_select_confirms = count($select_confirms);
            if ($total_select_confirms > 1) {
               $comment .= $this->language->get('entry_confirm_order') . ": ";
               foreach($select_confirms as $select_confirm) {
                   $comment .= "#" . $select_confirm . " ";
               }
               $comment .= "\n";
            }
            
		    if ($this->request->post['confirm_comment']) {
               $comment .= $this->language->get('entry_confirm_comment') . ": " . $this->request->post['confirm_comment'] . "\n";
            }

            foreach($select_confirms as $select_confirm) {
                $this->model_checkout_order->addOrderHistory($select_confirm, $this->config->get('config_payconfirm_status_id'), $comment, $this->config->get('config_payconfirm_notify'));
            }

            //Admin Alert Mail
            if ($this->config->get('config_payconfirm_mail')) {
               $message  = $this->language->get('heading_title') . "\n\n";
               $message .= $this->language->get('text_contact') . "\n";
               $message .= $this->language->get('entry_name') . ": " . $this->request->post['name'] . "\n";
               $message .= $this->language->get('entry_lastname') . ": " . $this->request->post['lastname'] . "\n";
               $message .= $this->language->get('entry_email') . ": " . $this->request->post['email'] . "\n";
               $message .= $this->language->get('entry_telephone') . ": " . $this->request->post['telephone'] . "\n\n";
               $message .= $this->language->get('text_payment') . "\n";
               $message .= $this->language->get('entry_sender') . ": " . $this->request->post['sender'] . "\n";
               $message .= $this->language->get('entry_date_transfer') . ": " . date($this->language->get('date_format_short'), strtotime($this->request->post['date_transfer'])) . "\n";

               if ($destination > 0) {
                 $message .= $this->language->get('entry_destination') . ": " . $select_destination[$this->config->get('config_language_id')]['name'] . "\n";
               }
               if ($method > 0) {
                 $message .= $this->language->get('entry_transfer_method') . ": " . $select_method[$this->config->get('config_language_id')]['name'] . "\n";
               }

               $message .= $this->language->get('entry_amount') . ": " . $this->request->post['amount'] . "\n";

		       if ($this->request->post['filename']) {
                  $message .= $this->language->get('entry_filename') . ": " . $this->request->post['filename'] . "\n";
               }

               $message .= $this->language->get('entry_confirm_order') . ": ";

               foreach($select_confirms as $select_confirm) {
                   $message .= "#" . $select_confirm . " ";
               }
               $message .= "\n";

		       if ($this->request->post['confirm_comment']) {
                  $message .= $this->language->get('entry_confirm_comment') . ": " . $this->request->post['confirm_comment'] . "\n";
               }

               if (VERSION == '2.0.0.0' || VERSION == '2.0.1.0' || VERSION == '2.0.1.1') {
                 $mail = new Mail($this->config->get('config_mail'));
               } elseif (VERSION == '2.0.2.0') {
                 $mail = new Mail();
			     $mail->protocol = $this->config->get('config_mail_protocol');
			     $mail->parameter = $this->config->get('config_mail_parameter');
			     $mail->smtp_hostname = $this->config->get('config_mail_smtp_host');
			     $mail->smtp_username = $this->config->get('config_mail_smtp_username');
			     $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			     $mail->smtp_port = $this->config->get('config_mail_smtp_port');
			     $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
               } else {
                 $mail = new Mail();
			     $mail->protocol = $this->config->get('config_mail_protocol');
			     $mail->parameter = $this->config->get('config_mail_parameter');
			     $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			     $mail->smtp_username = $this->config->get('config_mail_smtp_username');
			     $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			     $mail->smtp_port = $this->config->get('config_mail_smtp_port');
			     $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
               }
               
			   $mail->setTo($this->config->get('config_email'));
			   $mail->setFrom($this->request->post['email']);
               if (VERSION == '2.0.0.0' || VERSION == '2.0.1.0' || VERSION == '2.0.1.1' || VERSION == '2.0.2.0' || VERSION == '2.0.3.1') {
			      $mail->setSender(sprintf($this->language->get('email_sender'), $this->request->post['name'], $this->request->post['lastname']));
			      $mail->setSubject(sprintf($this->language->get('email_subject'), $this->request->post['name'], $this->request->post['lastname']));
               } else {
			      $mail->setSender(html_entity_decode(sprintf($this->language->get('email_sender'), $this->request->post['name'], $this->request->post['lastname']), ENT_QUOTES, 'UTF-8'));
			      $mail->setSubject(html_entity_decode(sprintf($this->language->get('email_subject'), $this->request->post['name'], $this->request->post['lastname']),  ENT_QUOTES, 'UTF-8'));
               }
               $mail->setText($message);

               if($this->request->post['code']){
                 $this->load->model('tool/upload');
                 $upload_info = $this->model_tool_upload->getUploadByCode($this->request->post['code']);
                 $phyname = DIR_UPLOAD.$upload_info['filename'];
                 $temp_name = DIR_UPLOAD.$upload_info['name'];
                 copy($phyname,$temp_name);
                 $mail->AddAttachment($temp_name);
               }

			   $mail->send();
			  
			   // Send to additional alert emails
			   $emails = explode(',', $this->config->get('config_mail_alert'));

			   foreach ($emails as $email) {
                   if ($email && preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)) {
                      $mail->setTo($email);
                      $mail->send();
				   }
	           }

               if(isset($temp_name)){
                 unlink( $temp_name );
               }

			}

			$this->response->redirect($this->url->link('account/payconfirm/success'));
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/account', '', 'SSL')
		);

		$url = '';

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('account/payconfirm', $url, 'SSL')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_description'] = $this->language->get('text_description');
		$data['text_contact'] = $this->language->get('text_contact');
		$data['text_payment'] = $this->language->get('text_payment');
		$data['text_loading'] = $this->language->get('text_loading');

		$data['text_status'] = $this->language->get('text_status');
		$data['text_total'] = $this->language->get('text_total');
		$data['text_details'] = $this->language->get('text_details');
		$data['text_separate'] = $this->language->get('text_separate');
		$data['text_open_brackets'] = $this->language->get('text_open_brackets');
		$data['text_close_brackets'] = $this->language->get('text_close_brackets');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_lastname'] = $this->language->get('entry_lastname');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_telephone'] = $this->language->get('entry_telephone');
		$data['entry_sender'] = $this->language->get('entry_sender');
		$data['entry_date_transfer'] = $this->language->get('entry_date_transfer');
		$data['entry_destination'] = $this->language->get('entry_destination');
		$data['entry_transfer_method'] = $this->language->get('entry_transfer_method');
		$data['entry_amount'] = $this->language->get('entry_amount');
		$data['entry_confirm_order'] = $this->language->get('entry_confirm_order');
		$data['entry_filename'] = $this->language->get('entry_filename');
		$data['entry_confirm_comment'] = $this->language->get('entry_confirm_comment');

		$data['help_confirm_order'] = $this->language->get('help_confirm_order');

        $data['text_empty'] = $this->language->get('text_empty');

		$data['column_order_id'] = $this->language->get('column_order_id');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_customer'] = $this->language->get('column_customer');
		$data['column_product'] = $this->language->get('column_product');
		$data['column_total'] = $this->language->get('column_total');

		$data['button_back'] = $this->language->get('button_back');
		$data['button_view'] = $this->language->get('button_view');
		$data['button_upload'] = $this->language->get('button_upload');
		$data['button_continue'] = $this->language->get('button_continue');

		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
		$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

		if (isset($this->error['lastname'])) {
			$data['error_lastname'] = $this->error['lastname'];
		} else {
			$data['error_lastname'] = '';
		}

		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}

		if (isset($this->error['telephone'])) {
			$data['error_telephone'] = $this->error['telephone'];
		} else {
			$data['error_telephone'] = '';
		}

		if (isset($this->error['sender'])) {
			$data['error_sender'] = $this->error['sender'];
		} else {
			$data['error_sender'] = '';
		}

		if (isset($this->error['date_transfer'])) {
			$data['error_date_transfer'] = $this->error['date_transfer'];
		} else {
			$data['error_date_transfer'] = '';
		}

		if (isset($this->error['destination'])) {
			$data['error_destination'] = $this->error['destination'];
		} else {
			$data['error_destination'] = '';
		}

		if (isset($this->error['transfer_method'])) {
			$data['error_transfer_method'] = $this->error['transfer_method'];
		} else {
			$data['error_transfer_method'] = '';
		}

		if (isset($this->error['amount'])) {
			$data['error_amount'] = $this->error['amount'];
		} else {
			$data['error_amount'] = '';
		}

		if (isset($this->error['slip'])) {
			$data['error_slip'] = $this->error['slip'];
		} else {
			$data['error_slip'] = '';
		}

		if (isset($this->error['confirm_order'])) {
			$data['error_confirm_order'] = $this->error['confirm_order'];
		} else {
			$data['error_confirm_order'] = '';
		}

		if (isset($this->error['captcha'])) {
			$data['error_captcha'] = $this->error['captcha'];
		} else {
			$data['error_captcha'] = '';
		}

        $data['slip_required'] = $this->config->get('config_payconfirm_slip');
		$data['button_submit'] = $this->language->get('button_submit');

		$data['action'] = $this->url->link('account/payconfirm');

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} else {
			$data['name'] = $this->customer->getFirstName();
		}

		if (isset($this->request->post['lastname'])) {
			$data['lastname'] = $this->request->post['lastname'];
		} else {
			$data['lastname'] = $this->customer->getLastName();
		}

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} else {
			$data['email'] = $this->customer->getEmail();
		}

		if (isset($this->request->post['telephone'])) {
			$data['telephone'] = $this->request->post['telephone'];
		} else {
			$data['telephone'] = $this->customer->getTelephone();
		}

		if (isset($this->request->post['sender'])) {
			$data['sender'] = $this->request->post['sender'];
		} else {
			$data['sender'] = '';
		}
		
		if (isset($this->request->post['date_transfer'])) {
			$data['date_transfer'] = $this->request->post['date_transfer'];
		} else {
			$data['date_transfer'] = '';
		}
		
		if (isset($this->request->post['payconfirm_destination_id'])) {
			$data['payconfirm_destination_id'] = $this->request->post['payconfirm_destination_id'];
		} else {
			$data['payconfirm_destination_id'] = '';
		}

		$this->load->model('localisation/payconfirm_destination');

		$data['payconfirm_destinations'] = $this->model_localisation_payconfirm_destination->getPayconfirmDestinations();
        $data['total_destination'] = $this->model_localisation_payconfirm_destination->getTotalPayconfirmDestinations();

		if (isset($this->request->post['payconfirm_method_id'])) {
			$data['payconfirm_method_id'] = $this->request->post['payconfirm_method_id'];
		} else {
			$data['payconfirm_method_id'] = '';
		}

		$this->load->model('localisation/payconfirm_method');

		$data['payconfirm_methods'] = $this->model_localisation_payconfirm_method->getPayconfirmMethods();
        $data['total_method'] = $this->model_localisation_payconfirm_method->getTotalPayconfirmMethods();

		if (isset($this->request->post['amount'])) {
			$data['amount'] = $this->request->post['amount'];
		} else {
			$data['amount'] = '';
		}

		if (isset($this->request->post['filename'])) {
			$data['filename'] = $this->request->post['filename'];
		} else {
			$data['filename'] = '';
		}

		if (isset($this->request->post['code'])) {
			$data['code'] = $this->request->post['code'];
		} else {
			$data['code'] = '';
		}

		if (isset($this->request->post['sum_confirm_order'])) {
			$data['sum_confirm_order'] = (array)$this->request->post['sum_confirm_order'];
		} else {
			$data['sum_confirm_order'] = array();
		}


		if (isset($this->request->post['confirm_comment'])) {
			$data['confirm_comment'] = $this->request->post['confirm_comment'];
		} else {
			$data['confirm_comment'] = '';
		}

		if ($this->config->get('config_google_captcha_status')) {
			$this->document->addScript('https://www.google.com/recaptcha/api.js');

			$data['site_key'] = $this->config->get('config_google_captcha_public');
		} else {
			$data['site_key'] = '';
		}

		$data['orders'] = array();

		$this->load->model('account/payconfirm');

		$order_total = $this->model_account_payconfirm->getTotalOrders();

        $results = $this->model_account_payconfirm->getOrders(0, $order_total);

		foreach ($results as $result) {
			$product_total = $this->model_account_payconfirm->getTotalOrderProductsByOrderId($result['order_id']);
			$voucher_total = $this->model_account_payconfirm->getTotalOrderVouchersByOrderId($result['order_id']);

			$data['orders'][] = array(
				'order_id'   => $result['order_id'],
				'name'       => $result['firstname'] . ' ' . $result['lastname'],
				'status'     => $result['status'],
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'products'   => ($product_total + $voucher_total),
				'total'      => $this->currency->format($result['total'], $result['currency_code'], $result['currency_value']),
				'href'       => $this->url->link('account/payconfirm/info', 'order_id=' . $result['order_id'], 'SSL'),
			);
		}

		$data['back'] = $this->url->link('account/account', '', 'SSL');
		$data['continue'] = $this->url->link('account/account', '', 'SSL');
		$data['done'] = $this->url->link('account/payconfirm/success', '', 'SSL');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/payconfirm.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/payconfirm.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/account/payconfirm.tpl', $data));
		}
	}

	public function info() {
		$this->load->language('account/payconfirm');

		if (isset($this->request->get['order_id'])) {
			$order_id = $this->request->get['order_id'];
		} else {
			$order_id = 0;
		}

		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/payconfirm/info', 'order_id=' . $order_id, 'SSL');

			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$this->load->model('account/payconfirm');

		$payconfirm_info = $this->model_account_payconfirm->getOrder($order_id);

		if ($payconfirm_info) {
			$this->document->setTitle($this->language->get('text_order'));

			$data['breadcrumbs'] = array();

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_home'),
				'href' => $this->url->link('common/home')
			);

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_account'),
				'href' => $this->url->link('account/account', '', 'SSL')
			);

			$url = '';

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('account/payconfirm', $url, 'SSL')
			);

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_order'),
				'href' => $this->url->link('account/payconfirm/info', 'order_id=' . $this->request->get['order_id'] . $url, 'SSL')
			);

			$data['heading_title'] = $this->language->get('text_order');

			$data['text_order_detail'] = $this->language->get('text_order_detail');
			$data['text_invoice_no'] = $this->language->get('text_invoice_no');
			$data['text_order_id'] = $this->language->get('text_order_id');
			$data['text_date_added'] = $this->language->get('text_date_added');
			$data['text_shipping_method'] = $this->language->get('text_shipping_method');
			$data['text_shipping_address'] = $this->language->get('text_shipping_address');
			$data['text_payment_method'] = $this->language->get('text_payment_method');
			$data['text_payment_address'] = $this->language->get('text_payment_address');
			$data['text_history'] = $this->language->get('text_history');
			$data['text_comment'] = $this->language->get('text_comment');

			$data['column_name'] = $this->language->get('column_name');
			$data['column_model'] = $this->language->get('column_model');
			$data['column_quantity'] = $this->language->get('column_quantity');
			$data['column_price'] = $this->language->get('column_price');
			$data['column_total'] = $this->language->get('column_total');
			$data['column_action'] = $this->language->get('column_action');
			$data['column_date_added'] = $this->language->get('column_date_added');
			$data['column_status'] = $this->language->get('column_status');
			$data['column_comment'] = $this->language->get('column_comment');

			$data['button_continue'] = $this->language->get('button_continue');

			if (isset($this->session->data['error'])) {
				$data['error_warning'] = $this->session->data['error'];

				unset($this->session->data['error']);
			} else {
				$data['error_warning'] = '';
			}

			if (isset($this->session->data['success'])) {
				$data['success'] = $this->session->data['success'];

				unset($this->session->data['success']);
			} else {
				$data['success'] = '';
			}

			if ($payconfirm_info['invoice_no']) {
				$data['invoice_no'] = $payconfirm_info['invoice_prefix'] . $payconfirm_info['invoice_no'];
			} else {
				$data['invoice_no'] = '';
			}

			$data['order_id'] = $this->request->get['order_id'];
			$data['date_added'] = date($this->language->get('date_format_short'), strtotime($payconfirm_info['date_added']));

			if ($payconfirm_info['payment_address_format']) {
				$format = $payconfirm_info['payment_address_format'];
			} else {
				$format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
			}

			$find = array(
				'{firstname}',
				'{lastname}',
				'{company}',
				'{address_1}',
				'{address_2}',
				'{city}',
				'{postcode}',
				'{zone}',
				'{zone_code}',
				'{country}'
			);

			$replace = array(
				'firstname' => $payconfirm_info['payment_firstname'],
				'lastname'  => $payconfirm_info['payment_lastname'],
				'company'   => $payconfirm_info['payment_company'],
				'address_1' => $payconfirm_info['payment_address_1'],
				'address_2' => $payconfirm_info['payment_address_2'],
				'city'      => $payconfirm_info['payment_city'],
				'postcode'  => $payconfirm_info['payment_postcode'],
				'zone'      => $payconfirm_info['payment_zone'],
				'zone_code' => $payconfirm_info['payment_zone_code'],
				'country'   => $payconfirm_info['payment_country']
			);

			$data['payment_address'] = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

			$data['payment_method'] = $payconfirm_info['payment_method'];

			if ($payconfirm_info['shipping_address_format']) {
				$format = $payconfirm_info['shipping_address_format'];
			} else {
				$format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
			}

			$find = array(
				'{firstname}',
				'{lastname}',
				'{company}',
				'{address_1}',
				'{address_2}',
				'{city}',
				'{postcode}',
				'{zone}',
				'{zone_code}',
				'{country}'
			);

			$replace = array(
				'firstname' => $payconfirm_info['shipping_firstname'],
				'lastname'  => $payconfirm_info['shipping_lastname'],
				'company'   => $payconfirm_info['shipping_company'],
				'address_1' => $payconfirm_info['shipping_address_1'],
				'address_2' => $payconfirm_info['shipping_address_2'],
				'city'      => $payconfirm_info['shipping_city'],
				'postcode'  => $payconfirm_info['shipping_postcode'],
				'zone'      => $payconfirm_info['shipping_zone'],
				'zone_code' => $payconfirm_info['shipping_zone_code'],
				'country'   => $payconfirm_info['shipping_country']
			);

			$data['shipping_address'] = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

			$data['shipping_method'] = $payconfirm_info['shipping_method'];

			$this->load->model('catalog/product');
			$this->load->model('tool/upload');

			// Products
			$data['products'] = array();

			$products = $this->model_account_payconfirm->getOrderProducts($this->request->get['order_id']);

			foreach ($products as $product) {
				$option_data = array();

				$options = $this->model_account_payconfirm->getOrderOptions($this->request->get['order_id'], $product['order_product_id']);

				foreach ($options as $option) {
					if ($option['type'] != 'file') {
						$value = $option['value'];
					} else {
						$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);

						if ($upload_info) {
							$value = $upload_info['name'];
						} else {
							$value = '';
						}
					}

					$option_data[] = array(
						'name'  => $option['name'],
						'value' => (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20) . '..' : $value)
					);
				}

				$product_info = $this->model_catalog_product->getProduct($product['product_id']);

				$data['products'][] = array(
					'name'     => $product['name'],
					'model'    => $product['model'],
					'option'   => $option_data,
					'quantity' => $product['quantity'],
					'price'    => $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $payconfirm_info['currency_code'], $payconfirm_info['currency_value']),
					'total'    => $this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $payconfirm_info['currency_code'], $payconfirm_info['currency_value']),
				);
			}

			// Voucher
			$data['vouchers'] = array();

			$vouchers = $this->model_account_payconfirm->getOrderVouchers($this->request->get['order_id']);

			foreach ($vouchers as $voucher) {
				$data['vouchers'][] = array(
					'description' => $voucher['description'],
					'amount'      => $this->currency->format($voucher['amount'], $payconfirm_info['currency_code'], $payconfirm_info['currency_value'])
				);
			}

			// Totals
			$data['totals'] = array();

			$totals = $this->model_account_payconfirm->getOrderTotals($this->request->get['order_id']);

			foreach ($totals as $total) {
				$data['totals'][] = array(
					'title' => $total['title'],
					'text'  => $this->currency->format($total['value'], $payconfirm_info['currency_code'], $payconfirm_info['currency_value']),
				);
			}

			$data['comment'] = nl2br($payconfirm_info['comment']);

			$data['continue'] = $this->url->link('account/payconfirm', '', 'SSL');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/payconfirm_info.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/payconfirm_info.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/account/payconfirm_info.tpl', $data));
			}
		} else {
			$this->document->setTitle($this->language->get('text_order'));

			$data['heading_title'] = $this->language->get('text_order');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['breadcrumbs'] = array();

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_home'),
				'href' => $this->url->link('common/home')
			);

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_account'),
				'href' => $this->url->link('account/account', '', 'SSL')
			);

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('account/payconfirm', '', 'SSL')
			);

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_order'),
				'href' => $this->url->link('account/payconfirm/info', 'order_id=' . $order_id, 'SSL')
			);

			$data['continue'] = $this->url->link('account/payconfirm', '', 'SSL');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
			}
		}
	}

	public function success() {
		$this->load->language('account/payconfirm');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/account', '', 'SSL')
		);

		$url = '';

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('account/payconfirm', $url, 'SSL')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_message'] = $this->language->get('text_success_confirm');

		$data['button_continue'] = $this->language->get('button_continue');

		$data['continue'] = $this->url->link('common/home');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/success.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/success.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/success.tpl', $data));
		}
	}

	protected function validate() {
		$this->load->model('localisation/payconfirm_destination');
		$this->load->model('localisation/payconfirm_method');

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		if ((utf8_strlen($this->request->post['lastname']) < 3) || (utf8_strlen($this->request->post['lastname']) > 32)) {
			$this->error['lastname'] = $this->language->get('error_lastname');
		}

		if (!preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->request->post['email'])) {
			$this->error['email'] = $this->language->get('error_email');
		}

		if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
			$this->error['telephone'] = $this->language->get('error_telephone');
		}

		if ((utf8_strlen($this->request->post['sender']) < 3) || (utf8_strlen($this->request->post['sender']) > 32)) {
			$this->error['sender'] = $this->language->get('error_sender');
		}
		
		if ((utf8_strlen($this->request->post['date_transfer']) < 3) || (utf8_strlen($this->request->post['date_transfer']) > 32)) {
			$this->error['date_transfer'] = $this->language->get('error_date_transfer');
		}
		
		if ($this->model_localisation_payconfirm_destination->getTotalPayconfirmDestinations() > 0 && empty($this->request->post['payconfirm_destination_id'])) {
			$this->error['destination'] = $this->language->get('error_destination');
		}

		if ($this->model_localisation_payconfirm_method->getTotalPayconfirmMethods() > 0 && empty($this->request->post['payconfirm_method_id'])) {
			$this->error['transfer_method'] = $this->language->get('error_transfer_method');
		}

		if ((utf8_strlen($this->request->post['amount']) < 1) || (utf8_strlen($this->request->post['amount']) > 32)) {
			$this->error['amount'] = $this->language->get('error_amount');
		}

		if ($this->config->get('config_payconfirm_slip') == 1 && empty($this->request->post['filename'])) {
			$this->error['slip'] = $this->language->get('error_slip');
		}

		if (!isset($this->request->post['sum_confirm_order'])) {
			$this->error['confirm_order'] = $this->language->get('error_confirm_order');
		}

		if ($this->config->get('config_google_captcha_status')) {
			$recaptcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($this->config->get('config_google_captcha_secret')) . '&response=' . $this->request->post['g-recaptcha-response'] . '&remoteip=' . $this->request->server['REMOTE_ADDR']);

			$recaptcha = json_decode($recaptcha, true);

			if (!$recaptcha['success']) {
				$this->error['captcha'] = $this->language->get('error_captcha');
			}
		}

		return !$this->error;
	}

	public function upload() {
		$this->load->language('account/payconfirm');

		$json = array();

		if (!$json) {
			if (!empty($this->request->files['file']['name']) && is_file($this->request->files['file']['tmp_name'])) {
				// Sanitize the filename
				$filename = basename(html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8'));

				// Validate the filename length
				if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 128)) {
					$json['error'] = $this->language->get('error_filename');
				}

				// Allowed file extension types
				$allowed = array();

				$extension_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_ext_allowed'));

				$filetypes = explode("\n", $extension_allowed);

				foreach ($filetypes as $filetype) {
					$allowed[] = trim($filetype);
				}

				if (!in_array(strtolower(substr(strrchr($filename, '.'), 1)), $allowed)) {
					$json['error'] = $this->language->get('error_filetype');
				}

				// Allowed file mime types
				$allowed = array();

				$mime_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_mime_allowed'));

				$filetypes = explode("\n", $mime_allowed);

				foreach ($filetypes as $filetype) {
					$allowed[] = trim($filetype);
				}

				if (!in_array($this->request->files['file']['type'], $allowed)) {
					$json['error'] = $this->language->get('error_filetype');
				}

				// Check to see if any PHP files are trying to be uploaded
				$content = file_get_contents($this->request->files['file']['tmp_name']);

				if (preg_match('/\<\?php/i', $content)) {
					$json['error'] = $this->language->get('error_filetype');
				}

				// Return any upload error
				if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
					$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
				}
			} else {
				$json['error'] = $this->language->get('error_upload');
			}
		}

		if (!$json) {
			$file = $filename . '.' . md5(mt_rand());

			move_uploaded_file($this->request->files['file']['tmp_name'], DIR_UPLOAD . $file);

			// Hide the uploaded file name so people can not link to it directly.
			$this->load->model('tool/upload');

			$json['code'] = $this->model_tool_upload->addUpload($filename, $file);
			$json['filename'] = $filename;

			$json['success'] = $this->language->get('text_upload');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
