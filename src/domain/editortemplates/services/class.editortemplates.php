<?php

namespace leantime\domain\services {

    use leantime\core;
    use leantime\domain\repositories;

    class editortemplates
    {

        private $editortemplateRepository;

        public function __construct()
        {

            $this->tpl = new core\template();
            $this->editortemplateRepository = new repositories\editortemplates();
        }

        public function getAll()
        {
            return $this->editortemplateRepository->getAll();
        }
    }
}
