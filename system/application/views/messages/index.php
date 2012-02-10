<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	foreach($users as $u){
		$user[$u->username] = $u->username;
	}

?>
<div class="pad">
	<div id="filtros">
		<form action="messages/filter" method="post">
			<?=img('static/img/icon/zoom.png')?>
			<input type="text" name="string" class="tipns" title="Buscar un texto en el mensaje"/>
			<?if($this->session->userdata('admin')):?>
				<?=img('static/img/icon/user_sent.png')?>
				<?=form_dropdown('from',$user,$this->session->userdata('username'),'id="from" class="tipns" title="Filtrar por emisor"')?>
			<?php else:?>
				<?
					$tipo = array('to' => 'Recibidos','from'=>'Enviados');
				?>
				<?=img('static/img/icon/mail_2.png')?>
				<?=form_dropdown('tipo',$tipo,'','id="tipo" class="tipns" title="Filtrar por enviado o recibido"')?>
			<?php endif;?>
			<?=img('static/img/icon/user.png')?>
			<?=form_dropdown('to',$user,'','id="to" class="tipns" title="Filtrar por destinatario"')?>
			<a href="<?=site_url('messages/compose')?>" class="nyroModal"><button type="button"><?=img('static/img/white/mail_2.png')?> Redactar nuevo</button></a>
		</form>
	</div>
	<?=$this->session->flashdata('msg')?>
	<div id="results">
		<table>
			<tr>
				<th>De</th>
				<th>Para</th>
				<th>Mensaje</th>
				<th>Fecha</th>
				<?php if($this->session->userdata('admin')):?>
				<th></th>
				<?php endif?>
			</tr>
			<?php foreach($msg as $m):?>
			<tr>
				<td><?=$m->from?></td>
				<td><?=$m->to?></td>
				<td><?=$m->message?></td>
				<td><?=date('d/m/Y h:i a',mysql_to_unix($m->sent))?></td>
				<?php if($this->session->userdata('admin')):?>
				<td>
					<?=anchor('messages/delete/'.$m->id,img('static/img/icon/trash.png'))?>
				</td>
				<?php endif?>
			</tr>
			<?php endforeach;?>
		</table>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#from').prepend('<option value="0">Todos</option>');
		$('#to').prepend('<option value="0" selected>Todos</option>');
		$('#filtros select').change(function(){
			$('#results').html('<img src="/sgi/static/img/ajaxLoader.gif" />');
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('messages/filter'); ?>",
				data: $('#filtros form').serialize(),
				success: function(data){
					$('#results').html(data);
				}
			});
		})
		
		$('#filtros input').keyup(function(){
			$('#results').html('<img src="/sgi/static/img/ajaxLoader.gif" />');
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('messages/filter'); ?>",
				data: $('#filtros form').serialize(),
				success: function(data){
					$('#results').html(data);
				}
			});
		})
	});
</script>