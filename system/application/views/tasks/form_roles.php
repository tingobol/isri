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
	<h2>Asignación de recursos</h2>
	<?=$this->session->flashdata('msg')?>
	<?
		if($this->session->flashdata('errors'))
		{
			$errors = $this->session->flashdata('errors');
			foreach($errors as $e)
			{
				echo $e;
			}
		}
	?>
	<?
		foreach($users as $u)
		{
			$user[$u->id] = $u->name;
		}
		
		foreach($task->result() as $re)
		{
			$resource[$re->uid] = $re->name;
		}
		
		foreach($roles as $r)
		{
			$role[$r->id] = $r->role;
		}
		
		if(!empty($resource))
		{
			$users_list = array_diff($user,$resource);
		}
		else
		{
			$users_list = $user;
		}
	?>
	<?if($task->num_rows() > 0):?>
	<table>
		<tr>
			<th>Rol</th>
			<th class="right">Usuario</th>
		</tr>
		<?foreach($task->result() as $r):?>
			<tr>
				<td><?=$r->role?></td>
				<td class="right"><?=$r->name?> <?=anchor('tasks/remove_role/'.$r->rid.'/'.$r->id,img('static/img/icon/trash.png'),'class="nyroModal"')?></td>
			</tr>
		<?endforeach;?>
	</table>
	<?else:?>
	<p>Este TAP no tiene recursos asignados. Asigne recursos a este TAP mediante el formulario.</p>
	<?endif?>
	<h4>Asignar nuevo recurso</h4>
	<?if(!empty($users_list)):?>
	<p>Seleccione uno ó más usuarios (ctrl + click) y asigne el rol correspondiente.</p>
	<?=form_open('tasks/add_roles/'.$this->uri->segment(3), array( 'class' => 'nyroModal' ))?>
	<?=form_hidden('task_id',$r->id)?>
	<table class="form">
		<tr>
			<td><?=form_label('Usuarios','user_id')?><?=form_multiselect('user_id[]',$users_list,'','class="tip" title="Seleccione un usuario de la lista"')?></td>
			<td valign="top"><?=form_label('Rol','role_id')?><?=form_dropdown('role_id',$role,'','title="Asigne un rol al usuario seleccionado."')?></td>
			<tr>
				<td><?if(!empty($users_list)) echo form_submit('enviar','Asignar recurso');?></td>
				<td><?if($this->session->flashdata('post') OR empty($users_list)) echo anchor('tasks/view/'.$dt->slug,'Finalizar','class=""')?></td>
			</tr>
		</tr>
	</table>
	<?=form_close()?>
	<?else:?>
	No hay mas recursos disponibles para asignar. <?=anchor('tasks/view/'.$dt->slug,'Finalizar','class=""')?>
	<?endif?>
</div>