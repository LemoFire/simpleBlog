<?php
namespace Home\Controller;
use Think\Controller;
class PostController extends Controller {
    public function write($pid='',$mode=''){
        $tit='添加文章';
        if(I('post.del')!=NULL){
            $mode='del';
        }
        if(I('post.edit')!=NULL){
            $mode='edit';
        }
        if($mode=="edit"){
            $tit='文章编辑器';
            $psm=M('post');
            $data=$psm->where("pid=$pid")->find();
            $this->assign('title',$data['title']);
            $this->assign('content',$data['content']);            
        }
        if($mode=='del'){
            $psm=M('post');
            $psm->delete("$pid");
            $this->success('删除成功',U('Index/index'));
            exit();
        }
        $this->assign('tit',$tit);
        $this->assign('pid',$pid);       
        $this->assign('mode',$mode);
        $this->display();
    }
    public function editpost($pid='',$mode=''){
        $psm=M('post');
        if($pid!=NULL){
            $data=$psm->where("pid=$pid")->find();
            if(!session('uid')||(session('uid')!='1' && session('uid')!=$data['uid'])){
                $this->error('无权限操作');
            }
        }else{
            if(!session('uid')){
                $this->error('无权限操作');
            }
        }
        
        if($mode=='edit'){
            $psm->create();
            $psm->where("pid=$pid")->save();
            $this->success('编辑成功',U('Post/topic',array('pid'=>$pid)));
        }
        if($mode==''){
            $psm->create();
            $psm->uid=session('uid');
            $psm->add();
            $this->success('写文成功',U('Index/index'));
        }
    }
    public function topic($pid=""){
        if(!$pid){
            $this->error('不要调皮');
        }
        $psm=M('post');
        $data=$psm->where("pid=$pid")->find();
        $this->assign('tit',$data['title']);
        $this->assign('content',$data['content']);
        $this->assign('uid',$data['uid']);
        $comment = M('comment'); // 实例化User对象
        $count      = $comment->where("pid=$pid")->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $comment->where("pid=$pid")->order('cid desc')->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }
    public function writecomment($pid=""){
        if(!$pid){
            $this->error('请检查传入数据');
        }
        $cmm=M('comment');
        $cmm->create();
        $cmm->pid=$pid;
        $cmm->add();
        $this->success('评论成功！');
    }
    public function delcomment($cid=""){
        $csm=M('comment');
        $csm->delete("$cid");
        $this->success('删除成功！');
    }
    public function _empty(){
        $this->error('Something ERRoR!');
    }
}
