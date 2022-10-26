<?php

namespace leantime\domain\controllers {

    use leantime\core;
    use leantime\domain\services;

    class showAll
    {

        private $tpl;
        private $editortemplateService;

        public function __construct()
        {
            $this->tpl = new core\template();
            $this->editortemplateService = new services\editortemplates();

            $_SESSION['lastPage'] = CURRENT_URL;
        }

        public function get($params)
        {

            $this->tpl->assign('allEditortemplates', $this->editortemplateService->getAll());

            $this->tpl->display('editortemplates.showAll');
        }
    }
}
