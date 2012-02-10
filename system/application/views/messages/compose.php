<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<script src="<?=site_url('static/js/jquery.tipsy.js')?>" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			var availableTags = [<?=implode(', ',$users)?>];
			function split( val ) {
				return val.split( /,\s*/ );
			}
			function extractLast( term ) {
				return split( term ).pop();
			}

			$("#rcpt")
				// don't navigate away from the field on tab when selecting an item
				.bind( "keydown", function( event ) {
					if ( event.keyCode === $.ui.keyCode.TAB &&
							$( this ).data( "autocomplete" ).menu.active ) {
						event.preventDefault();
					}
				})
				.autocomplete({
					minLength: 0,
					delay: 0,
					source: function( request, response ) {
						// delegate back to autocomplete, but extract the last term
						response( $.ui.autocomplete.filter(
							availableTags, extractLast( request.term ) ) );
					},
					focus: function() {
						// prevent value inserted on focus
						return false;
					},
					select: function( event, ui ) {
						var terms = split( this.value );
						// remove the current input
						terms.pop();
						// add the selected item
						terms.push( ui.item.value );
						// add placeholder to get the comma-and-space at the end
						terms.push( "" );
						this.value = terms.join( ", " );
						return false;
					}
				});
				
		});
	</script>
	<style type="text/css">
		label { color: #777; font-size:12px;}
		input#rcpt{
			width:99%;
		}
		textarea {
			margin-bottom:10px;
			width:99%;
		}
		div.box {
			width:600px;
		}
	</style>
</head>
<div class="yui-g">
	<div class="box">
	<h2>Redactar nuevo mensaje</h2>
	<?=$this->session->flashdata('msg')?>
		<?=form_open('messages/send',array( 'class' => 'nyroModal' ))?>
		<?=form_label('Para','rcpt')?><br />
		<?=form_input(array('name'=>'rcpt','id'=>'rcpt'))?><br /><br />
		<?=form_label('Mensaje','message')?><br />
		<?=form_textarea(array('name'=>'message','id'=>'message'))?><br />
		<?=form_submit('enviar','Enviar mensaje')?>
	</div>
</div>