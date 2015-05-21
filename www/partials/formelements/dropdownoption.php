<?php ob_start();?>
<option value="[[value]]" [[selected]]>[[content]]</option>
<?php
$ret = ob_get_contents();
ob_end_clean();
return $ret;
?>