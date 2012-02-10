<h4>Editar sucursal</h4>
<p>Modifique el nombre de la sucursal y presione guardar.</p>
<?=$this->session->flashdata('msg')?>
<?=form_open('branches/save_branch/'.$branch->id, array( 'class' => 'nyroModal' ))?>
<table class="form">
	<tr>
		<td><?=form_label('Sucursal','name')?><?=form_input(array('name' => 'name', 'value' => $branch->name,'title' => 'Escriba el nombre de la sucursal.'))?></td>
	</tr>
</table>
<?=form_submit('enviar','Guardar')?>&nbsp;&nbsp;&nbsp;&nbsp;<?=anchor('branches/admin_branches','Cancelar', 'class="nyroModal"')?></td>
<?=form_close()?>