<?php
/*
File Name: DAO.php
Date: 2015/4/28 50
Version: 1.0.1
Author: LostCap
*/
//执行 SQL 语句
$db = \Yii::$app->db;
$rows = $db->createCommand('SELECT * FROM zs_dynasty')->queryAll();

$rowCount=$command->execute();   // 执行无查询 SQL
$dataReader=$command->query();   // 执行一个 SQL 查询
$rows=$command->queryAll();      // 查询并返回结果中的所有行
$row=$command->queryRow();       // 查询并返回结果中的第一行
$column=$command->queryColumn(); // 查询并返回结果中的第一列
$value=$command->queryScalar();  // 查询并返回结果中第一行的第一个字段


//获取查询结果
$db = \Yii::$app->db;
$query = $db->createCommand('SELECT * FROM zs_dynasty')->query();
while(($row=$query->read())!==false) {
    print_r($row);
}

// 使用 foreach 遍历数据中的每一行
$query = $db->createCommand('SELECT * FROM zs_dynasty')->query();
foreach($query as $row) {
    print_r($row);
}

// 一次性提取所有行到一个数组
$query = $db->createCommand('SELECT * FROM zs_dynasty')
    ->query();
$rows=$query->readAll();
print_r($rows);



//使用事务
$db = \Yii::$app->db;
    $transaction=$db->beginTransaction();
    try
    {
    $query = $db->createCommand('SELECT * FROM zs_dynasty')->query();
    $transaction->commit();
}
catch(Exception $e) // 如果有一条查询失败，则会抛出异常
{
    $transaction->rollBack();
}
$rows=$query->readAll();
print_r($rows);


//绑定参数
// 一条带有两个占位符 ":username" 和 ":email"的 SQL
$sql="INSERT INTO tbl_user (username, email) VALUES(:username,:email)";
$db = \Yii::$app->db;
$command=$db->createCommand($sql);
// 用实际的用户名替换占位符 ":username"
$command->bindParam(":username",$username,PDO::PARAM_STR);
// 用实际的 Email 替换占位符 ":email"
$command->bindParam(":email",$email,PDO::PARAM_STR);
$command->execute();
// 使用新的参数集插入另一行
$command->bindParam(":username",$username2,PDO::PARAM_STR);
$command->bindParam(":email",$email2,PDO::PARAM_STR);
$command->execute();


//绑定列
$sql="SELECT username, email FROM tbl_user";
$dataReader=$db->createCommand($sql)->query();
// 使用 $username 变量绑定第一列 (username)
$dataReader->bindColumn(1,$username);
// 使用 $email 变量绑定第二列 (email)
$dataReader->bindColumn(2,$email);
while($dataReader->read()!==false)
{
    // $username 和 $email 含有当前行中的 username 和 email
}


//使用表前缀
//配置:Connection::tablePrefix
//在 SQL 语句中使用 {{%TableName}}
$sql='SELECT * FROM {{user}}';
$users=$connection->createCommand($sql)->queryAll();


$query = new \yii\db\Query();
$menus = $query->from("{{menu}}")->orderBy('order desc')->where(['is_show'=>1])->all();
return $menus;