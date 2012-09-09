<div class="pad rightsidebar">
	<h4>Mis TAPs</h4>
	<ul class="sidebar">
		<li><?=anchor('tasks/notify/due','vencidas')?> <span id="vencidas"><?=$vencidas?></span></li>
		<li><?=anchor('tasks/notify/postponed','postergadas')?> <span id="postponed"><?=$postergadas?></span></li>
		<li><?=anchor('tasks/notify/updated','actualizadas')?></a> <span id="updates"><?=$updates?></span></li>
		<li><?=anchor('tasks/notify/new','no leídas')?> <span id="nuevo"><?=$nuevas?></span></li>
		<li><?=anchor('tasks/notify/activas','activas')?> <span id="activas"><?=$activas?></span></li>
		<li><?=anchor('tasks/notify/complete','completas')?></a> <span id="complete"><?=$complete?></span></li>
		<li><?=anchor('tasks/notify/notificado','notificaciones')?></a> <span id="notificaciones"><?=$notificaciones?></span></li>
		<li><?=anchor('tasks/notify/all','todas')?></a> <span id="all"><?=$all?></span></li>
		<?php if($this->session->userdata('admin')):?>
			<li><?=anchor('tasks/notify/otros','todas de otros')?></a> <span id="otros"><?=$otros?></span></li>
            <li><?=anchor('tasks/trash','papelera')?></a> <span id="otros"><? /*$papelera*/?></span></li>
		<?php endif?>
	</ul>
	<h4>Usuarios conectados</h4>
	<?if(count($active) > 0):?>
	<?=ul($active,array('class' => 'sidebar chat'))?>
	<?else:?>
		<p>No hay usuarios conectados</p>
	<?endif?>
	<h4>Taps por categoría</h4>
	<?
		if($etiquetas->count() > 0)
		{
			$list = array();
			foreach($etiquetas as $t)
			{
				$list[] = anchor('tasks/tag/'.$t->slug,$t->tag).' <span>'.$t->task->where_related('recurso','user_id',$this->session->userdata('id'))->count().'</span>';
			}
			if(count($list) == 0)
			{
				echo "No hay tareas activas";
			}
			else echo ul($list,array('class'=>'sidebar'));
		}
		else
		{
			echo "Todavía no existen etiquetas.";
		}
	?>
</div>
