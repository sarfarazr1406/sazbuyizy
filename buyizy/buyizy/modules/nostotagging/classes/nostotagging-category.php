<?php
/**
 * 2013-2014 Nosto Solutions Ltd
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to contact@nosto.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    Nosto Solutions Ltd <contact@nosto.com>
 * @copyright 2013-2014 Nosto Solutions Ltd
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

/**
 * Block for tagging categories.
 */
class NostoTaggingCategory extends NostoTaggingBlock
{
	/**
	 * @var string the built category string.
	 */
	public $category_string;

	/**
	 * @inheritdoc
	 */
	public function getRequiredItems()
	{
		return array('category_string');
	}

	/**
	 * @inheritdoc
	 */
	public function populate()
	{
		$category = $this->object;
		if (Validate::isLoadedObject($category))
			$this->category_string = self::buildCategoryString($category->id, $this->context->language->id);
	}

	/**
	 * Builds a tagging string of the given category including all its parent categories.
	 *
	 * @param int $category_id
	 * @param int $lang_id
	 * @return string
	 */
	public static function buildCategoryString($category_id, $lang_id)
	{
		$category_list = array();

		$category = new Category((int)$category_id, $lang_id);

		if (Validate::isLoadedObject($category) && (int)$category->active === 1)
			foreach ($category->getParentsCategories($lang_id) as $parent_category)
				if (isset($parent_category['name'], $parent_category['active']) && (int)$parent_category['active'] === 1)
					$category_list[] = (string)$parent_category['name'];

		if (empty($category_list))
			return '';

		return DS.implode(DS, array_reverse($category_list));
	}
}
