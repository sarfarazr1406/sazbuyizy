     {$Message}
	<br />
	<form action="{$action}" method="post" id="payu_form" name="payu_form" >
			<input type="hidden" name="key" value="{$key}" />
			<input type="hidden" name="txnid" value="{$txnid}" />
			<input type="hidden" name="amount" value="{$amount}" />
			<input type="hidden" name="productinfo" value="{$productinfo}" />
			<input type="hidden" name="firstname" value="{$firstname}" />
			<input type="hidden" name="Lastname" value="{$Lastname}" />
			<input type="hidden" name="Zipcode" value="{$Zipcode}" />
			<input type="hidden" name="email" value="{$email}" />
			<input type="hidden" name="phone" value="{$phone}" />
			<input type="hidden" name="surl" value="{$surl}" />
			<input type="hidden" name="furl" value="{$furl}" />
			<input type="hidden" name="curl" value="{$curl}" />
			<input type="hidden" name="Hash" value="{$Hash}" />
			<input type="hidden" name="Pg" value="{$Pg}" />
			<input type="hidden" name="service_provider" value="{$service_provider}" />
                       
		</form>	
		
		<script type="text/javascript">
		
		document.payu_form.submit();
		
		</script>