<?php
namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use api\functionGlobal\FunctionRand;
use backend\modules\chuchai\models\Chuchai;
use backend\modules\qingjia\models\Qingjia;
use backend\modules\vehicle\models\VehicleApply;
use backend\modules\welfareapply\models\WelfareApply;
use backend\modules\officeapply\models\OfficeApply;
use backend\modules\carwx\models\Carwx;
use backend\modules\travel\models\Travel;
use backend\modules\meet\models\Meet;
use backend\modules\personwork\models\PersonWork;

/**
 * 审批管理 api
 */
class ShenpiController extends ActiveController
{
    public $modelClass = 'backend\modules\gongchu\models\Gongchu';

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items'
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['contentNegotiator']['formats']['application/xml']);
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        // 注销系统自带的实现方法
        unset($actions['index'], $actions['update'], $actions['create'], $actions['delete'], $actions['view']);
        return $actions;
    }
    //我发起的、我审批的list
    public function actionList($userid,$user_key,$type)
    {
        $type = (int)$type;
        $userid = (int)$userid;
        FunctionRand::UserAuth($userid, $user_key);
        $gongchu = new $this->modelClass();
        $gongchu = $gongchu::find();
        $chuchai = Chuchai::find();
        $qingjia = Qingjia::find();
        $vehicle = VehicleApply::find();
        $welfare = WelfareApply::find();
        $office = OfficeApply::find();
        $travel = Travel::find();
        $carwx = Carwx::find();
        $meet = Meet::find();
        $personwork = PersonWork::find();
        if($type == 1){//我发起的
            $num_gongchu = $gongchu->where("jb_ren = :jb_ren and user_delete = 0",['jb_ren' => $userid])->count();
            $num_chuchai = $chuchai->where("apply_ren = :apply_ren and user_delete = 0",['apply_ren' => $userid])->count();
            $num_qingjia = $qingjia->where("qj_ren = :qj_ren and user_delete = 0",['qj_ren' => $userid])->count();
            $num_vehicle = $vehicle->where("v_user = :v_user and apply_delete = 0",['v_user' => $userid])->count();
            $num_welfare = $welfare->where("welfare_sp_id = :welfare_sp_id and welfare_sp_id_is_del = 1",['welfare_sp_id' => $userid])->count();
            $num_office = $office->where("apply_mee_id = :apply_mee_id and apply_mee_id_is_del = 1",['apply_mee_id' => $userid])->andwhere(['apply_cgsq'=>'否'])->count();
            $num_ocaigou = $office->where("apply_mee_id = :apply_mee_id and apply_mee_id_is_del = 1",['apply_mee_id' => $userid])->andwhere(['apply_cgsq'=>'是'])->count();
            $num_travel = $travel->where("bxr = :bxr and bxr_del = 1",['bxr' => $userid])->count();
            $num_carwx = $carwx->where("bxr = :bxr and bxr_del = 1",['bxr' => $userid])->count();
            $num_meet = $meet->where("bxr = :bxr and bxr_del = 1",['bxr' => $userid])->count();
            $num_personwork = $personwork->where("p_fsq = :p_fsq and p_del = 1",['p_fsq' => $userid])->count();
            $data['num_gongchu'] = $num_gongchu;
            $data['num_chuchai'] = $num_chuchai;
            $data['num_qingjia'] = $num_qingjia;
            $data['num_vehicle'] = $num_vehicle;
            $data['num_welfare'] = $num_welfare;
            $data['num_office'] = $num_office;
            $data['num_ocaigou'] = $num_ocaigou;
            $data['num_travel'] = $num_travel;
            $data['num_carwx'] = $num_carwx;
            $data['num_meet'] = $num_meet;
            $data['num_personwork'] = $num_personwork;
        }elseif ($type == 2) {//我审批的
            $num_gongchu = $gongchu->where('(dept_leader=:dept_leader and dept_delete=:dept_delete)
                    or (yuan_leader=:dept_leader and yuan_delete=:dept_delete and dept_audit=:dept_audit)
                    or (jcz=:dept_leader and jcz_delete=:dept_delete and dept_audit=:dept_audit and yuan_audit=:dept_audit)',
                [':dept_leader'=>$userid,':dept_delete'=>0,':dept_audit'=>1,])->count();
            $num_chuchai = $chuchai->where('(dept_leader=:dept_leader and dept_delete=:dept_delete)
                    or (branch_leader=:dept_leader and branch_delete=:dept_delete and dept_audit=:dept_audit)
                    or (chief=:dept_leader and chief_delete=:dept_delete and dept_audit=:dept_audit and branch_audit=:dept_audit)',
                [':dept_leader'=>$userid,':dept_delete'=>0,':dept_audit'=>1,])->count();
            $num_qingjia = $qingjia->where('(dept_leader=:dept_leader and dept_delete=:dept_delete)
                    or (branch_leader=:dept_leader and branch_delete=:dept_delete and dept_audit=:dept_audit)
                    or (zzc=:dept_leader and zzc_delete=0 and dept_audit=:dept_audit and branch_audit=:dept_audit)
                    or (jcz=:dept_leader and jcz_delete=:dept_delete and dept_audit=:dept_audit and branch_audit=:dept_audit and zzc_audit=:dept_audit)',
                [':dept_leader'=>$userid,':dept_delete'=>0,':dept_audit'=>1,])->count();
            $num_vehicle = $vehicle->where('(dept_leader=:dept_leader and dept_delete=:dept_delete)
                    or (branch_leader=:dept_leader and branch_delete=:dept_delete and dept_audit=:dept_audit)',
                [':dept_leader'=>$userid,':dept_delete'=>0,':dept_audit'=>1,])->count();
            $num_welfare = $welfare->where("welfare_apply_mee_id = :welfare_apply_mee_id and welfare_sp_id_is_del = 1",['welfare_apply_mee_id' => $userid])->count();
            $num_office = $office->where('(apply_pack_id=:dept_leader and apply_pack_id_is_del=:dept_delete)
                    or (apply_genneral_id=:dept_leader and apply_genneral_id_is_del=:dept_delete and apply_pack_status=:dept_audit)', [':dept_leader'=>$userid,':dept_delete'=>1,':dept_audit'=>'同意',])
                    ->andwhere(['apply_cgsq'=>'否'])
                    ->count();
            $num_ocaigou = $office->where('(apply_pack_id=:dept_leader and apply_pack_id_is_del=:dept_delete)
                    or (apply_genneral_id=:dept_leader and apply_genneral_id_is_del=:dept_delete and apply_pack_status=:dept_audit)', [':dept_leader'=>$userid,':dept_delete'=>1,':dept_audit'=>'同意',])
                ->andwhere(['apply_cgsq'=>'是'])
                ->count();
            $num_travel = $travel->where('(zmr=:dept_leader and zmr_del=:dept_del)
                    or (glkj=:dept_leader and glkj_del=:dept_del and zmr_rs=:dept_audit)
                    or (ldsp=:dept_leader and ldsp_del=:dept_del and ldsp_rs=:dept_audit and glkj_rs=:dept_audit)',
                [':dept_leader'=>$userid,':dept_del'=>1,':dept_audit'=>1])->count();
            $num_carwx = $carwx->where('(zmr=:dept_leader and zmr_del=:dept_del)
                    or (glkj=:dept_leader and glkj_del=:dept_del and zmr_rs=:dept_audit)
                    or (ldsp=:dept_leader and ldsp_del=:dept_del and ldsp_rs=:dept_audit and glkj_rs=:dept_audit)',
                [':dept_leader'=>$userid,':dept_del'=>1,':dept_audit'=>1])->count();
            $num_meet = $meet->where('(zmr=:dept_leader and zmr_del=:dept_del)
                    or (glkj=:dept_leader and glkj_del=:dept_del and zmr_rs=:dept_audit)
                    or (ldsp=:dept_leader and ldsp_del=:dept_del and ldsp_rs=:dept_audit and glkj_rs=:dept_audit)',
                [':dept_leader'=>$userid,':dept_del'=>1,':dept_audit'=>1])->count();
            $num_personwork = $personwork->where(['w_del' => '1','w_s_status' => '未审批','w_person_id' => $userid])->join('LEFT JOIN', 'person_work_workflow', 'person_work_workflow.w_p_id = person_work.p_id')->count();
            $data['num_gongchu'] = $num_gongchu;
            $data['num_chuchai'] = $num_chuchai;
            $data['num_qingjia'] = $num_qingjia;
            $data['num_vehicle'] = $num_vehicle;
            $data['num_welfare'] = $num_welfare;
            $data['num_office'] = $num_office;
            $data['num_ocaigou'] = $num_ocaigou;
            $data['num_travel'] = $num_travel;
            $data['num_carwx'] = $num_carwx;
            $data['num_meet'] = $num_meet;
            $data['num_personwork'] = $num_personwork;
        }
        FunctionRand::view(1, 'Success',$data);
    }
}