<?php ob_start();?>
<label>[[content]]</label>
<?php
$ret = ob_get_contents();
ob_end_clean();
return $ret;
?>