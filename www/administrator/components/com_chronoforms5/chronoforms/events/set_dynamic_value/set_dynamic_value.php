<?php
/**
* ChronoCMS version 1.0
* Copyright (c) 2012 ChronoCMS.com, All rights reserved.
* Author: (ChronoCMS.com Team)
* license: Please read LICENSE.txt
* Visit http://www.ChronoCMS.com for regular updates and information.
**/
namespace GCore\Admin\Extensions\Chronoforms\Events\SetDynamicValue;
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
class SetDynamicValue extends \GCore\Admin\Extensions\Chronoforms\Events\Event{
	static $title = 'Set Dynamic Value';
	static $cat_id = 'basic';
	static $cat_title = 'Basic';
	
	public static function config($data = array(), $k = '{N}'){
		echo \GCore\Helpers\Html::formStart('jsevent_config', 'set_dynamic_value_config_'.$k);
		echo \GCore\Helpers\Html::formSecStart();
		
		echo \GCore\Helpers\Html::formLine('-', array('type' => 'multi', 'inputs' => array_merge(self::_fields($data, $k), array(
			array('name' => 'Form[extras][jsevents]['.$k.'][target]', 'type' => 'dropdown', 'label' => array('position' => 'top', 'text' => l_('CF_EVENT_SET_VALUE')), 'sublabel' => l_('CF_EVENT_ELEMENT'), 'options' => self::$fields),
			array('name' => 'Form[extras][jsevents]['.$k.'][ajax]', 'type' => 'text', 'class' => 'M', 'label' => array('position' => 'top', 'text' => l_('CF_EVENT_AJAX')), 'sublabel' => l_('CF_EVENT_AJAX_VALUE_DESC')),
		))));
		
		echo \GCore\Helpers\Html::input('Form[extras][jsevents]['.$k.'][type]', array('type' => 'hidden', 'value' => 'set_dynamic_value'));
		echo \GCore\Helpers\Html::formSecEnd();
		echo \GCore\Helpers\Html::formEnd();
	}
	
	public static function output($target, $event, $form){
		$form_id = 'chronoform-'.$form->form['Form']['title'];
		$return = "";
		if(!empty($event['ajax'])){
			$return .= "
			$.ajax({
				'type' : 'GET',
				'url' : '".r_('index.php?ext=chronoforms&chronoform='.$form->form['Form']['title'].'&event='.$event['ajax'].'&tvout=ajax')."',
				'data' : $('#".$form_id."').serialize(),
				'success' : function(res){
					$('".$target."').val(res);
				},
			});";
		}
		return $return;
	}
}
?>