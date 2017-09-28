<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/28 0028
 * Time: 11:01
 */
include_once './groupAvatar.php';

$avatars = [
    'http://diy.qqjay.com/u2/2012/0618/ed6982355b1340095aeaf79072bdc1cc.jpg',
    'http://v1.qzone.cc/avatar/201310/12/15/42/5258fd6f0db4b914.jpg%21200x200.jpg',
    'http://qzone.qqjay.com/u/files/2011/0505/ff58f34ab463720fb7aeb23e18dc7790.jpg',
    'http://diy.qqjay.com/u2/2014/0609/48f4b6834fac32345c9f7eca8b4abde0.jpg',
    'http://up.qqya.com/allimg/201710-t/17-101802_79867.jpg',
    'http://img.jsqq.net/uploads/allimg/150210/1-150210161I90-L.jpg',
    'http://v1.qzone.cc/avatar/201408/09/11/39/53e597e6d30cd273.jpg%21200x200.jpg',
    'http://www.feizl.com/upload2007/2011_05/1105241409555916.jpg',
    'http://diy.qqjay.com/u2/2012/0912/a188c51e5d10d1c61241759ed3c43307.jpg'
];

$obj = new groupAvatar($avatars);
$obj->handle();
$path = $obj->getCanvas();
echo "<img src='{$path['data']['webPath']}'>";