<?php

class SJB_Classifieds_RandomSecteurs extends SJB_Function
{
    public function execute()
    {
        $template = SJB_Request::getVar('template', 'random_secteurs.tpl');
        
         $secteurs=SJB_DB::query('SELECT * FROM secteurs where display=1 ORDER BY RAND() LIMIT 0,4');
		       $tp = SJB_System::getTemplateProcessor();
        $tp->assign('secteurs', $secteurs);
        $tp->display($template);
    }
}
