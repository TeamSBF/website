<?php ob_start();?>
<div class="[[classes]]" id="[[id]]" style="[[style]]">[[content]]</div>
<?php
$ret = ob_get_contents();
ob_end_clean();
return $ret;
?>