<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>SGI</title>
	<meta charset="utf-8">
	<?=link_tag('static/css/yui.css')?>
	<?=link_tag('static/css/sgi.css')?>
	<?=link_tag('static/css/chat.css')?>
	<?=link_tag('static/css/nyroModal.css')?>
	<?=link_tag('static/css/tipsy.css')?>
	<?=link_tag('static/css/calendar.css')?>
	<?=link_tag('static/css/spellcheck.css')?>
	<?=link_tag('static/css/sgi-ui/jquery-ui-1.8.9.custom.css')?>
	<script src="<?=site_url('static/js/jquery-1.4.4.min.js')?>" type="text/javascript"></script>
	<script src="<?=site_url('static/js/jquery-ui-1.8.9.custom.min.js')?>" type="text/javascript"></script>
	<script src="<?=site_url('static/js/jquery.ui.datepicker-es.js')?>" type="text/javascript"></script>
	<script src="<?=site_url('static/js/jquery.nyroModal.custom.js')?>" type="text/javascript"></script>
	<script src="<?=site_url('static/js/jquery.tipsy.js')?>" type="text/javascript"></script>
	<script src="<?=site_url('static/js/jquery.periodicalupdater.js')?>" type="text/javascript"></script>
	<script src="<?=site_url('static/js/jquery-ui-timepicker-addon.js')?>" type="text/javascript"></script>
	<script src="<?=site_url('static/js/jquery.spellcheck.js')?>" type="text/javascript"></script>
	<script src="<?=site_url('static/js/chat.js')?>" type="text/javascript"></script>
	<script src="<?=site_url('static/js/FusionCharts.js')?>" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.nyroModal').nyroModal();
			$('.modal').nyroModal({
				modal: true
			});
			
			$.datepicker.setDefaults($.datepicker.regional['es']);
			$('.date').datepicker({
				showAnim: 'fadeIn',
			});
			
			$('.error, .success').click(function(){
				$(this).fadeOut();
			});
			
			$('.tipwe').tipsy({gravity: $.fn.tipsy.autoWE, fade:true});
			$('.tipns').tipsy({gravity: $.fn.tipsy.autoNS, fade:true});
			$.PeriodicalUpdater('<?=site_url('tasks/periodical')?>', {
				method: 'post',          // method; get or post
										// array of values to be passed to the page - e.g. {name: "John", greeting: "hello"}
				minTimeout: 1000,       // starting value for the timeout in milliseconds
				maxTimeout: 8000,       // maximum length of time between requests
				multiplier: 2,          // if set to 2, timerInterval will double each time the response hasn't changed (up to maxTimeout)
				type: 'json',           // response type - text, xml, json, etc.  See $.ajax config options
				maxCalls: 0,            // maximum number of calls. 0 = no limit.
				autoStop: 0             // automatically stop requests after this many returns of the same data. 0 = disabled.
			}, function(data) {
				var oldnew = parseInt($('#nuevo').html());
				var oldupdates = parseInt($('#updates').html());
				var oldvencidas = parseInt($('#vencidas').html());
				var oldpostergadas = parseInt($('#postponed').html());
				var oldcomplete = parseInt($('#complete').html());
				var oldnotificado = parseInt($('#notificaciones').html());
				var oldall = parseInt($('#all').html());
				var oldactivas = parseInt($('#activas').html());
				var oldotros = parseInt($('#otros').html());
			//	var oldmsg = $('#msg').html();
				
				if(oldnew !== data.new)
				{
					$('#nuevo').html(data.new).addClass('new');
					var oldnew = data.new;
				}
				if(oldupdates !== data.updates)
				{
					$('#updates').html(data.updates).addClass('new');
					var oldupdates = data.updates;
				}
				if(oldvencidas !== data.vencidas)
				{
					$('#vencidas').html(data.vencidas).addClass('new');
					var oldvencidas = data.vencidas;
				}
				if(oldpostergadas !== data.postergadas)
				{
					$('#postponed').html(data.postergadas).addClass('new');
					var oldpostergadas = data.postergadas;
				}
				if(oldcomplete !== data.complete)
				{
					$('#complete').html(data.complete).addClass('new');
					var oldcomplete = data.complete;
				}
				if(oldnotificado !== data.notificaciones)
				{
					$('#notificaciones').html(data.notificaciones).addClass('new');
					var oldnotificado = data.notificaciones;
				}
				if(oldall !== data.all)
				{
					$('#all').html(data.all).addClass('new');
					var oldall = data.all;
				}
				if(oldactivas !== data.activas)
				{
					$('#activas').html(data.activas).addClass('new');
					var oldactivas = data.activas;
				}
				if(oldotros !== data.otros)
				{
					$('#otros').html(data.otros).addClass('new');
					var oldotros = data.otros;
				}
			/*	if(oldmsg !== data.vencidas)
				{
					$('#msg').html(data.vencidas).addClass('new');
					var oldvencidas = data.vencidas;
				} */
			});
		});
	</script>
</head>

<body>
	<div id="doc3" class="yui-t5">
		<div id="hd">
			<ul class="nav">
				<?php
					if($mensajes > 0) $mensajes = ' <span class="label">'.$mensajes.'</span>';
					else $mensajes = "";
				?>
				<li><?=anchor('tasks/switch_mode/list',img('static/img/white/monitor.png').' Inicio','class="tipns" title="Ver TAPS por vencer"')?></li>
				<li><?=anchor('tasks/switch_mode/calendar',img('static/img/white/calendar_1.png').' Calendario','class="tipns" title="Ver calendario de vencimientos"')?></li>
				<li><?=anchor('messages',img('static/img/white/mail_2.png').' Mensajes'.$mensajes,'class="tipns" title="Envíe y reciba mensajes entre los usuarios del sistema."')?></li>
				<li><?=anchor('users/agenda',img('static/img/white/notepad.png').' Agenda','target="blank" class="tipns" title="Consulte la agenda telefónica del personal."')?></li>
				<li><?=anchor('tasks/add_edit',img('static/img/white/sq_plus.png').' Agregar TAP','class="modal tipns" title="Haga click aquí para agregar una TAP al sistema."')?></li>
				<?if($this->session->userdata('admin')):?>
				<li><?=anchor('reports/index',img('static/img/white/chart_bar.png').' Reportes','class="tipns" title="Ver reportes y estadísticas."')?></li>
				<?endif?>
				<?if($this->session->userdata('admin')):?>
				<li><?=anchor('tags/admin_tags',img('static/img/white/tag.png').' Categorías','class="nyroModal tipns" title="Presione aquí para agregar, modificar y eliminar categorías."')?></li>
				<li><?=anchor('users/admin',img('static/img/white/users.png').' Usuarios','class="tipns nyroModal" title="Administrar usuarios."')?></li>
				<li><?=anchor('branches/admin_branches',img('static/img/white/globe_2.png').' Sucursales','class="tipns nyroModal" title="Administrar sucursales."')?></li>
                
				<?endif?>
			</ul>
			<ul class="user">
				<li><?=anchor('users/add_edit/'.$this->session->userdata('id').'/1',img('static/img/white/user.png').' '.$this->session->userdata('name'),'class="nyroModal tipns" title="Modifique su perfil de usuario"')?></li>
		<!--	<?if($this->session->userdata('admin')):?><li><?=anchor('#',img('static/img/white/cog.png'),'class="tipwe" title="Configurar parámetros del sistema."')?></li><?endif?>	!-->
				<li><?=anchor('/auth/logout',img('static/img/white/on-off.png').' Salir','class="tipwe" title="Haga click aquí para cerrar sesión."')?> </li>
				<li><?=date('h:i:s')?></li>
			</ul>
		</div>
		<div id="bd">
			<div id="yui-main">
				<div class="yui-b">
					<?=$content?>
			   </div>
			</div>
			<div class="yui-b sidebar">
				<?=$sidebar?>
			</div>
		</div>
	</div>
<!-- Sidebars fixed	
<script type="text/javascript">
function scrollSidebar(e,padding)
{
	var $sidebar   = $(e),
        $window    = $(window),
        offset     = $sidebar.offset(),
        topPadding = padding;

    $window.scroll(function() {
        if ($window.scrollTop() > offset.top) {
            $sidebar.stop().animate({
                marginTop: $window.scrollTop() - offset.top + topPadding
            });
        } else {
            $sidebar.stop().animate({
                marginTop: 0
            });
        }
    });
}
</script>
-->
</body>
</html>
