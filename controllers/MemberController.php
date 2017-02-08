<?php
/**
 * Created by PhpStorm.
 * User: yangyu
 * Date: 2017/2/5
 * Time: 22:14
 */
namespace app\controllers;
use yii\web\Controller;
class  MemberController extends Controller{
    public function actionAuth(){
        //用户登录
        $this->layout ="layouts2";
        return $this->render("auth");
    }
}
