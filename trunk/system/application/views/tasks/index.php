<div class="pad">
	<?=$this->session->flashdata('msg')?>
	<?php
		foreach($users as $usr)
		{
			$us[$usr->id] = $usr->name;
		}
		foreach($tags as $t)
		{
			$tg[$t->id] = $t->tag;
		}
		foreach($roles as $r)
		{
			$ro[$r->id] = $r->role;
		}
		foreach($types as $tp)
		{
			$ty[$tp->id] = $tp->type;
		}
		foreach($status as $s)
		{
			$st[$s->id] = $s->status;
		}
		foreach($branches as $b)
		{
			$br[$b->id] = $b->name;
		}
	?>
	<div id="filtros">
		<form action="" method="post" id="f">
			<?=img('static/img/icon/zoom.png')?>
			<input type="text" name="string" class="tipns" title="Buscar por asunto"/>
			<?if($this->session->userdata('admin')):?>
				<?=img('static/img/icon/user.png')?>
				<?=form_dropdown('user_id',$us,'','id="users" class="tipns" title="Filtrar por usuario"')?>
				<?=img('static/img/icon/globe_2.png')?>
				<?=form_dropdown('branch_id',$br,'','id="branches" class="tipns" title="Filtrar por sucursal"')?>
			<?php endif;?>
			<?=img('static/img/icon/users.png')?>
			<?=form_dropdown('role_id',$ro,'','id="roles" class="tipns" title="Filtrar por roles"')?>
			<?=img('static/img/icon/flag.png')?>
			<?=form_dropdown('status_id',$st,'','id="status" class="tipns" title="Filtrar por estados"')?>
			<?=img('static/img/icon/fire.png')?>
			<?=form_dropdown('type_id',$ty,'','id="types" class="tipns" title="Filtrar por prioridades"')?>
			<?=img('static/img/icon/tag.png')?>
			<?=form_dropdown('tag_id',$tg,'','id="tags" class="tipns" title="Filtrar por categorías"')?>
			<?=anchor('tasks','Remover filtros')?>
		</form>
	</div>
	<div id="results">
	<table>
		<tr>
			<th colspan="3"><?=img('static/img/icon/info.png')?> TAP</th>
			<th><?=img('static/img/icon/fire.png')?> Prio.</th>
			<!--<th><?=img('static/img/icon/clock.png')?> Transcurrido</th>-->
			<th><?=img('static/img/icon/clock.png')?> Restante</th>
			<th><?=img('static/img/icon/spechbubble_2.png')?></th>
		</tr>
		<?foreach($tasks as $t):?>
		<tr>
			<td class="status">
					<?=anchor('tasks/tag/'.$t->tag->slug,$t->tag->tag,'class="tag"');?>				
			</td>
			
			<td class="subject">
				<?=anchor('tasks/view/'.$t->slug,character_limiter($t->subject, 25),'title="'.$t->subject.'"')?>
			</td>
			<td>
				<span class="<?=$t->status->status?>"><?=$t->status->status?></span>
			</td>
			<td><?=$t->type->type?></td>
			<!--<td><?=timespan($t->start_date)?></td>-->
			<td>
				<?php if($t->end_date < time()):?>
					Vencida
				<?php else:?>
					<?php
						$diff = round(($t->end_date - time()) / (60*60*24),1);
						if(strstr($diff,'.'))
						{
							list($days,$hours) = explode('.',$diff);
						}
						else {
							$hours = 0;
							$days = $diff;
						}
						if($days > 7)
						{
							$p = 100;
						}
						else
						{
							$p = ($days/7*100);
						}
						switch ($p) {
							case $p < 30:
								$c = 'rojo';
								break;
							case $p < 60:
								$c = 'amarillo';
								break;
							default:
								$c = 'verde';
							
						}
					?>
					<div class="progress">
						<div class="meter <?=$c?>" style="width:<?=$p?>%"></div>
					</div>
					<span class="days"><?=$days?>d <? if($hours):?><?=$hours*.24?>hs<?php endif?></span>
				<?php endif?>				
			</td>
			<td><?=$t->comment->count()?></td>
		</tr>
		<?endforeach;?>
	</table>
	<?
		switch($this->uri->segment(2))
		{
			case '':
				$url = 'tasks/index/';
				break;
			case 'index':
				$url = 'tasks/index/';
				break;
			default:
				$url = 'tasks/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/';			
		}
	?>
	<p class="pagination">
		<?if($tasks->paged->has_previous):?>
			<a href="<?= site_url($url.'1')?>">◄ primero</a>
			<a href="<?= site_url($url.$tasks->paged->previous_page)?>">anterior</a>
		<?else:?>
			<span>◄ primero anterior</span>
		<?endif?>
		<?=$tasks->paged->current_page?> de <?=$tasks->paged->total_pages?>
		<?if($tasks->paged->has_next):?>
			<a href="<?= site_url($url.$tasks->paged->next_page)?>">siguiente</a>
			<a href="<?= site_url($url.$tasks->paged->total_pages) ?>">último ►</a>
		<?else:?>
			<span>siguiente último ►</span>
		<?endif?>
	</p>	

	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.progressbar').progressbar({ 'value': 20});
			$('#users').prepend('<option value="0" selected>Todos</option>');
			$('#roles').prepend('<option value="0" selected>Todos</option>');
			$('#status').prepend('<option value="0" selected>Todos</option>');
			$('#types').prepend('<option value="0" selected>Todas</option>');
			$('#tags').prepend('<option value="0" selected>Todas</option>');
			$('#branches').prepend('<option value="0" selected>Todas</option>');
			
			$('#filtros select').change(function(){
				$('#results').html('<?=img("static/img/ajaxLoader.gif")?>');
				$.ajax({
					type: "POST",
					url: "<?php echo site_url('tasks/filtrar'); ?>",
					data: $('#filtros form').serialize(),
					success: function(data){
						$('#results').html(data);
					}
				});
			})
			
			$('#filtros input').keyup(function(){
				$('#results').html('<?=img("static/img/ajaxLoader.gif")?>');
				$.ajax({
					type: "POST",
					url: "<?php echo site_url('tasks/filtrar'); ?>",
					data: $('#filtros form').serialize(),
					success: function(data){
						$('#results').html(data);
					}
				});
			})
			
			scrollSidebar('.rightsidebar',0);
		});
	</script>
</div>
