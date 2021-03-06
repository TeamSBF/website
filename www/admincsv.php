<?php require_once"header.php";

$csv = new CSVConverter();
// needs better protection but is a proof of concept
if(isset($_GET['f']))
{
	$start = $_GET['start'];
	$end = $_GET['end'];
	if ($start != 0 && $start != "")
		$start = strtotime($_GET['start']);
	else
		$start = 0;
	if ($end != 0 && $end != "")
		$end = strtotime($_GET['end']);
	else
		$end = PHP_INT_MAX;
    // we don't want anything being sent along with the csv
    ob_end_clean();
    $csv->getCSV($_GET['f'], $start, $end);
    // kill the page so it can't output any else except for the file
    die();
}
else
{	
	//$rowCount = $csv->getDataTableRowCount();
	//$rowCount = CSVConverter::getDataTableRowCount();
?>
<div class="background">
<h1>Data Retrieval [ADMIN]</h1>
<p>You can download CSV (comma spererated values) files for various data here.</p>
<div><label>You can choose to gather data within a time range by checking the box and picking dates</label></div>

<div id="scriptMessage"></div>

<h3>Assessments Data:</h3>
<button type="button" id="assessmentDl">Download</button>
<div style="margin-top:15px;margin-bottom:15px"><input type="checkbox" id="assessmentBox"><label>Filter By Date</label>
<label style="margin-left:50px;margin-right:10px">From:</label><input type="date" id="assessmentDateStart">
<label style="margin-left:20px;margin-right:10px">To:</label><input type="date" id="assessmentDateEnd" value="<?php echo date('Y-m-d'); ?>"></div>

<hr>

<h3>Enrollment Form Data</h3>
<button type="button" id="enrollmentDl">Download</button>
<div style="margin-top:15px;margin-bottom:15px"><input type="checkbox" id="enrollmentBox"><label>Filter By Date</label>
<label style="margin-left:50px;margin-right:10px">From:</label><input type="date" id="enrollmentDateStart">
<label style="margin-left:20px;margin-right:10px">To:</label><input type="date" id="enrollmentDateEnd" value="<?php echo date('Y-m-d'); ?>"></div>


<hr>

<h3>Questionnaire Form Data</h3>
<button type="button" id="questionnaireDl">Download</button>
<div style="margin-top:15px;margin-bottom:15px"><input type="checkbox" id="questionnaireBox"><label>Filter By Date</label>
<label style="margin-left:50px;margin-right:10px">From:</label><input type="date" id="questionnaireDateStart">
<label style="margin-left:20px;margin-right:10px">To:</label><input type="date" id="questionnaireDateEnd" value="<?php echo date('Y-m-d'); ?>"></div>

<hr>

<h3>ParQ Form Data</h3>
<button type="button" id="parqDl">Download</button>
<div style="margin-top:15px;margin-bottom:15px"><input type="checkbox" id="parqBox"><label>Filter By Date</label>
<label style="margin-left:50px;margin-right:10px">From:</label><input type="date" id="parqDateStart">
<label style="margin-left:20px;margin-right:10px">To:</label><input type="date" id="parqDateEnd" value="<?php echo date('Y-m-d'); ?>"></div>
</div>

<script>

/* event handlers to download the files */
$(document).ready(function() { 
	
});

$("#assessmentDl").on("click", function() {
	var startDate = 0; var endDate = 0;
	if ($("#assessmentBox").is(":checked")) {
		startDate = $("#assessmentDateStart").val();
		endDate = $("#assessmentDateEnd").val();		
	}
	window.location.href = 'admincsv.php?f=assessments';
});

$("#enrollmentDl").on("click", function() {
	var startDate = 0; var endDate = 0;
	if ($("#enrollmentBox").is(":checked")) {
		startDate = $("#enrollmentDateStart").val();
		endDate = $("#enrollmentDateEnd").val();		
	}
	window.location.href = 'admincsv.php?f=enrollment&start='+ startDate +'&end='+ endDate;
});

$("#questionnaireDl").on("click", function() {
	var startDate = 0; var endDate = 0;
	if ($("#questionnaireBox").is(":checked")) {
		startDate = $("#questionnaireDateStart").val();
		endDate = $("#questionnaireDateEnd").val();		
	}
	window.location.href = 'admincsv.php?f=questionnaire&start='+ startDate +'&end='+ endDate;
});

$("#parqDl").on("click", function() {
	var startDate = 0; var endDate = 0;
	if ($("#parqBox").is(":checked")) {
		startDate = $("#parqDateStart").val();
		endDate = $("#parqDateEnd").val();		
	}
	window.location.href = 'admincsv.php?f=parq&start='+ startDate +'&end='+ endDate;
});

</script>

<?php } ?>

<?php require_once"footer.php"; ?>