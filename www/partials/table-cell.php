<?php ob_start();?>
<div class="cell">[[content]]</div>
<?php
$ret = ob_get_contents();
ob_end_clean();
return $ret;
?>