<?php
/**
 * Created by PhpStorm.
 * User: yangyu
 * Date: 2017/2/7
 * Time: 20:31
 */
namespace app\modules\models;
use yii\db\ActiveRecord;
use YII;

class Admin extends ActiveRecord{
    public $rememberMe = true; //默认记住我
    public $repass;
    public static function tableName()
    {
        return "{{%admin}}";
    }

    public function attributeLabels(){
        return[
            'adminuser' => "管理员账号",
            'adminpass' => "管理员密码",
            'adminemail'=> "管理员邮箱",
            'repass'    => "确认密码"
        ];
    }

    public function rules(){
        return[
            ['adminuser','unique','message'=>"管理员已存在",'on'=>'adminadd'],
            ['adminuser','required','message'=>'账号不能为空','on'=>['login','seekPass','changepass','adminadd','changeemail'] ],
            ['adminpass','required','message'=>'密码不能为空','on'=>['login','changepass','adminadd','changeemail'] ],
            ['rememberMe','boolean','on'=>'login'],
            ['adminpass','validatePass','on'=>['login','changeemail']],
            ['adminemail','required','message'=>'邮箱不能为空','on'=>['seekPass','adminadd','changeemail']],
            ['adminemail','email','message'=>'邮箱格式不正确','on'=>['seekPass','adminadd','changeemail']],
            ['adminemail','unique','on'=>['adminadd','changeemail'],'message'=>'邮箱已注册'],
            ['adminemail','validateEmail','on'=>'seekPass'],
            ['repass', 'required', 'message' => '确认密码不能为空', 'on' => ['changepass', 'adminadd']],
            ['repass', 'compare', 'compareAttribute' => 'adminpass', 'message' => '两次密码输入不一致', 'on' => ['changepass', 'adminadd']],
        ];
    }

    public function login($data)
    {
        $this->scenario ="login";
        if ($this->load($data) && $this->validate()){
            $lifetime = $this->rememberMe ? 24*3600:0;
            $session =Yii::$app->session;
            session_set_cookie_params($lifetime);
            $session['admin']= [
                'adminuser' => $this->adminuser,
                'isLogin' =>1,
            ];
            $this->updateAll(['logintime' => time(),'loginip'=>ip2long(Yii::$app->request->userIP)],'adminuser =:user',[':user'=>$this->adminuser]);
            return(bool)$session['admin']['isLogin'];
        }
        return false;
    }

    public function validatePass(){
        if(!$this->hasErrors()){
            $data=self::find()->where('adminuser =:user and adminpass = :pass',[":user"=> $this->adminuser,":pass"=> md5($this->adminpass)])->one();
            if (is_null($data)){
                $this->addError("adminpass","用户名或密码错误");
            }
        }
    }

    public function seekPass($data){
        $this->scenario ="seekPass";
        if ($this->load($data) && $this->validate()){
            $time=time();
            $token =$this->createToken($data['Admin']['adminuser'],$time);
            $mailer =Yii::$app->mailer->compose('seekpass',['adminuser'=>$data['Admin']['adminuser'],'time'=> $time,'token'=>$token]);
            $mailer->setFrom("591282626@qq.com");
            $mailer->setTo($data['Admin']['adminemail']);
            $mailer->setSubject("找回密码");
            if ($mailer->send()){
                return true;
            }
        }
        return false;
    }
    public function createToken($adminuser,$time){
        return md5(sha1($adminuser).hash("sha256",YII::$app->request->userIP).sha1($time));
    }

    public function validateEmail()
    {
        if (!$this->hasErrors()) {
            $data = self::find()->where('adminuser = :user and adminemail = :email', [':user' => $this->adminuser, ':email' => $this->adminemail])->one();
            if (is_null($data)) {
                $this->addError("adminemail", "管理员电子邮箱不匹配");
            }
        }
    }
    public function changePass($data)
    {
        $this->scenario = "changepass";
        if ($this->load($data) && $this->validate()) {
            return (bool)$this->updateAll(['adminpass' => md5($this->adminpass)], 'adminuser = :user', [':user' => $this->adminuser]);
        }
        return false;
    }

    public function reg($data){
        $this->scenario ='adminadd';
        if ($this->load($data) && $this->validate()){
            $this->adminpass = md5($this->adminpass);
            if ($this->save(false)){
                return true;
            }
            return false;
        }
        return false;
    }

    public function changeEmail($data){
        $this->scenario = "changeemail";
        if ($this->load($data) && $this->validate()){
          return (bool)$this->updateAll(['adminemail' =>$this->adminemail],'adminuser=:user',[':user' => $this->adminuser]);
        }
        return false;
    }


}