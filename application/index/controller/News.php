<?php
namespace app\index\controller;

use think\Controller;
use think\Loader;

class News extends Controller
{
    public function news()
    {
         require_once('Base.php');
         $newResult=$navberModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'id'=>4
             ])->limit(1)->select();
         // return json($newResult);
         $newsModel=Loader::model('News');
         $newsResult=$newsModel->where([
                 'isdelete'=>0,
                 'status'=>1
             ])->order('sort=0 asc,sort asc,id asc')->select();
        $news= i_array_column($newsResult,'name','id');
         $news= str_replace(' ', '-', $news);
         $arrhome4= str_replace('?', '_', $news);
        $newsaModel=Loader::model('Newsa');
        $newsaResult=$newsaModel->where([
                'isdelete'=>0,
                'status'=>1
            ])->order('sort=0 asc,sort asc,id desc')->paginate(5,false,[
                                      'path'=>'/news1/[PAGE].html',
                                      'page' => input('param.p'),
                                     ]);
        $page = $newsaResult->render();
        $name = null;
        $newsaResult5=$newsaModel->where([
                'isdelete'=>0,
                'status'=>1,
            ])->select();
        $news= i_array_column($newsaResult5,'name','id');
         $news= str_replace(' ', '-', $news);
         $arrhome5= str_replace('?', '_', $news);
        return $this->view->fetch('',[
        	'newResult'=>$newResult,
        	'newsResult'=>$newsResult,
        	'newsaResult'=>$newsaResult,
        	'page'=>$page,
            'name'=>$name,
            'arrhome4'=>$arrhome4,
        	'arrhome5'=>$arrhome5,
               ]);
    }
      public function newsa($id)
    {
         require_once('Base.php');
         $news= str_replace('-', ' ', $id);
         $id= str_replace('_', '?', $news);
         $newsModel=Loader::model('News');
         $newsResult=$newsModel->where([
                 'isdelete'=>0,
                 'status'=>1
             ])->order('sort=0 asc,sort asc,id asc')->select();
        $news= i_array_column($newsResult,'name','id');
         $news= str_replace(' ', '-', $news);
         $arrhome4= str_replace('?', '_', $news);
        $newResult=$newsModel->where([
                'isdelete'=>0,
                'status'=>1,
                'name'=>$id
            ])->limit(1)->select();
        $arr1=i_array_column($newResult,'name');
        $name=reset($arr1);
        // return json($name);
        $newsaModel=Loader::model('Newsa');
        $newsaResult=$newsaModel->where([
                'isdelete'=>0,
                'status'=>1,
                'titles'=>$name
            ])->order('sort=0 asc,sort asc,id desc')->paginate(5,false,[
                                      'path'=>'/newsa1/'.$id.'/[PAGE].html',
                                      'page' => input('param.p'),
                                     ]);
           // return json($newsaResult);
        $page = $newsaResult->render();
        $newsaResult=$newsaModel->where([
                'isdelete'=>0,
                'status'=>1,
                'titles'=>$name
            ])->select();
        $news= i_array_column($newsaResult,'name','id');
         $news= str_replace(' ', '-', $news);
         $arrhome5= str_replace('?', '_', $news);
        return $this->view->fetch('news',[
        	'newResult'=>$newResult,
        	'newsResult'=>$newsResult,
        	'newsaResult'=>$newsaResult,
        	'page'=>$page,
            'name'=>$name,
            'arrhome4'=>$arrhome4,
        	'arrhome5'=>$arrhome5,
               ]);
    }
      public function newsc($id)
    {
         require_once('Base.php');

        $news= str_replace('-', ' ', $id);
        $id= str_replace('_', '?', $news);
        $newsaModel=Loader::model('Newsa');
        $newsaResult=$newsaModel->where([
                'isdelete'=>0,
                'status'=>1,
                'name'=>$id
            ])->limit(1)->select();
        $news= i_array_column($newsaResult,'name','id');
        $news= str_replace(' ', '-', $news);
        $arrhome5= str_replace('?', '_', $news);
        $arr1=i_array_column($newsaResult,'titles');
        $titles=reset($arr1);
        $arr2=i_array_column($newsaResult,'num');
        $num=reset($arr2);
        $numResult=$newsaModel->where([
                'isdelete'=>0,
                'status'=>1,
                'name'=>$id
            ])->update(['num' => $num+1]);
        $arrd= i_array_column($newsaResult,'id');
        $tid=reset($arrd);
        // return json($newsaResult);
        //上一页
        $prev=$newsaModel->where([
                'isdelete'=>0,
                'status'=>1,
                'titles'=>$titles,
                'id' => ['<',$tid]
            ])->order('id','desc')->limit(1)->select();
        $news= i_array_column($prev,'name','id');
         $news= str_replace(' ', '-', $news);
         $arrhome6= str_replace('?', '_', $news);
        //下一页
        $next=$newsaModel->where([
            'isdelete'=>0,
            'status'=>1,
            'titles'=>$titles,
            'id' => ['>',$tid]
            ])->order('id','asc')->limit(1)->select();
         $news= i_array_column($next,'name','id');
         $news= str_replace(' ', '-', $news);
         $arrhome7= str_replace('?', '_', $news);
          // return json($next);

         $newResult=$navberModel->where([
                'isdelete'=>0,
                'status'=>1,
                'id'=>4
            ])->limit(1)->select();
          $newsModel=Loader::model('News');
          $newsResult=$newsModel->where([
                  'isdelete'=>0,
                  'status'=>1,
                  'name'=>$titles,
              ])->limit(1)->select();
        // return json($newsResult);
        return $this->view->fetch('',[
            'newResult'=>$newResult,
            'newsResult'=>$newsResult,
        	'newsaResult'=>$newsaResult,
        	'prev'=>$prev,
            'next'=>$next,
            'arrhome5'=>$arrhome5,
            'arrhome6'=>$arrhome6,
        	'arrhome7'=>$arrhome7,
               ]);
    }
}
