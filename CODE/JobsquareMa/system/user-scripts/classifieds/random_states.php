<?php

class SJB_Classifieds_RandomStates extends SJB_Function
{
    public function execute()
    {
        $template = SJB_Request::getVar('template', 'random_states.tpl');
        
         $states=SJB_DB::query('SELECT * FROM states where display=1 ORDER BY RAND() LIMIT 0,4');
		       $tp = SJB_System::getTemplateProcessor();
        $tp->assign('states', $states);
        $tp->display($template);
    }
}
