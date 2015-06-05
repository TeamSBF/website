<?php
class MakeRadio
{
	public function make($values, $class, $name, $amount)
	{
		foreach ($values as $val)
		{
			echo '<label class="'.$class.'"><input type="radio" name="'.$name.'" value="'.$val.'">'.$val.'</label>';
		}
	}
}
?>
// example
				<div class="form-group">
                <label class="control-label">*How often do you perform the Sit and Be Fit exercises?</label><br>
                <?php
	                $vals = ["Less than once a month", "Once per month", "Once per week", "More than once per week"];
	                $radio->make($vals, "radio col-sm-offset-2", "boggusName", 3);
                ?>
              	</div>