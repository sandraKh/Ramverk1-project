<?php

namespace Anax\Answer;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model using the Active Record design pattern.
 */
class Answer extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Answer";
    protected $tableIdColumn = "answerId";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $answerId;
    public $questionId;
    public $userId;
    public $text;

    public function findAllAnswerWhere($where, $value)
    {
        $this->checkDb();
        $params = is_array($value) ? $value : [$value];
        return $this->db->connect()
                        ->select()
                        ->from($this->tableName)
                        ->where($where . " = ?")
                        ->execute($params)
                        ->fetchAllClass(get_class($this));
    }
}
