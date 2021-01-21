<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function index(){
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }
	public function reg(){
        $tit='添加作者';
        $admchk=M('userinf');
        $havadm=$admchk->where('uid=1')->find();
        if(!$havadm){
            $tit='添加管理员';
            $this->assign('tit',$tit);
            $this->display();
        }else{
            if(session('uid')=='1')
            {
                $this->assign('tit',$tit);
                $this->display();
            }else
            {
                $this->error('你没有权限添加用户！');
            }
        }

    }
    public function adduser(){
        $rules = array(
            array('uname','','帐号名称已经存在！',0,'unique',1), 
            array('email','','电子邮件已经存在！',0,'unique',1), 
            array('phone','','手机号已经存在！',0,'unique',1), 
            array('repass','upass','确认密码不正确',0,'confirm'),
        );
        $User = M("userinf"); // 实例化User对象
        if (!$User->validate($rules)->create()){
                // 如果创建失败 表示验证没有通过 输出错误提示信息
            exit($User->getError());
        }else{
            $User->upass=md5($User->upass);
            $User->add();
            $this->success('注册成功',U('Index/index'));
            }
        }
    public function _before_login(){
        if(session('uid')){
            $this->error('登陆前请先注销');
        }
    }
	public function login(){
        $tit='用户登录';
        $this->assign('tit',$tit);
        $this->display();
    }
    public function checklogin(){
        $login=M('userinf');
        $login->create();
        function check_verify($code, $id = ''){
            $verify = new \Think\Verify();
            return $verify->check($code, $id);
        }
        if(!check_verify(I('check')))
        {
            $this->error('验证码错误');
        }
        $login->upass=md5($login->upass);
        if($result=$login->where("uname='$login->uname' AND upass='$login->upass'")->find())
        {
            session('usn',"$result[uname]");
            session('uid',"$result[uid]");
            //$_SESSION['usn'] = $result['uname'];
            //$_SESSION['uid'] = $result['uid'];
            $this->success('登陆成功',U('Index/index'));
        }
        else $this->error('账号或密码错误');
    }
    public function verify(){
        $Verify =     new \Think\Verify();
        $Verify->fontSize = 30;
        $Verify->length   = 4;
        $Verify->useNoise = false;
        $Verify->entry();
    }
	public function logout(){
        session(null);
        $this->success('欢迎再来');
    }
    public function id2name($uid=""){
        $usm=M('userinf');
        $data=$usm->where("uid=$uid")->find();
        return data['uname'];
    }
    public function _empty(){
        $this->error('Something ERRoR!');
    }
}
