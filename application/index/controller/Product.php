<?php
namespace app\index\controller;

use think\Controller;
use think\Loader;

class Product extends Controller
{
    public function product()
    {
         require_once('Base.php');
         $proResult=$navberModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'id'=>3
             ])->limit(1)->select();
         $mainModel=Loader::model('Main');
         $mainResult=$mainModel->where([
                 'isdelete'=>0,
                 'status'=>1
             ])->order('sort','asc')->select();
         $news= i_array_column($mainResult,'name','id');
         $news= str_replace(' ', '-', $news);
         $news= str_replace('/', '--', $news);
         $arrhome8= str_replace('?', '_', $news);
         $productModel=Loader::model('Product');
         $productResult=$productModel->where([
                 'isdelete'=>0,
                 'status'=>1
             ])->order('sort','asc')->paginate(6,false,[
                                      'path'=>'/product1/[PAGE].html',
                                      'page' => input('param.p'),
                                     ]);
         $page = $productResult->render();
         $productResult10=$productModel->where([
                 'isdelete'=>0,
                 'status'=>1
             ])->select();
         $news= i_array_column($productResult10,'name','id');
         $news= str_replace(' ', '-', $news);
         $news= str_replace('/', '--', $news);
         $arrhome10= str_replace('?', '_', $news);
        // return json($productResult);
        return $this->view->fetch('',[
            'proResult'=>$proResult,
            'mainResult'=>$mainResult,
            'productResult'=>$productResult,
            'page'=>$page,
            'arrhome8'=>$arrhome8,
            'arrhome10'=>$arrhome10,
               ]);
    }
     public function battery($id)
    {
         require_once('Base.php');
         $news= str_replace('--', '/', $id);
         $news= str_replace('-', ' ', $news);
         $id= str_replace('_', '?', $news);
         $newsModel=Loader::model('News');
         $proResult=$navberModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'id'=>3
             ])->limit(1)->select();
         $mainModel=Loader::model('Main');
         $mainResult=$mainModel->where([
                 'isdelete'=>0,
                 'status'=>1
             ])->order('sort','asc')->select();
        $news= i_array_column($mainResult,'name','id');
         $news= str_replace(' ', '-', $news);
         $news= str_replace('/', '--', $news);
         $arrhome8= str_replace('?', '_', $news);
         $titleResult=$mainModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'name'=>$id
             ])->limit(1)->select();
         // return json($titleResult);
         $arr1=i_array_column($titleResult,'name');
         $main1=reset($arr1);
         $viceModel=Loader::model('Vice');
         $viceResult=$viceModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'titles'=>$main1
             ])->order('sort','asc')->select();
        $news= i_array_column($viceResult,'name','id');
         $news= str_replace(' ', '-', $news);
         $news= str_replace('/', '--', $news);
         $arrhome9= str_replace('?', '_', $news);
         $vice1Result=$viceModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'titles'=>$main1
             ])->order('sort','asc')->limit(1)->select();
         $arr2=i_array_column($vice1Result,'name');
         $vice1=reset($arr2);
         $productModel=Loader::model('Product');
         $productResult=$productModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'titles'=>$vice1
             ])->order('sort','asc')->paginate(6,false,[
                                      'path'=>'/batt/'.$id.'/[PAGE].html',
                                      'page' => input('param.p'),
                                     ]);
         $page = $productResult->render();
         $productResult10=$productModel->where([
                 'isdelete'=>0,
                 'status'=>1
             ])->select();
        $news= i_array_column($productResult10,'name','id');
         $news= str_replace(' ', '-', $news);
         $news= str_replace('/', '--', $news);
         $arrhome10= str_replace('?', '_', $news);
        return $this->view->fetch('',[
            'proResult'=>$proResult,
            'mainResult'=>$mainResult,
            'titleResult'=>$titleResult,
            'productResult'=>$productResult,
            'page'=>$page,
            'main1'=>$main1,
            'viceResult'=>$viceResult,
            'vice1'=>$vice1,
            'arrhome8'=>$arrhome8,
            'arrhome9'=>$arrhome9,
            'arrhome10'=>$arrhome10,
               ]);
    }
    public function battery1($id)
    {
         require_once('Base.php');
         $news= str_replace('--', '/', $id);
         $news= str_replace('-', ' ', $news);
         $id= str_replace('_', '?', $news);
         $newsModel=Loader::model('News');
         $proResult=$navberModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'id'=>3
             ])->limit(1)->select();
         $mainModel=Loader::model('Main');
         $mainResult=$mainModel->where([
                 'isdelete'=>0,
                 'status'=>1
             ])->order('sort','asc')->select();
        $news= i_array_column($mainResult,'name','id');
         $news= str_replace(' ', '-', $news);
         $news= str_replace('/', '--', $news);
         $arrhome8= str_replace('?', '_', $news);
         $viceModel=Loader::model('Vice');
         $vice1Result=$viceModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'name'=>$id
             ])->order('sort','asc')->select();
         // return json($vice1Result);
         $arr1=i_array_column($vice1Result,'titles');
         $main1=reset($arr1);

         $arr2=i_array_column($vice1Result,'name');
         $vice1=reset($arr2);
         $viceResult=$viceModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'titles'=>$main1
             ])->order('sort','asc')->select();
        $news= i_array_column($viceResult,'name','id');
         $news= str_replace(' ', '-', $news);
         $news= str_replace('/', '--', $news);
         $arrhome9= str_replace('?', '_', $news);
         $titleResult=$viceModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'name'=>$id
             ])->limit(1)->select();
         $productModel=Loader::model('Product');
         $productResult=$productModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'titles'=>$vice1
             ])->order('sort','asc')->paginate(6,false,[
                                      'path'=>'/tery/'.$id.'/[PAGE].html',
                                      'page' => input('param.p'),
                                     ]);
         $page = $productResult->render();
         $productResult10=$productModel->where([
                 'isdelete'=>0,
                 'status'=>1
             ])->select();
        $news= i_array_column($productResult10,'name','id');
         $news= str_replace(' ', '-', $news);
         $news= str_replace('/', '--', $news);
         $arrhome10= str_replace('?', '_', $news);
        return $this->view->fetch('battery',[
            'proResult'=>$proResult,
            'mainResult'=>$mainResult,
            'productResult'=>$productResult,
            'page'=>$page,
            'main1'=>$main1,
            'viceResult'=>$viceResult,
            'titleResult'=>$titleResult,
            'vice1'=>$vice1,
            'arrhome8'=>$arrhome8,
            'arrhome9'=>$arrhome9,
            'arrhome10'=>$arrhome10,
               ]);
    }
    public function product2($id)  
    {
         require_once('Base.php');
         $news= str_replace('--', '/', $id);
         $news= str_replace('-', ' ', $news);
         $id= str_replace('_', '?', $news);
         $newsModel=Loader::model('News');
         $proResult=$navberModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'id'=>3
             ])->limit(1)->select();
         $productModel=Loader::model('Product');
         $productResult=$productModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'name'=>$id
             ])->select();
         $news= i_array_column($productResult,'name','id');
         $news= str_replace(' ', '-', $news);
         $news= str_replace('/', '--', $news);
         $arrhome10= str_replace('?', '_', $news);
         $arr1=i_array_column($productResult,'titles');
         $titles=reset($arr1);
         $arrd= i_array_column($productResult,'id');
         $tid=reset($arrd);
         $prev=$productModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'titles'=>$titles,
                 'id' => ['<',$tid]
             ])->order('id','desc')->limit(1)->select();
         $news= i_array_column($prev,'name','id');
         $news= str_replace(' ', '-', $news);
         $news= str_replace('/', '--', $news);
         $arrhome11= str_replace('?', '_', $news);
         // return json($prev);
         //ÏÂÒ»Ò³
         $next=$productModel->where([
             'isdelete'=>0,
             'status'=>1,
             'titles'=>$titles,
             'id' => ['>',$tid]
             ])->order('id','asc')->limit(1)->select();
         $news= i_array_column($next,'name','id');
         $news= str_replace(' ', '-', $news);
         $news= str_replace('/', '--', $news);
         $arrhome12= str_replace('?', '_', $news);

         $viceModel=Loader::model('Vice');
         $viceResult=$viceModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'name'=>$titles,
             ])->limit(1)->select();
        $news= i_array_column($viceResult,'name','id');
         $news= str_replace(' ', '-', $news);
         $news= str_replace('/', '--', $news);
         $arrhome9= str_replace('?', '_', $news);
        $arr1=i_array_column($viceResult,'titles');
        $main=reset($arr1);
        $mainModel=Loader::model('Main');
        $mainResult=$mainModel->where([
                'isdelete'=>0,
                'status'=>1,
                'name'=>$main
            ])->limit(1)->select();
         $news= i_array_column($mainResult,'name','id');
         $news= str_replace(' ', '-', $news);
         $news= str_replace('/', '--', $news);
         $arrhome8= str_replace('?', '_', $news);
        return $this->view->fetch('',[
            'proResult'=>$proResult,
            'productResult'=>$productResult,
            'prev'=>$prev,
            'next'=>$next,
            'mainResult'=>$mainResult,
            'main'=>$main,
            'arrhome8'=>$arrhome8,
            'arrhome9'=>$arrhome9,
            'arrhome10'=>$arrhome10,
            'arrhome11'=>$arrhome11,
            'arrhome12'=>$arrhome12,
               ]);
    }

     public function search()
    {
        $title=request()->param();
        $name=urldecode($title['name']);
        // return json($titles);
         require_once('Base.php');
         $news= str_replace('--', '/', $name);
         $news= str_replace('-', ' ', $news);
         $id= str_replace('_', '?', $news);
         $newsModel=Loader::model('News');
         $proResult=$navberModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'id'=>3
             ])->limit(1)->select();
         $mainModel=Loader::model('Main');  
         $mainResult=$mainModel->where([
                 'isdelete'=>0,
                 'status'=>1
             ])->order('sort','asc')->select();
        $news= i_array_column($mainResult,'name','id');
         $news= str_replace(' ', '-', $news);
         $news= str_replace('/', '--', $news);
         $arrhome8= str_replace('?', '_', $news);
         $titleResult=$mainModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'name'=>['like', "%".$name."%"]
             ])->limit(1)->select();
 
            $viceModel=Loader::model('Vice');
            $vice2Result=$viceModel->where([
                    'isdelete'=>0,
                    'status'=>1,
                    'name'=>['like', "%".$name."%"]
                ])->order('sort','asc')->select();
            $arr1=i_array_column($vice2Result,'titles');
            $main1=reset($arr1);
            $viceResult=$viceModel->where([
                    'isdelete'=>0,
                    'status'=>1,
                    'name'=>['like', "%".$name."%"]
                ])->order('sort','asc')->select();
        $news= i_array_column($viceResult,'name','id');
         $news= str_replace(' ', '-', $news);
         $news= str_replace('/', '--', $news);
         $arrhome9= str_replace('?', '_', $news);
            $vice1Result=$viceModel->where([
                    'isdelete'=>0,
                    'status'=>1,    
                    'name'=>['like', "%".$name."%"]
                ])->order('sort','asc')->limit(1)->select();
            $arr2=i_array_column($vice1Result,'name');     
            $vice1=reset($arr2);
    if($titleResult!=null || $viceResult!=null){
         $arr1=i_array_column($titleResult,'id');
         $id=reset($arr1);
         $arr2=i_array_column($vice1Result,'name');     
         $vice1=reset($arr2);
         $productModel=Loader::model('Product');
         $productResult=$productModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'titles'=>$vice1
             ])->order('sort','asc')->paginate(6,false,[
                                      'path'=>'/batt/'.$id.'/[PAGE].html',
                                      'page' => input('param.p'),
                                     ]);
        $page = $productResult->render();
         $productResult10=$productModel->where([
                 'isdelete'=>0,
                 'status'=>1
             ])->select();
        $news= i_array_column($productResult10,'name','id');
         $news= str_replace(' ', '-', $news);
         $news= str_replace('/', '--', $news);
         $arrhome10= str_replace('?', '_', $news);
        return $this->view->fetch('battery',[
            'proResult'=>$proResult,
            'mainResult'=>$mainResult,
            'titleResult'=>$titleResult,
            'productResult'=>$productResult,
            'page'=>$page,
            'main1'=>$main1,
            'viceResult'=>$viceResult,
            'vice1'=>$vice1,
            'arrhome8'=>$arrhome8,
            'arrhome9'=>$arrhome9,
            'arrhome10'=>$arrhome10,
               ]);
    }else if($titleResult==null && $viceResult==null){
             $productModel=Loader::model('Product');
             $productResult=$productModel->where([
                     'isdelete'=>0,
                     'status'=>1,
                     'name'=>['like', "%".$name."%"]
                 ])->limit(1)->select();
        $news= i_array_column($productResult,'name','id');
         $news= str_replace(' ', '-', $news);
         $news= str_replace('/', '--', $news);
         $arrhome10= str_replace('?', '_', $news);
             $arr1=i_array_column($productResult,'titles');
             $titles=reset($arr1);
             $arr2=i_array_column($productResult,'id');
             $id=reset($arr2);
             $prev=$productModel->where([
                     'isdelete'=>0,
                     'status'=>1,
                     'titles'=>$titles,
                     'id' => ['<',$id]
                 ])->order('id','desc')->limit(1)->select();
        $news= i_array_column($prev,'name','id');
         $news= str_replace(' ', '-', $news);
         $news= str_replace('/', '--', $news);
         $arrhome11= str_replace('?', '_', $news);
             // return json($prev);
             //ÏÂÒ»Ò³
             $next=$productModel->where([
                 'isdelete'=>0,
                 'status'=>1,
                 'titles'=>$titles,
                 'id' => ['>',$id]
                 ])->order('id','asc')->limit(1)->select();
        $news= i_array_column($next,'name','id');
         $news= str_replace(' ', '-', $news);
         $news= str_replace('/', '--', $news);
         $arrhome12= str_replace('?', '_', $news);

             $viceModel=Loader::model('Vice');
             $viceResult=$viceModel->where([
                     'isdelete'=>0,
                     'status'=>1,
                     'name'=>$titles,
                 ])->limit(1)->select();
        $news= i_array_column($viceResult,'name','id');
         $news= str_replace(' ', '-', $news);
         $news= str_replace('/', '--', $news);
         $arrhome9= str_replace('?', '_', $news);
            $arr1=i_array_column($viceResult,'titles');
            $main=reset($arr1);
            $mainModel=Loader::model('Main');
            $mainResult=$mainModel->where([
                    'isdelete'=>0,
                    'status'=>1,
                    'name'=>$main
                ])->limit(1)->select();
        $news= i_array_column($mainResult,'name','id');
         $news= str_replace(' ', '-', $news);
         $news= str_replace('/', '--', $news);
         $arrhome8= str_replace('?', '_', $news);
            if($productResult==null){
               echo "<script>alert('暂无相关产品!');location.href='/index.html';</script>";
            }
            return $this->view->fetch('product2',[
                'proResult'=>$proResult,
                'productResult'=>$productResult,
                'prev'=>$prev,
                'next'=>$next,
                'mainResult'=>$mainResult,
                'main'=>$main,
            'arrhome8'=>$arrhome8,
            'arrhome9'=>$arrhome9,
            'arrhome10'=>$arrhome10,
            'arrhome11'=>$arrhome11,
            'arrhome12'=>$arrhome12,
                   ]);
        }
    }
}
