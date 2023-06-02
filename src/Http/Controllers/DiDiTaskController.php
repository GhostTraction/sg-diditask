<?php

namespace DiDiTask\Seat\SeatDiDiTask\Http\Controllers;

use DiDiTask\Seat\SeatDiDiTask\Models\DkpInfo;
use DiDiTask\Seat\SeatDiDiTask\Models\DkpSupplement;
use Seat\Web\Http\Controllers\Controller;

function sendPostRequest($interface, $getParameter, $data)
{
    $url = 'http://127.0.0.1:8000/' . $interface . "?" . $getParameter; // 替换为实际的目标地址

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
     * 获取个人dkp
     */
    public function getMineDkp()
    {
        return view('diditask::list');

    }

    /**
     * DKP兑换页
     * @return void
     */
    public function commodity()
    {

        return view('diditask::commodity');
    }


}
