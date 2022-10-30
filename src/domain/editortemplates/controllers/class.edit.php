<?php

namespace leantime\domain\controllers {

    use leantime\core;
    use leantime\domain\models\auth\roles;
    use leantime\domain\repositories;
    use leantime\domain\services;
    use leantime\domain\models;

    use DateTime;
    use DateInterval;
    use leantime\domain\services\auth;


    class edit
    {

        private $tpl;
        private $editortemplateService;

        /**
         * constructor - initialize private variables
         *
         * @access public
         *
         */
        public function __construct()
        {
            $this->tpl = new core\template();
            $this->editortemplateService = new services\editortemplates();
        }

        /**
         * get - handle get requests
         *
         * @access public
         *
         */
        public function get($params)
        {
            if (isset($params['id'])) {
                $editortemplate = $this->editortemplateService->get($params['id']);
            } else {
                $editortemplate = new models\editortemplates();
            }

            $this->tpl->assign('editortemplate', $editortemplate);
            $this->tpl->displayPartial('editortemplates.editortemplatedialog');
        }

        /**
         * post - handle post requests
         *
         * @access public
         *
         */
        public function post($params)
        {
            //If ID is set its an update

            if (isset($_GET['id']) && $_GET['id'] > 0) {

                $params['id'] = (int)$_GET['id'];

                if ($this->editortemplateService->edit($params) == true) {

                    $this->tpl->setNotification("Editortemplate edited successfully", "success");
                } else {

                    $this->tpl->setNotification("There was a problem saving the editortemplate", "error");
                }
            } else {

                if ($this->editortemplateService->add($params) == true) {

                    $this->tpl->setNotification("Editortemplate created successfully.", "success");
                } else {

                    $this->tpl->setNotification("There was a problem saving the editortemplate", "error");
                }
            }
            $this->tpl->assign('editortemplate', (object) $params);
            $this->tpl->displayPartial('editortemplates.editortemplatedialog');
        }

        /**
         * put - handle put requests
         *
         * @access public
         *
         */
        public function put($params)
        {
        }

        /**
         * delete - handle delete requests
         *
         * @access public
         *
         */
        public function delete($params)
        {
        }
    }
}
