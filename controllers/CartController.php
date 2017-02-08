<?php
/**
 * Created by PhpStorm.
 * User: yangyu
 * Date: 2017/2/5
 * Time: 21:03
 */
namespace app\controllers;
use yii\web\Controller;
class  CartController extends Controller{
    public function actionIndex(){    //购物车
       $this->layout ="layouts1";
        return $this->render("index");
    }
}
