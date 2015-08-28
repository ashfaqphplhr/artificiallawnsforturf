var mst = jQuery.noConflict();

mst(document).ready(function($){
	var baseurl=$('#mst_baseurl').val();
	MST = {
		showAndHideInput : function( par ) {
			for(var i = 0; i < par.length - 1; i+=2){
				// If true->show, else hide
				if(par[i+1] == true){
					$("#" + par[i]).removeAttr('disabled');
					$("#" + par[i]).parent().parent().show();
				}else{
					$("#" + par[i]).attr('disabled',true);
					$("#" + par[i]).parent().parent().hide();
				}
			}
		},
		deleteHomedelivery:function(id){
			var rule_id = id.split('_')[2];
			var ok = confirm("Are you sure?");
			if(ok){
				$.ajax({
					type:"POST",
					url:baseurl+'ship/index/deleteHomedelivery',
					data:'rule_id=' + rule_id,
					beforeSend:function(){
						$("#loading-mask").attr("style","left: -2px; top: 0px; width: 1034px; height: 833px;");
						$("#loading-mask").show();
					},
					success:function(data){
						if(data == ""){
							//Remove this row
							$("#" + id).parent().parent().parent().remove();
							$("#loading-mask").hide();
						}else{
							alert('There are some errors!');
							window.location.reload();
						}
					}
				});
			}
		},
		editHomedelivery:function(id){
			
			var rule_id = id.split('_')[2];
			
			$.ajax({
				type:"POST",
				
				url : baseurl + 'ship/index/editHomedelivery',
				data : 'rule_id=' + rule_id,
				beforeSend:function(){
					$("#loading-mask").attr("style","left: -2px; top: 0px; width: 1034px; height: 833px;");
					$("#loading-mask").show();
					
				},
				success : function(data){
					if(data!=""){
						var ruleInfo = $.parseJSON(data);
						$("#from_price").val(ruleInfo.from_price);
						$("#to_price").val(ruleInfo.to_price);
						$("#cost").val(ruleInfo.cost);
						$("#add_or_edit").val(ruleInfo.id);
						$("#loading-mask").hide();
						$("#homedelivery-dialog-form").dialog( "open" );
					}else{
						alert('There are some errors!');
					}
				}
			});
		},
		addHomedelivery:function(){
			//Homedelivery info
			$("#from_price, #to_price, #cost").val('');
			//Emty this field to add new rule
			$("#add_or_edit").val('');
			//Active dialog
			$( "#homedelivery-dialog-form" ).dialog( "open" );
		}
	}
});