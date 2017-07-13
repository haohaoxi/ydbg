<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\tzgggl\models\Announcement */

$this->title = 'Create Announcement';
$this->params['breadcrumbs'][] = ['label' => 'Announcements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<link href="css/ydbg/common.css" type="text/css" rel="stylesheet" />
<link href="css/ydbg/style.css" type="text/css" rel="stylesheet" />
<link href="css/ydbg/common1.css" type="text/css" rel="stylesheet" />
<link href="css/ydbg/style1.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/ydbg/jquery.min.js"></script>
<script type="text/javascript" src="js/ydbg/common.js"></script>
<script type="text/javascript" src="js/ydbg/getdate.js"></script>
<script type="text/javascript" src="js/ydbg/jquery.placeholder.js"></script>

<div class="boxer">

<div class="announcement-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
