<?php

defined('_JEXEC') or die('Restricted access');

function modChrome_jaw($module, &$params, &$attribs)
{
	if (!empty ($module->content)) : ?>
	<div class="module">
        <div class="inner">
		<?php if ($module->showtitle != 0) : ?>
		<h3 class="module-title"><?php echo $module->title; ?></h3><span class="modtitle"></span>
		<?php endif; ?>
	    <div class="module-body">
	        <?php echo $module->content; ?>
        </div>
        </div>
	</div>
<?php endif;}?>


<?php function modChrome_usergrid($module, &$params, &$attribs) { ?>
<div class="module <?php echo $params->get( 'moduleclass_sfx' ); ?> <?php echo $attribs['grid'] ?> col clr">
	<?php if ($module->showtitle) : ?>
    	<h3 class="module-title"><?php echo $module->title; ?></h3>
    <?php endif; ?>
    <div class="module-body">
    	<?php echo $module->content; ?>
    </div>
</div>
<?php }?>


<?php
function modChrome_grid($module, &$params, &$attribs) {
?>
<div class="module <?php echo $params->get( 'moduleclass_sfx' ); ?> <?php echo $attribs['grid'] ?>">
	<?php if ($module->showtitle) : ?>
    	<h3 class="module-title"><?php echo $module->title; ?></h3>
    <?php endif; ?>
    <div class="module-body">
    	<?php echo $module->content; ?>
    </div>
</div>
<?php }?>


<?php function modChrome_menu($module, &$params, &$attribs) { ?>
<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#navbar-wrap').prepend('<a id="menu-icon"><span class="menu-icon-title"><?php echo $module->title; ?></span> <i class="icon-double-angle-down"></i> </a>');
		$("#menu-icon").on("click", function(){
			$("#navbar").slideToggle(500,"linear");
			$(this).toggleClass("active");
		});
	});
</script>
    <?php echo $module->content; ?>
<?php }?>
