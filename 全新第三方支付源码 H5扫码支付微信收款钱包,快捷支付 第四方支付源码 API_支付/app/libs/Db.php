<?php
namespace WY\app\libs;

use WY\app\Config;
use WY\app\libs\Log;
use PDO;
use PDOException;
if (!defined('WY_ROOT')) {
    exit;
}
class Db
{
    private $db = null;
    static $instance = null;
    function __construct()
    {
    }
    function getConfig()
    {
        return Config::db();
    }
    static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Db();
        }
        return self::$instance;
    }
    function connect()
    {
        try {
            $this->db = new PDO('mysql:host=' . $this->getConfig()['server'] . ';port=' . $this->getConfig()['port'] . ';dbname=' . $this->getConfig()['name'] . ';charset=utf8', $this->getConfig()['user'], $this->getConfig()['pass']);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            if ($this->getConfig()['debug']) {
                Log::$type = 'mysql';
                Log::write($e->getMessage());
            }
            echo 'database connect error.';
            exit;
        }
        return $this->db;
    }
    function isConnected()
    {
        if ($this->db == null) {
            return false;
        }
        return true;
    }
    function prepare($sql)
    {
        $stm = $this->db->prepare($sql);
        return $stm;
    }
    function bindValue($stm, $params)
    {
        if (!$params) {
            return false;
        }
        foreach ($params as $key => $val) {
            $key++;
            $stm->bindValue($key, $val);
        }
    }
    function bindParam($stm, $params)
    {
        if (!$params) {
            return false;
        }
        foreach ($params as $key => $val) {
            $key++;
            $stm->bindParam($key, $val);
        }
    }
    function execute($stm)
    {

        try {
            $stm->execute();
        } catch (PDOException $e) {
            $trace = $e->getTrace();
            $str = '';
            foreach ($trace[2] as $key => $val) {
                if ($key == 'file' || $key == 'line' || $key == 'class') {
                    $str .= $str ? "\n" : '';
                    $str .= '[' . $key . ']' . $val;
                }
            }
            Log::write('error in ' . $e->getFile() . ' ' . $e->getLine() . "\n" . $e->getMessage() . "\n" . $stm->queryString . "\n" . $str);
        }
    }
    function query($sql)
    {


        try {
            return $this->db->query($sql);
        } catch (PDOException $e) {
            Log::write('error in ' . $e->getFile() . ' ' . $e->getLine() . "\n" . $e->getMessage() . "\n" . $stm->queryString);
        }
    }
    function exec($sql)
    {


        try {
            return $this->db->exec($sql);
        } catch (PDOException $e) {
            Log::write('error in ' . $e->getFile() . ' ' . $e->getLine() . "\n" . $e->getMessage() . "\n" . $stm->queryString);
        }
    }
    function fetchAll($stm)
    {
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    function fetchRow($stm)
    {
        return $stm->fetch(PDO::FETCH_ASSOC);
    }
    function insert($table, $data)
    {
        if (!$data) {
            return false;
        }
        $result = $this->parseQues($data);
        $sql = "INSERT INTO " . $table . " (" . implode(',', $result['fields']) . ") VALUES(" . implode(',', $result['ques']) . ")";
        $stm = $this->prepare($sql);
        $this->bindValue($stm, $result['values']);
        $this->execute($stm);
        return $this->db->lastInsertId();
    }
    function getTable($table)
    {
        $config = $this->getConfig();
        return $config['prefix'] . $table;
    }
    function delete($table, $where = [])
    {
        $result = $this->parseWhere($where);
        $where = $result && $result['where'] ? $result['where'] : '';
        $sql = "DELETE FROM " . $table . " " . $where;
        $stm = $this->prepare($sql);
        if ($result && $result['values']) {
            $this->bindValue($stm, $result['values']);
        }
        $this->execute($stm);
        return $stm->rowCount();
    }
    function deleteIn($table, $where = [])
    {
        $cons = '';
        if ($where) {
            foreach ($where as $key => $val) {
                $cons = 'WHERE ' . $key . ' IN (' . implode(',', $val) . ')';
            }
        }
        return $this->exec("DELETE FROM " . $table . " " . $cons);
    }
    function update($table, $set, $where = [])
    {
        $result = $this->parseWhere($where);
        $where = $result && $result['where'] ? $result['where'] : '';
        $data = $this->parseQues($set);



//print_r( $data );




        $fields = '';
        foreach ($data['fields'] as $field) {
            $fields .= $fields ? ',' : '';
            $fields .= $field . '=?';
        }
        $sql = "UPDATE " . $table . " SET " . $fields . " " . $where;



        $stm = $this->prepare($sql);
        if ($result && $result['values']) {
            $arr = array_merge($data['values'], $result['values']);
        } else {
            $arr = $data['values'];
        }
        $this->bindValue($stm, $arr);
        $this->execute($stm);
        return $stm->rowCount();
    }
    function count($table, $where = array())
    {
        $result = $this->parseWhere($where);
        $where = $result && $result['where'] ? $result['where'] : '';
        $sql = "SELECT COUNT(*) AS num FROM " . $table . " " . $where;
        $stm = $this->prepare($sql);
        if ($result && $result['values']) {
            $this->bindValue($stm, $result['values']);
        }
        $this->execute($stm);
        $result = $this->fetchRow($stm);
        return $result['num'];
    }
    function sum($table, $fields = array(), $where = array())
    {
        $result = $this->parseWhere($where);
        $where = $result && $result['where'] ? $result['where'] : '';
        if (!$fields || !is_array($fields)) {
            return 0;
        }
        $sum = '';
        foreach ($fields as $key => $val) {
            $sum .= $sum ? ',' : '';
            $sum .= 'sum(' . $val . ') as ' . $key;
        }
        $sql = "SELECT " . $sum . " FROM " . $table . " " . $where;
        $stm = $this->prepare($sql);
        if ($result && $result['values']) {
            $this->bindValue($stm, $result['values']);
        }
        $this->execute($stm);
        $result = $this->fetchRow($stm);
        foreach ($result as $key => $val) {
            $result[$key] = $val == null ? 0 : number_format($val, 2, '.', '');
        }
        return $result;
    }
    function parseQues($data)
    {
        $result = [];
        foreach ($data as $key => $val) {
            $result['fields'][] = $key;
            $result['ques'][] = '?';
            $result['values'][] = $val;
        }
        return $result;
    }
    function parseWhere($where)
    {
        if (!$where) {
            return false;
        }
        if (!$where['fields']) {
            return false;
        }
        return array('where' => 'where ' . $where['fields'], 'values' => $where['values']);
    }
    function hasOper($key, $val)
    {
        if (strpos($val, '>') !== false || strpos($val, '>=') !== false || strpos($val, '<') !== false || strpos($val, '<=') !== false || strpos($val, '<>') !== false) {
            preg_match('/<>|>=|<=|>|<|/', $val, $match);
            return $key . $match[0] . '?';
        } else {
            return "{$key}=?";
        }
    }
}