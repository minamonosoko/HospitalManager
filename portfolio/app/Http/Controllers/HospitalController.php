<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\User;
use App\Models\Medicine;
use App\Models\Department;
use App\Models\Treatment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\HospitalRequest;

/**
 * 病院コントローラー
 */
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
        $medicines = Medicine::where('flag_delete', '!=', 1)->get();
        $departments = Department::all();
        $treatments = Treatment::all();
        return view('hospital', compact('hospitals', 'medicines', 'departments', 'treatments'));
    }

    /**
     * 処理の分岐（登録編集削除）
     *
     * @param Request $request
     * @return redirect()->route('hospital');
     */
    public function action(HospitalRequest $request)
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
        elseif ($action === 'delete-medicine')
        {
            $this->deleteMedicine($request);
        }
    
        return redirect()->route('hospital');
    }

    /**
     * 新規作成
     *
     * @param Request $request
     * @return void
     */
    public function create(HospitalRequest $request)
    {
        // 取得：ログインユーザID
        $user_id = Auth::id();
        // 削除：前回POST
        $request->session()->forget('post_data');
        // // 取得：POST
        $post_data = $request->all();
        // 設定：Session
        foreach ($post_data as $key => $value) 
        {
            $request->session()->push('post_data', ["key" => $key, "value" => $value]);
        }

        $request->session()->put('action', 'create');
        $validatedData = $request->validated();


        if (empty($validatedData)) {
            return redirect()->route('hospital')->withErrors('エラーが発生しました');
        }

        // 追加のデータを準備
        $validatedData['id'] = $user_id;
        $validatedData['previous_treatment_id'] = 1;
        $validatedData['next_treatment_id'] = 2;

        // DBへの保存処理
        $hospital = new Hospital;
        $hospital->create($validatedData);

        $request->session()->flash('success', '新しく病院が登録されました。');

        return redirect()->route('hospital');
    }


    /**
     * 更新
     *
     * @param Request $request
     * @return void
     */
    private function update(HospitalRequest $request)
    {
        // 削除：前回POST
        $request->session()->forget('post_data');
        // 取得：POST
        $post_data = $request->all();
        // 設定：Session
        foreach ($post_data as $key => $value) {
            $request->session()->push('post_data', ["key" => $key, "value" => $value]);
        }

        $request->merge(['action' => 'update']);

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
        if(array_key_exists('medicine', $post_data))
        {
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
        }

        $medicine_new_name = $post_data['medicine_new_name'];
        $medicine_new_stock = $post_data['medicine_new_stock'];

        if(isset($medicine_new_name) && isset($medicine_new_stock))
        {
            $medicine = new Medicine;
            $medicine->createMedicine($medicine_new_name, $medicine_new_stock, $hospital_id);
        }

        $request->session()->flash('success', '更新されました。');

    }


    /**
     * 論理削除：病院
     *
     * @param Request $request
     * @return void
     */
    private function softDelete(HospitalRequest $request)
    {
        $request->merge(['action' => 'deleteHospital']);

        // 取得：ログインユーザID
        $user_id = Auth::id();
        // 削除：前回POST
        $request->session()->forget('post_data');
        // 取得：POST
        $post_data = $request->all();
        // 設定：Session
        foreach ($post_data as $key => $value) 
        {
            $request->session()->push('post_data', ["key" => $key, "value" => $value]);
        }

        $hospital_id = $request->input('hospital_id');
        $hospital = Hospital::find($hospital_id);

        $hospital->softDelete();

        $request->session()->flash('success', '病院が削除されました。');
    }

    /**
     * 論理削除：薬
     *
     * @param Request $request
     * @return void
     */
    private function deleteMedicine(Request $request)
    {
        // 取得：ログインユーザID
        $user_id = Auth::id();
        // 削除：前回POST
        $request->session()->forget('post_data');
        // 取得：POST
        $post_data = $request->all();
        // 設定：Session
        foreach ($post_data as $key => $value) 
        {
            $request->session()->push('post_data', ["key" => $key, "value" => $value]);
        }

        foreach($post_data['medicine-delete'] as $key => $val)
        {
            $medicine = Medicine::find($val);
            $medicine->softDelete();
        }

        $request->session()->flash('success', 'チェックした薬が削除されました。');
    }
}