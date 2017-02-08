<?php
/**
 * Created by PhpStorm.
 * User: yangyu
 * Date: 2017/2/5
 * Time: 20:25
 */
namespace app\controllers;
use yii\web\Controller;
class  ProductController extends Controller{
    public function actionIndex(){  //商品分类
        $this->layout ="layouts2";
        return $this->render("index");
    }
    public function actionDetail(){  //商品详情
        $this->layout ="layouts2";
        return $this->render("detail");
    }

}