<?php
	defined('_JEXEC') or die;
?>

<div class ="<?php echo htmlspecialchars($params->get('moduleclass_sfx'));?>">
	<div id="test_form">
		<form method="post" name="frm_sbf_tests">
			<fieldset>
				<div id="test1">
					<label for="test1" >test1</label>
					<input type="number" id="test1" name="test1" min="0">
				</div>
				
				<div id = "test2">
					<label for="test2" >test2</label>
					<input type="number" id="test2" name="test2" min="0">
				</div>
				
				<div id = "test3">
					<label for="test3" >test3</label>
					<input type="number" id="test3" name="test3" min="0">
				</div>
				
				<div id = "test4">
					<label for="test4" >test4</label>
					<input type="number" id="test4" name="test4" min="0">
				</div>
				
				<div id = "test5">
					<label for="test5" >test5</label>
					<input type="number" id="test5" name="test5" min="0">
				</div>
				
				<div id = "button">
					<button type="submit">Submit</button>
				</div>
			</fieldset>
		
			<input type="hidden" name="check" value="1">
		</form>
	</div>

</div>