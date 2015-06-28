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
		if ((self::$_priceDisplayMethod = $order->getTaxCalculationMethod()) === false)
			die(self::l('No price display method defined for the customer group'));

		if (!$multiple)
			$pdf = new PDF('P', 'mm', 'A4');

		$pdf->SetAutoPageBreak(true, 35);
		$pdf->StartPageGroup();

		self::$currency = Currency::getCurrencyInstance((int)(self::$order->id_currency));

		$pdf->AliasNbPages();
		$pdf->AddPage();
		/* Display address information */
		$invoice_address = new Address((int)($order->id_address_invoice));
		$invoiceState = $invoice_address->id_state ? new State($invoice_address->id_state) : false;
		$delivery_address = new Address((int)($order->id_address_delivery));
		$deliveryState = $delivery_address->id_state ? new State($delivery_address->id_state) : false;

		$ordered_adr_fields = AddressFormat::getOrderedAddressFields($invoice_address->id_country);
 
		$optional_fields = array(
						'address2' => 1
						, 'company' => 1
					);
		$ignore_fields = array(
						'phone'	=> 1
						, 'mobile_phone' =>1
					);
		
		$width = 100;

		$pdf->SetX(10);
		$pdf->SetY(25);
		$pdf->SetFont(self::fontname(), '', 12);
		$pdf->Cell($width, 10, self::l('Delivery'), 0, 'L');
		$pdf->Cell($width, 10, self::l('Invoicing'), 0, 'L');
		$pdf->Ln(5);
		$pdf->SetFont(self::fontname(), '', 9);


		foreach ($ordered_adr_fields as $adr_line)
		{
			$line_fields = explode(" ", trim($adr_line));

			$tmp_inv_vals = array();
			$tmp_dlv_vals = array();
		
			foreach($line_fields as $field_name)
			{
				// if not skip 
				if (!isset($ignore_fields[$field_name]))
				{
					$tmp_inv = $invoice_address->{$field_name};
					$tmp_dlv = $delivery_address->{$field_name};
					if (!((empty($tmp_inv) || $tmp_inv == '') && isset($optional_fields[$field_name])))
					{
						$tmp_inv = ($field_name == "country") ? $tmp_inv.($deliveryState ? ' - '.$deliveryState->name : ''): $tmp_inv;
						$tmp_inv_vals[] = Tools::iconv('utf-8', self::encoding(), $tmp_inv);
					}
					if (!((empty($tmp_dlv) || $tmp_dlv == '') && isset($optional_fields[$field_name])))
					{
						$tmp_dlv = ($field_name == "country") ? $tmp_dlv.($deliveryState ? ' - '.$deliveryState->name : ''): $tmp_dlv;
						$tmp_dlv_vals[] = Tools::iconv('utf-8', self::encoding(), $tmp_dlv);
					}
				}
			}
			$str_inv_vals = implode(" ", $tmp_inv_vals);
			$str_dlv_vals = implode(" ", $tmp_dlv_vals);

			$need_nl = false;
			if (!empty($str_dlv_vals) && $str_dlv_vals != '' && $str_dlv_vals != ' ')
			{
				$need_nl = true;
				$pdf->Cell($width, 10, $str_dlv_vals, 0, 'L');
			}
			if (!empty($str_inv_vals) && $str_inv_vals != '' && $str_inv_vals != ' ')
			{
				$need_nl = true;
				$pdf->Cell($width, 10, $str_inv_vals, 0, 'L');
			}

			if ($need_nl)
				$pdf->Ln(5);

		}


		if (Configuration::get('VATNUMBER_MANAGEMENT') AND !empty($invoice_address->vat_number))
		{
			$vat_delivery = '';
			if ($invoice_address->id != $delivery_address->id)
				$vat_delivery = $delivery_address->vat_number;
			$pdf->Cell($width, 10, Tools::iconv('utf-8', self::encoding(), $vat_delivery), 0, 'L');
			$pdf->Cell($width, 10, Tools::iconv('utf-8', self::encoding(), $invoice_address->vat_number), 0, 'L');
			$pdf->Ln(5);
		}

		$pdf->Cell($width, 10, $delivery_address->phone, 0, 'L');
		if($invoice_address->dni != NULL)
			$pdf->Cell($width, 10, self::l('Tax ID number:').' '.Tools::iconv('utf-8', self::encoding(), $invoice_address->dni), 0, 'L');
		if (!empty($delivery_address->phone_mobile))
		{
			$pdf->Ln(5);
			$pdf->Cell($width, 10, $delivery_address->phone_mobile, 0, 'L');
		}

		/*
		 * display order information
		 */
		$carrier = new Carrier(self::$order->id_carrier);
		if ($carrier->name == '0')
				$carrier->name = Configuration::get('PS_SHOP_NAME');
		$history = self::$order->getHistory(self::$order->id_lang);
		foreach($history as $h)
			if ($h['id_order_state'] == _PS_OS_SHIPPING_)
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
			$pdf->Cell(0, 6, self::l('SLIP #').sprintf('%06d', self::$orderSlip->id).' '.self::l('from') . ' ' .Tools::displayDate(self::$orderSlip->date_upd, self::$order->id_lang), 1, 2, 'L', 1);
		elseif (self::$delivery)
			$pdf->Cell(0, 6, self::l('DELIVERY SLIP #').Configuration::get('PS_DELIVERY_PREFIX', (int)($cookie->id_lang)).sprintf('%06d', self::$delivery).' '.self::l('from') . ' ' .Tools::displayDate(self::$order->delivery_date, self::$order->id_lang), 1, 2, 'L', 1);
		else
			$pdf->Cell(0, 6, self::l('INVOICE #').Configuration::get('PS_INVOICE_PREFIX', (int)($cookie->id_lang)).sprintf('%06d', self::$order->invoice_number).' '.self::l('from') . ' ' .Tools::displayDate(self::$order->invoice_date, self::$order->id_lang), 1, 2, 'L', 1);
		$pdf->Cell(55, 6, self::l('Order #').sprintf('%06d', self::$order->id), 'L', 0);
		$pdf->Cell(70, 6, self::l('Carrier:').($order->gift ? ' '.Tools::iconv('utf-8', self::encoding(), $carrier->name) : ''), 'L');
		$pdf->Cell(0, 6, self::l('Payment method:'), 'LR');
		$pdf->Ln(5);
		$pdf->Cell(55, 6, (isset($shipping_date) ? self::l('Shipping date:').' '.Tools::displayDate($shipping_date, self::$order->id_lang) : ' '), 'LB', 0);
		$pdf->Cell(70, 6, ($order->gift ? self::l('Gift-wrapped order') : Tools::iconv('utf-8', self::encoding(), $carrier->name)), 'LRB');
		$pdf->Cell(0, 6, Tools::iconv('utf-8', self::encoding(), $order->payment), 'LRB');
		$pdf->Ln(15);
		$pdf->ProdTab((self::$delivery ? true : ''));

		/* Exit if delivery */
		if (!self::$delivery)
		{
			if (!self::$orderSlip)
				$pdf->DiscTab();
			$priceBreakDown = array();
			$pdf->priceBreakDownCalculation($priceBreakDown);

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
				$pdf->Cell(0, 0, (self::$orderSlip ? '-' : '').self::convertSign(Tools::displayPrice($priceBreakDown['totalProductsWithoutTax'], self::$currency, true, false)), 0, 0, 'R');
				$pdf->Ln(4);

				$pdf->SetFont(self::fontname(), 'B', 8);
				$width = 165;
				$pdf->Cell($width, 0, self::l('Total products (tax incl.)').' : ', 0, 0, 'R');
				$pdf->Cell(0, 0, (self::$orderSlip ? '-' : '').self::convertSign(Tools::displayPrice($priceBreakDown['totalProductsWithTax'], self::$currency, true, false)), 0, 0, 'R');
				$pdf->Ln(4);
			}
			else
			{
				$pdf->Ln(5);
				$pdf->SetFont(self::fontname(), 'B', 8);
				$width = 165;
				$pdf->Cell($width, 0, self::l('Total products ').' : ', 0, 0, 'R');
				$pdf->Cell(0, 0, (self::$orderSlip ? '-' : '').self::convertSign(Tools::displayPrice($priceBreakDown['totalProductsWithoutTax'], self::$currency, true, false)), 0, 0, 'R');
				$pdf->Ln(4);
			}

			if (!self::$orderSlip AND self::$order->total_discounts != '0.00')
			{
				$pdf->Cell($width, 0, self::l('Total discounts (tax incl.)').' : ', 0, 0, 'R');
				$pdf->Cell(0, 0, (!self::$orderSlip ? '-' : '').self::convertSign(Tools::displayPrice(self::$order->total_discounts, self::$currency, true, false)), 0, 0, 'R');
				$pdf->Ln(4);
			}

			if(isset(self::$order->total_wrapping) and ((float)(self::$order->total_wrapping) > 0))
			{
				$pdf->Cell($width, 0, self::l('Total gift-wrapping').' : ', 0, 0, 'R');
				if (self::$_priceDisplayMethod == PS_TAX_EXC)
					$pdf->Cell(0, 0, (self::$orderSlip ? '-' : '').self::convertSign(Tools::displayPrice($priceBreakDown['wrappingCostWithoutTax'], self::$currency, true, false)), 0, 0, 'R');
				else
					$pdf->Cell(0, 0, (self::$orderSlip ? '-' : '').self::convertSign(Tools::displayPrice(self::$order->total_wrapping, self::$currency, true, false)), 0, 0, 'R');
				$pdf->Ln(4);
			}

			if (self::$order->total_shipping != '0.00' AND (!self::$orderSlip OR (self::$orderSlip AND self::$orderSlip->shipping_cost)))
			{
				$pdf->Cell($width, 0, self::l('Total shipping').' : ', 0, 0, 'R');
				if (self::$_priceDisplayMethod == PS_TAX_EXC)
					$pdf->Cell(0, 0, (self::$orderSlip ? '-' : '').self::convertSign(Tools::displayPrice(Tools::ps_round($priceBreakDown['shippingCostWithoutTax'], 2), self::$currency, true, false)), 0, 0, 'R');
				else
					$pdf->Cell(0, 0, (self::$orderSlip ? '-' : '').self::convertSign(Tools::displayPrice(self::$order->total_shipping, self::$currency, true, false)), 0, 0, 'R');
				$pdf->Ln(4);
			}

			if (Configuration::get('PS_TAX') OR $order->total_products_wt != $order->total_products)
			{
				$pdf->Cell($width, 0, self::l('Total').' '.(self::$_priceDisplayMethod == PS_TAX_EXC ? self::l(' (tax incl.)') : self::l(' (tax excl.)')).' : ', 0, 0, 'R');
				$pdf->Cell(0, 0, (self::$orderSlip ? '-' : '').self::convertSign(Tools::displayPrice((self::$_priceDisplayMethod == PS_TAX_EXC ? $priceBreakDown['totalWithTax'] : $priceBreakDown['totalWithoutTax']), self::$currency, true, false)), 0, 0, 'R');
				$pdf->Ln(4);
				$pdf->Cell($width, 0, self::l('Total').' '.(self::$_priceDisplayMethod == PS_TAX_EXC ? self::l(' (tax excl.)') : self::l(' (tax incl.)')).' : ', 0, 0, 'R');
				$pdf->Cell(0, 0, (self::$orderSlip ? '-' : '').self::convertSign(Tools::displayPrice((self::$_priceDisplayMethod == PS_TAX_EXC ? $priceBreakDown['totalWithoutTax'] : $priceBreakDown['totalWithTax']), self::$currency, true, false)), 0, 0, 'R');
				$pdf->Ln(4);
			}
			else
			{
				$pdf->Cell($width, 0, self::l('Total').' : ', 0, 0, 'R');
				$pdf->Cell(0, 0, (self::$orderSlip ? '-' : '').self::convertSign(Tools::displayPrice(($priceBreakDown['totalWithoutTax']), self::$currency, true, false)), 0, 0, 'R');
				$pdf->Ln(4);
			}

			$pdf->TaxTab($priceBreakDown);
		}
		Hook::PDFInvoice($pdf, self::$order->id);

		if (!$multiple)
			return $pdf->Output(sprintf('%06d', self::$order->id).'.pdf', $mode);
	}
}

