<?php
namespace WY\app\libs;

use WY\app\Config;
use WY\app\libs\Db;
use WY\app\libs\Res;
use WY\app\libs\Req;
use WY\app\libs\Log;
if (!defined('WY_ROOT')) {
    exit;
}
class Model
{
    public $limits = '';
    public $limit = false;
    public $offset = false;
    public $orderby = '';
    public $where = [];
    public $fields = '';
    public $insertData = [];
    public $updateSet = [];
    private $db;
    public $in = false;
    public $left = '';
    public $right = '';
    public $inner = '';
    public $join = '';
    public $on = '';
    public $groupby = '';
    function __construct()
    {
        $this->prefix = Config::db()['prefix'];
        $this->db = Db::getInstance();
        $this->db->connect();
        $this->res = new Res();
        $this->req = new Req();
    }
    function select($fields = '*')
    {
        $this->fields = $fields;
        return $this;
    }
    function from($table)
    {
        $this->table = $this->prefix . $table;
        return $this;
    }
    function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }
    function offset($offset)
    {
        $this->offset = $offset;
        return $this;
    }
    function orderby($orderby)
    {
        if ($orderby) {
            $this->orderby = 'ORDER BY ' . $orderby;
        }
        return $this;
    }
    function groupby($groupby)
    {
        $this->groupby = 'GROUP BY ' . $groupby;
        return $this;
    }
    function where($where)
    {
        $this->where = $where;
        return $this;
    }
    function sums($fields)
    {
        $this->sums = $fields;
        return $this;
    }
    function in()
    {
        if ($this->where) {
            $this->in = true;
        }
        return $this;
    }
    function on($on)
    {
        $this->on = $on;
        return $this;
    }
    function join()
    {
        if ($this->left) {
            $this->join = 'LEFT JOIN ' . $this->left . ' ON ' . $this->on;
        }
        if ($this->right) {
            $this->join = 'RIGHT JOIN ' . $this->right . ' ON ' . $this->on;
        }
        if ($this->inner) {
            $this->join = 'INNER JOIN ' . $this->inner . ' ON ' . $this->on;
        }
        return $this;
    }
    function left($table)
    {
        $this->left = $this->prefix . $table;
        return $this;
    }
    function inner($table)
    {
        $this->inner = $this->prefix . $table;
        return $this;
    }
    function right($table)
    {
        $this->right = $this->prefix . $table;
        return $this;
    }
    function toSql()
    {
        if (false !== $this->limit) {
            if (false !== $this->offset) {
                $this->limits = 'LIMIT ' . $this->offset . ',' . $this->limit;
            } else {
                $this->limits = 'LIMIT ' . $this->limit;
            }
        }
        $sql = "select " . $this->fields . " from " . $this->table . " " . $this->join . " {where} " . $this->groupby . "  " . $this->orderby . " " . $this->limits;
        return $sql;
    }
    function fetchAll()
    {
        $sql = $this->toSql();

	

        $data = array();
        if ($this->where) {
            $data = $this->db->parseWhere($this->where);
            $sql = str_replace('{where}', $data['where'], $sql);
        } else {
            $sql = str_replace('{where}', '', $sql);
        }
        $stm = $this->db->prepare($sql);
        if ($data) {
            $this->db->bindValue($stm, $data['values']);
        }





        $this->db->execute($stm);
        if ($stm->rowCount()) {
            return $this->db->fetchAll($stm);
        }
        return false;
    }
    function fetchRow()
    {
        $sql = $this->toSql();
        $data = array();
        if ($this->where) {
            $data = $this->db->parseWhere($this->where);
            $sql = str_replace('{where}', $data['where'], $sql);
        } else {
            $sql = str_replace('{where}', '', $sql);
        }
        $stm = $this->db->prepare($sql);
        if ($data) {
            $this->db->bindValue($stm, $data['values']);
        }		

        $this->db->execute($stm);

        if ($stm->rowCount()) {
            return $this->db->fetchRow($stm);
        }
        return false;
    }
    function insertData(array $insertData)
    {
        $this->insertData = $insertData;
        return $this;
    }
    function updateSet(array $updateSet)
    {


        $this->updateSet = $updateSet;
        return $this;
    }
    function insert()
    {
        if (!$this->insertData) {
            return false;
        }
        $result = $this->db->insert($this->table, $this->insertData);
        return $result;
    }
    function count()
    {
        $result = $this->db->count($this->table, $this->where);
        return $result;
    }
    function sum()
    {
        $result = $this->db->sum($this->table, $this->fields, $this->where);
        return $result;
    }
    function delete()
    {
        if ($this->in) {
            $result = $this->db->deleteIn($this->table, $this->where);
        } else {
            $result = $this->db->delete($this->table, $this->where);
        }
        return $result;
    }
    function update()
    {
        if (!$this->updateSet) {
            return false;
        }

	


        $result = $this->db->update($this->table, $this->updateSet, $this->where);
        return $result;
    }
    protected function model()
    {
        return new Model();
    }
}
?>