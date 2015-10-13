<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\components\api\Football;

class FootballController extends Controller
{
    public function actionIndex()
    {
        // Update the database from the API.
        // Football::competitions();
        // Football::standings();
        // Football::live();
        // Football::matches();
        // Football::fixtures(null, time(), time() + (86400*28*12));

        return $this->render('index');
    }
}
