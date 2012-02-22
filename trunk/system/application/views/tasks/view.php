<?php $this->load->helper('typography')?>
<div class="yui-u">
	<div class="pad">
		<h2><?=$task->subject?>
			<span id="b">
				<?php if($tr):?>
					<?php if($tr->read):?>
						<?=anchor('tasks/marcar/0/'.$task->id, img('static/img/white/round.png'),'class="tipns" title="Marcar como leida"')?>
					<?php else:?>
						<?=anchor('tasks/marcar/1/'.$task->id, img('static/img/white/round_checkmark.png'),'class="tipns" title="Marcar como no leida"')?>
					<?php endif?>
				<?php endif?>
				<?if(($this->session->userdata('admin'))):?>
					<?=anchor('tasks/add_edit/'.$task->id, img('static/img/white/pencil.png'),'class="modal tipns" title="Editar esta TAP"')?>
					<?=anchor('tasks/delete_task/'.$task->id, img('static/img/white/trash.png'),'class="tipns" title="Eliminar esta TAP" onClick="return confirm(\'¿Está seguro de eliminar este TAP?\')"')?>
				<?endif?>
			</span>
		</h2>
		<p><?=anchor('tasks/view/'.$task->slug,site_url('tasks/view/'.$task->slug))?></p>
		<hr />
	</div>
</div>
<div class="yui-gc">
	<div class="yui-u first">
		<div class="pad">
			<h4>Descripcion</h4>
			<?=auto_typography($task->body)?>
			<br />
			<br />
			<?if($task->task->exists()):?>
				<hr />
				<br />
				<h4>TAP superior</h4>
				<table>
					<tr>
						<th>Estado</th>
						<th>Asunto</th>
						<th>Restante</th>
					</tr>
					<?foreach($task->task as $t):?>
					<tr>
						<td class="status">
							<span class="<?=$t->status->status?>"><?=$t->status->status?></span>
						</td>
						<td class="subject">
						<?if(($task->user_id == $this->session->userdata('id')) OR ($this->session->userdata('admin'))):?>
						<?=anchor('tasks/view/'.$t->slug,character_limiter($t->subject, 30),'title="'.$t->subject.'"')?>
						<?php else:?>
							<?=character_limiter($t->subject, 30)?>
						<?php endif?>
						</td>
						<td><?=timespan(time(),$t->end_date)?></td>
					</tr>
					<?endforeach;?>
				</table>
			<?endif?>
			<?if(!$task->task->exists()):?>
			<h4>TAPS dependientes</h4>
			<?if(($task->user_id == $this->session->userdata('id')) OR ($this->session->userdata('admin')) OR ($tr->role_id < 3)):?>
			<p><?=anchor('tasks/add_edit/0/'.$task->id, 'Crear nueva dependencia','class="nyroModal"')?></p>
			<?else:?>
				<p>No tiene permisos para agregar taps dependientes.</p>
			<?endif?>
			<?if($task->relatedtask->exists()):?>
				<table>
					<tr>
						<th>Estado</th>
						<th>Asunto</th>
						<th class="right">Restante</th>
					</tr>
					<?foreach($task->relatedtask as $t):?>
					<?if(($t->user_id == $this->session->userdata('id')) OR ($this->session->userdata('admin'))):?>
					<tr>
						<td class="status">
							<span class="<?=$t->status->status?>"><?=$t->status->status?></span>
						</td>
						<td class="subject">
						<?=anchor('tasks/view/'.$t->slug,character_limiter($t->subject, 30),'title="'.$t->subject.'"')?>
						</td>
						<td class="right"><?=timespan(time(),$t->end_date)?></td>
					</tr>
					<?php endif?>					
					<?endforeach;?>
				</table>
			<?else:?>
				<p>Este TAP no posee tareas dependientes.</p>
			<?endif?>
			<?endif?>
			<h4>Agregar un comentario</h4>
			<?=form_open('tasks/add_comment/'.$task->id)?>
			<p><?=form_textarea(array('name' => 'comment','style' => 'width:97%; height:100px; padding:10px;', 'title' => 'Puede incluir etiquetas HTML básicas como a, li, ul, etc.', 'class' => 'tipwe'))?></p>
			<?=form_submit('comentar','Enviar comentario')?>
			<p></p>
			<?if($task->comment->exists()):?>
			<h4>Comentarios</h4>
				<div class="comments">
					<?foreach($task->comment as $c):?>
					<div class="comment">
						<div class="comment_info">
							<p>
								<strong><?=$c->user->name?></strong> <small>hace <?=timespan($c->created)?> ...</small>
							</p>
						</div>
						<p><?=auto_typography($c->comment)?></p>
					</div>
					<?endforeach;?>
				</div>
			<?endif;?>
		</div>
	</div>
	<div class="yui-u">
		<div class="pad task">
			<h4>Detalles de TAP</h4>
			<?if(($task->user_id == $this->session->userdata('id')) OR ($this->session->userdata('admin'))):?>
			<p><?=anchor('tasks/add_edit/'.$task->id, 'Editar detalles','class="modal"')?></p>
			<?endif?>
			<table>
				<tr>
					<th>Ítem</th>
					<th class="right">Descripción</th>
				</tr>
				<tr>
					<td><?=img('static/img/icon/flag.png')?>
						<?if(($task->user_id == $this->session->userdata('id')) OR ($this->session->userdata('admin')) OR ($tr->role_id == 2)):?>
							<?=anchor('tasks/change_status/'.$task->id,'Estado','class="modal tipns" title="Presione aquí para cambiar el estado."')?>
						<?else:?>
							Estado
						<?endif?>
					</td>
					<td class="right status">
						<span class="<?=$task->status->status?>"><?=$task->status->status?></span>
					</td>
				</tr>
				<tr>
					<td><?=img('static/img/icon/fire.png')?> Prioridad</td>
					<td class="right">
						<?php echo $task->type->type?> 
					</td>
				</tr>
				<?if(!$task->completed):?>
				<tr>
					<td><?=img('static/img/icon/clock.png')?> Restante</td>
					<td class="right">
						<?
							if($task->end_date > time()) echo timespan(time(),$task->end_date);
							else echo "venció el ".mdate('%d/%m/%Y',$task->end_date);
						?> 
					</td>
				</tr>
				<?endif?>
				<?if($task->completed):?>
				<tr>
					<td><?=img('static/img/icon/calendar_2.png')?> Completa</td>
					<td class="right"><?=mdate('%d/%m/%Y - %H:%i %a',$task->completed)?></td>
				</tr>
				<?endif;?>
				<tr>
					<td><?=img('static/img/icon/calendar_2.png')?> Creada</td>
					<td class="right"><?=mdate('%d/%m/%Y - %H:%i %a',$task->created)?></td>
				</tr>
				<tr>
					<td><?=img('static/img/icon/calendar_2.png')?> Inicio</td>
					<td class="right"><?=mdate('%d/%m/%Y - %H:%i %a',$task->start_date)?></td>
				</tr>
				<tr>
					<td>
						<?=img('static/img/icon/calendar_2.png')?>
						<?if((($task->user_id == $this->session->userdata('id')) OR ($this->session->userdata('admin')) OR ($tr->role_id < 4)) AND (!$task->completed)):?>
							<?=anchor('tasks/postpone/'.$task->slug,'Vence','class="modal tipns" title="Presione aquí para postergar."')?>
						<?else:?>
							Vencimiento
						<?endif?>
					</td>
					<td class="right"><?=mdate('%d/%m/%Y - %H:%i %a',$task->end_date)?></td>
				</tr>
				<tr>
					<td><?=img('static/img/icon/user.png')?> Solicitante</td>
					<td class="right"><?=$task->creator->name?></td>
				</tr>
				<tr>
					<td><?=img('static/img/icon/tag.png')?> Categoría</td>
					<td class="right">
					<?
						echo anchor('tasks/tag/'.$task->tag->slug,$task->tag->tag,'class="tag"');
					?>
					</td>
				</tr>
			</table>
			<h4>Recursos asignados</h4>
			<?if(($task->user_id == $this->session->userdata('id')) OR ($this->session->userdata('admin'))):?>
			<p><?=anchor('tasks/add_roles/'.$task->id,'Administrar recursos','class="nyroModal"')?></p>
			<?endif?>
			<?if($users->num_rows() > 0):?>	
				<table>
					<tr>
						<th>Rol</th>
						<th class="right">Usuario</th>
					</tr>
					<?foreach($users->result() as $r):?>
					<tr>
						<td>
							<?=$r->role?>
						</td>
						<td class="right">
							<?=$r->name?>
						</td>
					</tr>
					<?endforeach;?>
				</table>
			<?else:?>
			<p class="error">No hay recursos asignados.</p>
			<?endif?>
			<?if(isset($pete)):?>
				<h4>Archivos adjuntos</h4>
				<p><?=anchor('#','Crear nuevo adjunto')?></p>
				<table>
					<tr>
						<th>Nombre</th>
						<th>Tipo</th>
						<th class="right">Tamaño</th>
						<th class="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
					</tr>
					<?foreach($task->role as $r):?>
					<tr>
						<td>
							<?=anchor('#','Configuracion_router_cisco')?>
						</td>
						<td>
							PDF
						</td>
						<td class="right">
							2,5Mb
						</td>
						<td class="right"><?=anchor('#',img('static/img/icon/trash.png'))?></td>
					</tr>
					<?endforeach;?>
				</table>
			<?endif?>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function() {
	scrollSidebar('.task',0);
	scrollSidebar('.rightsidebar',0);
});
</script>
