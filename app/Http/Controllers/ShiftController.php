<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class ShiftController extends Controller
{
    public function store(Request $request)
    {
        $shift = new Shift;
        
        $shift->user_id = $request -> input('user_id');
        $shift->start_date = date('Y-m-d',$request->input('start_date')/1000);
        $shift->end_date = date('Y-m-d',$request->input('end_date')/1000);
        $shift->name = $request->input('name');
        $shift->save();
    }
    public function getShift(Request $request)
    {
        //カレンダーの表示期間
        $start_date = date('Y-m-d', $request->input('start_date') / 1000);
        $end_date = date('Y-m-d', $request->input('end_date') / 1000);
        //登録処理
        return Shift::query()
            ->with('user')
            ->select(
                'start_date as start',
                'end_date as end',
                'name as title',
                'id'
            )
            ->where('end_date', '>',$start_date)
            ->where('start_date', '>',$end_date)
            ->get();
    }
    public function update(Request $request, Shift $event)
    {
        
    // 日付に変換。JavaScriptのタイムスタンプはミリ秒なので秒に変換
        $shift->start_date = date('Y-m-d', $request->input('start_date') / 1000);
        $shift->end_date = date('Y-m-d', $request->input('end_date') / 1000);
        $shift->save();
    }
}
