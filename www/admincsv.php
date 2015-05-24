<?php require_once"header.php"; ?>
<?php

if ($user && $user->AccessLevel >= 2)
{
	$csv = new CSVConverter();
	$rowCount = $csv->getDataTableRowCount();
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
	//$.ajax({ url: 'scripts/MakeAssessmentCsv.php' });
	window.location.href = 'scripts/CsvDownload.php?f=assessment_data.csv';
});

$("#enrollmentDl").on("click", function() {
	//$.ajax({ url: 'scripts/MakeEnrollmentCsv.php' });
	window.location.href = 'scripts/CsvDownload.php?f=enrollment_data.csv';
});

$("#questionnaireDl").on("click", function() {
	//$.ajax({ url: 'scripts/MakeQuestionnaireCsv.php' });
	window.location.href = 'scripts/CsvDownload.php?f=questionnaire_data.csv';
});

$("#parqDl").on("click", function() {
	$.ajax({ 
		url: 'MakeParqCsv.php',
		async: false,
		success: function(data) {
			$("#scriptMessage").html(data);
		}
	});
	window.location.href = 'scripts/CsvDownload.php?f=parq_data.csv';
});

</script>

<?php } ?>

<?php require_once"footer.php"; ?>


