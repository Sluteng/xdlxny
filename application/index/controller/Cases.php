<?php
namespace app\index\controller;

use think\Controller;
use think\Loader;

class Cases extends Controller
{
    public function cases()
    {
         require_once('Base.php');
         $caseResult=$navberModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'id'=>5
             ])->limit(1)->select();
         $casesModel=Loader::model('Cases');
         $casesResult=$casesModel->where([
                 'isdelete'=>0,
                 'status'=>1
             ])->order('sort','desc')->paginate(9,false,[
                                      'path'=>'/cases1/[PAGE].html',
                                      'page' => input('param.p'),
                                     ]);
         $page = $casesResult->render();
         $casesResult1=$casesModel->where([
                 'isdelete'=>0,
                 'status'=>1
             ])->select();
        // return json($casesResult);
        $news= i_array_column($casesResult1,'name','id');
         $news= str_replace(' ', '-', $news);
         $arrhome1= str_replace('?', '_', $news);
        return $this->view->fetch('',[
            'caseResult'=>$caseResult,
        	'casesResult'=>$casesResult,
            'page'=>$page,
            'arrhome1'=>$arrhome1,
               ]);
    }
     public function casea($id)
    {
         require_once('Base.php');
         $news= str_replace('-', ' ', $id);
         $id= str_replace('_', '?', $news);
         $caseResult=$navberModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'id'=>5
             ])->limit(1)->select();
         $casesModel=Loader::model('Cases');
         $casesResult=$casesModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'name'=>$id
             ])->limit(1)->select();
         $news= i_array_column($casesResult,'name','id');
         $news= str_replace(' ', '-', $news);
         $arrhome1= str_replace('?', '_', $news);
         $arr2=i_array_column($casesResult,'num');
         $num=reset($arr2);
         $numResult=$casesModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'name'=>$id
             ])->update(['num' => $num+1]);
         //下一页
         $prev=$casesModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'name' => ['<',$id]
             ])->order('id','desc')->limit(1)->select();
         $news= i_array_column($prev,'name','id');
         $news= str_replace(' ', '-', $news);
         $arrhome2= str_replace('?', '_', $news);
         //上一页
         $next=$casesModel->where([
             'isdelete'=>0,
             'status'=>1,
             'name' => ['>',$id]
             ])->order('id','asc')->limit(1)->select();
         $news= i_array_column($next,'name','id');
         $news= str_replace(' ', '-', $news);
         $arrhome3= str_replace('?', '_', $news);
        // return json($casesResult);
        return $this->view->fetch('',[
            'caseResult'=>$caseResult,
        	'casesResult'=>$casesResult,
        	'prev'=>$prev,
        	'next'=>$next,
            'arrhome1'=>$arrhome1,
            'arrhome2'=>$arrhome2,
            'arrhome3'=>$arrhome3,
               ]);
    }
}
