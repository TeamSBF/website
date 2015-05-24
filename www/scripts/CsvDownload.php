<?php
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.$_REQUEST['f']);
readfile('./../csv/'.$_REQUEST['f']); 
exit;