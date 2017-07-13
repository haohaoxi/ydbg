<?php

namespace backend\modules\chuchai\controllers;

use backend\controllers\CommonController;
use yii\web\Controller;

class DefaultController extends CommonController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
