<?php
namespace backend\functions;
use backend\modules\menu\models\Menu;
use backend\modules\params\models\Params;
use backend\modules\peoplecontact\models\PeopleContact;
use backend\modules\user\models\RoleUser;
use yii\web\NotFoundHttpException;
/**
 * 公共方法库
 */
class functions
{

    protected static $_Breadcrumbs;

    /**
     * 把返回的数据集转换成Tree
     * @param array $list 要转换的数据集
     * @param string $pid parent标记字段
     * @param string $level level标记字段
     * @return array
     */
    public static function list_to_tree($list, $pk='id', $pid = 'pid', $child = '_child', $root = 0) {
        // 创建Tree
        $tree = array();
        if(is_array($list)) {
            // 创建基于主键的数组引用
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] =& $list[$key];
            }

            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId = $data[$pid];
                if ($root == $parentId) {
                    $tree[$data['id']] =& $list[$key];
                }else{
                    if (isset($refer[$parentId])) {
                        $parent =& $refer[$parentId];
                        $parent[$child][] =& $list[$key];
                    }
                }
            }
        }
        return $tree;
    }


    /*
     * 无线分类递归 数组转换 一维数组
     * @param $list
     * @param array $list_new
     * @return array
     */
    public static function tree_to_array($list,&$list_new=array()){
        foreach($list as $key=>&$value){
            if(isset($value['_child'])){
                self::tree_to_array($value['_child'],$list_new);
                unset($value['_child']);
            }
            $list_new[] = $value;
        }
        return $list_new;
    }

    //********弹出alert框并跳转到指定页面******//
    public static function alert($message,$url='',$isAlert=true,$title='提示'){
        echo '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>',$title,'</title></head><body>';
        echo '<script type="text/javascript">';
        echo $isAlert?'alert("'.$message.'");':'';
        echo $url==''?'history.back();':'location.href="'.$url.'";';
        echo '</script>';
        echo '</body></html>';
        exit();
    }


    /**
     * 取得输入目录所包含的所有文件
     * 以数组形式返回
     * author: flynetcn
     */
    public static function get_dir_files($dir)
    {
        if (is_file($dir)) {
            return array($dir);
        }
        $files = array();
        if (is_dir($dir) && ($dir_p = opendir($dir))) {
            $ds = DIRECTORY_SEPARATOR;
            while (($filename = readdir($dir_p)) !== false) {
                if ($filename=='.' || $filename=='..') { continue; }
                $filetype = filetype($dir.$ds.$filename);
                if ($filetype == 'dir') {
                    $files = array_merge($files, self::get_dir_files($dir.$ds.$filename));
                } elseif ($filetype == 'file') {
                    $files[] = $dir.$ds.$filename;
                }
            }
            closedir($dir_p);
        }
        return $files;
    }

    /*
     * 是否显示 html
     * @param $status
     */
    public static function get_show_html($status){
        if($status == 1){
            return "<font color='green'>是</font>";
        }else{
            return "<font color='red'>否</font>";
        }
    }

    /*
     * 状态显示 html
     * @param $status
     */
    public static function get_status_html($status){
        if($status == 1){
            return "<font color='green'>启用</font>";
        }else{
            return "<font color='red'>禁用</font>";
        }
    }

    /*
     * 是否显示
     * @param $status
     */
    public static function get_show($id=""){
        $show = ['1'=>'是','0'=>"否"];
        if($id != "") return $show[$id];
        return $show;
    }

    /*
     * 状态显示
     * @param $status
     */
    public static function get_status($id=""){
        $status = ['1'=>'启用','0'=>"禁用"];
        if($id != "") return $status[$id];
        return $status;
    }



    /**
     * 安全过滤整合方法
     *
     * @param $string
     * @return string
     */
    public static function safe_filter($str){
        return self::remove_xss(self::remove_xss($str));
    }


    /**
     * 安全过滤方法
     *
     * @param $string
     * @return string
     */
    public static function safe_replace($string) {
        $string = str_replace('%20', '', $string);
        $string = str_replace('%27', '', $string);
        $string = str_replace('%2527', '', $string);
        $string = str_replace('*', '', $string);
        $string = str_replace('"', '&quot;', $string);
        $string = str_replace("'", '', $string);
        $string = str_replace('"', '', $string);
        $string = str_replace(';', '', $string);
        $string = str_replace('<', '&lt;', $string);
        $string = str_replace('>', '&gt;', $string);
        $string = str_replace("{", '', $string);
        $string = str_replace('}', '', $string);
        $string = str_replace('\\', '', $string);
        return $string;
    }

    /**
     * xss过滤方法
     *
     * @param $string
     * @return string
     */
    public static function remove_xss($string) {
        $string = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S', '', $string);

        $parm1 = Array('javascript','vbscript','expression','applet','meta','xml','blink','link','script','embed','object','iframe','frame','frameset','ilayer','layer','bgsound','title','base');

        $parm2 = Array('onabort','onactivate','onafterprint','onafterupdate','onbeforeactivate','onbeforecopy','onbeforecut','onbeforedeactivate','onbeforeeditfocus','onbeforepaste','onbeforeprint','onbeforeunload','onbeforeupdate','onblur','onbounce','oncellchange','onchange','onclick','oncontextmenu','oncontrolselect','oncopy','oncut','ondataavailable','ondatasetchanged','ondatasetcomplete','ondblclick','ondeactivate','ondrag','ondragend','ondragenter','ondragleave','ondragover','ondragstart','ondrop','onerror','onerrorupdate','onfilterchange','onfinish','onfocus','onfocusin','onfocusout','onhelp','onkeydown','onkeypress','onkeyup','onlayoutcomplete','onload','onlosecapture','onmousedown','onmouseenter','onmouseleave','onmousemove','onmouseout','onmouseover','onmouseup','onmousewheel','onmove','onmoveend','onmovestart','onpaste','onpropertychange','onreadystatechange','onreset','onresize','onresizeend','onresizestart','onrowenter','onrowexit','onrowsdelete','onrowsinserted','onscroll','onselect','onselectionchange','onselectstart','onstart','onstop','onsubmit','onunload');

        $parm = array_merge($parm1, $parm2);

        for($i = 0; $i < sizeof($parm); $i++) {
            $pattern = '/';
            for($j = 0; $j < strlen($parm[$i]); $j++) {
                if ($j > 0) {
                    $pattern .= '(';
                    $pattern .= '(&#[x|X]0([9][a][b]);?)?';
                    $pattern .= '|(&#0([9][10][13]);?)?';
                    $pattern .= ')?';
                }
                $pattern .= $parm[$i][$j];
            }
            $pattern .= '/i';
            $string = preg_replace($pattern, '', $string);
        }
        return $string;
    }


    /**
     * 返回经addslashes处理过的字符串或数组
     * @param $string 需要处理的字符串或数组
     * @return mixed
     */
    public static function new_addslashes($string) {
        if (!is_array($string))
            return addslashes($string);
        foreach ($string as $key => $val)
            $string[$key] = self::new_addslashes($val);
        return $string;
    }

    /**
     * 返回经stripslashes处理过的字符串或数组
     * @param $string 需要处理的字符串或数组
     * @return mixed
     */
    public static function new_stripslashes($string) {
        if (!is_array($string))
            return stripslashes($string);
        foreach ($string as $key => $val)
            $string[$key] = self::new_stripslashes($val);
        return $string;
    }


    /**
     * 将数组转换为字符串
     *
     * @param	array	$data		数组
     * @param	bool	$isformdata	如果为0，则不使用new_stripslashes处理，可选参数，默认为1
     * @return	string	返回字符串，如果，data为空，则返回空
     */
    public static function array2string($data, $isformdata = 1) {
        if($data == '' || empty($data)) return '';

        if($isformdata) $data = self::new_stripslashes($data);
        if (version_compare(PHP_VERSION,'5.3.0','<')){
            return addslashes(json_encode($data));
        }else{
            return addslashes(json_encode($data,JSON_FORCE_OBJECT));
        }
    }

    /**
     * 数组转码
     *
     */
    public static function mult_iconv($in_charset,$out_charset,$data){
        if(substr($out_charset,-8)=='//IGNORE'){
            $out_charset=substr($out_charset,0,-8);
        }
        if(is_array($data)){
            foreach($data as $key => $value){
                if(is_array($value)){
                    $key=iconv($in_charset,$out_charset.'//IGNORE',$key);
                    $rtn[$key]=self::mult_iconv($in_charset,$out_charset,$value);
                }elseif(is_string($key) || is_string($value)){
                    if(is_string($key)){
                        $key=iconv($in_charset,$out_charset.'//IGNORE',$key);
                    }
                    if(is_string($value)){
                        $value=iconv($in_charset,$out_charset.'//IGNORE',$value);
                    }
                    $rtn[$key]=$value;
                }else{
                    $rtn[$key]=$value;
                }
            }
        }elseif(is_string($data)){
            $rtn=iconv($in_charset,$out_charset.'//IGNORE',$data);
        }else{
            $rtn=$data;
        }
        return $rtn;
    }


    /*
     * ·根据ID返回状态
     */
    public static function getStatus($id=""){
        $data = array('1'=>'启用','0'=>'禁用');
        if($id === "") return $data;
        return $data[$id];
    }

    /*
     * ·根据ID返回状态 用户
     */
    public static function getStatusUser($id=""){
        $data = array('10'=>'启用','0'=>'禁用');
        if($id === "") return $data;
        return $data[$id];
    }

    /*
     * 获取性别
     * @param string $id
     * @return array
     */
    public static function getSex($id=""){
        $data = array('男'=>'男','女'=>'女','未知性别'=>'未知性别');
        if($id === "") return $data;
        return $data[$id];
    }


    /*
     * 获取子id 父id
     * @return array
     */
    public static function getPidCid(){
        $data = array();
        $moduleId = \Yii::$app->controller->module->id; //获取模块id
        $controllerId =  \Yii::$app->controller->id; //获取控制器id
        $actionId =  \Yii::$app->controller->action->id; //获取方法id
        $query = new \yii\db\Query();

        $where = ['module'=>$moduleId,'controller'=>$controllerId,'action'=>$actionId,'is_run'=>1];
        if(!empty($_GET['menutype'])) $where['menutype'] = $_GET['menutype'];

        if(!$menu = $query->select('id,name,parent_id,action')->from("{{menu}}")->where($where)->one()){
            functions::alert('该菜单功能不存在或者未启用.'.$moduleId.'-'.$controllerId.'-'.$actionId);
        }
        if($menu['parent_id'] == 0){ //代表是顶级菜单
            $data['p_id'] = $menu['id']; // 顶级菜单id
            $c_id = Menu::get_child_id($menu['id']);
            $data['c_id'] = $c_id === false ? '' : $c_id;
        }elseif($menu['action'] == 'index' || $menu['action'] == 'record' || $menu['action'] == 'myget'){ //代表是中级级菜单 需要获取顶级菜单id
            $data['c_id'] = $menu['id'];
            $data['p_id'] = Menu::get_parent_top_id($menu['parent_id']);
        }else{
            $_cid = $query->select('id')->from("{{menu}}")->where(['id'=>$menu['parent_id'],'is_run'=>1])->one();
            $data['c_id'] = $_cid['id'];
            $data['p_id'] = Menu::get_parent_top_id($menu['parent_id']);
        }
        return $data;
    }


    /*
     * 获取等级
     */
    public static function getLevel($id=''){
        $data = array('一般'=>'一般','紧急'=>'紧急');
        if($id === "") return $data;
        return $data[$id];
    }

    /*
     * 工资查询获取年份
     */
    public static function getWagesYear($id=''){
        $data = array();
        $year = date('Y',time())-1;
        for($i= 0;$i <= 15;$i++){
            $data[$year + $i] = $year + $i;
        }
        if($id === "") return $data;
        return $data[$id];
    }

    /*
 * 工资查询获取年份
 */
    public static function getWagesMonth($id=''){
        $data = array();
        for($i= 1;$i <= 12;$i++){
            $data[str_pad($i,2,"0",STR_PAD_LEFT)] =  str_pad($i,2,"0",STR_PAD_LEFT);
        }
        if($id === "") return $data;
        return $data[$id];
    }

    /*
* 获取机构下的人员个数
* @return array
*/
    public static function findPeople($id){
        $data = PeopleContact::find()->where(['dept_id'=>$id])->asArray()->all();
        if($data){
            $_user_ids = "";
            foreach($data as $value){
                $_user_ids[]= $value['id'];
            }
            $count = count($_user_ids);
            return $count;
        }else
            return 0;
    }

    //********弹出alert框并成功关闭******//
    public static function alertClose($message,$url='',$isAlert=true,$title='提示'){
        echo '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>',$title,'</title></head><body>';
        echo '<script type="text/javascript">';
        echo $isAlert?'alert("'.$message.'");':'';
        echo $url==''?'window.close();':'location.href="'.$url.'";';
        echo '</script>';
        echo '</body></html>';
        exit();
    }


    /*
     * 验证是否拥有单一操作的权限
     * @return bool
     */
    public static function hasPermissionOne($moduleId='',$controllerId='',$actionId=''){
            $super_admin = \Yii::$app->params['super_admin']; //获取超级用户账号
            $username = \Yii::$app->user->identity->username; //获取登录账号
            if(in_array($username,$super_admin)) return true; //如果是超级账户的话 则免除验证 拥有最高权限
            $moduleId = $moduleId == '' ? \Yii::$app->controller->module->id : $moduleId; //获取模块id
            $controllerId = $controllerId == '' ?  \Yii::$app->controller->id : $controllerId; //获取控制器id
            $actionId = $controllerId == '' ? \Yii::$app->controller->action->id : $actionId; //获取方法id
            $userId = \Yii::$app->user->identity->id; //获取用户id
            $query = new \yii\db\Query();
            $role_user = $query->select('role_id')->from("{{role_user}}")->where(['user_id'=>$userId])->one();
            $role_id = $role_user['role_id'];//获取角色id

            $where = ['module'=>$moduleId,'controller'=>$controllerId,'action'=>$actionId,'is_run'=>1];
            if(!empty($_GET['menutype'])) $where['menutype'] = $_GET['menutype'];
            if(!$menu = $query->select('id,name')->from("{{menu}}")->where($where)->one()){   //获取当前方法的验证权限记录id
                return false;
            }
            $menu_id = $menu['id'];
            if(!$query->select('id')->from("{{role_menu}}")->where(['role_id'=>$role_id,'menu_id'=>$menu_id])->one()){ //检查用户是否拥有该权限
                return false;
            }
            return true;
    }

    /*
    * 获取角色下的用户个数
    * @return array
    */
    public static function findUser($id){
        $data = RoleUser::find()->where(['role_id'=>$id])->asArray()->all();
        if($data){
            $_user_ids = "";
            foreach($data as $value){
                $_user_ids[]= $value['user_id'];
            }
            $count = count($_user_ids);
            return $count;
        }else
            return 0;
    }

}
