<?php

class SJB_Admin_Miscellaneous_TaskSchedulerSettings extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_SETTINGS);
        return parent::isAccessible();
    }

    public function execute()
    {
        $tp = SJB_System::getTemplateProcessor();
        $action = SJB_Request::getVar('action');
        $template = 'task_scheduler_settings.tpl';

        $tp->assign('cronPath', SJB_BASE_DIR . 'cron/index.php');

        if ($action != 'log_view') {
            $res = SJB_DB::query("SELECT * FROM `task_scheduler_log` ORDER BY `sid` DESC LIMIT 1");
            $tp->assign('task_scheduler_log', array_pop($res));
        } else {
            $log_file = [];
            $res = SJB_DB::query("SELECT `log_text` FROM `task_scheduler_log` ORDER BY `sid` DESC LIMIT 200");
            foreach ($res as $record) {
                $text = $record['log_text'];
                if ($text)
                    $log_file[] = $text;
            }

            $tp->assign('log_content', $log_file);
            $template = 'task_scheduler_log_view.tpl';
        }

        $tp->display($template);
    }
}