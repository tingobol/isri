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
	<h2>Administración de usuarios</h2>
	<?=$this->session->flashdata('msg')?>
	<?if($users->count() > 0):?>
	<table style="width:750px;">
		<tr>
			<th>Nombre</th>
			<th>Usuario</th>
			<th>Email</th>
			<th>Acceso</th>
			<th class="right">Acciones</th>
		</tr>
		<?foreach($users as $u):?>
			<tr>
				<td><?=$u->name?></td>
				<td><?=$u->username?></td>
				<td><?=$u->email?></td>
				<td><?if($u->admin) echo "Administrador"; else echo "Usuario regular";?></td>
				<td class="right">
					<?
						if($u->active) echo anchor('users/active/0/'.$u->id,img('static/img/icon/checkbox_checked.png'),'class="nyroModal" title="Haga click aquí para desactivar el usuario"');
						else echo anchor('users/active/1/'.$u->id,img('static/img/icon/checkbox_unchecked.png'),'class="nyroModal" title="Haga click aquí para activar el usuario"');
					?>
					<?=anchor('users/add_edit/'.$u->id,img('static/img/icon/pencil.png'),'class="nyroModal"')?>
					<?=anchor('users/delete_user/'.$u->id,img('static/img/icon/trash.png'),'class="nyroModal"')?>
				</td>
			</tr>
		<?endforeach;?>
	</table>
	<?else:?>
	<p>No hay usuarios en la base de datos.</p>
	<?endif?>
	<p><?=anchor('users/add_edit', 'Agregar usuario', 'class="nyroModal button"')?> &nbsp;&nbsp;&nbsp; <?=anchor('#','Finalizar','class="nyroModalClose"')?></p>
</div>