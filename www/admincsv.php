<?php require_once"header.php"; ?>
<?php

$csv = new CSVConverter();
// needs better protection but is a proof of concept
if(isset($_GET['f']) && $user && $user->AccessLevel >= 2)
{
    // we don't want anything being sent along with the csv
    ob_end_clean();
    $csv->getCSV($_GET['f']);
    // kill the page so it can't output any else except for the file
    die();
}
else if ($user && $user->AccessLevel >= 2)
{	
	//$rowCount = $csv->getDataTableRowCount();
	//$rowCount = CSVConverter::getDataTableRowCount();
?>
<div class="background">
<h1>Data Retrieval [ADMIN]</h1>
<p>You can download CSV (comma spererated values) files for various data here.</p>

<div id="scriptMessage"></div>

<h4>Assessments Data:</h4>
<button type="button" id="assessmentDl">Download</button>

<hr>

<h4>Enrollment Form Data</h4>
<button type="button" id="enrollmentDl">Download</button>

<hr>

<h4>Questionnaire Form Data</h4>
<button type="button" id="questionnaireDl">Download</button>

<hr>

<h4>ParQ Form Data</h4>
<button type="button" id="parqDl">Download</button>
</div>

<script>

/* event handlers to download the files */
$("#assessmentDl").on("click", function() {
	window.location.href = 'admincsv.php?f=assessments';
});

$("#enrollmentDl").on("click", function() {
	window.location.href = 'admincsv.php?f=enrollment';
});

$("#questionnaireDl").on("click", function() {
	window.location.href = 'admincsv.php?f=questionnaire';
});

$("#parqDl").on("click", function() {
	window.location.href = 'admincsv.php?f=parq';
});

</script>

<?php } ?>

<?php require_once"footer.php"; ?>


