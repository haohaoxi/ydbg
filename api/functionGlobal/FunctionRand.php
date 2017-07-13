<?php
namespace api\functionGlobal;

use Yii;
use yii\db\mssql\PDO;

/*
File Name: FunctionRand.php
Date: 2016/5/12
Version: 1.0.1
Author: Wangxue
*/
class FunctionRand {
    /**
     * 列表数据返回格式
     * @param int $code 状态
     * @param string $msg 提示信息
     * @param int $count 总数
     * @param int $page_size 一页显示条数
     * @param array $rows 查询返回的数据
     * @param int $page 当前页码
     */
    public static function Page($code = 0, $msg = '', $count = 0, $page_size = 10, $page = 0, $rows = [])
    {
        $format = [];
        $format['code'] = $code;
        $format['msg'] = $msg;
        $format['count'] = $count;
        $format['page_size'] = $page_size;
        $format['page'] = $page;
        $format['data'] = $rows;
        die(json_encode($format));
    }
    public static function View($code = 0, $msg = '', $rows = [])
    {
        $format = [];
        $format['code'] = $code;
        $format['msg'] = $msg;
        $format['data'] = $rows;
        die(json_encode($format));
    }
    public static function Error($code = 0, $msg = '')
    {
        if(is_string($msg)){
            $msgArr = ['error' => $msg];
        }else{
            $msgArr = $msg;
        }
        $format = [];
        $format['code'] = $code;
        $format['msg'] = $msgArr;
        die(json_encode($format));
    }
    //POST数据格式化
    public static function PostFormat($data)
    {
        if(!empty($data)){
            foreach($data as $key => $value){
                if(!is_array($value)){
                    $data[$key] = trim($value);
                }

            }
        }
        return $data;
    }
    //用户访问api验证
    public static function UserAuth($userid = 0,$user_key = '')
    {
        if(empty($userid) || empty($user_key) || !is_numeric($userid)){
            self::Error(103, '你没访问权限');
        }
        if(isset($userid) && isset($user_key)){
            $connection = \Yii::$app->db;
            $row = $connection->createCommand('SELECT * FROM {{%user}}  WHERE id = :id');
            $row->bindParam(':id', $userid, PDO::PARAM_STR);
            $row = $row->queryOne();
            if(!empty($row)){
                if($user_key == md5($userid.'&%@kju;?'.$row['auth_key'])){
                    return true;
                }
            }
        }
        self::Error(103, '你没访问权限');
    }

}

