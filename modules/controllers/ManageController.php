<?php
/**
 * Created by PhpStorm.
 * User: yangyu
 * Date: 2017/2/11
 * Time: 23:39
 */
namespace app\modules\controllers;

use app\modules\models\Admin;
use Yii;
use yii\web\Controller;
use yii\data\Pagination;
class ManageController extends Controller
{
    public function actionMailchangepass()
    {
        $this->layout = false;
        $time = Yii::$app->request->get("time");
        $adminuser = Yii::$app->request->get("adminuser");
        $token = Yii::$app->request->get("token");
        $model = new Admin;
        $myToken = $model->createToken($adminuser, $time);
        if ($token != $myToken) {
            $this->redirect(['public/login']);
            Yii::$app->end();
        }
        if (time() - $time > 300) {
            $this->redirect(['public/login']);
            Yii::$app->end();
        }
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->changePass($post)) {
                Yii::$app->session->setFlash('info', '密码修改成功');
            }
        }
        $model->adminuser = $adminuser;
        return $this->render("mailchangepass", ['model' => $model]);

    }

    public function actionManagers()
    {
        $this->layout = "layouts1";
        $model = Admin::find();
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['manage'];
        $pager = new Pagination(['totalCount' => $count, 'pagesize' => $pageSize]);
        $managers = $model->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render("managers", ['managers' => $managers, 'pager' => $pager]);
    }

    public function actionReg()
    {
        $this->layout = "layouts1";
        $model = new Admin;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->reg($post)) {
                Yii::$app->session->setFlash('info', "添加成功");
            } else {
                Yii::$app->session->setFlash('info', "添加失败");
            }
        }
        $model->adminpass = "";
        $model->repass = "";
        return $this->render("reg", ['model' => $model]);
    }

    public function actionDel()
    {
        $adminid = (int)Yii::$app->request->get("adminid");
        if (empty($adminid)) {
            $this->redirect(['manage/managers']);
        }
        $model = new Admin;
        if ($model->deleteAll('adminid=:id', [':id' => $adminid])) {
            Yii::$app->session->setFlash('info', "删除成功");
            $this->redirect(['manage/managers']);
        }
    }

    public function actionChangeemail()
    {
        $this->layout = "layouts1";
        $model = Admin::find()->where('adminuser = :user', [':user' => Yii::$app->session['admin']['adminuser']])->one();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->changeEmail($post)) {
                Yii::$app->session->setFlash('info', '修改成功');
            } else {
                Yii::$app->session->setFlash('info', '修改失败');
            }
        }
        $model->adminpass = "";
        return $this->render("changeemail", ['model' => $model]);
    }

    public function actionChangepass()
    {
        $this->layout = "layouts1";
        $model = Admin::find()->where('adminuser = :user', [':user' => Yii::$app->session['admin']['adminuser']])->one();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->changePass($post)) {
                Yii::$app->session->setFlash('info', '修改成功');
            }else{
                Yii::$app->session->setFlash('info','修改失败');
            }
        }
        $model->adminpass = '';
        $model->repass = '';
        return $this->render('changepass', ['model' => $model]);
    }
}

