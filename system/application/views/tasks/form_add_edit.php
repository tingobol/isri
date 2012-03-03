<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<script type="text/javascript">
		$(document).ready(function() {
			$('textarea').tipsy({trigger: 'focus', gravity: 'w', fallback: 'No hay ayuda disponible', fade: true});
			$('input[type=text]').tipsy({trigger: 'focus', gravity: 'w', fallback: 'No hay ayuda disponible', fade: true});
			$.datepicker.setDefaults($.datepicker.regional['es']);
			$('.date').datepicker({
				showAnim: 'fadeIn',
			});
			
			$('.time').timepicker({});
		
		/*	var availableTags = [<?=implode(', ',$jtags)?>];
			function split( val ) {
				return val.split( /,\s*/ /*);
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
		*/		
			$(window).keydown(function(event){
				if(event.keyCode == 13) {
					$('input').next().focus();
					event.preventDefault();
					return false;
				}
			});
			
		});
	</script>
	<script type="text/javascript">
		$("textarea").spellchecker({
					lang: "es",
					engine: "google"
		}).spellchecker("check");
	</script>
</head>
<div class="yui-g">
<div class="pad">
	<h2>Detalles de TAP</h2>
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
		foreach($tags as $t)
		{
			$cat[$t->id] = $t->tag;
		}
		if(isset($id))
		{
			echo form_open('tasks/save_task/'.$id, array('class' => 'nyroModal'));
			echo form_hidden('id',$id);
			echo form_hidden('url',uri_string());
			
			if(!isset($errors))
			{			
				$task = $task->to_array(array(
										'subject',
										'start_date',
										'end_date',
										'body',
										'type_id',
										'slug',
										'tag_id'
										));
				$task['start_hour'] = mdate('%H:%i',$task['start_date']);
				$task['end_hour'] = mdate('%H:%i',$task['end_date']);
			}
			else
			{
				$tags[] = $task['tags'];
				$task['start_date'] = human_to_unix($task['start_date']);
				$task['end_date'] = human_to_unix($task['end_date']);
				$task['start_hour'] = mdate('%H:%i',$task['start_date']);
				$task['end_hour'] = mdate('%H:%i',$task['end_date']);
			}
			
		}
		else
		{
			echo form_open('tasks/save_task/', array('class' => 'nyroModal'));
			echo form_hidden('status_id',1);
			echo form_hidden('url',uri_string());
			if(isset($task_id))
			{
				echo form_hidden('task_id',$task_id);
			}
			
			if(isset($errors))
			{
				$task['start_date'] = human_to_unix($task['start_date']);
				$task['end_date'] = human_to_unix($task['end_date']);
			}
			
			$task['start_hour'] = mdate('%H:%i',$task['start_date']);
			$task['end_hour'] = mdate('%H:%i',$task['end_date']);
			$task['tags'] = '';
		}
	?>
	<table class="form">
		<tr>
			<td colspan="2"><?=form_label('Asunto','subject')?><?=form_input(array('name' => 'subject', 'placeholder' => 'asunto', 'title' => 'Escriba un texto descriptivo para el asunto del TAP.', 'value' => $task['subject']))?></td>
		</tr>
		<tr>
			<td><?=form_label('Fecha de inicio','start_date')?><?=form_input(array('name' => 'start_date', 'placeholder' => 'fecha inicio', 'title' => 'Seleccione una fecha en el calendario para indicar la fecha de inicio del TAP.', 'value' => mdate('%d/%m/%Y',$task['start_date']), 'class' => 'date'))?></td>
			<td><?=form_label('Fecha de vencimiento','end_date')?><?=form_input(array('name' => 'end_date', 'placeholder' => 'fecha vencimiento', 'value' => mdate('%d/%m/%Y',$task['end_date']), 'class' => 'date', 'title' => 'Seleccione una fecha en el calendario para indicar la fecha de vencimiento del TAP.'))?></td>
		</tr>
		<tr>
			<td><?=form_label('Hora de inicio','start_hour')?><?=form_input(array('name' => 'start_hour', 'placeholder' => 'hora inicio', 'value' => $task['start_hour'], 'class' => 'time', 'title' => 'Seleccione una fecha en el calendario para indicar la fecha de vencimiento del TAP.'))?></td>
			<td><?=form_label('Hora de vencimiento','end_hour')?><?=form_input(array('name' => 'end_hour', 'placeholder' => 'hora vencimiento', 'value' => $task['end_hour'], 'class' => 'time', 'title' => 'Seleccione una fecha en el calendario para indicar la fecha de vencimiento del TAP.'))?></td>
		</tr>
		<tr>
			<td><?=form_label('Prioridad','type_id')?><?=form_dropdown('type_id',$types,$task['type_id'],'id="type_id"');?></td>
			<td><?=form_label('Categoría','tag_id')?><?=form_dropdown('tag_id',$cat,$task['tag_id'],'id="tag_id"');?></td>
		</tr>
		<tr>
			<td colspan="2"><?=form_label('Descripción','body')?><?=form_textarea(array('name' => 'body', 'id' => 'spell', 'value' => $task['body'], 'title' => 'Escriba un texto que describa detalladamente este TAP.'))?></td>
		</tr>
		<tr>
			<td>
				<?
					if(isset($id)) echo form_submit('enviar','guardar');
					else echo form_submit('enviar','Siguiente');
				?>
			</td>
			<td>
				<?
					if($this->session->flashdata('msg')) echo anchor('tasks/view/'.$task['slug'],'Finalizar');
					else echo anchor('#','Cancelar','class="nyroModalClose"');
				?>
			</td>
		</tr>
	</table>
	<?=form_hidden('branch_id',$this->session->userdata('branch_id'))?>
	<?=form_close()?>
</div>
</div>
