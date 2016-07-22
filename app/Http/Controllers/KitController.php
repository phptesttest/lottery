<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

//引用对应的命名空间
use Gregwar\Captcha\CaptchaBuilder;
use Session;

class KitController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function captcha($tmp)
    {
             //生成验证码图片的Builder对象，配置相应属性
        //$builder = new CaptchaBuilder;
        //获取验证码的内容
        //$phrase = $builder->getPhrase();
        //把内容存入session
        //Session::flash('milkcaptcha', $phrase);
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        ob_clean();
        flush();
        //$builder->create()->build($width=100, $height=40, $font="captcha1.ttf")->output();
        CaptchaBuilder::create()
            ->build()
            ->output();
    }

    public function check()
    {
        $code = Session::get("milkcaptcha");
        dump($code);
        $key = \Input::get("key");
        dump($key);
        if ($code == $key) {
            //用户输入验证码正确
            dump("success");
        } else {
            //用户输入验证码错误
            dump("error");
        }

    }

}