<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\UserModel;

class UserController extends Controller
{
    public function judgeInfo($id) {
        $user = new UserModel();
        $num = $user -> selectInfo($id);
        if ($num) {
            $stInfo = new UserModel;
            $tstInfo = $stInfo -> putInfo($id);

            $classtimet=explode(',' ,$tstInfo);
            $this->view($classtimet);
        }
        else {
            $this->getInfo($id);
        }
    }

    public function getInfo($id) {

        $add = "http://jwzx.cqupt.edu.cn/jwzxtmp/kebiao/kb_stu.php?xh=" . $id;

        $curl = curl_init();  
        curl_setopt($curl, CURLOPT_URL, $add);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("application/x-www-form-urlencoded;charset=utf-8;"));

        $curlopt = curl_exec($curl);
        curl_close($curl);

        $keywords = preg_match_all("/<td[^>]*>([^<>]+)<\/td>/", $curlopt, $classinfo);
        //处理数组
        array_splice($classinfo, 0, 1);

        for ($i=0; $i < count($classinfo[0]); $i++) { 
            $classtimet[$i] = $classinfo[0][$i];
        }

        for ($m=0; $m < count($classtimet); $m++) { 
            if ($classtimet[0] == "备注") {break;}
            array_splice($classtimet, 0, 1);
        }
        array_splice($classtimet, 0, 1);

        $this ->dealdb($id, $classtimet);
        $this ->view($classtimet);
    }

    public function view($classtimet) {
        for ($n=0; $n < count($classtimet); $n++) { 
            if (preg_match("/^[A-Z]+/", $classtimet[$n], $matches)) {
                echo "<hr>";
            }
        echo $classtimet[$n];
        echo '        ';
        }
    }

    public function dealdb($id, $classtimet) {
        $adddb = new UserModel();
        $adddb -> addInfo($id, $classtimet);
    }
}