<?php

namespace leantime\domain\repositories {

    use leantime\core;
    use pdo;
    use leantime\domain\repositories;
    use leantime\domain\services;

    class editortemplates
    {


        /**
         * __construct - get database connection
         *
         * @access public
         */
        public function __construct()
        {

            $this->db = core\db::getInstance();
        }

        public function getAll()
        {

            $sql = "SELECT
						zp_editortemplates.id,
						zp_editortemplates.title,
						zp_editortemplates.description,
						zp_editortemplates.content,
						
				FROM 
				zp_editortemplates
				";

            $stmn = $this->db->database->prepare($sql);

            $stmn->execute();
            $values = $stmn->fetch();
            $stmn->closeCursor();

            return $values;
        }

        public function getEditortemplate($id)
        {

            $sql = "SELECT
						zp_editortemplates.id,
						zp_editortemplates.title,
						zp_editortemplates.description,
						zp_editortemplates.content,
						
				FROM 
				zp_editortemplates
				WHERE zp_editortemplates.id = :id 
				";

            $stmn = $this->db->database->prepare($sql);
            $stmn->bindValue(':id', $id, PDO::PARAM_INT);

            $stmn->execute();
            $values = $stmn->fetch();
            $stmn->closeCursor();

            return $values;
        }

        public function addEditortemplate($values)
        {

            $query = "INSERT INTO zp_editortemplates (
						title,
						description,
						content
				) VALUES (
                        :title,
						:description,
						:content
				)";

            $stmn = $this->db->database->prepare($query);

            $stmn->bindValue(':title', $values['title'], PDO::PARAM_STR);
            $stmn->bindValue(':description', $values['description'], PDO::PARAM_STR);
            $stmn->bindValue(':content', $values['content'], PDO::PARAM_STR);

            $stmn->execute();
            $id = $this->db->database->lastInsertId();
            $stmn->closeCursor();

            return $id;
        }


        public function delEditortemplate($id)
        {
            $query = "DELETE FROM zp_editortemplates WHERE id = :id LIMIT 1";

            $stmn = $this->db->database->prepare($query);

            $stmn->bindValue(':id', $id, PDO::PARAM_INT);

            $stmn->execute();

            $stmn->closeCursor();
        }
    }
}
