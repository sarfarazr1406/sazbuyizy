{*
* WhatsApp Sharing Button v1.1
* @author kik-off.com <info@kik-off.com>
* @file whatsapp-button-compare.tpl
*}
{if $PS_WHATSAPP_BUTTON >= 0}
	<p class="whatsapp-button">
	    <a href="whatsapp://send?text={$whatsappbutton_text|escape:'url'}" data-action="share/whatsapp/share" class="btn btn-default btn-whatsapp{if $PS_WHATSAPP_BUTTON == 0} btn-whatsapp-16 btn-xs{elseif $PS_WHATSAPP_BUTTON == 1} btn-whatsapp-24 btn-sm{elseif $PS_WHATSAPP_BUTTON == 2} btn-whatsapp-32 btn-lg btn-block{/if}">
			<span>{l s='Share' mod='whatsappbutton'}</span>
		</a>
	</p>
{/if}
