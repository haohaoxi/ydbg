<?php

namespace backend\modules\message\models;

use Yii;
use yii\db\mssql\PDO;

/**
 * This is the model class for table "{{%message}}".
 *
 * @property integer $id
 * @property string $type
 * @property string $contet
 * @property integer $fsr
 * @property string $jsr
 * @property string $time
 * @property string $is_reader
 * @property string $url
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%message}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'contet', 'fsr', 'jsr', 'time', 'url'], 'required'],
            [['id', 'fsr','jsr'], 'integer'],
            [['time'], 'safe'],
            [['type'], 'string', 'max' => 100],
            [['contet', 'url'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', '消息类型'),
            'contet' => Yii::t('app', '消息内容'),
            'fsr' => Yii::t('app', '发送人'),
            'jsr' => Yii::t('app', '接收人'),
            'time' => Yii::t('app', '发送时间'),
            'is_reader' => Yii::t('app', '是否读取'),
            'url' => Yii::t('app', '链接'),
        ];
    }


    /*
     * 所有消息数
     */
    public static function getMessageNum(){
        $count = self::find()->where('find_in_set(`jsr`,'.Yii::$app->user->identity->id.') and is_reader="未读"')->count();
        return $count;
    }
    /*
     * 所有消息数api调用
     */
    public static function getMessageNumApi($userid){
        $count = self::find()->where('find_in_set(`jsr`,'.$userid.') and is_reader="未读"')->count();
        return $count;
    }

    /*
     * 发送消息
     * @param $type 消息类型
     * @param $contet 消息内容
     * @param $jsr 接收人 1,2,3,4
     * @param $url 链接 数
     * 组类型 ["message/message/index",['id'=>1]]
     */
    public static function sendMsg($type,$contet,$jsr,$url = array()){
        if($type=="" || $contet == "" || $jsr == "" || !is_array($url)) return false;
        $db = \Yii::$app->db;
        $url = json_encode($url,JSON_UNESCAPED_UNICODE);
        foreach(explode(',',$jsr) as $key=>$value){
            $sql="INSERT INTO {{%message}} (`type`, `contet`,`fsr`,`jsr`,`time`,`is_reader`,`url`) VALUES(:type,:contet,:fsr,:jsr,:time,:is_reader,:url)";
            $is_reader = '未读';
            $time = date('Y-m-d H:i:s',time());
            $fsr = \Yii::$app->user->identity->id;
            $command=$db->createCommand($sql);
            $command->bindParam(":type",$type);
            $command->bindParam(":contet",$contet);
            $command->bindParam(":fsr",$fsr);
            $command->bindParam(":jsr",$value);
            $command->bindParam(":time",$time);
            $command->bindParam(":is_reader",$is_reader);
            $command->bindParam(":url",$url);
            $command->execute();
        }
        return true;
    }
    /*
     * aipf专用 发送消息
     * @param $type 消息类型
     * @param $contet 消息内容
     * @param $jsr 接收人 1,2,3,4
     * @param $url 链接 数组类型 ["message/message/index",['id'=>1]]
     */
    public static function sendMsgApi($type,$contet,$jsr,$url = array(),$fsr){
        if($type=="" || $contet == "" || $jsr == "" || !is_array($url)) return false;
        $db = \Yii::$app->db;
        $url = json_encode($url,JSON_UNESCAPED_UNICODE);
        foreach(explode(',',$jsr) as $key=>$value){
            $sql="INSERT INTO {{%message}} (`type`, `contet`,`fsr`,`jsr`,`time`,`is_reader`,`url`) VALUES(:type,:contet,:fsr,:jsr,:time,:is_reader,:url)";
            $is_reader = '未读';
            $time = date('Y-m-d H:i:s',time());
            $command=$db->createCommand($sql);
            $command->bindParam(":type",$type);
            $command->bindParam(":contet",$contet);
            $command->bindParam(":fsr",$fsr);
            $command->bindParam(":jsr",$value);
            $command->bindParam(":time",$time);
            $command->bindParam(":is_reader",$is_reader);
            $command->bindParam(":url",$url);
            $command->execute();
        }
        return true;
    }
}
