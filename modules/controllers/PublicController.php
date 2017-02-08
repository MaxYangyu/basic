<?php
/**
 * Created by PhpStorm.
 * User: yangyu
 * Date: 2017/2/7
 * Time: 19:42
 */
namespace app\modules\controllers;

use yii\web\Controller;
use app\modules\models\Admin;
class PublicController extends Controller{
    public  function actionLogin(){
        $this->layout =false;
        $model =new Admin;
        return $this->render("login",['model'=>$model]);
    }
}