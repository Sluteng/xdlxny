<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;
use think\Db;
use think\Loader;
use think\exception\HttpException;
use think\Config;


class Infor extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];
    /**
     * 编辑
     * @return mixed
     */
    public function edit()
    {
        $controller = $this->request->controller();

        if ($this->request->isAjax()) {
            // 更新
            $data = $this->request->post();
            if (!$data['id']) {
                return ajax_return_adv_error("缺少参数ID");
            }

            // 验证
            if (class_exists($validateClass = Loader::parseClass(Config::get('app.validate_path'), 'validate', $controller))) {
                $validate = new $validateClass();
                if (!$validate->check($data)) {
                    return ajax_return_adv_error($validate->getError());
                }
            }
            $imgModel=Loader::model($controller);
            $list=$imgModel->where([
            'id'=>$data['id'],
            ])->select();
            $arr1=i_array_column($list,'logo');
            $logo=reset($arr1);
            $file1= file_exists(ROOT_PATH . "$logo");//判断文件是否存在
            $arr2=i_array_column($list,'wechat');
            $wechat=reset($arr2);
            $file2= file_exists(ROOT_PATH . "$wechat");//判断文件是否存在
            if ($data['logo']!=$logo && $data['logo']!=null && $file1!=false ) {
              unlink( ROOT_PATH . "$logo");
              }
            if ($data['wechat']!=$wechat && $data['wechat']!=null && $file2!=false) {
              unlink( ROOT_PATH . "$wechat");
              }
            // 更新数据
            if (
                class_exists($modelClass = Loader::parseClass(Config::get('app.model_path'), 'model', $this->parseCamelCase($controller)))
                || class_exists($modelClass = Loader::parseClass(Config::get('app.model_path'), 'model', $controller))
            ) {
                // 使用模型更新，可以在模型中定义更高级的操作
                $model = new $modelClass();
                $ret = $model->isUpdate(true)->save($data, ['id' => $data['id']]);
            } else {
                // 简单的直接使用db更新
                Db::startTrans();
                try {
                    $model = Db::name($this->parseTable($controller));
                    $ret = $model->where('id', $data['id'])->update($data);
                    // 提交事务
                    Db::commit();
                } catch (\Exception $e) {
                    // 回滚事务
                    Db::rollback();

                    return ajax_return_adv_error($e->getMessage());
                }
            }

            return ajax_return_adv("编辑成功");
        } else {
            // 编辑
            $id = $this->request->param('id');
            if (!$id) {
                throw new HttpException(404, "缺少参数ID");
            }
            $vo = $this->getModel($controller)->find($id);
            if (!$vo) {
                throw new HttpException(404, '该记录不存在');
            }

            $this->view->assign("vo", $vo);

            return $this->view->fetch();
        }
    }
    
}
