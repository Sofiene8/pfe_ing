<?php

class SJB_Admin_Miscellaneous_FunctionIsNotAccessible extends SJB_Function
{
	public function execute()
	{
		$tp = SJB_System::getTemplateProcessor();
        $tp->assign('message', SJB_Array::get($this->params, 'message'));
		$tp->display('../miscellaneous/error.tpl');
	}
}
