<div class="pad">
	<div id="filtros">
		<?=form_open('reports/index')?>
			<?php 
				if(isset($_POST['date_from']))
				{
					if($_POST['date_from'] != '') $from = $_POST['date_from'];
					else $from = date('d/m/Y');
				}
				else $from = date('d/m/Y');
				if(isset($_POST['date_to']))
				{
					if($_POST['date_to'] != '') $to = $_POST['date_to'];
					else $to = date('d/m/Y');
				}
				else $to = date('d/m/Y');
			?>
			<?=img('static/img/icon/calendar_2.png')?>
			<input type="text" name="date_from" value="<?php echo $from ?>" class="tipns date" title="Fecha desde"/>
			&rarr;&nbsp;&nbsp;&nbsp;
			<?=img('static/img/icon/calendar_2.png')?>
			<input type="text" name="date_to" value="<?php echo $to ?>" class="tipns date" title="Fecha hasta"/>
			<button type="submit" id="filtrar"/><?=img('static/img/white/zoom.png')?> Filtrar</button>
		<?=form_close()?>
	</div>
	<table id="charts">
		<tr>
			<th>Cantidad de tareas por prioridad</th>
			<th>Cantidad de tareas por estado</th>
		</tr>
		<tr>
			<td><?=$prioridad?></td>
			<td><?=$status?></td>
		</tr>
		<tr>
			<th>Tareas por usuario / estado</th>
			<th>Tareas por usuario / prioridad</th>
		</tr>
		<tr>
			<td>
				<div class="scroll">
					<?=$users_status?>
				</div>
			</td>
			<td>
				<div class="scroll">
					<?=$users_priority?>
				</div>
			</td>
		</tr>
		<tr>
			<th>Tareas por sucursal / estado</th>
			<th>Tareas por sucursal / prioridad</th>
		</tr>
		<tr>
			<td>
				<div class="scroll">
					<?=$branches_status?>
				</div>
			</td>
			<td>
				<div class="scroll">
					<?=$branches_priority?>
				</div>
			</td>
		</tr>
	</table>
</div>