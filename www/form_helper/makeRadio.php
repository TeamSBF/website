<?php
class makeRadio
{
	public function make($values, $class, $name, $label, $amount)
	{
		/*
		$values = $__GET['values'];
		$class = $__GET['class'];
		$name = $__GET['name'];
		$label = $__GET['label'];
		$amount = $__GET['amount'];
		*/
		for ($i = 0; i < $amount; $i++)
		{
			echo "<label class="$class"><input type="radio" name="$name" value="$values[$i]">"$values[$i]"</label>\n";
		}
	}
}




?>