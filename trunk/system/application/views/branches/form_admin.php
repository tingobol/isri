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
	<h2>Administrar sucursales</h2>
	<?=$this->session->flashdata('msg')?>
	<?if($branches->count() > 0):?>
	<table>
		<tr>
			<th>Nombre</th>
			<th class="right">Cantidad de TAP</th>
			<th class="right">Acción</th>
		</tr>
		<?foreach($branches as $t):?>
			<tr>
				<td><?=$t->name?></td>
				<td class="right"><?=$t->task->count()?></td>
				<td class="right">
					<?=anchor('branches/edit_branch/'.$t->id,img('static/img/icon/pencil.png'),'class="nyroModal"')?>
					<?=anchor('branches/delete_branch/'.$t->id,img('static/img/icon/trash.png'),'class="nyroModal"')?>
				</td>
			</tr>
		<?endforeach;?>
	</table>
	<?else:?>
		<p>No existen sucursales todavía, agregue una mediante el formulario.</p>
	<?endif?>
	<h4>Agregar nueva sucursal</h4>
	<p>Escriba el nombre de la sucursal y presione guardar.</p>
	<?=form_open('branches/save_branch/', array( 'class' => 'nyroModal' ))?>
	<table class="form">
		<tr>
			<td><?=form_label('Sucursal','name')?><?=form_input(array('name' => 'name', 'title' => 'Escriba el nombre de la sucursal a generar.'))?></td>
		</tr>
	</table>
	<?=form_submit('enviar','Guardar')?></td>
	<?=form_close()?>
</div>