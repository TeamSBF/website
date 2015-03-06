<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.form.formfield');

class JFormFieldAsset extends JFormField
{
	protected	$type = 'Asset';
	
	protected function getInput() {
	
        $jsFile = dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "css" . DIRECTORY_SEPARATOR . "mod-style.css";
        $jsUrl = str_replace(JPATH_ROOT, JURI::root(true), $jsFile);
        $jsUrl = str_replace(DIRECTORY_SEPARATOR, "/", $jsUrl);
		$doc = JFactory::getDocument();	
		$doc->addStylesheet($jsUrl);
		return null;
	}
} 
?>