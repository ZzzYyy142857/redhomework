<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{
    public function addInfo($id, $classtimet) {
        $base = implode(",", $classtimet);
        $data = [
            'id' => $id,
            'info' => $base,
            'create_at' => time(),
            'uptimed_at' => time()
        ];
        $inf = DB::table('classtimetable')->insert($data);
    }

    public function selectInfo($id) {
        $userInfo = DB::table('classtimetable')->where('id', '=', $id)->get();
        return $userInfo;
    }

    public function putInfo($id) {
        $theInfo = DB::table('classtimetable')->where('id', '=', $id)->get();
        //$theinfo[0] = $theInfo[0][1];
        //$t = json_decode($theInfo[0], 1);
        $t = get_object_vars($theInfo[0]);
        $k = $t['info'];
        return $k;
    }
}