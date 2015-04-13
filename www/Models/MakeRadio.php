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