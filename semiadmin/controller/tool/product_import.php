<?php
include DIR_SYSTEM.'library/PHPExcel.php';
class ControllerToolProductimport extends Controller {
	private $error = array();

	public function index(){
		$this->load->language('catalog/product');
		
		$this->load->language('tool/product_import');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product');
		
		$this->load->model('tool/product_import');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['product_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		
		$data['entry_store'] = $this->language->get('entry_store');
		
		$examplefiles = 'http://themegalore.in/import_sample2x/example.xls';
		$data['entry_import'] = sprintf($this->language->get('entry_import'),$examplefiles);
		$data['entry_language'] = $this->language->get('entry_language');
		
		$data['help_keyword'] = $this->language->get('help_keyword');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['cancel'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL');
		$data['button_add'] = $this->language->get('button_add');
		$data['text_importtype'] = $this->language->get('text_importtype');
		$data['text_productid'] = $this->language->get('text_productid');
		$data['text_model'] = $this->language->get('text_model');
		
		$data['token'] = $this->session->data['token'];
		
		$url = '';
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);
		
		
		if(($this->request->server['REQUEST_METHOD'] == 'POST')) {
			if($this->request->files) {
				if(!empty($this->request->post['store_id'])){
					$store_id = $this->request->post['store_id'];
				}else{
					$store_id = 0;
				}
				
				if(!empty($this->request->post['language_id'])){
					$language_id = $this->request->post['language_id'];
				}else{
					$language_id = $this->config->get('config_langauge_id');
				}
				
				
			$file = basename($this->request->files['import']['name']);
			move_uploaded_file($this->request->files['import']['tmp_name'], $file);
			$inputFileName = $file;
			$extension = pathinfo($inputFileName);
			if($extension['basename']){
				if($extension['extension']=='xlsx' || $extension['extension']=='xls') {
					try{
						$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
					}catch(Exception $e){
						die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
					}
					$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
					$i=0;
					$updateproduct = 0;
					$newproduct = 0;
					
					$this->load->model('localisation/tax_class');
					foreach($allDataInSheet as $k=> $value){
						if($i!=0){
							if($value['D']){
							//Tax Class
							if(empty($value['T'])){
								$value['T'] = $this->model_tool_product_import->CheckTaxClass($value['U']);
							}
							
							//Stock Status
							if(empty($value['Y'])){
								$value['Y'] = $this->model_tool_product_import->CheckStockStatus($value['Z']);
							}
							
							if(!empty($value['AB'])){
								 $value['AB'] = str_replace(' ','_',$value['AB']);
							}
							
							//manufacture
							if(empty($value['AN']) && !empty($value['AO'])){
								 $value['AN'] = $this->model_tool_product_import->CheckManufacturer($value['AO'],$store_id);
							}
							
							//Categories
							$categoryids=array();
							if(empty($value['AP']) && !empty($value['AQ'])){
								 $categoryids = $this->model_tool_product_import->CheckCategories($value['AQ'],$store_id);
							}else{
								 $categoryids = explode(',',trim($value['AP']));
							}
							
							
							//Filter
							$filters=array();
							if(!empty($value['AR'])){
								$filters = $this->model_tool_product_import->checkFilter($value['AR']);
							}
							
							//Download
							$downloads = array();
							if(!empty($value['AS'])){
								$downloads = explode(',',trim($value['AS']));
							}
							
							//Relaled Products
							$relaled_products = array();
							if(!empty($value['AT'])){
								$relaled_products = explode(',',trim($value['AT']));
							}
							
							//Attribute Group
							$attributes = array();
							if(!empty($value['AU'])){
								$attributes = $this->model_tool_product_import->checkAttribute($value['AU']);
							}
							
							//Options
							$options = array();
							if(!empty($value['AV'])){
								$options = $this->model_tool_product_import->checkoptions($value['AV']);
							}
							
							//Discount
							$discounts = array();
							if(!empty($value['AW'])){
								$discounts = $this->model_tool_product_import->checkdiscount($value['AW']);
							}
							
							//Specail
							$specails = array();
							if(!empty($value['AX'])){
								$specails = $this->model_tool_product_import->checkspecial($value['AX']);
							}
							
							//Image
							$images = array();
							if(!empty($value['AY'])){
								$images = explode(',',trim($value['AY']));
							}
							
							$importdata=array(
							  'name' 	 			=> $value['D'],
							  'model'  	 			=> $value['E'],
							  'description' 		=> $value['F'],
							  'meta_titile' 		=> $value['G'],
							  'meta_description' 	=> $value['H'],
							  'meta_keyword' 		=> $value['I'],
							  'tag' 				=> $value['J'],
							  'image' 				=> $value['K'],
							  'sku' 				=> $value['L'],
							  'upc' 				=> $value['M'],
							  'ean' 				=> $value['N'],
							  'jan' 				=> $value['O'],
							  'isbn' 				=> $value['P'],
							  'mpn' 				=> $value['Q'],
							  'location' 			=> $value['R'],
							  'price' 				=> $value['S'],
							  'tax_class_id' 		=> $value['T'],
							  'quantity' 			=> $value['V'],
							  'minimum' 			=> $value['W'],
							  'subtract' 			=> $value['X'],
							  'stock_status_id' 	=> $value['Y'],
							  'shipping' 			=> $value['AA'],
							  'keyword' 			=> $value['AB'],
							  'date_available' 		=> ($value['AC'] ? $value['AC'] : date('Y-m-d')),
							  'length' 				=> $value['AD'],
							  'length_class_id' 	=> $value['AE'],
							  'width' 				=> $value['AG'],
							  'height' 				=> $value['AH'],
							  'weight' 				=> $value['AI'],
							  'weight_class_id' 	=> $value['AJ'],
							  'status' 				=> $value['AL'],
							  'sort_order' 			=> $value['AM'],
							  'manufacturer_id' 	=> $value['AN'],
							  'categories'			=> array_unique($categoryids),
							  'filters'				=> array_unique($filters),
							  'downloads' 			=> $downloads,
							  'relaled_products' 	=> $relaled_products,
							  'attributes'			=> $attributes,
							  'options'				=> $options,
							  'discounts'			=> $discounts,
							  'specails'			=> $specails,
							  'images'				=> $images,
							);
							
							if($this->request->post['importtype']==2){
							 $product_id = $this->model_tool_product_import->getproductIDbymodel($value['E']);
								 if($product_id){
									 $this->model_tool_product_import->Editproduct($importdata,$product_id,$language_id,$store_id);
									 $updateproduct++;
								 }else{
									 $this->model_tool_product_import->addproduct($importdata,$language_id,$store_id);
									 $newproduct++;
								 }
							}else{
								if((int)$value['A']){
									$product_info = $this->model_catalog_product->getproduct($value['A']);
									if($product_info){
										$this->model_tool_product_import->Editproduct($importdata,$value['A'],$language_id,$store_id);
										$updateproduct++;
									}else{
										$this->model_tool_product_import->addoldproduct($importdata,$language_id,$store_id,$value['A']);
										$newproduct++;
									}
								}else{
									$this->model_tool_product_import->addproduct($importdata,$language_id,$store_id);
									$newproduct++;
								}
							}
						 }
						}
						$i++;
					}
					if($newproduct || $updateproduct){
						$this->session->data['success'] = sprintf($this->language->get('text_success'),$newproduct,$updateproduct);
					}
				
					if(!$newproduct && !$updateproduct){
						$this->session->data['error_warning'] = $this->language->get('text_no_data');
					}
				} else{
					$this->session->data['error_warning'] = $this->language->get('error_warning');
				}
			}else{
				$this->session->data['error_warning'] = $this->language->get('error_warning');
			}
			if($inputFileName){
				unlink($inputFileName);
			}
			
		  }else{
			$this->session->data['error_warning'] = $this->language->get('error_warning');
		  }
		}
		
		if(isset($this->error['warning'])){
			$data['error_warning'] = $this->error['warning'];
		}elseif(isset($this->session->data['error_warning'])){
			$data['error_warning'] = $this->session->data['error_warning'];
			unset($this->session->data['error_warning']);
		}else{
			$data['error_warning'] = '';
		}
		
		if(isset($this->session->data['success'])){
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		}else{
			$data['success'] = '';
		}
		
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		$this->load->model('setting/store');
		$data['stores'] = $this->model_setting_store->getStores();
		
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('tool/product_import.tpl', $data));
	}
}