<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<script src="<?=site_url('static/js/jquery.tipsy.js')?>" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('textarea').tipsy({trigger: 'focus', gravity: 'w', fallback: 'No hay ayuda disponible', fade: true});
			$('select').tipsy({trigger: 'focus', gravity: 'w', fallback: 'No hay ayuda disponible', fade: true});
			$('input[type=text]').tipsy({trigger: 'focus', gravity: 'w', fallback: 'No hay ayuda disponible', fade: true});
			$.datepicker.setDefaults($.datepicker.regional['es']);
			$('.date').datepicker({
				showAnim: 'fadeIn',
			});
			
			$('.modal').nyroModal({
				modal: true
			});
		
			var availableTags = [<?=implode(', ',$jtags)?>];
			function split( val ) {
				return val.split( /,\s*/ );
			}
			function extractLast( term ) {
				return split( term ).pop();
			}

			$("#tags")
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
				
			$(window).keydown(function(event){
				if(event.keyCode == 13) {
					$('input').next().focus();
					event.preventDefault();
					return false;
				}
			});
		});
	</script>
</head>
<div class="yui-g">
	<h2>Postergar tarea</h2>
	<p>Seleccione la cantida de tiempo y el intervalo correspondiente.</p>
	<?=$this->session->flashdata('msg')?>
	<?=form_open('tasks/postpone/'.$task, array( 'class' => 'nyroModal' ))?>
	<?
		$interval = array(
					'MINUTE' => 'Minutos',
					'HOUR' => 'Horas',
					'DAY' => 'Días',
					'WEEK' => 'Semanas',
					'MONTH' => 'Meses',
					'YEAR' => 'Años'
				);
	?>
	<table class="form">
		<tr>
			<td><?=form_label('Cantidad','amount')?><?=form_input(array('name' => 'amount', 'id' => 'amount', 'title' => 'Cantidad de días, horas, semanas ó meses'))?></td>
			<td><?=form_label('Intervalo','interval')?><?=form_dropdown('interval',$interval,'','title="Seleccione el intervalo de tiempo deseado."')?></td>
			<tr>
				<td><?=form_submit('enviar','Postergar')?></td>
				<td>
					<?
						if($this->session->flashdata('msg')) echo anchor('tasks/view/'.$task,'Finalizar');
						else echo anchor('tasks/view/'.$task,'Cancelar','class="nyroModalClose"');
					?>
				</td>
			</tr>
		</tr>
	</table>
	<?=form_close()?>
</div>