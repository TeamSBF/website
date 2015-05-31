<?php ob_start();?>
<[[tag]] class="[[classes]]" id="[[id]]" style="[[style]]">[[content]]</[[tag]]>
<?php
$ret = ob_get_contents();
ob_end_clean();
return $ret;
?>