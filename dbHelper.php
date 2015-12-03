<?php
/* 
 * FUNCTION：数据库类
 * DATETIME：2015年12月1日上午10:41:44
 * AUTHORITY：MartyZane
 */
class eclass_dbHelper{
    public $_conn = '';
    public $_serverName = '';
    public $_userName = '';
    public $_password = '';
    public $_database = '';
    public $_port = '';
    public $_table = '';
    public $_charsetName = '';
    public $_errcode = '';
    public $_errmsg = '';
    
    //无参构造函数
    public function __construct() {
        $this->_serverName = '127.0.0.1';
        $this->_userName = 'root';
        $this->_password = 'root';
        $this->_database = 'test';
        $this->_port = '3307';
        $this->_table = 'guest';
        $this->_charsetName = 'utf-8';
    }
    
    //有参构造函数
//     public function __construct($Server,$User,$Password,$Database,$Port) {
//         ;
//     }
    
    //面向过程连接数据库
    public function dbConnect() {
        // 创建连接
        $this->_conn = mysqli_connect($this->_serverName, $this->_userName, $this->_password,$this->_database,$this->_port);
        // 设置数据库编码
        mysqli_set_charset($this->_conn, 'utf-8');
        // 检测连接
        if (!$this->_conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return "Connected successfully";
    }
    
    //面向过程断开数据库
    public function dbDisconnect() {
        mysqli_close($this->_conn);
    }
    
    //面向过程执行SQL语句
    public function dbExec($SQL) {
        $this->dbConnect();
        $QR = mysqli_query($this->_conn, $SQL);
        if($QR){
            $this->_errmsg = 'New Record Option Successful';
        }else{
            $this->_errmsg = 'Error '.$SQL.'<br/>'.mysqli_error($this->_conn);
        }
        $this->dbDisconnect();
        return $QR;
    }
    
    public function test() {
        echo 'common.eclass.dbHelper.php';
    }
    
}
?>