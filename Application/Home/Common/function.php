<?php
function id2name($uid=""){
        $usm=M('userinf');
        $data=$usm->where("uid=$uid")->find();
        return $data['uname'];
    }