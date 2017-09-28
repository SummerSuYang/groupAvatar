<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/22 0022
 * Time: 10:02
 */

// 告知浏览器不进行缓存
header('Cache-Control: no-cache');
header('X-Accel-Buffering: no');
require_once './vendor/autoload.php';
use Intervention\Image\ImageManager;

$manager = new ImageManager(array('driver' => 'imagick'));

$path = './test.jpg';
$result = './new.jpg';

/*//图片资源
$image = $manager->make($path);

//改变图像的大小
$image->resize(100,100);

//保存图片
$image->save('./new.jpg');*/


/*//生成一个新的画布，规定了大小和底色
$image = $manager->canvas(200,150,[233,233,233]);
//将另外一幅图片覆盖在当前画布上，fill函数可以接受颜色也可以接受图片
$image->fill('./new.jpg');
$image->save('./new1.jpg');*/


/*$image = $manager->make($path);
//让图片变得模糊
$image->blur(10);
//改变图像的亮度，-100最暗，0不变，100最亮
$image->brightness(10);
$image->save('./new.jpg');*/


/*$image = $manager->canvas(300,200,'#ddd');
//在image这个画布上画个圆
$image->circle(10,100,100,function ($draw){
   $draw->background('#0000ff');
    $draw->border(1, '#f00');
});
$image->save('./new.jpg');*/


/*//裁剪一个矩形，宽，长，x起点，y起点
$image = $manager->make($path);
$image->crop(100,100,500,500);
$image->save($result);
//清除内存中的资源，默认但脚本结束的时候会自动清除
$image->destroy();*/


/*$image = $manager->canvas(800,600,'#ddd');
//画椭圆，半径，半径，起点x，起点y
$image->ellipse(30,30,50,50,function ($draw){
   $draw->background('#0000ff');
   $draw->border(1, '#ff0000');
});
$image->save($result);*/



/*$image = $manager->make($path);
//输出图像的元信息
var_dump($image->exif());
//获取图像的大小
var_dump($image->filesize());*/


/*$image = $manager->make('./new.jpg');
//反转
$image->flip('v');
$image->save($result);*/


/*$image = $manager->make($path);
//合理的缩小图片，包括裁剪和缩放
$image->fit(466,466);
$image->save($result);*/


//将图片变为灰色
/*$image = $manager->make($path);
$image->greyscale();
$image->save($result);*/


/*$image = $manager->make($path);
//获取图像的高
echo $image->height();
//获取图像的宽
echo $image->width();*/


/*$image = $manager->make($path);
//将图片的高设置为指定的值，同时图片的宽也会等比例的变化
$image->heighten(3000);
$image->save($result);*/


/*$image = $manager->make($path);
//添加水印
$image->insert('./avatar.jpg','bottom-right',10,10);
$image->save($result);*/

//画线
/*$image = $manager->canvas(100, 100, '#ddd');
$image->line(10, 10, 100, 10, function ($draw) {
    $draw->color('#0000ff');
});
$image->line(10, 10, 195, 195, function ($draw) {
    $draw->color('#f00');
    $draw->width(5);
});
$image->save($result);*/


//make
/*$img = Image::make('public/foo.jpg');
$img = Image::make(file_get_contents('public/foo.jpg'));
$img = Image::make(imagecreatefromjpeg('public/foo.jpg'));
$img = Image::make('http://example.com/example.jpg');
//laravel中可以直接获取
$img = Image::make(Input::file('photo'));*/

//base64编码
/*$image = $manager->make('more.png');
$data = $image->encode('data-url');
file_put_contents('123.md',$data);*/

$canvas = $manager->canvas(200,200,'#F7F7F7');
$image = $manager->make('./test.png');

/*//一个
$image->fit(200,200);
$canvas->insert($image,'center',0,0);*/
//两个
$image->fit(85,85);
$canvas->insert($image,'bottom-left',10,57);
$canvas->insert($image,'bottom-left',105,57);

//三个
/*$image->fit(85,85);
$canvas->insert($image,'top',0,10);
$canvas->insert($image,'bottom-left',10,10);
$canvas->insert($image,'bottom-left',105,10);*/

//四个
/*$image->fit(85,85);
$canvas->insert($image,'top-left',10,10);
$canvas->insert($image,'top-left',105,10);
$canvas->insert($image,'bottom-left',10,10);
$canvas->insert($image,'bottom-right',10,10);*/

//五个
/*$image->fit(60,60);
$canvas->insert($image,'top-left',37,37);
$canvas->insert($image,'top-left',102,37);
$canvas->insert($image,'bottom-left',5,37);
$canvas->insert($image,'bottom-left',70,37);
$canvas->insert($image,'bottom-right',5,37);*/

//六个
/*$image->fit(60,60);
$canvas->insert($image,'top-left',5,37);
$canvas->insert($image,'top-left',70,37);
$canvas->insert($image,'top-left',135,37);
$canvas->insert($image,'bottom-left',5,37);
$canvas->insert($image,'bottom-left',70,37);
$canvas->insert($image,'bottom-right',5,37);*/

//七个
/*$image->fit(60,60);
$canvas->insert($image,'top',0,5);
$canvas->insert($image,'top-left',5,70);
$canvas->insert($image,'top-left',70,70);
$canvas->insert($image,'top-left',135,70);
$canvas->insert($image,'bottom-left',5,5);
$canvas->insert($image,'bottom-left',70,5);
$canvas->insert($image,'bottom-left',135,5);*/

//八个
/*$image->fit(60,60);
$canvas->insert($image,'top-left',37,5);
$canvas->insert($image,'top-left',102,5);
$canvas->insert($image,'top-left',5,70);
$canvas->insert($image,'top-left',70,70);
$canvas->insert($image,'top-left',135,70);
$canvas->insert($image,'bottom-left',5,5);
$canvas->insert($image,'bottom-left',70,5);
$canvas->insert($image,'bottom-left',135,5);*/

/*$image->fit(60,60);
$canvas->insert($image,'top-left',5,5);
$canvas->insert($image,'top-left',70,5);
$canvas->insert($image,'top-left',135,5);
$canvas->insert($image,'top-left',5,70);
$canvas->insert($image,'top-left',70,70);
$canvas->insert($image,'top-left',135,70);
$canvas->insert($image,'bottom-left',5,5);
$canvas->insert($image,'bottom-left',70,5);
$canvas->insert($image,'bottom-left',135,5);*/



/*$canvas->save('dfdfdk.png');
header("Content-Type: image/png");
echo $canvas;*/

 function getExtensionType($str)
{
    $position = strrpos($str,'.');

    //return substr($str,$position+1);
    return $position;
}

echo getExtensionType('123');