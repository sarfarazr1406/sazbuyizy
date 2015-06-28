<?php
class BlockCategories2 extends Module{
	public function __construct(){
		$this->name = 'blockcategories2';
		$this->tab = 'front_office_features';
		$this->version = '1.1';
		$this->author = 'MyPresta.eu';
		parent::__construct();
		$this->displayName = $this->l('Categories block with number of products');
		$this->description = $this->l('This module create categories block with number of products in each category');
        $this->mkey="freelicense";       
        if (@file_exists('../modules/'.$this->name.'/key.php'))
            @require_once ('../modules/'.$this->name.'/key.php');
        else if (@file_exists(dirname(__FILE__) . $this->name.'/key.php'))
            @require_once (dirname(__FILE__) . $this->name.'/key.php');
        else if (@file_exists('modules/'.$this->name.'/key.php'))
            @require_once ('modules/'.$this->name.'/key.php');                        
        $this->checkforupdates();
	}
    
    function checkforupdates(){
            if (isset($_GET['controller']) OR isset($_GET['tab'])){
                if (Configuration::get('update_'.$this->name) < (date("U")>86400)){
                    $actual_version = BlockCategories2Update::verify($this->name,$this->mkey,$this->version);
                }
                if (BlockCategories2Update::version($this->version)<BlockCategories2Update::version(Configuration::get('updatev_'.$this->name))){
                    $this->warning=$this->l('New version available, check MyPresta.eu for more informations');
                }
            }
        } 
        
	public function install(){
		if (!parent::install() ||
			!$this->registerHook('leftColumn') ||
			!$this->registerHook('header') ||
			!$this->registerHook('categoryAddition') ||
			!$this->registerHook('categoryUpdate') ||
			!$this->registerHook('categoryDeletion') ||
			!$this->registerHook('actionAdminMetaControllerUpdate_optionsBefore') ||
			!$this->registerHook('actionAdminLanguagesControllerStatusBefore') ||
			!Configuration::updateValue('BLOCK_CATEG2_MAX_DEPTH', 4) ||
			!Configuration::updateValue('BLOCK_CATEG2_DHTML', 1) ||
            !Configuration::updateValue('update_'.$this->name,'0'))
			return false;
		return true;
	}

	public function uninstall(){
		if (!parent::uninstall() ||
			!Configuration::deleteByName('BLOCK_CATEG2_MAX_DEPTH') ||
			!Configuration::deleteByName('BLOCK_CATEG2_DHTML'))
			return false;
		return true;
	}

	public function getContent(){
		$output = '<h2>'.$this->displayName.'</h2>';
		if (Tools::isSubmit('submitBlockCategories')){
			$maxDepth = (int)(Tools::getValue('maxDepth'));
			$dhtml = Tools::getValue('dhtml');
			$nbrColumns = Tools::getValue('nbrColumns', 4);
			if ($maxDepth < 0)
				$output .= '<div class="alert error">'.$this->l('Maximum depth: Invalid number.').'</div>';
			elseif ($dhtml != 0 && $dhtml != 1)
				$output .= '<div class="alert error">'.$this->l('Dynamic HTML: Invalid choice.').'</div>';
			else{
				Configuration::updateValue('BLOCK_CATEG2_MAX_DEPTH', (int)($maxDepth));
				Configuration::updateValue('BLOCK_CATEG2_DHTML', (int)($dhtml));
				Configuration::updateValue('BLOCK_CATEG2_NBR_COLUMN_FOOTER', $nbrColumns);
				Configuration::updateValue('BLOCK_CATEG2_SORT_WAY', Tools::getValue('BLOCK_CATEG2_SORT_WAY'));
				Configuration::updateValue('BLOCK_CATEG2_SORT', Tools::getValue('BLOCK_CATEG2_SORT'));

				$this->_clearBlockcategoriesCache();
				$output .= '<div class="conf confirm">'.$this->l('Settings updated').'</div>';
			}
		}
		return $output.$this->displayForm();
	}

	public function displayForm(){
		return '
        <iframe src="http://mypresta.eu/content/uploads/2012/09/htmlbox_advertise.html" width="100%" height="130" border="0" style="border:none;"></iframe>
		<form action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'" method="post">
			<fieldset>
				<legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Settings').'</legend>
				<label>'.$this->l('Maximum depth').'</label>
				<div class="margin-form">
					<input type="text" name="maxDepth" value="'.(int)Configuration::get('BLOCK_CATEG2_MAX_DEPTH').'" />
					<p class="clear">'.$this->l('Set the maximum depth of sublevels displayed in this block (0 = infinite)').'</p>
				</div>
				<label>'.$this->l('Dynamic').'</label>

				<div class="margin-form">
					<input type="radio" name="dhtml" id="dhtml_on" value="1" '.(Tools::getValue('dhtml', Configuration::get('BLOCK_CATEG2_DHTML')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="dhtml_on"> <img src="../img/admin/enabled.gif" alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" /></label>
					<input type="radio" name="dhtml" id="dhtml_off" value="0" '.(!Tools::getValue('dhtml', Configuration::get('BLOCK_CATEG2_DHTML')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="dhtml_off"> <img src="../img/admin/disabled.gif" alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" /></label>
					<p class="clear">'.$this->l('Activate dynamic (animated) mode for sublevels.').'</p>
				</div>
				<label>'.$this->l('Sort').'</label>

				<div class="margin-form">
					<input type="radio" name="BLOCK_CATEG2_SORT" id="sort_on" value="0" '.(!Tools::getValue('BLOCK_CATEG2_SORT', Configuration::get('BLOCK_CATEG2_SORT')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="sort_on"> <img src="../modules/'.$this->name.'/sort_number.png" alt="'.$this->l('Enabled').'" title="'.$this->l('By position').'" />'.$this->l('By position').'</label>
					<input type="radio" name="BLOCK_CATEG2_SORT" id="sort_off" value="1" '.(Tools::getValue('BLOCK_CATEG2_SORT', Configuration::get('BLOCK_CATEG2_SORT')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="sort_off"> <img src="../modules/'.$this->name.'/sort_alphabet.png" alt="'.$this->l('Disabled').'" title="'.$this->l('By name').'" />'.$this->l('By name').'</label> -
					<select name="BLOCK_CATEG2_SORT_WAY">
						<option value="0" '.(!Tools::getValue('BLOCK_CATEG2_SORT_WAY', Configuration::get('BLOCK_CATEG2_SORT_WAY')) ? 'selected="selected" ' : '').'>'.$this->l('Ascending').'</option>
						<option value="1" '.(Tools::getValue('BLOCK_CATEG2_SORT_WAY', Configuration::get('BLOCK_CATEG2_SORT_WAY')) ? 'selected="selected" ' : '').'>'.$this->l('Descending').'</option>
					</select>
				</div>
				
				<center><input type="submit" name="submitBlockCategories" value="'.$this->l('Save').'" class="button" /></center>
			</fieldset>
		</form>
        '.'               
		<div style="diplay:block; clear:both; margin-bottom:20px;">
		</div>'.$this->l('like us on Facebook').'</br><iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Ffacebook.com%2Fmypresta&amp;send=false&amp;layout=button_count&amp;width=120&amp;show_faces=true&amp;font=verdana&amp;colorscheme=light&amp;action=like&amp;height=21&amp;appId=276212249177933" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:120px; height:21px; margin-top:10px;" allowtransparency="true"></iframe>
        '.'<div style="float:right; text-align:right; display:inline-block; margin-top:10px; font-size:10px;">
        '.$this->l('Proudly developed by').' <a href="http://mypresta.eu" style="font-weight:bold; color:#B73737">MyPresta<font style="color:black;">.eu</font>.</a>
        </div>';
	}

	public function getTree($resultParents, $resultIds, $maxDepth, $id_category = null, $currentDepth = 0){
		if (is_null($id_category))
			$id_category = $this->context->shop->getCategory();

		$children = array();
		if (isset($resultParents[$id_category]) && count($resultParents[$id_category]) && ($maxDepth == 0 || $currentDepth < $maxDepth))
			foreach ($resultParents[$id_category] as $subcat)
				$children[] = $this->getTree($resultParents, $resultIds, $maxDepth, $subcat['id_category'], $currentDepth + 1);
		if (!isset($resultIds[$id_category]))
			return false;
        $productsCount = (int)Db::getInstance()->getValue('SELECT COUNT(*) FROM '._DB_PREFIX_.'category_product AS cp INNER JOIN '._DB_PREFIX_.'product_shop AS ps ON cp.id_product = ps.id_product WHERE cp.id_category = '. $id_category.' AND ps.active=1 AND ps.id_shop='.$this->context->shop->id);
		$return = array('id' => $id_category, 'link' => $this->context->link->getCategoryLink($id_category, $resultIds[$id_category]['link_rewrite']),
					 'name' => $resultIds[$id_category]['name'], 'desc'=> $resultIds[$id_category]['description'],
					 'children' => $children, 'productsCount'=>$productsCount);
		return $return;
	}

	public function hookLeftColumn($params){	
		if (!$this->isCached('blockcategories2.tpl', $this->getCacheId()))
		{
			// Get all groups for this customer and concatenate them as a string: "1,2,3..."
			$groups = implode(', ', Customer::getGroupsStatic((int)$this->context->customer->id));
			$maxdepth = Configuration::get('BLOCK_CATEG2_MAX_DEPTH');
			if (!$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
				SELECT DISTINCT c.id_parent, c.id_category, cl.name, cl.description, cl.link_rewrite
				FROM `'._DB_PREFIX_.'category` c
				INNER JOIN `'._DB_PREFIX_.'category_lang` cl ON (c.`id_category` = cl.`id_category` AND cl.`id_lang` = '.(int)$this->context->language->id.Shop::addSqlRestrictionOnLang('cl').')
				INNER JOIN `'._DB_PREFIX_.'category_shop` cs ON (cs.`id_category` = c.`id_category` AND cs.`id_shop` = '.(int)$this->context->shop->id.')
				WHERE (c.`active` = 1 OR c.`id_category` = '.(int)Configuration::get('PS_HOME_CATEGORY').')
				AND c.`id_category` != '.(int)Configuration::get('PS_ROOT_CATEGORY').'
				'.((int)$maxdepth != 0 ? ' AND `level_depth` <= '.(int)$maxdepth : '').'
				AND c.id_category IN (SELECT id_category FROM `'._DB_PREFIX_.'category_group` WHERE `id_group` IN ('.pSQL($groups).'))
				ORDER BY `level_depth` ASC, '.(Configuration::get('BLOCK_CATEG2_SORT') ? 'cl.`name`' : 'cs.`position`').' '.(Configuration::get('BLOCK_CATEG2_SORT_WAY') ? 'DESC' : 'ASC')))
				return;

			$resultParents = array();
			$resultIds = array();

			foreach ($result as &$row)
			{
				$resultParents[$row['id_parent']][] = &$row;
				$resultIds[$row['id_category']] = &$row;
			}

			$blockCategTree = $this->getTree($resultParents, $resultIds, Configuration::get('BLOCK_CATEG2_MAX_DEPTH'));
			unset($resultParents, $resultIds);

			$id_category = (int)Tools::getValue('id_category');
			$id_product = (int)Tools::getValue('id_product');
			
			$isDhtml = (Configuration::get('BLOCK_CATEG2_DHTML') == 1 ? true : false);
			if (Tools::isSubmit('id_category'))
			{
				$this->context->cookie->last_visited_category = $id_category;
				$this->smarty->assign('currentCategoryId', $this->context->cookie->last_visited_category);
			}
			if (Tools::isSubmit('id_product'))
			{
				if (!isset($this->context->cookie->last_visited_category)
					|| !Product::idIsOnCategoryId($id_product, array('0' => array('id_category' => $this->context->cookie->last_visited_category)))
					|| !Category::inShopStatic($this->context->cookie->last_visited_category, $this->context->shop))
				{
					$product = new Product($id_product);
					if (isset($product) && Validate::isLoadedObject($product))
						$this->context->cookie->last_visited_category = (int)$product->id_category_default;
				}
				$this->smarty->assign('currentCategoryId', (int)$this->context->cookie->last_visited_category);
			}
			$this->smarty->assign('blockCategTree', $blockCategTree);

			if (file_exists(_PS_THEME_DIR_.'modules/blockcategories2/blockcategories2.tpl'))
				$this->smarty->assign('branche_tpl_path', _PS_THEME_DIR_.'modules/blockcategories2/category-tree-branch2.tpl');
			else
				$this->smarty->assign('branche_tpl_path', _PS_MODULE_DIR_.'blockcategories2/category-tree-branch2.tpl');
			$this->smarty->assign('isDhtml', $isDhtml);
		}
		$display = $this->display(__FILE__, 'blockcategories2.tpl', $this->getCacheId());
		return $display;
	}

	protected function getCacheId($name = null){
		parent::getCacheId($name);

		$groups = implode(', ', Customer::getGroupsStatic((int)$this->context->customer->id));
		$id_product = (int)Tools::getValue('id_product', 0);
		$id_category = (int)Tools::getValue('id_category', 0);
		$id_lang = (int)$this->context->language->id;
		return 'blockcategories|'.(int)Tools::usingSecureMode().'|'.$this->context->shop->id.'|'.$groups.'|'.$id_lang.'|'.$id_product.'|'.$id_category;
	}

	
	public function hookRightColumn($params){
		return $this->hookLeftColumn($params);
	}

	public function hookHeader(){
		$this->context->controller->addJS(_THEME_JS_DIR_.'tools/treeManagement.js');
		$this->context->controller->addCSS(($this->_path).'blockcategories.css', 'all');
	}

	private function _clearBlockcategoriesCache(){
		$this->_clearCache('blockcategories2.tpl');
		$this->_clearCache('blockcategories_footer2.tpl');
	}

	public function hookCategoryAddition($params){
		$this->_clearBlockcategoriesCache();
	}

	public function hookCategoryUpdate($params){
		$this->_clearBlockcategoriesCache();
	}

	public function hookCategoryDeletion($params){
		$this->_clearBlockcategoriesCache();
	}

	public function hookActionAdminMetaControllerUpdate_optionsBefore($params){
		$this->_clearBlockcategoriesCache();
	}
}

class BlockCategories2Update extends BlockCategories2 {  
    public static function version($version){
        $version=(int)str_replace(".","",$version);
        if (strlen($version)==3){$version=(int)$version."0";}
        if (strlen($version)==2){$version=(int)$version."00";}
        if (strlen($version)==1){$version=(int)$version."000";}
        if (strlen($version)==0){$version=(int)$version."0000";}
        return (int)$version;
    }
    
    public static function encrypt($string){
        return base64_encode($string);
    }
    
    public static function verify($module,$key,$version){
        if (ini_get("allow_url_fopen")) {
             if (function_exists("file_get_contents")){
                $actual_version = @file_get_contents('http://dev.mypresta.eu/update/get.php?module='.$module."&version=".self::encrypt($version)."&lic=$key&u=".self::encrypt(_PS_BASE_URL_.__PS_BASE_URI__));
             }
        }
        Configuration::updateValue("update_".$module,date("U"));
        Configuration::updateValue("updatev_".$module,$actual_version); 
        return $actual_version;
    }
}