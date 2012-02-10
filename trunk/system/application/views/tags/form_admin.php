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
	<h2>Administrar categorías</h2>
	<?=$this->session->flashdata('msg')?>
	<?if($tags->count() > 0):?>
	<table>
		<tr>
			<th>Nombre</th>
			<th class="right">Cantidad de TAP</th>
			<th class="right">Acción</th>
		</tr>
		<?foreach($tags as $t):?>
			<tr>
				<td><?=$t->tag?></td>
				<td class="right"><?=$t->task->count()?></td>
				<td class="right">
					<?=anchor('tags/edit_tag/'.$t->id,img('static/img/icon/pencil.png'),'class="nyroModal"')?>
					<?=anchor('tags/delete_tag/'.$t->id,img('static/img/icon/trash.png'),'class="nyroModal"')?>
				</td>
			</tr>
		<?endforeach;?>
	</table>
	<?else:?>
		<p>No existen categorías todavía, agregue una mediante el formulario.</p>
	<?endif?>
	<h4>Agregar nueva categoría</h4>
	<p>Escriba el nombre de la categoría y presione guardar.</p>
	<?=form_open('tags/save_tag/', array( 'class' => 'nyroModal' ))?>
	<table class="form">
		<tr>
			<td><?=form_label('Categoría','tag')?><?=form_input(array('name' => 'tag', 'title' => 'Escriba el nombre de la etiqueta a generar.'))?></td>
		</tr>
	</table>
	<?=form_submit('enviar','Guardar')?></td>
	<?=form_close()?>
</div>