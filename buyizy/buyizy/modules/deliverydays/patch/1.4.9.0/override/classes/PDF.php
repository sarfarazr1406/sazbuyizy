<?php
class PDF extends PDFCore
{
	/**
	* Main
	*
	* @param object $order Order
	* @param string $mode Download or display (optional)
	*/
	public static function invoice($order, $mode = 'D', $multiple = false, &$pdf = NULL, $slip = false, $delivery = false)
	{
	 	global $cookie;

		if (!Validate::isLoadedObject($order) OR (!$cookie->id_employee AND (!OrderState::invoiceAvailable($order->getCurrentState()) AND !$order->invoice_number)))
			die('Invalid order or invalid order state');
		self::$order = $order;
		self::$orderSlip = $slip;
		self::$delivery = $delivery;
		self::$_iso = strtoupper(Language::getIsoById((int)(self::$order->id_lang)));
		if (!isset(self::$_pdfparams[self::$_iso]))
			self::$_iso = strtoupper(Language::getIsoById((int)_PS_LANG_DEFAULT_));
		
		if ((self::$_priceDisplayMethod = $order->getTaxCalculationMethod()) === false)
			die(self::l('No price display method defined for the customer group'));

		if (!$multiple)
			$pdf = new PDF('P', 'mm', 'A4');

		$pdf->SetAutoPageBreak(true, 35);
		$pdf->StartPageGroup();

		self::$currency = Currency::getCurrencyInstance((int)(self::$order->id_currency));

		$pdf->AliasNbPages();
		$pdf->AddPage();

		$width = 100;
		$pdf->SetX(10);
		$pdf->SetY(25);
		$pdf->SetFont(self::fontname(), '', 12);
		$pdf->Cell($width, 10, self::l('Delivery'), 0, 'L');
		$pdf->Cell($width, 10, self::l('Invoicing'), 0, 'L');
		$pdf->Ln(5);
		$pdf->SetFont(self::fontname(), '', 9);

		$addressType = array(
			'delivery' => array(),
			'invoice' => array(),
		);

		$patternRules = array(
				'optional' => array(
					'address2',
					'company'),
				'avoid' => array(
					'State:iso_code'));

		$addressType = self::generateHeaderAddresses($pdf, $order, $addressType, $patternRules, $width);

		if (Configuration::get('VATNUMBER_MANAGEMENT') AND !empty($addressType['invoice']['addressObject']->vat_number))
		{
			$vat_delivery = '';
			if ($addressType['invoice']['addressObject']->id != $addressType['delivery']['addressObject']->id)
				$vat_delivery = $addressType['delivery']['addressObject']->vat_number;
			$pdf->Cell($width, 10, Tools::iconv('utf-8', self::encoding(), $vat_delivery), 0, 'L');
			$pdf->Cell($width, 10, Tools::iconv('utf-8', self::encoding(), $addressType['invoice']['addressObject']->vat_number), 0, 'L');
			$pdf->Ln(5);
		}

		if ($addressType['invoice']['addressObject']->dni != NULL)
			$pdf->Cell($width, 10,
				self::l('Tax ID number:').' '.Tools::iconv('utf-8', self::encoding(),
				$addressType['invoice']['addressObject']->dni), 0, 'L');

		/*
		 * display order information
		 */
		$carrier = new Carrier(self::$order->id_carrier);
		if ($carrier->name == '0')
				$carrier->name = Configuration::get('PS_SHOP_NAME');
		$history = self::$order->getHistory(self::$order->id_lang);
		foreach($history as $h)
			if ($h['id_order_state'] == Configuration::get('PS_OS_SHIPPING'))
				$shipping_date = $h['date_add'];
		/* start deliverydays */
		if (
			!isset($shipping_date) &&
			($module = Module::getInstanceByName('deliverydays')) &&
			($module->active) &&
			($deliveryDay = $module->getDate(self::$order->id_cart, false))
		) {
			$shipping_date = $deliveryDay['date'];
		}
		/* end deliverydays */
		$pdf->Ln(12);
		$pdf->SetFillColor(240, 240, 240);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetFont(self::fontname(), '', 9);
		if (self::$orderSlip)
			$pdf->Cell(0, 6, self::l('SLIP #').' '.sprintf('%06d', self::$orderSlip->id).' '.self::l('from') . ' ' .Tools::displayDate(self::$orderSlip->date_upd, self::$order->id_lang), 1, 2, 'L', 1);
		elseif (self::$delivery)
			$pdf->Cell(0, 6, self::l('DELIVERY SLIP #').Tools::iconv('utf-8', self::encoding(), Configuration::get('PS_DELIVERY_PREFIX', (int)($cookie->id_lang))).sprintf('%06d', self::$delivery).' '.self::l('from') . ' ' .Tools::displayDate(self::$order->delivery_date, self::$order->id_lang), 1, 2, 'L', 1);
		elseif ((int)self::$order->invoice_date)
			$pdf->Cell(0, 6, self::l('INVOICE #').' '.Tools::iconv('utf-8', self::encoding(), Configuration::get('PS_INVOICE_PREFIX', (int)($cookie->id_lang))).sprintf('%06d', self::$order->invoice_number).' '.self::l('from') . ' ' .Tools::displayDate(self::$order->invoice_date, self::$order->id_lang), 1, 2, 'L', 1);
		else
			$pdf->Cell(0, 6, self::l('Invoice draft'), 1, 2, 'L', 1);

		$pdf->Cell(55, 6, self::l('Order #').' '.sprintf('%06d', self::$order->id), 'L', 0);
		$pdf->Cell(70, 6, self::l('Carrier:').($order->gift ? ' '.Tools::iconv('utf-8', self::encoding(), $carrier->name) : ''), 'L');
		$pdf->Cell(0, 6, self::l('Payment method:'), 'LR');
		$pdf->Ln(5);
		$pdf->Cell(55, 6, (isset($shipping_date) ? self::l('Shipping date:').' '.Tools::displayDate($shipping_date, self::$order->id_lang) : ' '), 'LB', 0);
		$pdf->Cell(70, 6, ($order->gift ? self::l('Gift-wrapped order') : Tools::iconv('utf-8', self::encoding(), $carrier->name)), 'LRB');
		$pdf->Cell(0, 6, Tools::iconv('utf-8', self::encoding(), $order->payment), 'LRB');
		$pdf->Ln(15);
		$pdf->ProdTab((self::$delivery ? true : ''));

		if (!self::$delivery)
		{
			$priceBreakDown = array();
			$pdf->priceBreakDownCalculation($priceBreakDown);
		}

		/* Canada */
		$taxable_address = new Address((int)self::$order->{Configuration::get('PS_TAX_ADDRESS_TYPE')});
		if (!self::$delivery && strtoupper(Country::getIsoById((int)$taxable_address->id_country)) == 'CA')
		{
			$pdf->Ln(15);

			if (self::$orderSlip)
			{
				$id_country = (int)$taxable_address->id_country;
				$id_state = (int)$taxable_address->id_state;
				$id_county = 0;

				// fetch taxes for product
				$products = self::$orderSlip->getOrdersSlipProducts(self::$orderSlip->id, self::$order);
				foreach ($products as $product)
				{
					$tmp_price = $product['product_price'];

					$allTaxes = TaxRulesGroup::getTaxes((int)Product::getIdTaxRulesGroupByIdProduct((int)$product['product_id']), $id_country, $id_state, $id_county);
					foreach ($allTaxes as $res)
					{
						if (!isset($store_all_taxes[$res->id]))
						{
							$store_all_taxes[$res->id] = array();
							$store_all_taxes[$res->id]['amount'] = 0;
						}

						$store_all_taxes[$res->id]['name'] = $res->name[(int)self::$order->id_lang];
						$store_all_taxes[$res->id]['rate'] = $res->rate;

						$unit_tax_amount = $tmp_price * ($res->rate * 0.01);
						$tmp_price = $tmp_price + $unit_tax_amount;
						$store_all_taxes[$res->id]['amount'] += $unit_tax_amount * $product['product_quantity'];
					}
				}

				// fetch taxes for carrier
				$allTaxes = TaxRulesGroup::getTaxes((int)Carrier::getIdTaxRulesGroupByIdCarrier((int)self::$order->id_carrier), $id_country, $id_state, $id_county);
				$nTax = 0;

				foreach ($allTaxes as $res)
				{
					if (!isset($res->id))
						continue;

					if (!isset($store_all_taxes[$res->id]))
						$store_all_taxes[$res->id] = array();
					if (!isset($store_all_taxes[$res->id]['amount']))
						$store_all_taxes[$res->id]['amount'] = 0;
					$store_all_taxes[$res->id]['name'] = $res->name[(int)self::$order->id_lang];
					$store_all_taxes[$res->id]['rate'] = $res->rate;

					if (!$nTax++)
						$store_all_taxes[$res->id]['amount'] += ($priceBreakDown['shippingCostWithoutTax'] * (1 + ($res->rate * 0.01))) - $priceBreakDown['shippingCostWithoutTax'];
					else
					{
						$priceTmp = self::$order->total_shipping / (1 + ($res->rate * 0.01));
						$store_all_taxes[$res->id]['amount'] += self::$order->total_shipping - $priceTmp;
					}
				}

				foreach ($store_all_taxes as $t)
				{
					$pdf->Cell(0, 6, utf8_decode($t['name']).' ('.number_format($t['rate'], 2, '.', '').'%)      '.self::convertSign(Tools::displayPrice($t['amount'], self::$currency, true)), 0, 0, 'R');
					$pdf->Ln(5);
				}
			} else {
				$taxToDisplay = Db::getInstance()->ExecuteS('SELECT * FROM '._DB_PREFIX_.'order_tax WHERE id_order = '.(int)self::$order->id);
				foreach ($taxToDisplay as $t)
				{
					$pdf->Cell(0, 6, utf8_decode($t['tax_name']).' ('.number_format($t['tax_rate'], 2, '.', '').'%)      '.self::convertSign(Tools::displayPrice($t['amount'], self::$currency, true)), 0, 0, 'R');
					$pdf->Ln(5);
				}
			}
		}
		/* End */

		/* Exit if delivery */
		if (!self::$delivery)
		{
			if (!self::$orderSlip)
				$pdf->DiscTab();

			if (!self::$orderSlip OR (self::$orderSlip AND self::$orderSlip->shipping_cost))
			{
				$priceBreakDown['totalWithoutTax'] += Tools::ps_round($priceBreakDown['shippingCostWithoutTax'], 2) + Tools::ps_round($priceBreakDown['wrappingCostWithoutTax'], 2);
				$priceBreakDown['totalWithTax'] += self::$order->total_shipping + self::$order->total_wrapping;
			}
			if (!self::$orderSlip)
			{
				$taxDiscount = self::$order->getTaxesAverageUsed();
				if ($taxDiscount != 0)
					$priceBreakDown['totalWithoutTax'] -= Tools::ps_round(self::$order->total_discounts / (1 + self::$order->getTaxesAverageUsed() * 0.01), 2);
				else
					$priceBreakDown['totalWithoutTax'] -= self::$order->total_discounts;

				// The discount is already applied in Tax Incl mode
				if (self::$_priceDisplayMethod == PS_TAX_EXC)
					$priceBreakDown['totalWithTax'] -= self::$order->total_discounts;
			}

			/*
			 * Display price summation
			 */
			if (Configuration::get('PS_TAX') OR $order->total_products_wt != $order->total_products)
			{
				$pdf->Ln(5);
				$pdf->SetFont(self::fontname(), 'B', 8);
				$width = 165;
				$pdf->Cell($width, 0, self::l('Total products (tax excl.)').' : ', 0, 0, 'R');
				$pdf->Cell(0, 0, (self::$orderSlip ? '-' : '').self::convertSign(Tools::displayPrice($priceBreakDown['totalProductsWithoutTax'], self::$currency, true)), 0, 0, 'R');
				$pdf->Ln(4);

				$pdf->SetFont(self::fontname(), 'B', 8);
				$width = 165;
				$pdf->Cell($width, 0, self::l('Total products (tax incl.)').' : ', 0, 0, 'R');
				$pdf->Cell(0, 0, (self::$orderSlip ? '-' : '').self::convertSign(Tools::displayPrice($priceBreakDown['totalProductsWithTax'], self::$currency, true)), 0, 0, 'R');
				$pdf->Ln(4);
			}
			else
			{
				$pdf->Ln(5);
				$pdf->SetFont(self::fontname(), 'B', 8);
				$width = 165;
				$pdf->Cell($width, 0, self::l('Total products ').' : ', 0, 0, 'R');
				$pdf->Cell(0, 0, (self::$orderSlip ? '-' : '').self::convertSign(Tools::displayPrice($priceBreakDown['totalProductsWithoutTax'], self::$currency, true)), 0, 0, 'R');
				$pdf->Ln(4);
			}

			if (!self::$orderSlip AND self::$order->total_discounts != '0.00')
			{
				$pdf->Cell($width, 0, self::l('Total discounts (tax incl.)').' : ', 0, 0, 'R');
				$pdf->Cell(0, 0, (!self::$orderSlip ? '-' : '').self::convertSign(Tools::displayPrice(self::$order->total_discounts, self::$currency, true)), 0, 0, 'R');
				$pdf->Ln(4);
			}

			if (isset(self::$order->total_wrapping) and ((float)(self::$order->total_wrapping) > 0))
			{
				$pdf->Cell($width, 0, self::l('Total gift-wrapping').' : ', 0, 0, 'R');
				if (self::$_priceDisplayMethod == PS_TAX_EXC)
					$pdf->Cell(0, 0, (self::$orderSlip ? '-' : '').self::convertSign(Tools::displayPrice($priceBreakDown['wrappingCostWithoutTax'], self::$currency, true)), 0, 0, 'R');
				else
					$pdf->Cell(0, 0, (self::$orderSlip ? '-' : '').self::convertSign(Tools::displayPrice(self::$order->total_wrapping, self::$currency, true)), 0, 0, 'R');
				$pdf->Ln(4);
			}

			if (self::$order->total_shipping != '0.00' AND (!self::$orderSlip OR (self::$orderSlip AND self::$orderSlip->shipping_cost)))
			{
				if (self::$_priceDisplayMethod == PS_TAX_EXC)
                {
                    $pdf->Cell($width, 0, self::l('Total shipping (tax excl.)').' : ', 0, 0, 'R');
					$pdf->Cell(0, 0, (self::$orderSlip ? '-' : '').self::convertSign(Tools::displayPrice(Tools::ps_round($priceBreakDown['shippingCostWithoutTax'], 2), self::$currency, true)), 0, 0, 'R');
                }
				else
                {
                    $pdf->Cell($width, 0, self::l('Total shipping (tax incl.)').' : ', 0, 0, 'R');
					$pdf->Cell(0, 0, (self::$orderSlip ? '-' : '').self::convertSign(Tools::displayPrice(self::$order->total_shipping, self::$currency, true)), 0, 0, 'R');
                }
				$pdf->Ln(4);
			}

			if (Configuration::get('PS_TAX') OR $order->total_products_wt != $order->total_products)
			{
				$pdf->Cell($width, 0, self::l('Total').' '.(self::$_priceDisplayMethod == PS_TAX_EXC ? self::l(' (tax incl.)') : self::l(' (tax excl.)')).' : ', 0, 0, 'R');
				$pdf->Cell(0, 0, (self::$orderSlip ? '-' : '').self::convertSign(Tools::displayPrice((self::$_priceDisplayMethod == PS_TAX_EXC ? $priceBreakDown['totalWithTax'] : $priceBreakDown['totalWithoutTax']), self::$currency, true)), 0, 0, 'R');
				$pdf->Ln(4);
				$pdf->Cell($width, 0, self::l('Total').' '.(self::$_priceDisplayMethod == PS_TAX_EXC ? self::l(' (tax excl.)') : self::l(' (tax incl.)')).' : ', 0, 0, 'R');
				$pdf->Cell(0, 0, (self::$orderSlip ? '-' : '').self::convertSign(Tools::displayPrice((self::$_priceDisplayMethod == PS_TAX_EXC ? $priceBreakDown['totalWithoutTax'] : $priceBreakDown['totalWithTax']), self::$currency, true)), 0, 0, 'R');
				$pdf->Ln(4);
			}
			else
			{
				$pdf->Cell($width, 0, self::l('Total').' : ', 0, 0, 'R');
				$pdf->Cell(0, 0, (self::$orderSlip ? '-' : '').self::convertSign(Tools::displayPrice(($priceBreakDown['totalWithoutTax']), self::$currency, true)), 0, 0, 'R');
				$pdf->Ln(4);
			}

			$pdf->TaxTab($priceBreakDown);
		}
		Hook::PDFInvoice($pdf, self::$order->id);

		if (!$multiple)
			return $pdf->Output(sprintf('%06d', self::$order->id).'.pdf', $mode);
	}
}

