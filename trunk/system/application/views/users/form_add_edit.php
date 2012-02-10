<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<script type="text/javascript">
		$(document).ready(function() {
	
			$('input[type=text]').tipsy({trigger: 'focus', gravity: 'w', fallback: 'No hay ayuda disponible', fade: true});
	
			$(window).keydown(function(event){
				if(event.keyCode == 13)
				{
					$('input').next().focus();
					event.preventDefault();
					return false;
				}
			});
		});
	</script>
</head>
<div class="yui-g">
	<?if($profile):?>
		<h2>Editar mi perfil</h2>
	<?else:?>
		<h2>Detalles de usuario</h2>
	<?endif?>
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
		if(isset($id))
		{
			echo form_open('users/save_edit/'.$id, array('class' => 'nyroModal'));
		}
		else
		{
			echo form_open('users/save_edit/',array('class' => 'nyroModal'));
		}
		
		$admin = array('1' => 'Administrador', '0' => 'Usuario regular');
		$active = array('1' => 'Activo', '0' => 'Inactivo');
		
		foreach($branches as $b)
		{
			$br[$b->id] = $b->name;
		}
	?>
	<table class="form">
		<tr>
			<td colspan="2"><?=form_label('Nombre','name')?><?=form_input(array('name' => 'name', 'placeholder' => 'nombre', 'title' => 'Escriba el nombre del usuario.', 'value' => $user['name']))?></td>
		</tr>
		<tr>
			<td>
				<?
					$username = array('name' => 'username', 'placeholder' => 'nombre de usuario', 'title' => 'Escriba el nombre de usuario deseado.', 'value' => $user['username']);
					if($profile)
					{
						$username['readonly'] = "readonly";
					}
				?>
				<?=form_label('Nombre de usuario','username')?><?=form_input($username)?>
			</td>
			<td><?=form_label('Email','email')?><?=form_input(array('name' => 'email', 'placeholder' => 'email', 'value' => $user['email'], 'title' => 'Escriba una dirección de email válida.'))?></td>
		</tr>
		<tr>
			<td>
				<?
					$phone = array('name' => 'phone', 'placeholder' => 'teléfono fijo', 'title' => 'Escriba el número de teléfono del usuario.', 'value' => $user['phone']);
				?>
				<?=form_label('Teléfono fijo','phone')?><?=form_input($phone)?>
			</td>
			<td><?=form_label('Celular','cellphone')?><?=form_input(array('name' => 'cellphone', 'placeholder' => 'celular', 'value' => $user['cellphone'], 'title' => 'Escriba un número de teléfono celular.'))?></td>
		</tr>
		<tr>
			<td><?=form_label('Contraseña','password')?><?=form_password(array('name' => 'password', 'placeholder' => 'contraseña', 'title' => 'Escriba una contraseña no menor a 6 caracteres.'))?></td>
			<td><?=form_label('Confirmar contraseña','confirm')?><?=form_password(array('name' => 'confirm', 'placeholder' => 'confirmar contraseña', 'title' => 'Este campo debe coincidir con el campo Contraseña.'))?></td>
		</tr>
		<?if(!$profile):?>
		<tr>
			<td><?=form_label('Nivel','admin')?><?=form_dropdown('admin',$admin,$user['admin'])?></td>
			<td><?=form_label('Activo','active')?><?=form_dropdown('active',$active,$user['active'])?></td>
		</tr>
		<tr>
			<td colspan="2"><?=form_label('Sucursal','branch_id')?><?=form_dropdown('branch_id',$br,$user['branch_id'])?></td>
		</tr>
		<?else:?>
			<?=form_hidden('admin',$user['admin'])?>
			<?=form_hidden('active',$user['active'])?>
			<?=form_hidden('profile',$profile)?>
		<?endif?>
		<tr>
			<td>
				<?=form_submit('enviar','guardar')?>
			</td>
			<td>
				<?
					if($profile) echo anchor('#','Cancelar','class="nyroModalClose"');
					else echo anchor('users/admin','Cancelar','class="nyroModal"');
				?>
			</td>
		</tr>
	</table>
	<?=form_close()?>
</div>