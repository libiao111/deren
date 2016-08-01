<?php
/*打印方法*/
function p($array) {
	dump($array, 1, '', 0);
}

//rbac节点递归重组 
function node_merge($node, $pid = 0){
    $arr = array();
    foreach($node as $v){
        if($v['pid'] == $pid){
            $v['child'] = node_merge($node, $v['id']);
            $arr[]=$v;
        }
    }
    return $arr;
}

/*裁剪字符*/
function substr_cut($str, $start, $len = '', $type = 0)
{
    $k = array('',' ','\t','\r','\n');
    $wk = array('','','','','');
    $str = str_replace($k,$wk,$str);
    if (strlen($str) > $start) {
        $tmpstr = "";
        if ($len == '') {$len = $start; $start = 0; }
        for ($i = 0; $i < $len; $i++)
        {
            if ($start <= $i) {
                if ( ord( substr($str, $i, 1) ) > 0xa0 ) {
                    $tmpstr .= substr($str, $i, 3);
                    $i += 2;
                } else {
                    $tmpstr .= substr($str, $i, 1);
                }
            } else {
                if ( ord( substr($str, $i, 1) ) > 0xa0 ) {$i += 2; }
            }
        }
        if ($type) {
            return $tmpstr;
        } else {
            return $tmpstr.'...';
        }
    } else {
        return $str;
    }
}


