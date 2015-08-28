var mst=jQuery.noConflict();
mst(function($) {

		function updateTips( t ) {
			tips
				.text( t )
				.addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
			}, 500 );
		}

		function checkLength(o) {
			if ( o.val().length==0 ) {
				o.addClass( "ui-state-error" );
				return false;
			} else {
				return true;
			}
		}

		function checkRegexp( o, regexp, n ) {
			if(o.val()!=""){
				if ( !( regexp.test( o.val() ) ) ) {
					o.addClass( "ui-state-error" );
					updateTips( n );
					return false;
				} else {
					return true;
				}
			}else{
				return true;
			}
		}

		$( "#homedelivery-dialog-form" ).dialog({
			autoOpen: false,
			height: 200,
			width: 400,
			modal: true,
			buttons: {
				"Save": function() {
				
					var from_price = $( "#from_price" );
					var to_price = $( "#to_price" );
					var cost = $( "#cost" );
					var allFields = $( [] ).add( from_price ).add( to_price ).add( cost );
					var tips = $( ".validateTips" );
				
					var bValid = true;
					allFields.removeClass( "ui-state-error" );

					bValid = bValid && checkLength(from_price);
					bValid = bValid && checkLength(to_price);
					bValid = bValid && checkLength(cost);

					if ( bValid ) {
						$('#homedelivery_form').submit();
						$( this ).dialog( "close" );
					}
				},
				Cancel: function() {
					//Delete value of this field if not update
					$('#add_or_edit').val('');
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				//Delete value of this field if not update
				$('#add_or_edit').val('');
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});
	});