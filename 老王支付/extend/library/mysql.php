<?php

namespace xh\library;
//mysql数据库类，废除mysql，仅支持pdo和mysqli
class mysql
{
    //连接
    private $connect;

    //自动连接mysql服务器，静态方法，返回数据库操作对象
    public function __construct()
    {
        if (strtolower(DB_TYPE) == 'mysqli') {
            $connect = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);
            mysqli_query($connect, "SET NAMES " . DB_CHAR);
            $this->connect = $connect;
        }
        if (strtolower(DB_TYPE) == 'pdo') {
            $this->connect = new \PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=" . DB_CHAR, DB_USER, DB_PWD);
        }
    }


    //写入一条数据到数据库
    //$array 例子: array("username"=>'xh123',"password"=>'123456');
    //$table 该参数为数据库的表名
    public function insert($table, $array)
    {
        $table = DB_PREFIX . $table;
        //开始处理局部array数组
        $x_key = '';
        $x_val = '';
        //进行sql预处理--pdo支持
        $x_val_prepare = '';
        $x_val_prepare_execute = array();

        foreach ($array as $key => $value) {
            $x_key .= "{$key},";
            $x_val .= "'{$value}',";
            //pdo支持
            $x_val_prepare .= "?,";
            $x_val_prepare_execute[] = $value;
        }

        $x_key = trim($x_key, ',');
        $x_val = trim($x_val, ',');
        //pdo支持
        $x_val_prepare = trim($x_val_prepare, ",");
        //组合SQL语句
        $sql = "INSERT INTO {$table} ({$x_key}) VALUES ($x_val)";
        //mysqli执行语句
        try {
            if (strtolower(DB_TYPE) == 'mysqli') {
                mysqli_query($this->connect, $sql);

                return mysqli_insert_id($this->connect);
            }
            //pdo特殊处理
            if (strtolower(DB_TYPE) == 'pdo') {
                $sql = "INSERT INTO {$table} ({$x_key}) VALUES ({$x_val_prepare})";
                //执行
                $prepare = $this->connect->prepare($sql);
                $execute = $prepare->execute($x_val_prepare_execute);

                return $this->connect->lastInsertId();
            }
        } catch (\Exception $e) {
            if (DEBUG_LOG) {
                file_put_contents("mysql_error.txt", $e->getMessage() . "：" . $sql . PHP_EOL, FILE_APPEND);
            }

        }

    }

    //写入多条数据到数据库
    //字段名称 $key_array 例子: array('username','pwd');
    //多个值 $value_list_array 例子： array(array('admin','123456'),array('root','555666'));
    //$table 该参数为数据库的表名
    public function insert_array($table, $key_array, $value_list_array)
    {
        $table = DB_PREFIX . $table;
        //字段列
        $key = '';
        //多个数据
        $val_list = '';
        //组合键
        for ($i = 0; $i < count($key_array); $i++) {
            $key .= $key_array[$i] . ',';
        }
        //组合列
        for ($j = 0; $j < count($value_list_array); $j++) {

            $val_list .= "(";

            for ($x = 0; $x < count($value_list_array[$j]); $x++) {
                //$value_list_array[$j]
                $val_list .= "'{$value_list_array[$j][$x]}',";
            }

            $val_list = trim($val_list, ",") . "),";
        }

        $key = trim($key, ',');
        $val_list = trim($val_list, ',');

        //组合sql语句，该模式下pdo不需要预编译，直接执行，大多数处理安全函数
        $sql = "INSERT INTO {$table} ({$key}) VALUES {$val_list}";
        try {
            if (strtolower(DB_TYPE) == 'mysqli') {
                mysqli_query($this->connect, $sql);

                return mysqli_insert_id($this->connect);
            }
            //pdo特殊处理
            if (strtolower(DB_TYPE) == 'pdo') {
                //执行
                $prepare = $this->connect->prepare($sql);
                $execute = $prepare->execute();

                return $this->connect->lastInsertId();
            }
        } catch (\Exception $e) {
            if (DEBUG_LOG) {
                file_put_contents("mysql_error.txt", $e->getMessage() . "：" . $sql . PHP_EOL, FILE_APPEND);
            }

        }

    }


    //删除数据
    //$where 条件
    //$table 表
    public function delete($table, $where)
    {
        $table = DB_PREFIX . $table;
        //处理$where 为空，禁止删除全表
        if (empty($where)) return false;
        //组件sql语句
        $sql = "DELETE FROM {$table} where {$where}";
        try {

            if (strtolower(DB_TYPE) == 'mysqli') {
                mysqli_query($this->connect, $sql);

                return mysqli_affected_rows($this->connect);
            }
            //pdo特殊处理
            if (strtolower(DB_TYPE) == 'pdo') {
                //执行
                $prepare = $this->connect->prepare($sql);
                $execute = $prepare->execute();

                return $prepare->rowCount();
            }

        } catch (\Exception $e) {
            if (DEBUG_LOG) {
                file_put_contents("mysql_error.txt", $e->getMessage() . "：" . $sql . PHP_EOL, FILE_APPEND);
            }

        }
    }


    //修改数据
    //$array array("username"=>'bxx1bs','pwd'=>'aaa1123')
    //$where id=24
    //$table 表
    public function update($table, $array, $where = null)
    {

        $table = DB_PREFIX . $table;
        $x_set = '';
        $ifwhere = '';
        //pdo支持
        $x_val_prepare = '';
        $x_val_prepare_execute = array();
        foreach ($array as $key => $value) {
            $x_set .= "{$key}='{$value}',";
            //支持pdo
            $x_val_prepare .= "{$key}=?,";
            $x_val_prepare_execute[] = $value;
        }
        $x_set = trim($x_set, ',');
        $x_val_prepare = trim($x_val_prepare, ",");

        //解决没有$where为空
        if (!empty($where)) $ifwhere = ' where ' . $where;

        $sql = "UPDATE {$table} SET $x_set $ifwhere";
        try {


            if (strtolower(DB_TYPE) == 'mysqli') {
                mysqli_query($this->connect, $sql);

                return mysqli_affected_rows($this->connect);
            }
            //pdo特殊处理
            if (strtolower(DB_TYPE) == 'pdo') {
                $sql = "UPDATE {$table} SET {$x_val_prepare} $ifwhere";
                //执行
                $prepare = $this->connect->prepare($sql);
                $execute = $prepare->execute($x_val_prepare_execute);

                return $prepare->rowCount();
            }
        } catch (\Exception $e) {
            if (DEBUG_LOG) {
                file_put_contents("mysql_error.txt", $e->getMessage() . "：" . $sql . PHP_EOL, FILE_APPEND);
            }

        }
    }


    //执行查询
    //$table 表  {支持连表查询} table,table
    //$ap * {或者字段} id,username
    //$where {搜索条件} 如果连表查询，必须带表，例子 tab1.id = tab2.uid
    //$order_by {排序字段} 如果连表查询，必须带表 例子 tab1.id
    //$order_rank {排序规则} desc(从大到小)/asc(从小到大)
    //$limit 该参数查询限制，从什么开始..每次查询多少记录，例子： 5,10 （从5开始查，向后查10条记录）、例子2： 10（只查10条记录出来）
    public function query($table, $where = null, $ap = null, $order_by = null, $order_rank = 'desc', $limit = null)
    {
        $table = DB_PREFIX . $table;
        $ifwhere = null;
        $order = null;
        if (empty($ap)) $ap = '*';
        if (!empty($where)) $ifwhere = ' where ' . $where;
        if (!empty($order_by)) {
            $order = "ORDER BY {$order_by} {$order_rank}";
        }
        if (!empty($limit)) $limit = " limit {$limit}";
        $sql = "SELECT {$ap} FROM {$table} {$ifwhere} {$order} {$limit}";
        try {


            if (strtolower(DB_TYPE) == 'mysqli') {
                $data = mysqli_query($this->connect, $sql);
                $result = mysqli_fetch_all($data, MYSQL_ASSOC);
                mysqli_free_result($data);

                return $result;
            }
            //pdo特殊处理
            if (strtolower(DB_TYPE) == 'pdo') {
                //执行
                $prepare = $this->connect->prepare($sql);
                $execute = $prepare->execute();

                return $prepare->fetchAll(2);
            }
        } catch (\Exception $e) {
            if (DEBUG_LOG) {
                file_put_contents("mysql_error.txt", $e->getMessage() . "：" . $sql . PHP_EOL, FILE_APPEND);
            }

        }
    }

    //自定义查询
    public function select($query)
    {
        if (strtolower(DB_TYPE) == 'mysqli') {
            $data = mysqli_query($this->connect, $query);
            $result = mysqli_fetch_all($data, MYSQL_ASSOC);
            mysqli_free_result($data);

            return $result;
        }
        //pdo特殊处理
        if (strtolower(DB_TYPE) == 'pdo') {
            //执行
            $prepare = $this->connect->prepare($query);
            $execute = $prepare->execute();

            return $prepare->fetchAll(2);
        }
    }

    //启动事物
    public function startThings()
    {
        if (strtolower(DB_TYPE) == 'mysqli') {
            $this->connect->autocommit(false);
        }
        if (strtolower(DB_TYPE) == 'pdo') {
            $this->connect->beginTransaction();
        }
    }

    //提交事务
    public function commit()
    {
        if (strtolower(DB_TYPE) == 'mysqli') {
            $this->connect->commit();
        }
        if (strtolower(DB_TYPE) == 'pdo') {
            $this->connect->commit();
        }
    }

    //回滚事务
    public function rollBack()
    {
        if (strtolower(DB_TYPE) == 'mysqli') {
            $this->connect->rollback();
        }
        if (strtolower(DB_TYPE) == 'pdo') {
            $this->connect->rollBack();
        }
    }

    //自动关闭连接
    public function __destruct()
    {
        if (strtolower(DB_TYPE) == 'mysqli') mysqli_close($this->connect);
        if (strtolower(DB_TYPE) == 'pdo') $this->connect = null;
    }


}