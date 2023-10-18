<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\User;
use App\Models\Medicine;
use App\Models\Department;
use App\Models\Treatment;
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
        $hospitals = Hospital::where('id', $user_id)->where('flag_delete', '!=', 1)->get();
        $medicines = Medicine::all();
        $departments = Department::all();
        $treatments = Treatment::all();
        return view('hospital', compact('hospitals', 'medicines', 'departments', 'treatments'));
    }

    public function action(Request $request)
    {
        $action = $request->input('action');

        if ($action === 'update') 
        {
            // 更新の処理
            $this->update($request);
        } 
        elseif ($action === 'delete') 
        {
            // 削除の処理
            $this->softDelete($request);
        }
    
        return redirect()->route('hospital');
    }

    public function create(Request $request)
    {
        // 取得：ログインユーザID
        $user_id = Auth::id();
        // 削除：前回POST
        $request->session()->forget('post_data');
        // 取得：POST
        $post_data = $request->all();
        // 設定：Session
        foreach ($post_data as $key => $value) {
            $request->session()->push('post_data', ["key" => $key, "value" => $value]);
        }

        if(isset($post_data['department_id']))
        {
            // ログインユーザIDを追加
            $post_data['id'] = $user_id;
            $post_data['previous_treatment_id'] = 1;
            $post_data['next_treatment_id'] = 1;

            $hospital = new Hospital;
            var_dump($post_data);
            $hospital->create($post_data);      
        }

        return redirect()->route('hospital');
    }

    /**
     * 更新
     *
     * @param Request $request
     * @return void
     */
    private function update(Request $request)
    {
        // 削除：前回POST
        $request->session()->forget('post_data');
        // 取得：POST
        $post_data = $request->all();
        // 設定：Session
        foreach ($post_data as $key => $value) {
            $request->session()->push('post_data', ["key" => $key, "value" => $value]);
        }

        ## 登録：Hospitalsテーブル
        $hospital_id = $request->input('hospital_id');
        $hospital = Hospital::find($hospital_id);

        if(!$hospital)
        {
            return redirect()->route('hospital')->with('error', '病院が見つかりませんでした。');
        }
        
        $hospital->updateHospital($post_data);

        ## 登録：Medicinesテーブル
        // 取得：薬剤
        $medicine_data = $post_data['medicine'];
        $medicine_name_data = $post_data['medicine_name'];
        // 更新：薬剤（key：medicine_id、val：medicine_stock）
        foreach($medicine_data as $key => $val)
        {
            foreach($medicine_name_data as $key2 => $val2)            
            {
                if($key == $key2)
                {
                    Medicine::updateMedicine($key, $val, $val2);
                }
            }
        }


        $medicine_new_name = $post_data['medicine_new_name'];
        $medicine_new_stock = $post_data['medicine_new_stock'];

        if(isset($medicine_new_name) && isset($medicine_new_stock))
        {
            $medicine = new Medicine;
            $medicine->createMedicine($medicine_new_name, $medicine_new_stock, $hospital_id);
        }

        // return redirect()->route('hospital');
    }


    private function softDelete(Request $request)
    {
        $hospital_id = $request->input('hospital_id');
        $hospital = Hospital::find($hospital_id);

        $hospital->softDelete();
    }
}