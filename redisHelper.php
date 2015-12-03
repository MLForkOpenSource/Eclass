<?php
/**
 * @name    Redis帮助类
 * @author  MartyZane
 */
class eclass_redisHelper{
    public $_redis;
    public $_IP = "127.0.0.3";
    public $_port = '6379';
    public $array_mset = array();
    public $array_mget = array();
    

    /**
     * @method  构造函数
     * @author  MartyZane
     */
    public function __construct(){
        $this->_redis = new Redis();
        $this->_redis->connect($this->_IP,$this->_port);
    }

    /**
     * @method  Set方法
     * @author  MartyZane
     */
    public function set($key,$value) {
        $this->_redis->set($key,$value);
    }

    /**
     * @method  Get方法
     * @author  MartyZane
     */
    public function get($key) {
        return $this->_redis->get($key);
    }

    /**
     * @method  Del方法
     * @author  MartyZane
     */
    public function del($key) {
        $this->_redis->del($key);
    }

    /**
     * @method  Exist方法
     * @author  MartyZane
     */
    public function exist($key) {
        if($this->_redis->exists($key)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @method  一次存储多个值
     * @param   数组
     * @example (key-value,key-value,key-value)
     * @author  MartyZane
     */
    public function mSet($array) {
        if(empty($this->array_mset)){
            $this->_redis->mset($array);
        }else{
            $this->_redis->mset($this->array_mset);
        }
    }
    
    /**
     * @method  一次读取多个值
     * @param   数组
     * @example (key,key,key)
     * @return  数组
     * @example (value,value,value)
     * @author  MartyZane
     */
    public function mGet($karray) {
        $this->array_mget = $this->_redis->mget($karray);
        return $this->array_mget;
    }
    
    /**
     * @method  一次删除多个值
     * @param   数组
     * @example 原数组：(key1-value1,key2-value2,key3-value3,key4-value4,key5-value5,...)
     *          删数组：(key1,key2,key3)
     * @return  数组
     * @example 现数组：(key4-value4,key5-value5,...)
     * @author  MartyZane
     */
    public function mDel($karray){
        $this->_redis->del($karray);
    }
    
    /**
     * @method  返回包含$keyword的Key列表
     * @param   字符串
     * @example 关键字
     * @return  数组
     * @author  MartyZane
     */
    public function sKeys($keyword) {
        return $this->_redis->keys($keyword);
    }
    
    /**
     * @method  随机返回数组中的一个key-value
     * @param   数组
     * @return  字符串
     * @author  MartyZane
     */
    public function randomKey($array){
        $this->_redis->flushAll();
        $this->mset($array);
        return $this->_redis->randomKey();
    }
    
    /**
     * @method  删除数据库中所有的key
     * @param   无
     * @return  布尔值
     * @author  MartyZane
     */
    public function removeAll() {
        $this->_redis->flushDB();
        return $this->_redis->randomKey();
    }
}
?>