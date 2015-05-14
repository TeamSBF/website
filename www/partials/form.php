<?php ob_start();?>
<form action="[[action]]" method="[[method]]">
    [[content]]
</form>
<?php
$ret = ob_get_contents();
ob_end_clean();
return $ret;
?>