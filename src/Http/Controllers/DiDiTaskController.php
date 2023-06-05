<?php

namespace DiDiTask\Seat\SeatDiDiTask\Http\Controllers;

use DiDiTask\Seat\SeatDiDiTask\Models\TasksList;
use DiDiTask\Seat\SeatDiDiTask\Validation\AcceptTaskValidation;
use Seat\Web\Http\Controllers\Controller;

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

class DiDiTaskController extends Controller
{

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
        switch ($action) {
            case 'Delete':
                $tempData['task_id'] = intval($id);
                //删除任务
                return json_encode(sendPostRequest("SeatAPI/DeleteTask", $tempData));

            case 'Success':
                $tempData['task_id'] = intval($id);
                //接受任务
                return json_encode(sendPostRequest("SeatAPI/CompleteTask", $tempData));

            case 'Abandon':
                $tempData['task_id'] = intval($id);
                //放弃任务
                return json_encode(sendPostRequest("SeatAPI/GiveUpTask", $tempData));
        }
    }


    /**
     * 批量接受任务
     * @param AcceptTaskValidation $request
     * @return mixed
     */
    public function getMission(AcceptTaskValidation $request)
    {
        $missionList = $request->input('missionList');
        $tempData = array();
        $tempData['user_id'] = auth()->user()->id;
        $tempData['text'] = $missionList;
        $responseData = sendPostRequest("SeatAPI/AcceptTask", $tempData);
        return redirect()->back()
            ->with('success', $responseData);


    }

    /**
     * 发布任务
     * @param AcceptTaskValidation $request
     * @return mixed
     */
    public function submitMission (AcceptTaskValidation $request)
    {
        $missionName = $request->input('missionName');
        $missionScore = $request->input('missionScore');
        $tempData = array();
        $tempData['user_id'] = auth()->user()->id;
        $tempData['taskName'] = $missionName;
        $tempData['taskReward'] = $missionScore;
        $responseData = sendPostRequest("SeatAPI/CreateTask", $tempData);
        return redirect()->back()
            ->with('success', $responseData);


    }


}
