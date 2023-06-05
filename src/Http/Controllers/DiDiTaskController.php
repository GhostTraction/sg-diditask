<?php

namespace DiDiTask\Seat\SeatDiDiTask\Http\Controllers;

use DiDiTask\Seat\SeatDiDiTask\Models\TasksList;
use Seat\Web\Http\Controllers\Controller;

class DiDiTaskController extends Controller
{
    /**
     * 三方post请求
     */
    function sendPostRequest($interface, $data)
    {
        $url = 'http://wx.eve-sg.com/' . $interface . "?API_AuthKey=AgLERU00O9QkovxS"; // 替换为实际的目标地址

        // 将数据转换为 JSON
        $jsonData = json_encode($data);

        // 设置请求头
        $headers = array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        );

        // 初始化 cURL
        $ch = curl_init();

        // 设置 cURL 选项
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // 执行请求并获取响应
        $response = curl_exec($ch);

        // 检查是否有错误发生
        if (curl_errno($ch)) {
            $error = curl_error($ch);
            echo "cURL Error: " . $error;
        }

        // 关闭 cURL 资源
        curl_close($ch);

        // 返回响应结果
        return $response;
    }

    /**
     * 发布得任务列表
     */
    public function publishTask()
    {
        $myTasksList = TasksList::where('sender_user_id', '=', auth()->user()->id)
            ->orderby('send_time', 'desc')
            ->get();
        return view('diditask::publishTask')->with('myTasksList', $myTasksList);

    }

    /**
     * 接受的任务列表
     * @return mixed
     */
    public function acceptTask()
    {
        $myTasksList = TasksList::where('receiver_user_id', '=', auth()->user()->id)
            ->orderby('send_time', 'desc')
            ->get();
        return view('diditask::acceptTask')->with('myTasksList', $myTasksList);
    }

    /**
     * 任务状态修改
     * @param $id
     * @param $action
     * @return false|string
     */
    public function changeStatus($id, $action)
    {
        $tempData = array();
        $tempData['user_id'] = auth()->user()->id;
        $tempData['task_id'] = $id;
        switch ($action) {
            case 'Delete':
                //删除
                return sendPostRequest("SeatAPI/DeleteTask", $tempData);

            case 'Success':
                //接受任务
                return sendPostRequest("SeatAPI/CompleteTask", $tempData);

            case 'Abandon':
                //放弃任务
                return sendPostRequest("SeatAPI/GiveUpTask", $tempData);

        }
    }


}
