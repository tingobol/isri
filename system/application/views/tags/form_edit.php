<h4>Editar etiqueta</h4>
<p>Modifique el nombre de la etiqueta y presione guardar.</p>
<?=$this->session->flashdata('msg')?>
<?=form_open('tags/save_tag/'.$tag->id, array( 'class' => 'nyroModal' ))?>
<table class="form">
	<tr>
		<td><?=form_label('Etiqueta','tag')?><?=form_input(array('name' => 'tag', 'value' => $tag->tag,'title' => 'Escriba el nombre de la etiqueta a generar.'))?></td>
	</tr>
</table>
<?=form_submit('enviar','Guardar')?>&nbsp;&nbsp;&nbsp;&nbsp;<?=anchor('tags/admin_tags','Cancelar', 'class="nyroModal"')?></td>
<?=form_close()?>