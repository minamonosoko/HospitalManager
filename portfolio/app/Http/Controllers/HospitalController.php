<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\User;
use App\Models\Medicine;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;


class HospitalController extends Controller
{
    /**
     * 表示：hospital
     *
     * @return void
     */
    public function index()
    {
        // 取得：ログインユーザID
        $user_id = Auth::id();
        $hospitals = Hospital::where('id', $user_id)->get();
        $medicines = Medicine::all();
        $departments = Department::all();
        return view('hospital', compact('hospitals', 'medicines', 'departments'));
    }

    /**
     * 更新
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
        // 削除：前回POST
        $request->session()->forget('post_data');
        // 取得：POST
        $postData = $request->all();

        PostData::create($postData);

        // 取得：POST
        foreach ($postData as $key => $value) {
            $request->session()->push('post_data', ["key" => $key, "value" => $value]);
        }

        // 更新処理
        // $user = User::find(1)

        return redirect()->route('hospital');
    }
}