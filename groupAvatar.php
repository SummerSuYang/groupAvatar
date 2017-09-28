<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/27 0027
 * Time: 18:42
 */

require_once './vendor/autoload.php';
use Intervention\Image\ImageManager;
use Intervention\Image\Exception\ImageException;

/**
 * Class groupAvatar
 * 用户生成群头像
 * 需要一个存储群成员头像路径的数组
 * 群成员个数最少一个最多九个
 * 生成的默认大小200 x 200
 */
class groupAvatar
{
    //存放用户头像的数组
    public $avatars;
    //头像的后缀名
    public $extensionType = ['jpg','jpeg','gif','png','bmp'];
    //用户头像的个数
    public $quantity;
    //image库的管理器
    public $manager;
    //群头像的背景画布
    public $canvas;
    //用户头像在群头像中的大小
    public $avatarSize;
    //用户头像的位置
    public $rules = [
        1 => [
            ['center',0,0]
        ],
        2 => [
            ['bottom-left',10,57],
            ['bottom-left',105,57],
        ],
        3 => [
            ['top',0,10],
            ['bottom-left',10,10],
            ['bottom-left',105,10],
        ],
        4 => [
            ['top-left',10,10],
            ['top-left',105,10],
            ['bottom-left',10,10],
            ['bottom-right',10,10]
        ],
        5 => [
            ['top-left',37,37],
            ['top-left',102,37],
            ['bottom-left',5,37],
            ['bottom-left',70,37],
            ['bottom-right',5,37]
        ],
        6 => [
            ['top-left',5,37],
            ['top-left',70,37],
            ['top-left',135,37],
            ['bottom-left',5,37],
            ['bottom-left',70,37],
            ['bottom-right',5,37]
        ],
        7 => [
            ['top',0,5],
            ['top-left',5,70],
            ['top-left',70,70],
            ['top-left',135,70],
            ['bottom-left',5,5],
            ['bottom-left',70,5],
            ['bottom-left',135,5]
        ],
        8 => [
            ['top-left',37,5],
            ['top-left',102,5],
            ['top-left',5,70],
            ['top-left',70,70],
            ['top-left',135,70],
            ['bottom-left',5,5],
            ['bottom-left',70,5],
            ['bottom-left',135,5]
        ],
        9 => [
            ['top-left',5,5],
            ['top-left',70,5],
            ['top-left',135,5],
            ['top-left',5,70],
            ['top-left',70,70],
            ['top-left',135,70],
            ['bottom-left',5,5],
            ['bottom-left',70,5],
            ['bottom-left',135,5]
        ]
];

    public function __construct($avatars)
    {
        $this->avatars = $avatars;
        $this->manager =  new ImageManager(array('driver' => 'imagick'));
    }

    /**
     * 处理过程
     */
    public function handle()
    {
        //过滤不合格的图片
        $this->validator();
        //获取用户头像个数
        $this->getQuantity();
        //计算每个用户图像的大小
        $this->getAvatarSize();
        //群头像的背景图
        $this->makeCanvas();
        //合成头像
        $this->composition();
        //保存群头像并获取群头像的路径
        $this->getCanvas();
    }

    /**
     * 检查图片
     */
    public function validator()
    {
        foreach ($this->avatars as $k=>$v)
        {
            $type = $this->getExtensionType($v);
            //顾虑掉不是图片的项目
            if( ! in_array($type,$this->extensionType))
                unset($this->avatars[$k]);
        }

        //防止传递的图片个数大于9
        $this->avatars = array_splice($this->avatars,0,count($this->rules));
    }

    /**
     * @param $str
     * @return bool|string
     * 获取一个文件的扩展名
     */
    public function getExtensionType($str)
    {
        $position = strrpos($str,'.');

        return substr($str,$position+1);
    }

    /**
     * 获取群成员头像的个数
     */
    public function getQuantity()
    {
        $this->quantity = count($this->avatars);

        //群里的成员的头像数不能为0
        if($this->quantity == 0)
            $this->jsonReturn(0,'please provide valid image path or url');
    }

    /**
     * 获取群成员头像在群头像中的大小
     */
    public function getAvatarSize()
    {
        //群里只有一个人
       if($this->quantity == 1)
       {
           $this->avatarSize = $this->getCanvasSize();
           return;
       }

       //群里少于五个人
        if($this->quantity < 5)
        {
            $this->avatarSize = 85;
            return;
        }

        $this->avatarSize = 60;
    }

    /**
     * 合成群头像
     */
    public function composition()
    {
        //根据需要合成的头像个数选择不同的规则
        $rule = $this->rules[$this->quantity];

        try
        {
            //逐一合成
            for($i = 0;$i<$this->quantity;$i++)
            {
                $image = $this->manager->make($this->avatars[$i]);
                $image->fit($this->avatarSize,$this->avatarSize);

                $this->canvas->insert($image,$rule[$i][0],$rule[$i][1],$rule[$i][2]);
            }
        }
        catch (ImageException $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * 生成群头像画布
     */
    public function makeCanvas()
    {
        //大小
        $size = $this->getCanvasSize();
        //背景颜色
        $backgroundColor = $this->getCanvasColor();
        //生成一个画布
        $this->canvas = $this->manager->canvas($size,$size,$backgroundColor);
    }

    /**
     * @return int
     * 群头像的大小
     */
    public function getCanvasSize()
    {
        return 200;
    }

    /**
     * @return string
     * 群头像的背景颜色
     */
    public function getCanvasColor()
    {
        return '#BFE4EC';
    }

    /**
     * @param $width
     * @param int $height
     * 对生成的200 x 200的群头像重新设定大小
     */
    public function resize($width,$height)
    {
        $this->canvas->fit($width,$height);
    }

    /**
     * @return array
     * 保存生成的群头像到硬盘
     */
    public function getCanvas()
    {
        //随机名称
        $name = uniqid().'.jpeg';

        $data = [
            //本地的绝对路径
            'realPath' => realpath('./results').'/'.$name,
            //网络路径
            'webPath' => $this->getDomain().'/'.$this->getUri($name),
        ];

        $this->canvas->save($data['realPath']);

        return $this->arrayReturn(1,'ok',$data);
    }

    /**
     * @return string
     * 获取站点的域名
     */
    public function getDomain()
    {
        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';

        return $http_type.$_SERVER['SERVER_NAME'];
    }

    /**
     * @param $name
     * @return string
     * 返回群头像在站点的uri
     */
    public function getUri($name)
    {
        return '/results/'.$name;
    }

    /**
     * @param int $code
     * @param string $msg
     * @param string $data
     * 标准json返回
     */
    public function jsonReturn($code=1,$msg='ok',$data='')
    {
        $return = json_encode(['code'=>$code,'msg'=>$msg,'data'=>$data]);
        header('Content-type: application/json');
        echo $return;
        exit;
    }

    /**
     * @param int $code
     * @param string $msg
     * @param string $data
     * @return array
     * 标准数组返回
     */
    public function arrayReturn($code=1,$msg='ok',$data='')
    {
        return ['code'=>$code,'msg'=>$msg,'data'=>$data];
    }
}
