<div class="pad">
	<h4>Mis TAPs</h4>
	<ul class="sidebar">
		<li><?=anchor('tasks/notify/due','vencidas')?> <span id="vencidas"><?=$vencidas?></span></li>
		<li><?=anchor('tasks/notify/postponed','postergadas')?> <span id="postponed"><?=$postergadas?></span></li>
		<li><?=anchor('tasks/notify/new','no leídas')?> <span id="nuevo"><?=$nuevas?></span></li>
		<li><?=anchor('tasks/notify/updated','actualizadas')?></a> <span id="updates"><?=$updates?></span></li>
		<li><?=anchor('tasks/notify/complete','completas')?></a> <span id="complete"><?=$complete?></span></li>
	</ul>
	<h4>Usuarios conectados</h4>
	<?if(count($active) > 0):?>
	<?=ul($active,array('class' => 'sidebar chat'))?>
	<?else:?>
		<p>No hay usuarios conectados</p>
	<?endif?>
	<h4>Taps activos por categoría</h4>
	<?
		if($etiquetas->count() > 0)
		{
			$list = array();
			foreach($etiquetas as $t)
			{
				$list[] = anchor('tasks/tag/'.$t->slug,$t->tag).' <span>'.$t->task->count().'</span>';
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