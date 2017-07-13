<?php

namespace backend\modules\gongchu\models;

use backend\functions\functions;
use common\models\User;
use Yii;
use backend\modules\deptcontact\models\DeptContact;
use backend\modules\position\models\Position;
/**
 * This is the model class for table "{{%gongchu}}".
 *
 * @property integer $id
 * @property integer $dept
 * @property string $gc_ren
 * @property integer $gc_count
 * @property string $gc_time
 * @property string $end_time
 * @property string $gc_place
 * @property string $ygwc
 * @property integer $jb_ren
 * @property integer $dept_leader
 * @property integer $dept_audit
 * @property integer $yuan_leader
 * @property integer $yuan_audit
 */
class Gongchu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%gongchu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dept', 'gc_ren', 'gc_count', 'gc_time', 'end_time', 'ygwc', 'jb_ren', 'dept_leader', 'dept_audit', 'yuan_leader', 'yuan_audit'], 'required'],
            [['gc_count','user_delete','dept_delete','yuan_delete'], 'integer'],
            [['gc_time', 'end_time','dept_audit_time','yuan_audit_time','apply_time'], 'safe'],
            [['ygwc','jb_ren', 'dept_leader', 'dept_audit', 'yuan_leader', 'yuan_audit'], 'string'],
            [['gc_ren'], 'string', 'max' => 500],
            [['dept_reason'], 'string', 'max' => 100],
            [['yuan_reason'], 'string', 'max' => 100],
            [['gc_place'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dept' => '科(室、局)',
            'gc_ren' => '公出人员',
            'gc_count' => '公出总人数',
            'gc_time' => '公出时间',
            'end_time' => '结束时间',
            'gc_place' => '公出地点',
            'ygwc' => '因公外出',
            'jb_ren' => '经办人',
            'dept_leader' => '科室领导',
            'dept_audit' => '科室负责人审核状态',
            'dept_reason'=>'科室驳回理由',
            'yuan_leader' => '院领导',
            'yuan_audit' => '状态',
            'yuan_reason' => '院驳回理由',
            'jcz'=>'检察长',
        ];
    }

    /**
     * 获取所有部门 格式 id=>name 数据
     * @return array
     * author:Bob
     * date:20160526
     */
    public static function getDepts(){
        $query=DeptContact::find()->select('id,dept_name')
            ->orderBy('id asc')
            ->asArray()
            ->all();
        $depts =array();
        if(!empty($query)){
            foreach($query as $v){
                $depts[$v['id']]=$v['dept_name'];
            }
        }
        return $depts;
    }

    /**
     * 根据部门id获取部门name 机构
     * author:Bob
     * date:20160525
     */
    public static function getDeptNameById($id){
        $name='';
        if(!empty($id)){
            $dept=DeptContact::findOne($id);
            if(!empty($dept)){
                $name=$dept->dept_name;
            }
        }
        return $name;
    }

    /**
     * @param $ids 人员ids
     * author:Bob
     * date:20160525
     * @return string
     */
    public static function getUserNamesByIds($ids){
        if(empty($ids)){
            return '';
        }
        if(substr($ids, -1)==','){
            $ids=substr($ids,0,-1);
        }
        $names=User::find()->addSelect('GROUP_CONCAT(name) as name')
            ->where('id in ('.$ids.')')->asArray()->one();
        if(!empty($names)){
            return $names['name'];
        }else{
            return '';
        }
    }

    /**
     * @param $id 发起人看的状态
     * @return mixed 审核状态 id=>名称 键值对
     */
    public static function getStatusById($id){
        $arr=array();
        $arr[0]='审批中';
        $arr[1]='同意';
        $arr[2]='驳回';
        return $arr[$id];
    }
    /**
     * @param $id 审核人查看的状态
     * @return mixed 审核状态 id=>名称 键值对
     */
    public static function getStatusByIdInAudit($id){
        $arr=array();
        $arr[0]='未审批';
        $arr[1]='同意';
        $arr[2]='驳回';
        return $arr[$id];
    }
    /**
     * @param $deptId 根据部门id获取部门负责人，包括行装科、政治处领导
     * @return mixed
     * author:Bob
     * date:20160527
     */
    public static function getDeptLeader($deptId){
        $names=array();
        $dept=DeptContact::findOne($deptId);
        if(!empty($dept)){
            $principal=$dept->principal;
            if(empty($principal)){
                $names[]='';
                $names[]='';
                return $names;
            }
            $users=User::findOne($principal);
            if(!empty($users)){
                $names[]=$principal;
                $names[]=$users->name;
            }else{
                $names[]='';
                $names[]='';
            }
            return $names;
        }else{
            functions::alert('部门不存在');
        }
    }

    /**
     * @param $deptId 根据部门id获取分管领导人
     * @return mixed
     */
    public static function getBranchLeader($deptId){
        $names=array();
        $dept=DeptContact::findOne($deptId);
        if(!empty($dept)) {
            $branch_leader = $dept->branch_leader;
            if (empty($branch_leader)) {
                $names[]='';
                $names[]='';
                return $names;
            }
            $users = User::findOne($branch_leader);
            if(!empty($users)){
                $names[] = $branch_leader;
                $names[] = $users->name;
            }else{
                $names[]='';
                $names[]='';
            }
            return $names;
        }else{
            functions::alert('部门不存在');
        }
    }


    /*
     * 获取部门负责人
     * @param $deptId
     * @return array
     * author:Bob
     * date:20160527
     */
    public static function getLeader($deptId){
        $names=array();
        $dept=DeptContact::findOne($deptId);
        if(!empty($dept)) {
            $branch_leader = $dept->branch_leader;
            $principal=$dept->principal;
            if (empty($branch_leader) && empty($principal)) {
                return $names;
            }
            $users = User::findOne($principal);
            $names['principal'][] = $principal;
            $names['principal'][] = isset($users->name) ? $users->name : '未知人员';
            $users = User::findOne($branch_leader);
            $names['branch_leader'][] = $branch_leader;
            $names['branch_leader'][] = isset($users->name) ? $users->name : '未知人员';
            return $names;
        }else{
            functions::alert('部门不存在');
        }
    }

    /**
     * 获取所有 有相关审核权限的部门人员信息
     * @param $menuId
     * @return array
     * author:Bob
     * date:20160526
     */
    public static function getDeptAuditors($menuId){
        $conn=Yii::$app->db;
        $deptAuditors=array();
        if(!empty($menuId)){//$menuid 不为空,找到有该功能菜单的操作权限的人
            $sql='select us.id,name,department,dp.dept_name from
        (select u.id,u.name,u.department from user u where u.status=10 and id in
        (select user_id from role_user where role_id in
        (select role_id from role_menu where menu_id='.$menuId.'))) as us
         left join dept_contact dp on us.department=dp.id  order by us.department asc';
        }else{//找到所有人
            $sql='select us.id,name,department,dp.dept_name from user us
        left join dept_contact dp on us.department=dp.id where us.status=10 order by us.department asc';
        }
        $auditors=$conn->createCommand($sql)->queryAll();
        if(!empty($auditors)){
            foreach($auditors as $v){
                $deptAuditors[$v['dept_name']][$v['id']]=$v['name'];
            }
        }
        return $deptAuditors;
    }

    /**
     * 获取所有平台账号，供选择部门人员信息  获取所有用户
     * @return array
     * author:Bob
     * date:20160526
     */
    public static function getDeptNames(){
        $conn=Yii::$app->db;
        $deptUsers=array();
        $sql='select ur.id,ur.name,ur.department,dp.dept_name from user ur
        left join dept_contact dp on ur.department=dp.id where ur.status=10 order by department asc, ur.id asc';
        $users=$conn->createCommand($sql)->queryAll();
        if(!empty($users)){
            foreach($users as $v){
                $deptUsers[$v['dept_name']][$v['id']]=$v['name'];
            }
        }
        return $deptUsers;
    }
    /**
     * 根据人员id获取人员职务名称
     * @return array
     * author:xue
     * date:20160526
     */
    public static function getPositionName($id){
        $position = Position::getZhiwu($id);
        return $position;
    }
}
