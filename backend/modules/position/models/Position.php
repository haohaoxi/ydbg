<?php

namespace backend\modules\position\models;

use Yii;

/**
 * This is the model class for table "{{%position}}".
 *
 * @property integer $id
 * @property string $name
 */
class Position extends \yii\db\ActiveRecord
{
    public static $_data;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%position}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /*
     * 获取所属职务数据name
     * 机构名称从“服务大厅后台”中的人员职能模块中的职务信息获取
     */
    public static function getZhiwu($id=""){
        if(isset(self::$_data['Zhiwu']) && self::$_data['Zhiwu'] != ''){
            $data = self::$_data['Zhiwu'];
        }else{
            $data = '{"code":0,"msg":"Success","data":[
            {"id":"1","dept_name":"书记"},{"id":"2","dept_name":"副书记"},{"id":"3","dept_name":"委员"},{"id":"4","dept_name":"主任"},{"id":"5","dept_name":"副主任"},{"id":"6","dept_name":"主任助理"},

            {"id":"7","dept_name":"巡视员"},{"id":"8","dept_name":"调研员"},{"id":"9","dept_name":"副调研员"},{"id":"10","dept_name":"督导员"},{"id":"11","dept_name":"监察员"},{"id":"12","dept_name":"纪检员"},

            {"id":"13","dept_name":"检察长"},{"id":"14","dept_name":"副检察长"},{"id":"15","dept_name":"检察长助理"},{"id":"16","dept_name":"检察员"},{"id":"17","dept_name":"助理检察员"},{"id":"18","dept_name":"书记员"},

            {"id":"19","dept_name":"法警"},{"id":"20","dept_name":"总编辑"},{"id":"21","dept_name":"副总编辑"},{"id":"22","dept_name":"部长"},{"id":"23","dept_name":"副部长"},{"id":"24","dept_name":"部长助理"},

            {"id":"25","dept_name":"局长"},{"id":"26","dept_name":"副局长"},{"id":"27","dept_name":"局长助理"},{"id":"28","dept_name":"厅长"},{"id":"29","dept_name":"副厅长"},{"id":"30","dept_name":"厅长助理"},

            {"id":"31","dept_name":"处长"},{"id":"32","dept_name":"副处长"},{"id":"33","dept_name":"科长"},{"id":"34","dept_name":"副科长"},{"id":"35","dept_name":"科员"},{"id":"36","dept_name":"主任科员"},

            {"id":"37","dept_name":"副主任科员"},{"id":"38","dept_name":"办事员"},{"id":"39","dept_name":"组长"},{"id":"40","dept_name":"副组长"},{"id":"41","dept_name":"社长"},{"id":"42","dept_name":"副社长"},

            {"id":"43","dept_name":"社长助理"},{"id":"44","dept_name":"馆长"},{"id":"45","dept_name":"副馆长"},{"id":"46","dept_name":"所长"},{"id":"47","dept_name":"副所长"},{"id":"48","dept_name":"所长助理"},

            {"id":"49","dept_name":"院长"},{"id":"50","dept_name":"副院长"},{"id":"51","dept_name":"院长助理"},{"id":"52","dept_name":"校长"},{"id":"53","dept_name":"副校长"},{"id":"54","dept_name":"大队长"},

            {"id":"55","dept_name":"副大队长"},{"id":"56","dept_name":"队长"},{"id":"57","dept_name":"副队长"},{"id":"58","dept_name":"总队长"},{"id":"59","dept_name":"副总队长"},{"id":"60","dept_name":"中队长"},

            {"id":"61","dept_name":"副中队长"},{"id":"62","dept_name":"支队长"},{"id":"63","dept_name":"副支队长"},{"id":"64","dept_name":"分队长"},{"id":"65","dept_name":"副分队长"},{"id":"66","dept_name":"政委"},

            {"id":"67","dept_name":"教导员"},{"id":"68","dept_name":"协理员"},{"id":"69","dept_name":"指导员"},{"id":"70","dept_name":"党组成员"},{"id":"71","dept_name":"党组副书记"},{"id":"72","dept_name":"检察委员会专职委员"},

            {"id":"73","dept_name":"总支组织委员政治处副主任"}
            ]}';
            self::$_data['Department'] = $data;
        }
        $data = json_decode($data,1);
        $data = $data['data'];
        $_data = array();
        foreach($data as $value){
            $_data[$value['id']] = $value['dept_name'];
        }
        if($id != '') return $_data[$id];
        return $_data;
    }

    /*
   * 获取所属职务数据id
   * 机构名称从“服务大厅后台”中的人员职能模块中的职务信息获取
   */
    public static function getZhiwuId($name=""){
        if(isset(self::$_data['Zhiwu']) && self::$_data['Zhiwu'] != ''){
            $data = self::$_data['Zhiwu'];
        }else{
            $data = '{"code":0,"msg":"Success","data":[
            {"id":"1","dept_name":"书记"},{"id":"2","dept_name":"副书记"},{"id":"3","dept_name":"委员"},{"id":"4","dept_name":"主任"},{"id":"5","dept_name":"副主任"},{"id":"6","dept_name":"主任助理"},

            {"id":"7","dept_name":"巡视员"},{"id":"8","dept_name":"调研员"},{"id":"9","dept_name":"副调研员"},{"id":"10","dept_name":"督导员"},{"id":"11","dept_name":"监察员"},{"id":"12","dept_name":"纪检员"},

            {"id":"13","dept_name":"检察长"},{"id":"14","dept_name":"副检察长"},{"id":"15","dept_name":"检察长助理"},{"id":"16","dept_name":"检察员"},{"id":"17","dept_name":"助理检察员"},{"id":"18","dept_name":"书记员"},

            {"id":"19","dept_name":"法警"},{"id":"20","dept_name":"总编辑"},{"id":"21","dept_name":"副总编辑"},{"id":"22","dept_name":"部长"},{"id":"23","dept_name":"副部长"},{"id":"24","dept_name":"部长助理"},

            {"id":"25","dept_name":"局长"},{"id":"26","dept_name":"副局长"},{"id":"27","dept_name":"局长助理"},{"id":"28","dept_name":"厅长"},{"id":"29","dept_name":"副厅长"},{"id":"30","dept_name":"厅长助理"},

            {"id":"31","dept_name":"处长"},{"id":"32","dept_name":"副处长"},{"id":"33","dept_name":"科长"},{"id":"34","dept_name":"副科长"},{"id":"35","dept_name":"科员"},{"id":"36","dept_name":"主任科员"},

            {"id":"37","dept_name":"副主任科员"},{"id":"38","dept_name":"办事员"},{"id":"39","dept_name":"组长"},{"id":"40","dept_name":"副组长"},{"id":"41","dept_name":"社长"},{"id":"42","dept_name":"副社长"},

            {"id":"43","dept_name":"社长助理"},{"id":"44","dept_name":"馆长"},{"id":"45","dept_name":"副馆长"},{"id":"46","dept_name":"所长"},{"id":"47","dept_name":"副所长"},{"id":"48","dept_name":"所长助理"},

            {"id":"49","dept_name":"院长"},{"id":"50","dept_name":"副院长"},{"id":"51","dept_name":"院长助理"},{"id":"52","dept_name":"校长"},{"id":"53","dept_name":"副校长"},{"id":"54","dept_name":"大队长"},

            {"id":"55","dept_name":"副大队长"},{"id":"56","dept_name":"队长"},{"id":"57","dept_name":"副队长"},{"id":"58","dept_name":"总队长"},{"id":"59","dept_name":"副总队长"},{"id":"60","dept_name":"中队长"},

            {"id":"61","dept_name":"副中队长"},{"id":"62","dept_name":"支队长"},{"id":"63","dept_name":"副支队长"},{"id":"64","dept_name":"分队长"},{"id":"65","dept_name":"副分队长"},{"id":"66","dept_name":"政委"},

            {"id":"67","dept_name":"教导员"},{"id":"68","dept_name":"协理员"},{"id":"69","dept_name":"指导员"},{"id":"70","dept_name":"党组成员"},{"id":"71","dept_name":"党组副书记"},{"id":"72","dept_name":"检察委员会专职委员"},

            {"id":"73","dept_name":"总支组织委员政治处副主任"}
            ]}';
            self::$_data['Department'] = $data;
        }
        $data = json_decode($data,1);
        $data = $data['data'];
        $_data = array();
        foreach($data as $value){
            $_data[$value['dept_name']] = $value['id'];
        }
        if($name != '') return $_data[$name];
        return $_data;
    }


}
