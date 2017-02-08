<?php
/**
 * Created by PhpStorm.
 * User: yangyu
 * Date: 2017/2/5
 * Time: 21:07
 */
namespace app\controllers;
use yii\web\Controller;
class  OrderController extends Controller{
    public function actionCheck(){  //收银台
       $this->layout ="layouts1";
        return $this->render("check");
    }
    public function actionIndex(){   //订单中心
        $this->layout ="layouts2";
        return $this->render("index");
    }
}