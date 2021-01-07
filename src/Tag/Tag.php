<?php

namespace Anax\Tag;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

class Tag extends ActiveRecordModel
{
    /**
    * @var string $tableName name of the database table.
    */
    protected $tableName = "Tag";


    /**
    * Columns in the table.
    *
    * @var integer $id primary key auto incremented.
    */
    public $tagId;
    public $tag;
    public $questionId;

    public function findTag($where, $value)
    {
        $this->checkDb();
        $params = is_array($value) ? $value : [$value];
        return $this->db->connect()
        ->select()
        ->from($this->tableName)
        ->where($where . " = ?")
        ->join("question", "Tag.questionId = Question.questionId")
        ->execute($params)
        ->fetchAllClass(get_class($this));
    }

    public function findAllOrderByGroupBy($orderBy, $groupBy, $limit = 1000, $select = "*")
    {
        $this->checkDb();
        return $this->db->connect()
        ->select($select)
        ->from($this->tableName)
        ->groupBy($groupBy)
        ->orderBy($orderBy)
        ->limit($limit)
        ->execute()
        ->fetchAllClass(get_class($this));
    }
}
