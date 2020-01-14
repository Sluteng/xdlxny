<?php
namespace app\index\controller;

use think\Controller;
use think\Loader;
use baidu;

class Index extends controller
{
    public function index()
    {
    require_once('Base.php');
    $bannerModel=Loader::model('Banner');
    $bannerResult=$bannerModel->where([
            'isdelete'=>0,
            'status'=>1
        ])->order('sort=0 asc,sort asc,id asc')->select();
    $mainModel=Loader::model('Main');
    $mainResult=$mainModel->where([
            'isdelete'=>0,
            'status'=>1,
            'home'=>1
        ])->order('sort=0 asc,sort asc,id asc')->select();
        $news= i_array_column($mainResult,'name','id');
         $news= str_replace(' ', '-', $news);
         $news= str_replace('/', '--', $news);
         $arrhome8= str_replace('?', '_', $news);
    $viceModel=Loader::model('Vice');
    $viceResult=$viceModel->where([
            'isdelete'=>0,
            'status'=>1,
            'home'=>1
        ])->order('sort=0 asc,sort asc,id asc')->select();
        $news= i_array_column($viceResult,'name','id');
         $news= str_replace(' ', '-', $news);
         $news= str_replace('/', '--', $news);
         $arrhome9= str_replace('?', '_', $news);
    $productModel=Loader::model('Product');
    $productResult=$productModel->where([
                    'isdelete'=>0,
                    'status'=>1,
                    'home'=>1
                ])->limit(6)->order('sort=0 asc,sort asc,id desc')->select();
        $news= i_array_column($productResult,'name','id');
         $news= str_replace(' ', '-', $news);
         $news= str_replace('/', '--', $news);
         $arrhome10= str_replace('?', '_', $news);
    $casesModel=Loader::model('Cases');
    $casesResult=$casesModel->where([
                    'isdelete'=>0,
                    'status'=>1,
                    'home'=>1
                ])->limit(3)->order('sort=0 asc,sort asc,id desc')->select();
        $news= i_array_column($casesResult,'name','id');
        $news= str_replace(' ', '-', $news);
        $arrhome1= str_replace('?', '_', $news);
    $weModel=Loader::model('We');
    $weResult=$weModel->where([
                    'isdelete'=>0,
                    'status'=>1,
                ])->limit(1)->select();
    // return json($weResult);
    $majorModel=Loader::model('Major');
    $majorResult=$majorModel->where([
                    'isdelete'=>0,
                    'status'=>1,
                ])->limit(3)->order('id asc')->select();
    $newsaModel=Loader::model('Newsa');
    $newsaResult=$newsaModel->where([
            'isdelete'=>0,
            'status'=>1,
            'home'=>1
        ])->limit(6)->order('sort=0 asc,sort asc,id desc')->select();
        $news= i_array_column($newsaResult,'name','id');
         $news= str_replace(' ', '-', $news);
         $arrhome5= str_replace('?', '_', $news);
    // $bannerModel=Loader::model('Banner');
    // $bannerResult=$bannerModel->where([
    //         'isdelete'=>0,
    //         'status'=>1
    //     ])->order('sort','asc')->select();
    $messResult=$navberModel->where([
            'isdelete'=>0,
            'status'=>1,
            'id'=>6
        ])->limit(1)->select();
    if (request()->isPost()){
     $data = input('post.');
     $validate = validate('Message');
     if (!$validate->batch()->check($data)) {
       $error = $validate->getError();
       $captcha=reset($error);
       return $this->view->fetch('',[
          'messResult'=>$messResult,
          'captcha'=>$captcha,
              ]);
       $this->error(implode(',',$error));
     }else{
      $center = model('Message');
      $center->data($data,true);
      $result = $center->allowField(true)->save();
      if ($result) {
      $captcha="true";
      return $this->view->fetch('',[
         'messResult'=>$messResult,
         'captcha'=>$captcha,
             ]);
      } else {
       $this->redirect('/index.html');
       }
     }
  }
    $captcha="";
    return $this->view->fetch('',[
      'bannerResult'=>$bannerResult,
      'mainResult'=>$mainResult,
      'viceResult'=>$viceResult,
      'productResult'=>$productResult,
      'casesResult'=>$casesResult,
      'weResult'=>$weResult,
      'majorResult'=>$majorResult,
      'newsaResult'=>$newsaResult,
      'arrhome8'=>$arrhome8,
      'arrhome9'=>$arrhome9,
      'arrhome10'=>$arrhome10,
      'arrhome1'=>$arrhome1,
      'arrhome5'=>$arrhome5,
      'messResult'=>$messResult,
      'captcha'=>$captcha,
           ]);
    }
}