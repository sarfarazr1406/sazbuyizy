<?php
/*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class SearchControllerCore extends FrontController
{
	public $php_self = 'search';
	public $instant_search;
	public $ajax_search;

	/**
	 * Initialize search controller
	 * @see FrontController::init()
	 */
	public function init()
	{
		parent::init();

		$this->instant_search = Tools::getValue('instantSearch');

		$this->ajax_search = Tools::getValue('ajaxSearch');

		if ($this->instant_search || $this->ajax_search)
		{
			$this->display_header = false;
			$this->display_footer = false;
		}
	}

	/**
	 * Assign template vars related to page content
	 * @see FrontController::initContent()
	 */
	public function initContent()
	{
		parent::initContent();

		$query = Tools::replaceAccentedChars(urldecode(Tools::getValue('q')));
		$original_query = Tools::getValue('q');
		if ($this->ajax_search)
		{
			$searchResults = Search::find((int)(Tools::getValue('id_lang')), $query, 1, 10, 'position', 'desc', true);
			foreach ($searchResults as &$product)
				$product['product_link'] = $this->context->link->getProductLink($product['id_product'], $product['prewrite'], $product['crewrite']);
				$combinations = $this->getProductAttributeCombinations($searchResults);
				$specificprice=$this->getProductSpecificPrice($searchResults);
			die(Tools::jsonEncode($searchResults));
		}

		if ($this->instant_search && !is_array($query))
		{
			$this->productSort();
			$this->n = abs((int)(Tools::getValue('n', Configuration::get('PS_PRODUCTS_PER_PAGE'))));
			$this->p = abs((int)(Tools::getValue('p', 1)));
			$search = Search::find($this->context->language->id, $query, 1, 10, 'position', 'desc');
			Hook::exec('actionSearch', array('expr' => $query, 'total' => $search['total']));
			$nbProducts = $search['total'];
			$this->pagination($nbProducts);

			$this->addColorsToProductList($search['result']);
            $combinations = $this->getProductAttributeCombinations($search['result']);
			$specificprice=$this->getProductSpecificPrice($search['result']);
			$this->context->smarty->assign(array(
				'products' => $search['result'], // DEPRECATED (since to 1.4), not use this: conflict with block_cart module
				'search_products' => $search['result'],
				'nbProducts' => $search['total'],
				'search_query' => $original_query,
				'instant_search' => $this->instant_search,
				'homeSize' => Image::getSize(ImageType::getFormatedName('home'))));
		}
		elseif (($query = Tools::getValue('search_query', Tools::getValue('ref'))) && !is_array($query))
		{
			$this->productSort();
			$this->n = abs((int)(Tools::getValue('n', Configuration::get('PS_PRODUCTS_PER_PAGE'))));
			$this->p = abs((int)(Tools::getValue('p', 1)));
			$original_query = $query;
			$query = Tools::replaceAccentedChars(urldecode($query));			
			$search = Search::find($this->context->language->id, $query, $this->p, $this->n, $this->orderBy, $this->orderWay);
			foreach ($search['result'] as &$product)
				$product['link'] .= (strpos($product['link'], '?') === false ? '?' : '&').'search_query='.urlencode($query).'&results='.(int)$search['total'];
			Hook::exec('actionSearch', array('expr' => $query, 'total' => $search['total']));
			$nbProducts = $search['total'];
			$this->pagination($nbProducts);

			$this->addColorsToProductList($search['result']);
            $combinations = $this->getProductAttributeCombinations($search['result']);
			$specificprice=$this->getProductSpecificPrice($search['result']);
			$this->context->smarty->assign(array(
				'products' => $search['result'], // DEPRECATED (since to 1.4), not use this: conflict with block_cart module
				'search_products' => $search['result'],
				'nbProducts' => $search['total'],
				'search_query' => $original_query,
				'homeSize' => Image::getSize(ImageType::getFormatedName('home'))));
		}
		elseif (($tag = urldecode(Tools::getValue('tag'))) && !is_array($tag))
		{
			$nbProducts = (int)(Search::searchTag($this->context->language->id, $tag, true));
			$this->pagination($nbProducts);
			$result = Search::searchTag($this->context->language->id, $tag, false, $this->p, $this->n, $this->orderBy, $this->orderWay);
			Hook::exec('actionSearch', array('expr' => $tag, 'total' => count($result)));

			$this->addColorsToProductList($result);
            $combinations = $this->getProductAttributeCombinations($result);
			$specificprice=$this->getProductSpecificPrice($search['result']);
			$this->context->smarty->assign(array(
				'search_tag' => $tag,
				'products' => $result, // DEPRECATED (since to 1.4), not use this: conflict with block_cart module
				'search_products' => $result,
				'nbProducts' => $nbProducts,
				'homeSize' => Image::getSize(ImageType::getFormatedName('home'))));
		}
		else
		{
			$this->context->smarty->assign(array(
				'products' => array(),
				'search_products' => array(),
				'pages_nb' => 1,
				'nbProducts' => 0));
		}
		$this->context->smarty->assign(array('add_prod_display' => Configuration::get('PS_ATTRIBUTE_CATEGORY_DISPLAY'), 'comparator_max_item' => Configuration::get('PS_COMPARATOR_MAX_ITEM')));
        $this->context->smarty->assign('combinations', $combinations);
		$this->context->smarty->assign('s_price', $specificprice);
		$this->setTemplate(_PS_THEME_DIR_.'search.tpl');
	}

	public function getProductAttributeCombinations($products) {
        $combinations = array();

        foreach($products as $product)
        {
            // load product object
            $product = new Product ($product['id_product'], $this->context->language->id);

            // get the product combinations data
            // create array combinations with key = id_product
            $combinations[$product->id] = $product->getAttributeCombinations($this->context->language->id);
		}
        return $combinations;
    }

    public function getProductAttributeCombinationsSingle($product) {
		$comb = array();
		$comb = $product->getAttributeCombinations($this->context->language->id);
		return $comb;
	}

    public function getProductSpecificPrice($products) {
 	     $s_price = array();

        foreach($products as $product)
        {
            $product = new Product ($product['id_product'], $this->context->language->id);
		    $allComb = $this->getProductAttributeCombinationsSingle($product);
		    foreach($allComb as $cc) {
			    if($cc != null)
                    $s_price[$cc['id_product_attribute']] = SpecificPrice::getSpecificPrice($product->id,0,0,0,0,0,$cc['id_product_attribute']);
	        }
	    }
        return $s_price;
    }

	public function displayHeader($display = true)
	{
		if (!$this->instant_search && !$this->ajax_search)
			parent::displayHeader();
		else
			$this->context->smarty->assign('static_token', Tools::getToken(false));
	}

	public function displayFooter($display = true)
	{
		if (!$this->instant_search && !$this->ajax_search)
			parent::displayFooter();
	}

	public function setMedia()
	{
		parent::setMedia();

		if (!$this->instant_search && !$this->ajax_search)
			$this->addCSS(_THEME_CSS_DIR_.'product_list.css');
	}
}
