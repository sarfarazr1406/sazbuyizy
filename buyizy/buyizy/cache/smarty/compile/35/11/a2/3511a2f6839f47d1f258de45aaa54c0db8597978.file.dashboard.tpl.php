<?php /* Smarty version Smarty-3.1.19, created on 2015-06-19 12:39:48
         compiled from "/home/buyizy/public_html/modules/affinityitems//views/templates/admin/dashboard.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9279026925583c03ce1f414-14093251%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3511a2f6839f47d1f258de45aaa54c0db8597978' => 
    array (
      0 => '/home/buyizy/public_html/modules/affinityitems//views/templates/admin/dashboard.tpl',
      1 => 1417109329,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9279026925583c03ce1f414-14093251',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ajaxController' => 0,
    'module_dir' => 0,
    'prestashopToken' => 0,
    'hookList' => 0,
    'hook' => 0,
    'aetoken' => 0,
    'abtestingPercentage' => 0,
    'recommendation' => 0,
    'data' => 0,
    'siteId' => 0,
    'breakContract' => 0,
    'blacklist' => 0,
    'ip' => 0,
    'syncDiff' => 0,
    'zone1' => 0,
    'configuration' => 0,
    'zone2' => 0,
    'themeList' => 0,
    'theme' => 0,
    'additionalCss' => 0,
    'logs' => 0,
    'log' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5583c03d3e9a03_61813289',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5583c03d3e9a03_61813289')) {function content_5583c03d3e9a03_61813289($_smarty_tpl) {?>

<script>

var step = ['Categories', 'Products', 'Carts', 'Orders', 'Actions'];
function synchronize() {
	$.ajax({
		<?php if ($_smarty_tpl->tpl_vars['ajaxController']->value) {?>
		url: "index.php?controller=AEAjax&configure=affinityitems&ajax",
		<?php } else { ?>
		url: "<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
ajax/synchronize.php",
		<?php }?>
			data: {"synchronize" : true, "getInformation" : true, "token" : "<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['prestashopToken']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"},
			type: "POST",
			async: true,
			success: function (e, t, n) {
				var response = jQuery.parseJSON(e);
				$(".items-box-synchronization-content").empty();
				if(response._ok == true) {
					if(!response._lock && response._percentage == 100) {
						$(".items-box-synchronization-content").append("<p class='items-checked'><?php echo smartyTranslate(array('s'=>'Your system is synchronized','mod'=>'affinityitems'),$_smarty_tpl);?>
</p>");
					} else {
						$(".items-box-synchronization-content").append("<p class='items-loading'><?php echo smartyTranslate(array('s'=>'Install in progress, please wait','mod'=>'affinityitems'),$_smarty_tpl);?>
...</p>");
						$(".items-box-synchronization-content").append("<p><?php echo smartyTranslate(array('s'=>'Step','mod'=>'affinityitems'),$_smarty_tpl);?>
 "+ response._step +" / 5 : </p>");
						$(".items-box-synchronization-content").append("<p>"+step[response._step-1]+" <?php echo smartyTranslate(array('s'=>'synchronization','mod'=>'affinityitems'),$_smarty_tpl);?>
</p>");
					}
				}
			}});
	setTimeout("synchronize()", 10000);
}

function changeZoneTab(name) {
	<?php  $_smarty_tpl->tpl_vars['hook'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['hook']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['hookList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['hook']->key => $_smarty_tpl->tpl_vars['hook']->value) {
$_smarty_tpl->tpl_vars['hook']->_loop = true;
?>
	$('#zone-<?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
').hide();
	<?php } ?>
	$('#zone-'+name+'').show();
}

$(document).ready(function() {
	synchronize();

 	$("#items-wiki").load("http://developer.affinity-engine.fr/affinityitems/prestashop/wikis/fr-page-faq .wiki-holder", function(response, status, xhr) {
    	var html = $("#items-wiki").html();
    	var result = html.replace(/<a href="/g, '<a target="_blank" class="ae-email-color" href="http://developer.affinity-engine.fr/affinityitems/prestashop/wikis/');
    	$("#items-wiki").html(result);
    });

	$('#zone-home').show();
	var slider = $('#slider'),
	input  = $('#input-number');

	input.keydown(function( e ) {
		var value = Number( slider.val() );

		switch ( e.which ) {
			case 38: slider.val( value + 5 ); break;
			case 40: slider.val( value - 5 ); break;
		}
	});

	var dropoptions = {
		accept:".items-item"
	};

	var tabs = new Array();
	$('.items-tab').each(function(index, value) {
		tabs.push(value.id);
	});
	var hash = window.location.hash.substring(1);
	if(hash) {
		showTab(hash);
	} else {
		showTab('home');
	}

	$('#themeSelector').on('change', function() {
		var url = location.search;
		var regex = /id_theme=[0-9]*/i;
		var redirect = url;
		if(regex.exec(url)) {
			redirect = url.replace(regex, 'id_theme='+$('#themeSelector').val());
		} else {
			redirect = url+"&id_theme="+$('#themeSelector').val();
		}
		document.location.href = redirect+'#theme-editor';
	});

	$.each(tabs, function(index, value) {
		$('#' + value).click(function(){showTab(value);});
	});

	function showTab(name) {
		window.location.hash = '#' + name;
		$.each(tabs, function(index, value) {
			var tab     = $('#' + value);
			var content = $('#content-' + value);

			if(name === value) {
				tab.addClass('active');
				content.show();
			} else {
				tab.removeClass('active');
				content.hide();
			}
		});
	}

	$('#registerTheme').click(function() {
		$('.items-register-theme').slideDown();
		return false;
	});

	$('.zone-tab').click(function() {
		$( ".zone-tab" ).each(function( index ) {
			$(this).css("color", "black");
			$(this).css("font-weight", "initial");
			$(this).css("border", "1px solid #bdc3c7");
			$(this).css("border-bottom-width", "6px");
		});
		$(this).css("color", "#604a7b");
		$(this).css("font-weight", "bold");
		$(this).css("border", "1px solid rgb(96, 74, 123)");
		$(this).css("border-bottom-width", "6px");
	});

	$('.ae-type-recommendation-select').on("change", function() {
		var zone = $(this).parent().parent();
		if($(this).val() == "recoAllFiltered") {
			$(this).closest(zone).find(".items-reco-all-filtered").fadeIn();
		} else {
			$(this).closest(zone).find(".items-reco-all-filtered").hide();
		}
	});

	$('.items-reco-all-filtered-select').on("change", function() {
		if($(this).val() == "byCategory") {
			$(this).closest('.items-reco-all-filtered').find(".categoryIds").show();
			$(this).closest('.items-reco-all-filtered').find(".attributeIds").hide();
			$(this).closest('.items-reco-all-filtered').find(".featureIds").hide();
		} else if($(this).val() == "byAttribute") {
			$(this).closest('.items-reco-all-filtered').find(".categoryIds").hide();
			$(this).closest('.items-reco-all-filtered').find(".attributeIds").show();
			$(this).closest('.items-reco-all-filtered').find(".featureIds").hide();
		} else if($(this).val() == "byFeature") {
			$(this).closest('.items-reco-all-filtered').find(".categoryIds").hide();
			$(this).closest('.items-reco-all-filtered').find(".attributeIds").hide();
			$(this).closest('.items-reco-all-filtered').find(".featureIds").show();
		} else {
			$(this).closest('.items-reco-all-filtered').find(".categoryIds").hide();
			$(this).closest('.items-reco-all-filtered').find(".attributeIds").hide();
			$(this).closest('.items-reco-all-filtered').find(".featureIds").hide();
		}
	});

	var toolbox = 'default';
	$('.toolbox-button').click(function() {
		$('.' + toolbox + '-toolbox').hide();
		toolbox = $(this).attr('toolbox');
		$('.' + toolbox + '-toolbox').show();
	});

	$("#myonoffswitch").on('change', function(){
		var checked = $(this).is(':checked') ? 1 : 0;
		$.ajax({
			<?php if ($_smarty_tpl->tpl_vars['ajaxController']->value) {?>
			url: "index.php?controller=AEAjax&configure=affinityitems&ajax",
			<?php } else { ?>
			url: "<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
ajax/property.php",
			<?php }?>
			type: "POST",
			data : {"activation" : checked, "token" : "<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['prestashopToken']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
", "aetoken" : '<?php echo $_smarty_tpl->tpl_vars['aetoken']->value;?>
'},
			async: false,
			success: function (e, t, n) {
				if(checked) {
					$(".items-box-description.notactivate").css("display", "block");
					$(".items-box-description.notactivate").slideUp();
				} else {
					$(".items-box-description.notactivate").slideDown();
				}
			}
		});
	});

	$('.items-tooltip').powerTip({
		placement: 's',
		smartPlacement: true
	});


	$("#slider").noUiSlider({
		start: <?php echo $_smarty_tpl->tpl_vars['abtestingPercentage']->value;?>
,
		range: {
			'min': 0,
			'max': 100
		},
		step: 5,
		connect: 'lower',
		serialization: {
			lower: [
			$.Link({
				target: $('#input-number'),
				format: {
					decimals: 0
				}
			})
			]
		}
	}).change( function(){
		$.ajax({
			<?php if ($_smarty_tpl->tpl_vars['ajaxController']->value) {?>
			url: "index.php?controller=AEAjax&configure=affinityitems&ajax",
			<?php } else { ?>
			url: "<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
ajax/property.php",
			<?php }?>
			type: "POST",
			data : {"percentage" : $("#input-number").val(), "token" : "<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['prestashopToken']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
", "aetoken" : '<?php echo $_smarty_tpl->tpl_vars['aetoken']->value;?>
'},
			async: false,
			success: function (e, t, n) {}
		});
	});
	<?php echo $_smarty_tpl->getSubTemplate ("./live-editor.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

});

</script>

<div class="items-wrapper">
	<div class="items-header">
		<div class="aelogo"></div>
	</div>
	<div class="items-tabs">
		<div id="home" class="items-first-tab items-tab active">
			<i class="fa fa-home"></i> 
			<?php echo smartyTranslate(array('s'=>'Home','mod'=>'affinityitems'),$_smarty_tpl);?>

		</div>
		<div id="config" class="items-tab">
			<i class="fa fa-wrench"></i> 
			<?php echo smartyTranslate(array('s'=>'Configuration','mod'=>'affinityitems'),$_smarty_tpl);?>

		</div>
		<div id="theme-editor" class="items-tab">
			<i class="fa fa-wrench"></i> 
			<?php echo smartyTranslate(array('s'=>'Theme editor','mod'=>'affinityitems'),$_smarty_tpl);?>

		</div>
		<div id="logs" class="items-tab">
			<i class="fa fa-list-alt"></i> 
			<?php echo smartyTranslate(array('s'=>'Logs','mod'=>'affinityitems'),$_smarty_tpl);?>

		</div>
		<div id="support" class="items-tab items-support">
			<i class="fa fa-life-ring"></i>
			<?php echo smartyTranslate(array('s'=>'Support','mod'=>'affinityitems'),$_smarty_tpl);?>

		</div>
	</div>
	<div id="content-home" class="items-content">
		<div class="items-box items-line items-explain">
			<div class="items-explain-description">
				<strong><?php echo smartyTranslate(array('s'=>'Improve your sales by up to 50%','mod'=>'affinityitems'),$_smarty_tpl);?>
 <br> <?php echo smartyTranslate(array('s'=>'thanks to personalized recommendations.','mod'=>'affinityitems'),$_smarty_tpl);?>
</strong><br><br>
				<p><?php echo smartyTranslate(array('s'=>'Give each visitor the products that fit his tastes','mod'=>'affinityitems'),$_smarty_tpl);?>
</p>
				<p><?php echo smartyTranslate(array('s'=>'& needs and benefit from higher transformation rate','mod'=>'affinityitems'),$_smarty_tpl);?>
</p>
				<p><?php echo smartyTranslate(array('s'=>'average basket and visitors loyalty.','mod'=>'affinityitems'),$_smarty_tpl);?>
</p><br />
				<p><?php echo smartyTranslate(array('s'=>'Easy to install, this service has no fixed costs, requires no commitment, and drives a big bunch of profits.','mod'=>'affinityitems'),$_smarty_tpl);?>
</p><br>
				<strong><?php echo smartyTranslate(array('s'=>'And a free trial offer for 1 month.','mod'=>'affinityitems'),$_smarty_tpl);?>
</strong><br><br>
				<p><?php echo smartyTranslate(array('s'=>'Take no risks try and see !','mod'=>'affinityitems'),$_smarty_tpl);?>
</p>
			</div>
			<div class="items-explain-image">
				<object type="text/html" data="http://www.youtube.com/embed/AIEfj2UV-qU" width="400" height="236"></object>
			</div>
		</div>
		<div class="clear"></div>
		<div class="ae-info-auth">
			<?php echo smartyTranslate(array('s'=>'We can install and configure the Affinity Items module for your website at no extra cost','mod'=>'affinityitems'),$_smarty_tpl);?>

			<br>
			<?php echo smartyTranslate(array('s'=>'Do not hesitate to contact us for any questions :','mod'=>'affinityitems'),$_smarty_tpl);?>

			<ul>
				<li><?php echo smartyTranslate(array('s'=>'The technical support at','mod'=>'affinityitems'),$_smarty_tpl);?>
 <span class="ae-email-color">+33 9 54 52 85 12</span> <?php echo smartyTranslate(array('s'=>'or contact','mod'=>'affinityitems'),$_smarty_tpl);?>
 <a class="ae-email-color" href="mailto:mathieu@affinity-engine.fr">mathieu@affinity-engine.fr</a></li>
				<li><?php echo smartyTranslate(array('s'=>'The commercial service at','mod'=>'affinityitems'),$_smarty_tpl);?>
 <span class="ae-email-color">+33 9 80 47 24 83</span></li>
			</ul>
		</div>
		<div class="clear"></div>
		<div class="items-title">
			<?php echo smartyTranslate(array('s'=>'Général','mod'=>'affinityitems'),$_smarty_tpl);?>

		</div>
		<div class="items-box">
			<div class="items-box-title">
				<?php echo smartyTranslate(array('s'=>'General activation','mod'=>'affinityitems'),$_smarty_tpl);?>

			</div>
			<div class="items-box-content">
				<div class="items-box-description notactivate<?php if ($_smarty_tpl->tpl_vars['recommendation']->value==1) {?> items-hide <?php }?>">
					<?php echo smartyTranslate(array('s'=>'Warning: the recommendation is not yet activated','mod'=>'affinityitems'),$_smarty_tpl);?>

					<?php echo smartyTranslate(array('s'=>'After having configured the different recommendation areas, make sure to enable the general recommendation','mod'=>'affinityitems'),$_smarty_tpl);?>

				</div>
				<div class="clear"></div>
				<div class="onoffswitch">
					<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" <?php if ($_smarty_tpl->tpl_vars['recommendation']->value==1) {?> checked <?php }?>>
					<label class="onoffswitch-label" for="myonoffswitch">
						<span class="onoffswitch-inner"></span>
						<span class="onoffswitch-switch"></span>
					</label>
				</div>
			</div>
		</div>
		<div class="items-box">
			<div class="items-box-title">
				<?php echo smartyTranslate(array('s'=>'Account','mod'=>'affinityitems'),$_smarty_tpl);?>

			</div>
			<div class="items-box-content">
				<div class="items-box-description">
					<?php echo smartyTranslate(array('s'=>'Manage your payment options and access your invoices in the customer area. Also find all the system messages and more detailed statistics on the impact of your personnalization service.','mod'=>'affinityitems'),$_smarty_tpl);?>

				</div>
				<div class="clear"></div>
				<?php if (isset($_smarty_tpl->tpl_vars['data']->value->authToken)) {?>
				<a class="items-manager-button" target="_blank" href="http://manager.affinityitems.com/login/<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['siteId']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
/<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['data']->value->authToken, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
					<div class="items-button">
						<?php echo smartyTranslate(array('s'=>'Access my account','mod'=>'affinityitems'),$_smarty_tpl);?>

					</div>
				</a>
				<?php }?>
			</div>
		</div>
		<div class="items-box">
			<div class="items-box-title">
				<?php echo smartyTranslate(array('s'=>'Synchronization','mod'=>'affinityitems'),$_smarty_tpl);?>
 
			</div>
			<div class="items-box-content">
				<div class="items-box-description">
					<div class="items-box-synchronization-content"></div>
				</div>
			</div>
			<div class="items-box-footer">
				<div class="items-detail grow">
					<a class="items-tooltip" title="<?php echo smartyTranslate(array('s'=>'The personalization service analyzes your catalog and your sales history to compute the profiles of your products and your users.','mod'=>'affinityitems'),$_smarty_tpl);?>
 <br /> <?php echo smartyTranslate(array('s'=>'After this initialization step, the customization service can suggest relevant recommendations to each visitor, even if they come on your website for the first time. The new products and members are then synchronized along the way.','mod'=>'affinityitems'),$_smarty_tpl);?>
 <br /> <?php echo smartyTranslate(array('s'=>'The first step is few minutes to few hours long, depending on the size of your database and the performances of your server.','mod'=>'affinityitems'),$_smarty_tpl);?>
" href="#"><?php echo smartyTranslate(array('s'=>'More about','mod'=>'affinityitems'),$_smarty_tpl);?>
</a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<div class="items-title">
			<?php echo smartyTranslate(array('s'=>'Statistics','mod'=>'affinityitems'),$_smarty_tpl);?>

		</div>
		<div class="items-box">
			<div class="items-box-title">
				<?php echo smartyTranslate(array('s'=>'Guests with','mod'=>'affinityitems'),$_smarty_tpl);?>
 <?php echo smartyTranslate(array('s'=>'recommendations','mod'=>'affinityitems'),$_smarty_tpl);?>

			</div>
			<div class="items-box-content">
				<input id="input-number" type="text">% 
				<div id="slider"></div>
			</div>
			<div class="items-box-footer">
				<div class="items-detail grow">
					<a class="items-tooltip"  title="<?php echo smartyTranslate(array('s'=>'The outcome measurement is based on the AB Testing method, an unbiased and reliable impact measure, no matter the conditions','mod'=>'affinityitems'),$_smarty_tpl);?>
<br><?php echo smartyTranslate(array('s'=>'In this method, a control group of visitors is not eligible for the recommandation.','mod'=>'affinityitems'),$_smarty_tpl);?>
<br><?php echo smartyTranslate(array('s'=>'You can control the AB Testing groups','mod'=>'affinityitems'),$_smarty_tpl);?>
 : <br>• <?php echo smartyTranslate(array('s'=>'First test our solution with a low rate of recommandation','mod'=>'affinityitems'),$_smarty_tpl);?>
 <br>• <?php echo smartyTranslate(array('s'=>'Maximize the rate to benefit from the full recommandation impact','mod'=>'affinityitems'),$_smarty_tpl);?>
" href="#"><?php echo smartyTranslate(array('s'=>'More about','mod'=>'affinityitems'),$_smarty_tpl);?>
</a>				
				</div>
			</div>
		</div>
		<div class="items-box items-stat">
			<div class="items-box-title">
				<?php echo smartyTranslate(array('s'=>'Recommendation number','mod'=>'affinityitems'),$_smarty_tpl);?>

				<?php echo smartyTranslate(array('s'=>'last 30 days','mod'=>'affinityitems'),$_smarty_tpl);?>

			</div>
			<div class="items-box-content">
				<div class="items-main-stat">
					<?php if (isset($_smarty_tpl->tpl_vars['data']->value->recommendation)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value->recommendation;?>
 recos<?php } else { ?> <img src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
/resources/img/error.png"> <?php }?>
				</div>
			</div>
		</div>
		<div class="items-box items-stat">
			<div class="items-box-title">
				<?php echo smartyTranslate(array('s'=>'Sales impact','mod'=>'affinityitems'),$_smarty_tpl);?>

			</div>
			<div class="items-box-content">
				<span class="items-stat-message"><?php echo smartyTranslate(array('s'=>'Find your statistics every month on your registration email','mod'=>'affinityitems'),$_smarty_tpl);?>
</span>
			</div>
		</div>
		<div class="clear"></div>
		<div class="items-title">
			<?php echo smartyTranslate(array('s'=>'Other','mod'=>'affinityitems'),$_smarty_tpl);?>

		</div>

		<form action='#home' method='POST'/>
		<div class="items-box">
			<div class="items-box-title">
				<?php echo smartyTranslate(array('s'=>'Rescind','mod'=>'affinityitems'),$_smarty_tpl);?>

			</div>
			<div class="items-box-content">
				<input id="rescind" type="checkbox" name="breakContract" <?php if ($_smarty_tpl->tpl_vars['breakContract']->value=="1") {?> checked="checked" <?php }?>>
				<label for="rescind"><?php echo smartyTranslate(array('s'=>'Check this box to have your website data deleted on our platform after the uninstallation','mod'=>'affinityitems'),$_smarty_tpl);?>
</label><br>
			</div>
		</div>
		<div class="items-box">
			<div class="items-box-title">
				<?php echo smartyTranslate(array('s'=>'A/B Testing','mod'=>'affinityitems'),$_smarty_tpl);?>
<br><?php echo smartyTranslate(array('s'=>'IP Blacklist','mod'=>'affinityitems'),$_smarty_tpl);?>

			</div>
			<div class="items-box-content">
				<input type="text" name="blacklist" value="<?php if (!empty($_smarty_tpl->tpl_vars['blacklist']->value)) {?><?php  $_smarty_tpl->tpl_vars['ip'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ip']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['blacklist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ip']->key => $_smarty_tpl->tpl_vars['ip']->value) {
$_smarty_tpl->tpl_vars['ip']->_loop = true;
?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['ip']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
;<?php } ?><?php }?>">
			</div>
			<div class="items-box-footer">
				<div class="items-detail grow">
					<a class="items-tooltip" title="" href="#"><?php echo smartyTranslate(array('s'=>'More about','mod'=>'affinityitems'),$_smarty_tpl);?>
</a>				
				</div>
			</div>			
		</div>
		<div class="items-box">
			<div class="items-box-title">
				<?php echo smartyTranslate(array('s'=>'Frequency','mod'=>'affinityitems'),$_smarty_tpl);?>
<br><?php echo smartyTranslate(array('s'=>'of the safety synchronization','mod'=>'affinityitems'),$_smarty_tpl);?>

			</div>
			<div class="items-box-content">
				<input type="text" class="items-sync-diff" name="syncDiff" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['syncDiff']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"> <?php echo smartyTranslate(array('s'=>'minutes','mod'=>'affinityitems'),$_smarty_tpl);?>

			</div>
		</div>
		<input type="submit" value="<?php echo smartyTranslate(array('s'=>'Save','mod'=>'affinityitems'),$_smarty_tpl);?>
" class="items-button-submit items-right">
		<div class="clear"></div>
		</form>
	</div>

	<div id="content-config">

		<div class="items-title">
			<?php echo smartyTranslate(array('s'=>'Recommendation configuration','mod'=>'affinityitems'),$_smarty_tpl);?>
			
			<span class="visit" onclick="javascript:introJs().start();"> <?php echo smartyTranslate(array('s'=>'Help','mod'=>'affinityitems'),$_smarty_tpl);?>
</span>
		</div>

		<div class="zone-config">

		<form action='#config' method='POST'/>

		<input type="hidden" name="configZoneReco" value="1">

		<div class="zone-tabs">
			<?php  $_smarty_tpl->tpl_vars['hook'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['hook']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['hookList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['hook']->key => $_smarty_tpl->tpl_vars['hook']->value) {
$_smarty_tpl->tpl_vars['hook']->_loop = true;
?>
			<?php $_smarty_tpl->tpl_vars["zone1"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['hook']->value)."_1", null, 0);?>
			<?php $_smarty_tpl->tpl_vars["zone2"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['hook']->value)."_2", null, 0);?>
			<div class="zone-tab <?php if ($_smarty_tpl->tpl_vars['hook']->value=='Home') {?> zone-tab-selected <?php }?>" onClick="changeZoneTab('<?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
')">
				<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

				<?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'reco'.$_smarty_tpl->tpl_vars['zone1']->value}=="1"||$_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'reco'.$_smarty_tpl->tpl_vars['zone2']->value}=="1") {?> 
				<span class="lightfire on">(on)</span>
				<?php } else { ?>
				<span class="lightfire">(off)</span>
				<?php }?>
			</div>
			<?php } ?>
		</div>

		<?php  $_smarty_tpl->tpl_vars['hook'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['hook']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['hookList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['hook']->key => $_smarty_tpl->tpl_vars['hook']->value) {
$_smarty_tpl->tpl_vars['hook']->_loop = true;
?>
		<?php $_smarty_tpl->tpl_vars["zone1"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['hook']->value)."_1", null, 0);?>
		<?php $_smarty_tpl->tpl_vars["zone2"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['hook']->value)."_2", null, 0);?>

		<div class="zone" id="zone-<?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
">
			<span class="title">
				<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

			</span>
			<span class="description" data-step="1" data-intro="Pour chaque recommandation vous aurez une explication ici.">
			</span>
			<div class="one" data-step="2" data-intro="Dans ce formulaire, vous configurez la zone haute de la recommandation">
				<div class="position"><?php echo smartyTranslate(array('s'=>'First recommendation zone','mod'=>'affinityitems'),$_smarty_tpl);?>
</div>
				<div class="position-options">
					<div class="onoffswitch" data-step="3" data-intro="Un bouton pour activer la zone">
						<input type="hidden" name="reco<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_1" value="0">
						<input type="checkbox" name="reco<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_1" class="onoffswitch-checkbox" id="reco<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_1" value="1" <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'reco'.$_smarty_tpl->tpl_vars['zone1']->value}=="1") {?> checked <?php }?>>
						<label class="onoffswitch-label" for="reco<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_1">
							<span class="onoffswitch-inner"></span>
							<span class="onoffswitch-switch"></span>
						</label>
					</div>
					<label><?php echo smartyTranslate(array('s'=>'Theme','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label>
					<select data-step="4" data-intro="Un champ pour choisir le style graphique de la zone. Par défaut le style utilisera les classes natives Prestashop si votre design a été conçu dans les normes Prestashop." name="recoTheme<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_1">
						<?php  $_smarty_tpl->tpl_vars['theme'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['theme']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['themeList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['theme']->key => $_smarty_tpl->tpl_vars['theme']->value) {
$_smarty_tpl->tpl_vars['theme']->_loop = true;
?>
						<option <?php if ($_smarty_tpl->tpl_vars['theme']->value['id_theme']==$_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoTheme'.$_smarty_tpl->tpl_vars['zone1']->value}) {?> selected <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['theme']->value['id_theme'];?>
"><?php echo $_smarty_tpl->tpl_vars['theme']->value['name'];?>
</option>
						<?php } ?>
					</select>
					<label><?php echo smartyTranslate(array('s'=>'Type','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label>
					<select class="ae-type-recommendation-select" data-step="5" data-intro="Un champ pour choisir le type de recommandation. La recommandation est personnalisée par défaut, mais vous pouvez utiliser la recommandation complémentaire (cross sell) ou [...]" name="recoType<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_1">
						<?php ob_start();?><?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
<?php $_tmp2=ob_get_clean();?><?php ob_start();?><?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
<?php $_tmp3=ob_get_clean();?><?php if ($_tmp1=="home"||$_tmp2=="left"||$_tmp3=="right") {?>
						<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoType'.$_smarty_tpl->tpl_vars['zone1']->value}=="recoAll") {?> selected <?php }?> value="recoAll">Recommandation personnalisée</option>
						<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoType'.$_smarty_tpl->tpl_vars['zone1']->value}=="recoAllFiltered") {?> selected <?php }?> value="recoAllFiltered">Recommandation personnalisée filtrée</option>
						<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoType'.$_smarty_tpl->tpl_vars['zone1']->value}=="recoLastSeen") {?> selected <?php }?> value="recoLastSeen">Recommandation derniers produits aimés</option>
						<?php } else {?><?php ob_start();?><?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
<?php $_tmp4=ob_get_clean();?><?php if ($_tmp4=="cart") {?>
						<option value="recoCart">Recommandation personnalisée</option>
						<?php } else {?><?php ob_start();?><?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
<?php $_tmp5=ob_get_clean();?><?php if ($_tmp5=="product") {?>
						<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoType'.$_smarty_tpl->tpl_vars['zone1']->value}=="recoSimilar") {?> selected <?php }?> value="recoSimilar">Recommandation personnalisée</option>
						<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoType'.$_smarty_tpl->tpl_vars['zone1']->value}=="recoUpSell") {?> selected <?php }?> value="recoUpSell">Up selling</option>
						<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoType'.$_smarty_tpl->tpl_vars['zone1']->value}=="recoCrossSell") {?> selected <?php }?> value="recoCrossSell">Cross selling</option>
						<?php } else {?><?php ob_start();?><?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
<?php $_tmp6=ob_get_clean();?><?php if ($_tmp6=="category") {?>
						<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoType'.$_smarty_tpl->tpl_vars['zone1']->value}=="recoCategory") {?> selected <?php }?> value="recoCategory">Recommandation personnalisée</option>
						<?php } else {?><?php ob_start();?><?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
<?php $_tmp7=ob_get_clean();?><?php if ($_tmp7=="search") {?>
						<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoType'.$_smarty_tpl->tpl_vars['zone1']->value}=="recoSearch") {?> selected <?php }?> value="recoSearch">Recommandation personnalisée</option>
						<?php }}}}}?>
					</select>
					<br /><br /><br /><br />
					<label class="items-selectors-label"><?php echo smartyTranslate(array('s'=>'Title zone','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label>
					<input class="items-selectors-input" name="recoTitle<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_1" type="text" value="<?php echo $_smarty_tpl->tpl_vars['configuration']->value[mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8')]->{'recoTitle'.$_smarty_tpl->tpl_vars['zone1']->value};?>
">
					<?php ob_start();?><?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
<?php $_tmp8=ob_get_clean();?><?php ob_start();?><?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
<?php $_tmp9=ob_get_clean();?><?php if ($_tmp8=="category"||$_tmp9=="search") {?>
					<label class="items-selectors-label"><?php echo smartyTranslate(array('s'=>'Selector','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label>
					<input class="items-selectors-input" name="recoSelector<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_1" type="text" value="<?php echo $_smarty_tpl->tpl_vars['configuration']->value[mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8')]->{'recoSelector'.$_smarty_tpl->tpl_vars['zone1']->value};?>
">
					<br /><br /><br /><br />
					<label class="items-selectors-position"><?php echo smartyTranslate(array('s'=>'Position','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label>
					<select  name="recoSelectorPosition<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_1">
						<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoSelectorPosition'.$_smarty_tpl->tpl_vars['zone1']->value}=="before") {?> selected <?php }?> value="before">Before</option>
						<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoSelectorPosition'.$_smarty_tpl->tpl_vars['zone1']->value}=="after") {?> selected <?php }?> value="after">After</option>
					</select>
					<?php }?>
					<label class="ae-number-reco-label"><?php echo smartyTranslate(array('s'=>'Recommendation number','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label>
					<input class="ae-number-reco-input" type="number" min="1" max="20" name="recoSize<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_1" value="<?php echo $_smarty_tpl->tpl_vars['configuration']->value[mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8')]->{'recoSize'.$_smarty_tpl->tpl_vars['zone1']->value};?>
">
				</div>
				<div class="clear"></div>
				<?php ob_start();?><?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
<?php $_tmp10=ob_get_clean();?><?php ob_start();?><?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
<?php $_tmp11=ob_get_clean();?><?php ob_start();?><?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
<?php $_tmp12=ob_get_clean();?><?php if ($_tmp10=="home"||$_tmp11=="left"||$_tmp12=="right") {?>
				<div class="items-reco-all-filtered <?php if ($_smarty_tpl->tpl_vars['configuration']->value[mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8')]->{'recoType'.$_smarty_tpl->tpl_vars['zone1']->value}=='recoAllFiltered') {?> items-display <?php }?>">
					<fieldset>
						<legend><?php echo smartyTranslate(array('s'=>'Filtered recommendation','mod'=>'affinityitems'),$_smarty_tpl);?>
</legend>
						<select class="items-reco-all-filtered-select" name="recoFilter<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_1">
							<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoFilter'.$_smarty_tpl->tpl_vars['zone1']->value}=="onSale") {?> selected <?php }?> value="onSale"><?php echo smartyTranslate(array('s'=>'By product on sale','mod'=>'affinityitems'),$_smarty_tpl);?>
</option>
							<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoFilter'.$_smarty_tpl->tpl_vars['zone1']->value}=="byCategory") {?> selected <?php }?> value="byCategory"><?php echo smartyTranslate(array('s'=>'By categories','mod'=>'affinityitems'),$_smarty_tpl);?>
</option>
							<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoFilter'.$_smarty_tpl->tpl_vars['zone1']->value}=="byAttribute") {?> selected <?php }?> value="byAttribute"><?php echo smartyTranslate(array('s'=>'By attributes','mod'=>'affinityitems'),$_smarty_tpl);?>
</option>
							<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoFilter'.$_smarty_tpl->tpl_vars['zone1']->value}=="byFeature") {?> selected <?php }?> value="byFeature"><?php echo smartyTranslate(array('s'=>'By features','mod'=>'affinityitems'),$_smarty_tpl);?>
</option>
						</select>
						<div class="categoryIds <?php if ($_smarty_tpl->tpl_vars['configuration']->value[mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8')]->{'recoFilter'.$_smarty_tpl->tpl_vars['zone1']->value}=='byCategory') {?> items-display <?php }?>">
							<?php echo smartyTranslate(array('s'=>'Filter by category ids (split by semicolon)','mod'=>'affinityitems'),$_smarty_tpl);?>
 : <input name="categoryIds<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_1" value="<?php echo $_smarty_tpl->tpl_vars['configuration']->value[mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8')]->{'categoryIds'.$_smarty_tpl->tpl_vars['zone1']->value};?>
" type="text">
						</div>
						<div class="attributeIds <?php if ($_smarty_tpl->tpl_vars['configuration']->value[mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8')]->{'recoFilter'.$_smarty_tpl->tpl_vars['zone1']->value}=='byAttribute') {?> items-display <?php }?>">
							<?php echo smartyTranslate(array('s'=>'Filter by attribute ids (split by semicolon)','mod'=>'affinityitems'),$_smarty_tpl);?>
 : <input name="attributeIds<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_1" value="<?php echo $_smarty_tpl->tpl_vars['configuration']->value[mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8')]->{'attributeIds'.$_smarty_tpl->tpl_vars['zone1']->value};?>
" type="text">
						</div>
						<div class="featureIds <?php if ($_smarty_tpl->tpl_vars['configuration']->value[mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8')]->{'recoFilter'.$_smarty_tpl->tpl_vars['zone1']->value}=='byFeature') {?> items-display <?php }?>">
							<?php echo smartyTranslate(array('s'=>'Filter by feature ids (split by semicolon)','mod'=>'affinityitems'),$_smarty_tpl);?>
 : <input name="featureIds<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_1" value="<?php echo $_smarty_tpl->tpl_vars['configuration']->value[mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8')]->{'featureIds'.$_smarty_tpl->tpl_vars['zone1']->value};?>
" type="text">
						</div>
					</fieldset>
				</div>
				<?php }?>
			</div>
			<div class="clear"></div>
			<div class="items-hr"></div>
			<div class="two" data-step="6" data-intro="La deuxième zone permet d'afficher une seconde barre de recommandation en dessous de la première.">
				<div class="position"><?php echo smartyTranslate(array('s'=>'Second recommendation zone','mod'=>'affinityitems'),$_smarty_tpl);?>
</div>
				<div class="position-options">
					<div class="onoffswitch">
						<input type="hidden" name="reco<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_2" value="0">
						<input type="checkbox" name="reco<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_2" class="onoffswitch-checkbox" id="reco<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_2" value="1" <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'reco'.$_smarty_tpl->tpl_vars['zone2']->value}=="1") {?> checked <?php }?>>
						<label class="onoffswitch-label" for="reco<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_2">
							<span class="onoffswitch-inner"></span>
							<span class="onoffswitch-switch"></span>
						</label>
					</div>
					<label><?php echo smartyTranslate(array('s'=>'Theme','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label>
					<select name="recoTheme<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_2">
						<?php  $_smarty_tpl->tpl_vars['theme'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['theme']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['themeList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['theme']->key => $_smarty_tpl->tpl_vars['theme']->value) {
$_smarty_tpl->tpl_vars['theme']->_loop = true;
?>
						<option <?php if ($_smarty_tpl->tpl_vars['theme']->value['id_theme']==$_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoTheme'.$_smarty_tpl->tpl_vars['zone2']->value}) {?> selected <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['theme']->value['id_theme'];?>
"><?php echo $_smarty_tpl->tpl_vars['theme']->value['name'];?>
</option>
						<?php } ?>
					</select>
					<label><?php echo smartyTranslate(array('s'=>'Type','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label>
					<select class="ae-type-recommendation-select" name="recoType<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_2">
						<?php ob_start();?><?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
<?php $_tmp13=ob_get_clean();?><?php ob_start();?><?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
<?php $_tmp14=ob_get_clean();?><?php ob_start();?><?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
<?php $_tmp15=ob_get_clean();?><?php if ($_tmp13=="home"||$_tmp14=="left"||$_tmp15=="right") {?>
						<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoType'.$_smarty_tpl->tpl_vars['zone2']->value}=="recoAll") {?> selected <?php }?> value="recoAll">Recommandation personnalisée</option>
						<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoType'.$_smarty_tpl->tpl_vars['zone2']->value}=="recoAllFiltered") {?> selected <?php }?> value="recoAllFiltered">Recommandation personnalisée filtrée</option>
						<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoType'.$_smarty_tpl->tpl_vars['zone2']->value}=="recoLastSeen") {?> selected <?php }?> value="recoLastSeen">Recommandation derniers produits aimés</option>
						<?php } else {?><?php ob_start();?><?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
<?php $_tmp16=ob_get_clean();?><?php if ($_tmp16=="cart") {?>
						<option value="recoCart">Recommandation personnalisée</option>
						<?php } else {?><?php ob_start();?><?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
<?php $_tmp17=ob_get_clean();?><?php if ($_tmp17=="product") {?>
						<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoType'.$_smarty_tpl->tpl_vars['zone2']->value}=="recoSimilar") {?> selected <?php }?> value="recoSimilar">Recommandation personnalisée</option>
						<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoType'.$_smarty_tpl->tpl_vars['zone2']->value}=="recoUpSell") {?> selected <?php }?> value="recoUpSell">Up selling</option>
						<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoType'.$_smarty_tpl->tpl_vars['zone2']->value}=="recoCrossSell") {?> selected <?php }?> value="recoCrossSell">Cross selling</option>
						<?php } else {?><?php ob_start();?><?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
<?php $_tmp18=ob_get_clean();?><?php if ($_tmp18=="category") {?>
						<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoType'.$_smarty_tpl->tpl_vars['zone2']->value}=="recoCategory") {?> selected <?php }?> value="recoCategory">Recommandation personnalisée</option>
						<?php } else {?><?php ob_start();?><?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
<?php $_tmp19=ob_get_clean();?><?php if ($_tmp19=="search") {?>
						<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoType'.$_smarty_tpl->tpl_vars['zone2']->value}=="recoSearch") {?> selected <?php }?> value="recoSearch">Recommandation personnalisée</option>
						<?php }}}}}?>
					</select>
					<br /><br /><br /><br />
					<label class="items-selectors-label"><?php echo smartyTranslate(array('s'=>'Title zone','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label>
					<input class="items-selectors-input" name="recoTitle<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_2" type="text" value="<?php echo $_smarty_tpl->tpl_vars['configuration']->value[mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8')]->{'recoTitle'.$_smarty_tpl->tpl_vars['zone2']->value};?>
">
					<?php ob_start();?><?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
<?php $_tmp20=ob_get_clean();?><?php ob_start();?><?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
<?php $_tmp21=ob_get_clean();?><?php if ($_tmp20=="category"||$_tmp21=="search") {?>
					<label class="items-selectors-label"><?php echo smartyTranslate(array('s'=>'Selector','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label>
					<input class="items-selectors-input" name="recoSelector<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_2" type="text" value="<?php echo $_smarty_tpl->tpl_vars['configuration']->value[mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8')]->{'recoSelector'.$_smarty_tpl->tpl_vars['zone2']->value};?>
">
					<br /><br /><br /><br />
					<label class="items-selectors-position"><?php echo smartyTranslate(array('s'=>'Position','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label>
					<select  name="recoSelectorPosition<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_2">
						<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoSelectorPosition'.$_smarty_tpl->tpl_vars['zone2']->value}=="before") {?> selected <?php }?> value="before">Before</option>
						<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoSelectorPosition'.$_smarty_tpl->tpl_vars['zone2']->value}=="after") {?> selected <?php }?> value="after">After</option>
					</select>
					<?php }?>
					<label class="ae-number-reco-label"><?php echo smartyTranslate(array('s'=>'Recommendation number','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label>
					<input class="ae-number-reco-input" type="number" min="1" max="20"  name="recoSize<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_2" value="<?php echo $_smarty_tpl->tpl_vars['configuration']->value[mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8')]->{'recoSize'.$_smarty_tpl->tpl_vars['zone2']->value};?>
">					
				</div>
				<div class="clear"></div>
				<?php ob_start();?><?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
<?php $_tmp22=ob_get_clean();?><?php ob_start();?><?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
<?php $_tmp23=ob_get_clean();?><?php ob_start();?><?php echo mb_strtolower($_smarty_tpl->tpl_vars['hook']->value, 'UTF-8');?>
<?php $_tmp24=ob_get_clean();?><?php if ($_tmp22=="home"||$_tmp23=="left"||$_tmp24=="right") {?>
				<div class="items-reco-all-filtered <?php if ($_smarty_tpl->tpl_vars['configuration']->value[mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8')]->{'recoType'.$_smarty_tpl->tpl_vars['zone2']->value}=='recoAllFiltered') {?> items-display <?php }?>">
					<fieldset>
						<legend><?php echo smartyTranslate(array('s'=>'Filtered recommendation','mod'=>'affinityitems'),$_smarty_tpl);?>
</legend>
						<select class="items-reco-all-filtered-select" name="recoFilter<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_2">
							<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoFilter'.$_smarty_tpl->tpl_vars['zone2']->value}=="onSale") {?> selected <?php }?> value="onSale">Produits en solde</option>
							<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoFilter'.$_smarty_tpl->tpl_vars['zone2']->value}=="byCategory") {?> selected <?php }?> value="byCategory">Par catégorie</option>
							<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoFilter'.$_smarty_tpl->tpl_vars['zone2']->value}=="byAttribute") {?> selected <?php }?> value="byAttribute">Par attribut</option>
							<option <?php if ($_smarty_tpl->tpl_vars['configuration']->value[$_smarty_tpl->tpl_vars['hook']->value]->{'recoFilter'.$_smarty_tpl->tpl_vars['zone2']->value}=="byFeature") {?> selected <?php }?> value="byFeature">Par caractéritique</option>
						</select>
						<div class="categoryIds <?php if ($_smarty_tpl->tpl_vars['configuration']->value[mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8')]->{'recoFilter'.$_smarty_tpl->tpl_vars['zone2']->value}=='byCategory') {?> items-display <?php }?>">
							<?php echo smartyTranslate(array('s'=>'Filter by category ids (split by semicolon)','mod'=>'affinityitems'),$_smarty_tpl);?>
 : <input name="categoryIds<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_2" value="<?php echo $_smarty_tpl->tpl_vars['configuration']->value[mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8')]->{'categoryIds'.$_smarty_tpl->tpl_vars['zone2']->value};?>
" type="text">
						</div>
						<div class="attributeIds <?php if ($_smarty_tpl->tpl_vars['configuration']->value[mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8')]->{'recoFilter'.$_smarty_tpl->tpl_vars['zone2']->value}=='byAttribute') {?> items-display <?php }?>">
							<?php echo smartyTranslate(array('s'=>'Filter by attribute ids (split by semicolon)','mod'=>'affinityitems'),$_smarty_tpl);?>
 : <input name="attributeIds<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_2" value="<?php echo $_smarty_tpl->tpl_vars['configuration']->value[mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8')]->{'attributeIds'.$_smarty_tpl->tpl_vars['zone2']->value};?>
" type="text">
						</div>
						<div class="featureIds <?php if ($_smarty_tpl->tpl_vars['configuration']->value[mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8')]->{'recoFilter'.$_smarty_tpl->tpl_vars['zone2']->value}=='byFeature') {?> items-display <?php }?>">
							<?php echo smartyTranslate(array('s'=>'Filter by feature ids (split by semicolon)','mod'=>'affinityitems'),$_smarty_tpl);?>
 : <input name="featureIds<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_2" value="<?php echo $_smarty_tpl->tpl_vars['configuration']->value[mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['hook']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8')]->{'featureIds'.$_smarty_tpl->tpl_vars['zone2']->value};?>
" type="text">
						</div>
					</fieldset>
				</div>
				<?php }?>
			</div>
		</div>
		<?php } ?>
		<input type="submit" value="<?php echo smartyTranslate(array('s'=>'Save','mod'=>'affinityitems'),$_smarty_tpl);?>
" class="items-button-submit items-right">
		<div class="clear"></div>
		</form>
		</div>
</div>
<div id="content-theme-editor">
	<?php echo $_smarty_tpl->getSubTemplate ("./theme-editor.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<div class="clear"></div>
	<div class="items-title">
		<?php echo smartyTranslate(array('s'=>'Additional CSS','mod'=>'affinityitems'),$_smarty_tpl);?>

	</div>
	<form action='#config' method='POST'/>
	<textarea class="items-css-text-area" name="additionalCss"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['additionalCss']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</textarea>
	<input type="submit" value="<?php echo smartyTranslate(array('s'=>'Save','mod'=>'affinityitems'),$_smarty_tpl);?>
" class="items-button-submit items-right">
	</form>
	<div class="clear"></div>
</div>
<div id="content-logs">
	<?php  $_smarty_tpl->tpl_vars['log'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['log']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['logs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['log']->key => $_smarty_tpl->tpl_vars['log']->value) {
$_smarty_tpl->tpl_vars['log']->_loop = true;
?>
	<div class="ae-log <?php if ($_smarty_tpl->tpl_vars['log']->value['severity']=='[ERROR]') {?> ae-alert <?php } else { ?> ae-info <?php }?>"><p>[<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['log']->value['date_add'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
] <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['log']->value['severity'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
 <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['log']->value['message'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</p></div><br />
	<?php } ?>
</div>
<div id="content-support">
	<div class="items-support-description">
		<h2 class="items-title"><i class="fa fa-life-ring"></i>  Support</h2>
		<?php echo smartyTranslate(array('s'=>'If you\'re having a problem with your Affinity Items module, please read the','mod'=>'affinityitems'),$_smarty_tpl);?>
 <?php echo smartyTranslate(array('s'=>'FAQ','mod'=>'affinityitems'),$_smarty_tpl);?>
 <?php echo smartyTranslate(array('s'=>' or contact','mod'=>'affinityitems'),$_smarty_tpl);?>

		<br />
		<br />
		<ul>
			<li><?php echo smartyTranslate(array('s'=>'The technical support at','mod'=>'affinityitems'),$_smarty_tpl);?>
 <span class="ae-email-color">+33 9 54 52 85 12</span> <?php echo smartyTranslate(array('s'=>'or contact','mod'=>'affinityitems'),$_smarty_tpl);?>
 <a class="ae-email-color" href="mailto:mathieu@affinity-engine.fr">mathieu@affinity-engine.fr</a></li>
			<li><?php echo smartyTranslate(array('s'=>'The commercial service at','mod'=>'affinityitems'),$_smarty_tpl);?>
 <span class="ae-email-color">+33 9 80 47 24 83</span></li>
		</ul>
	</div>
	<div id="items-wiki"></div>
	<div class="clear"></div>
</div>
</div><?php }} ?>
