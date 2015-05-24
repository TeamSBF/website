<?php require_once"header.php"; ?>
<?php

// needs better protection but is a proof of concept
if(isset($_GET['f']))
    {
        $csv = new CSVConverter();
        // we don't want anything being sent along with the csv
        ob_end_clean();
        CSVConverter::testGet($_GET['f']);
        // not enough data for me to test this out and the method is not set up to handle
        // automatic file downloads either
        //$csv->getParQCSV();
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
	//$.ajax({ url: 'scripts/MakeAssessmentCsv.php' });
	window.location.href = 'admincsv.php?f=assessments';
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


