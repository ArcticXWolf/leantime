<?php

namespace leantime\domain\controllers {

    use leantime\core;
    use leantime\domain\models\auth\roles;
    use leantime\domain\repositories;
    use leantime\domain\services\auth;

    class del
    {

        /**
         * run - display template and edit data
         *
         * @access public
         */
        public function run()
        {

            $tpl = new core\template();
            $editortemplatesRepo = new repositories\editortemplates();
            $language = new core\language();

            //Only admins
            if (auth::userIsAtLeast(roles::$editor)) {

                if (isset($_GET['id'])) {
                    $id = (int)($_GET['id']);
                }

                if (isset($_POST['del'])) {

                    $editortemplatesRepo->del($id);

                    $tpl->setNotification($language->__('notifications.editortemplate_deleted_successfully'), "success");

                    if (isset($_SESSION['lastPage'])) {
                        $tpl->redirect($_SESSION['lastPage']);
                    } else {
                        $tpl->redirect(BASE_URL . "/editortemplates/showAll");
                    }
                }

                $tpl->assign('id', $id);
                $tpl->displayPartial('editortemplates.del');
            } else {
                $tpl->displayPartial('general.error');
            }
        }
    }
}
