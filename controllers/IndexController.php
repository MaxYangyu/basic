<?php
/**
 * Created by PhpStorm.
 * User: yangyu
 * Date: 2017/2/5
 * Time: 20:05
 * 首页
 */
namespace app\controllers;
use yii\web\Controller;


class IndexController extends  Controller{
    public function actionIndex()
    {
        $this->layout ="layouts1";
        return $this->render("index");
    }
}