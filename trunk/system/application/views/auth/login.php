<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="es-ES">
	<head>
		<title>SGI - Iniciar sesión</title>
		<link rel="stylesheet" href="<?=site_url('static/css/sgi.css')?>" />
		<style type="text/css">
			body { text-align:center; background:#333; font-family: Arial;}
			.login { margin: 15% auto 0 auto; width:400px; text-align:left; padding-left:100px;}
			table.form { width:80%;}
			table.form label { color:#FFF; }
			table.form input { border:5px solid #FFF; border-radius:5px; -moz-border-radius:5px;}
			.user, .user:focus { background: #FFF url(http://localhost/sgi/static/img/icon/user.png) no-repeat right;}
			.pass, .pass:focus { background: #FFF url(http://localhost/sgi/static/img/icon/key.png) no-repeat right;}
		</style>
	</head>
	<body>
		<div class="login">
			<?=form_open('auth/do_login')?>
			<?=$this->session->flashdata('error')?>
				<table class="form">
					<tr>
						<td>
							<?=form_label('Email ó nombre de usuario','usuario')?>
							<?=form_input(array('name' => 'usuario', 'class' => 'user', 'id' => 'usuario'))?>
						</td>
					</tr>
					<tr>
						<td>
							<?=form_label('Password','password')?>
							<?=form_password(array('name' => 'password', 'class' => 'pass', 'id' => 'password'))?>
						</td>
					</tr>
				</table>				
				<?=form_submit('enviar','Iniciar sesión')?>
			<?=form_close()?>
		</div>
	</body>
</html>