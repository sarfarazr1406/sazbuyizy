$(function() {
	function reloadPage(URL) {
		window.location.href = URL;
	}

	function versionCompare(actualV, newV){
		
		var result;
		actualV = actualV.split('.');
		newV = newV.split('.');
		var size = actualV.length;
		if (size > newV.length)
			size = newV.length;
		
		for (i=0;i<size;i++){
			var NV = newV[i];
			var AV = actualV[i];
			if (i>0) {
				if (NV.length > AV.length) {
					var diff = NV.length-AV.length;
					for (d=0;d < diff;d++){
						AV = AV+'0';
					}
				} else if (AV.length > NV.length) {
					var diff = AV.length-NV.length;
					for (d=0;d<diff;d++){
						NV = NV+'0';
					}
				}
			}

			if (parseInt(NV) < parseInt(AV)) {
			    //is older
				result = -1;
				break;
			} else
			if (parseInt(NV) > parseInt(AV)) {
				result = 1;
				break;
			} else
				result = 0;
		}
		
		if (result == 0) {
			if (actualV.length < newV.length)
				for (i;i<newV.length; i++)
					if (newV[i] > 0){
						result = 1;
						break;
					}
		}
		
		return result;
	}
	$(document).ready(function(){
		var CU = window.location.href;
		CU = CU.replace(window.location.hash,'');
		$.ajaxSetup({
			cache: false,
			xhrFields: {
			   withCredentials: true
			},
			crossDomain: true
		});
		function checkUpdate() {
			var newVersion;
			$.ajax({
				type:     "GET",
				cache: false,
				url:      njupdateUrl+"?njc="+njactualVersion+'&d='+window.location.hostname,
				dataType: "jsonp",
				success: function(data){ 
					newVersion = data[0].version;
					if (versionCompare(njactualVersion, newVersion) > 0) {
						$.post(njajaxUrl+"&action=alertNewVersion", {params:newVersion}, function(data){
							showalert(data, function(){reloadPage(CU);});
						});
					}
				}
			}).done(function(data, message  ) {
				//console.log( "done:", data, message );
			}).fail(function(data, message) {
				console.log( "error:", data, message );
			}).always(function(data, message) {
				//console.log( "complete:",data, message );
			});
		}
		if (typeof njupdateUrl !== 'undefined' && typeof njactualVersion !== 'undefined'){
			setTimeout(function(){
				checkUpdate();
			},2000);
		};
		
		var alerts = $('<div id="alerts"><span class="fa fa-times closeme"></span><span class="wait fa fa-cog fa-spin"></span><span id="alertmsg"></span></div>');
		$('body').append(alerts);
		
		var alertTimeout;
		
		function showalert(msg, f, undo, time){
			clearTimeout(alertTimeout);
			var $al = $('#alerts');
			if (msg == '')
				msg = '...';
			$('#alertmsg').text(msg);
			$al.fadeIn('fast');
			if (typeof f == "function") {
				var alertButtons = $('<div class="alertButtons"></div>');
				var accept = $('<span class="accept fa fa-check"></span>');
				var cancel = $('<span class="cancel fa fa-times"></span>');
				$('#alertmsg').append(alertButtons);
				alertButtons.append(accept);
				if (undo){
					alertButtons.append(cancel);
				}
				accept.click(function(){
					f();
				})
				cancel.click(function(){
					hidealert();
				})
			} else {
				var delay = 1500;
				if (typeof time !== 'undefined')
					delay = time;
				alertTimeout = setTimeout(function(){hidealert()},delay)
			}
		}
					
		function hidealert(){
			$('#alerts').fadeOut('fast',function(){
				$('#alertmsg').html('');
			});
		}
		
		$('#alerts .closeme').click(function(){
			hidealert();
		})
		
		// update Module	
		$('#moduleUpdate').submit(function(e){
			e.preventDefault();
			showalert('Please wait!', false, false, 5000);
			$.post(njajaxUrl+"&action=updateModule", function(data){
				showalert(data, function(){reloadPage(CU);});
			});
		})
	
	}) //END DOC READY

}(jQuery));