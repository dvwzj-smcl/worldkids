<?php
/* 
Version: 1.0
Author: Artur Sułkowski
Website: http://artursulkowski.pl
*/

class ControllerModuleMegamenu extends Controller {
	public function category_to_menu($category){
		return array(
			'icon' => null,
			'name' => array(
				1 => $category['name'],
				2 => $category['name']
			),
			'link' => 'index.php?route=product/category&path='.$category['category_id'],
			'description' => null,
			'label' => null,
			'label_text_color'=> null,
			'label_background_color' => null,
			'custom_class' => null,
			'new_window' => 0,
			'display_on_mobile' => 0,
			'position' => 0,
			'submenu_width' => '190px',
			'submenu_type' => 0,
			'submenu_background' => null,
			'submenu_background_position' => 'top left',
			'submenu_background_repeat' => 'no-repeat',
			'submenu' => array()
		);
	}
	public function sub_category_to_sub_menu($sub_category){
		return array(
			'content_width' => 12,
			'content_type' => 2,
			'display_on_mobile' => 0,
			'html' => null,
			'product' => array(),
			'products' => array(),
			'column' => 1,
			'heading' => array(),
			'categories' => null,
			'submenu' => array()
		);
	}
	public function get_category_html_single($category){
		$html = '<li>
				<a href="index.php?route=product/category&amp;path='.$category['category_id'].'" onclick="window.location = \'index.php?route=product/category&amp;path='.$category['category_id'].'\';" class="main-menu ">'.$category['name'].'</a>
				</li>';
		return $html;
	}
	public function get_category_html_childs($category, $categories){
		if($categories){
			$html = '<li>
					<a href="index.php?route=product/category&amp;path='.$category['category_id'].'" onclick="window.location = \'index.php?route=product/category&amp;path='.$category['category_id'].'\';" class="main-menu with-submenu">'.$category['name'].'</a>
					<div class="open-categories"></div>
					<div class="close-categories"></div>
					<ul>';
			foreach($categories as $i => $category){

					$html .= $this->get_category_html_single($category);

			}
			$html .= '</ul></li>';
		}else{
			$html = $this->get_category_html_single($category);
		}
		return $html;
	}

	public function get_category_html(&$menu, $categories){
		foreach($categories as $i => $category){
			$menu['submenu'][$i]['categories'] = '<div class="row"><div class="col-sm-12 hover-menu"><div class="menu"><ul>';
			$childs = $this->model_catalog_category->getCategories($category['category_id']);
			/*
			if($childs){
				$menu['submenu'][$i]['categories'] .= $this->get_category_html_childs($category, $childs);
			}else{
				$menu['submenu'][$i]['categories'] .= $this->get_category_html_single($category);
			}
			*/
			if($childs){
				foreach($childs as $j => $c){
					$next_childs = $this->model_catalog_category->getCategories($c['category_id']);
					$menu['submenu'][$i]['categories'] .= $this->get_category_html_childs($c, $next_childs);
				}
			}else{
				$menu['submenu'][$i]['categories'] .= $this->get_category_html_single($category);
			}
			$menu['submenu'][$i]['categories'] .= '</ul></div></div></div>';
		}
		return;
	}


	public function get_sub_menu(&$menu, $categories){
		foreach($categories as $i => $category){
			$menu['submenu'][$i] = $this->sub_category_to_sub_menu($category);
			$childs = $this->model_catalog_category->getCategories($category['category_id']);
			if($childs){
				$this->get_sub_menu($menu['submenu'][$i], $childs);
			}
		}
	}

	public function get_category_menu($categories){
		$menu = array();
		foreach($categories as $i => $category){
			$menu[$i] = $this->category_to_menu($category);
			$childs = $this->model_catalog_category->getCategories($category['category_id']);
			if($childs){
				$this->get_sub_menu($menu[$i], $childs);
				$this->get_category_html($menu[$i], $childs);
			}
		}
		/*
		echo "<pre>";
		print_r($menu);
		echo "</pre>";
		*/
		return $menu;
	}

	
	public function index($setting) {
		
		// Ładowanie modelu MegaMenu
		$this->load->model('menu/megamenu');
		
		// Module id
		if(isset($setting['module_id'])) {
			$module_id = $setting['module_id'];
		} else {
			$module_id = 0;
		}
		
		// Cache MegaMenu	
		if(!isset($setting['status_cache'])) $setting['status_cache'] = 0;	
		$file_cache = 'catalog/model/menu/cache/cache_' . $module_id . '_' . $this->config->get('config_language_id') . '.json';
		if($setting['status_cache'] == 1 && is_writable('catalog/model/menu/cache')) {
			$cache_life = $setting['cache_time']*3600;
			if(!file_exists($file_cache) or (time() - filemtime($file_cache) >= $cache_life)) {
				file_put_contents($file_cache, json_encode($this->model_menu_megamenu->getMenu($module_id)));
			}
			$data['menu'] = json_decode(file_get_contents($file_cache), true);
		} else {
			$data['menu'] = $this->model_menu_megamenu->getMenu($module_id);
		}


		if($setting['orientation']==1){
			$this->load->model('catalog/category');
			$categories = $this->model_catalog_category->getCategories(0);

			/*
			$translate_category_to_menu = array();
			foreach($categories as $i => $category){
				$translate_category_to_menu[$i] = $this->category_to_menu($category);
				$sub_categories = $this->model_catalog_category->getCategories($category['category_id']);
				$translate_sub_category_to_sub_menu = array();
				foreach($sub_categories as $j => $sub_category){
					$sub_level2_categories = $this->model_catalog_category->getCategories($sub_category['category_id']);
					if($sub_level2_categories){
						$html = '';
						$html .= '<div class="row"><div class="col-sm-12 hover-menu"><div class="menu"><ul>';
						foreach($sub_level2_categories as $k => $sub_category_level2){
							$sub_level3_categories = $this->model_catalog_category->getCategories($sub_category_level2['category_id']);
							if($sub_level3_categories){
								$html .= '<li>
									<a href="index.php?route=product/category&amp;path='.$sub_category_level2['category_id'].'" onclick="window.location = \'index.php?route=product/category&amp;path='.$sub_category_level2['category_id'].'\';" class="main-menu with-submenu">'.$sub_category_level2['name'].($sub_category_level2['label']?'<span class="megamenu-label" style="background: #3898af;color: #ffffff"><span style="background: #3898af;border-color: #3898af"></span>NEW</span>':'').'</a>
									<div class="open-categories"></div>
									<div class="close-categories"></div>
									<ul>';
									foreach($sub_level3_categories as $k => $sub_category_level3){
										$html .= '<li>
											<a href="index.php?route=product/category&amp;path='.$sub_category_level3['category_id'].'" onclick="window.location = \'index.php?route=product/category&amp;path='.$sub_category_level3['category_id'].'\';" class="">'.$sub_category_level3['name'].'</a>
										</li>';
									}
								$html .= '</ul></li>';
							}else{
								$html .= '<li>
								<a href="index.php?route=product/category&amp;path='.$sub_category_level2['category_id'].'" onclick="window.location = \'index.php?route=product/category&amp;path='.$sub_category_level2['category_id'].'\';" class="main-menu ">'.$sub_category_level2['name'].'</a>
								</li>';
							}
						}
						$html .= '</ul></div></div></div>';
						$translate_sub_category_to_sub_menu[$j] = $this->sub_category_to_sub_menu($sub_category);
						$translate_sub_category_to_sub_menu[$j]['categories'] = $html;
					}
				}
				$translate_category_to_menu[$i]['submenu'] = $sub_categories ? $translate_sub_category_to_sub_menu : array();
			}
			*/
			
			//$data['menu'] = $translate_category_to_menu;
			$data['menu'] = $this->get_category_menu($categories);

			/*
			echo "<pre>";
			print_r($data['menu']);
			echo "</pre>";
			*/
		}
		
		// Pobranie ustawień
		$lang_id = $this->config->get('config_language_id');
		$data['ustawienia'] = array(
			'display_on_mobile' => $setting['display_on_mobile'],
			'orientation' => $setting['orientation'],
			'search_bar' => $setting['search_bar'],
			'navigation_text' => $setting['navigation_text'],
			'full_width' => $setting['full_width'],
			'home_item' => $setting['home_item'],
			'home_text' => $setting['home_text'],
			'animation' => $setting['animation'],
			'animation_time' => $setting['animation_time']
		);
		$data['navigation_text'] = 'Navigation';
		if(isset($setting['navigation_text'][$lang_id])) {
			if(!empty($setting['navigation_text'][$lang_id])) {
				$data['navigation_text'] = $setting['navigation_text'][$lang_id];
			}
		}
		$data['home_text'] = 'Home';
		if(isset($setting['home_text'][$lang_id])) {
			if(!empty($setting['home_text'][$lang_id])) {
				$data['home_text'] = $setting['home_text'][$lang_id];
			}
		}
		
		$data['home'] = $this->url->link('common/home');
		$data['lang_id'] = $this->config->get('config_language_id');
		
		// Search
		$this->language->load('common/header');
		$data['text_search'] = $this->language->get('text_search');
		if (isset($this->request->get['search'])) {
			$data['search'] = $this->request->get['search'];
		} else {
			$data['search'] = '';
		}
		
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/megamenu.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/megamenu.tpl', $data);
		} else {
			return $this->load->view('default/template/module/megamenu.tpl', $data);
		}
	}
}
?>