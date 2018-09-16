<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class IndexController extends Controller
{
    /**
     * 获取评论列表
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getList(Request $request)
    {   
        $res = DB::select("select * from comments where post_url = ? order by create_time desc", [$request->url]);
        if ($res) {
            $res = json_decode(json_encode($res), true);

            $dataList = $stack = array();

            foreach ($res as $k => $v) {
                if ($v['parent_id'] == 0) {
                    $v['level'] = 0;   //设置层级数
                    // $v['_root'] = $v['id'];   //标识评论id
                    array_push($stack,$v);   //入栈
                    unset($res[$k]);
                }
            }

            while(!empty($stack)){
                $node = array_pop($stack);   //出栈
                $dataList[] = $node;
                foreach($res as $k => $v){
                    if($v['parent_id'] == $node['id']){
                        $v['level'] = $node['level']+1;   //设置层级数
                        // $v['_root'] = $node['_root'];   //标识评论id
                        array_push($stack,$v);   //入栈
                        unset($res[$k ]) ;
                    }
                }
            }
            
            return json_encode($dataList);
        } else {
            return 'null';
        }
        
    }

    /**
     * 新增评论
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addComment(Request $request)
    {   
        $params = $request->all();
        $date = date('Y-m-d H:i', time());

        $res = DB::insert('insert into comments (post_url, nickname, content, create_time, parent_id) values (?, ?, ?, ?, ?)', [$params['post_url'], $params['nickname'], $params['content'], "$date", $params['parent_id']]);

        if ($res) {
            return 'success';
        } else {
            return 'error';
        }
    }

}
