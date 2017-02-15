<p>尊敬的<?php echo $adminuser?>,您好</p>
<p>您的找回密码链接为：</p>
<?php $url=Yii::$app->urlManager->createAbsoluteUrl(['admin/manage/mailchangepass','time'=>$time,'adminuser'=>$adminuser,'token'=>$token]); ?>
<p><a href="<?php echo $url;?>" ><?php echo $url;?></p>
<p>该链接5分钟内有效,请勿传递他人！</p>
<p>该邮件为系统自动发送,请勿回复</p>