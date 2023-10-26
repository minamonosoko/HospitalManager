@extends('base')

@section('content')

@if(config('app.debug'))
<ul>
    @foreach(session('post_data', []) as $data)
    <li>
        {{ $data['key'] }}: {{ is_array($data['value']) ? json_encode($data['value']) : $data['value'] }}
    </li>
    @endforeach
</ul>
@endif

<div class="main-container">
    @if($errors->any())
        <div class="error-wrapper">
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div><!-- .error-wrapper -->
    @endif
    <div class="contents-wrapper d-flex">
        <div class="accordion w-100">
            @foreach($hospitals as $key => $val)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading-{{ $key }}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#accordion-body-{{ $key }}">
                        <div>
                            <div class="fs-3">
                                {{ $val->hospital_name }}
                            </div>
                            @foreach($departments as $department)
                                @if($val->department_id === $department->department_id)
                                    {{ $department->department_name }}
                                @endif
                            @endforeach
                        </div>
                    </button>
                </h2><!-- .accordion-header -->
                <form method="POST" action="{{ route('hospital.action') }}" accept-charset="UTF-8">
                    @csrf
                    <input type="hidden" name="hospital_id" value="{{ $val->hospital_id }}">
                    <div id="accordion-body-{{ $key }}" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <div>
                                <div class="fs-5">
                                    ■通院日時
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="text-left">
                                        前回通院日
                                    </div>
                                    <div class="text-right">
                                        <input type="datetime-local" id="attend-previous-{{ $key }}"
                                            name="attend_previous" value="{{ $val->previous_attend }}">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="text-left">
                                        次回通院日
                                    </div>
                                    <div class="text-right">
                                        <input type="datetime-local" id="attend-next-{{ $key }}" name="attend_next"
                                            value="{{ $val->next_attend }}">
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div>
                                <div class="fs-5">
                                    ■治療内容
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="text-left">
                                        前回治療内容
                                    </div>
                                    <div class="text-right">
                                        <select name="treatment_previous" class="form-select form-select-sm">
                                            <option>選択してください</option>
                                            <option value="1" {{ $val->previous_treatment_id == 1 ? 'selected' : ''
                                                }}>初診</option>
                                            <option value="2" {{ $val->previous_treatment_id == 2 ? 'selected' : ''
                                                }}>定期受診</option>
                                            <option value="3" {{ $val->previous_treatment_id == 3 ? 'selected' : ''
                                                }}>検査</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="text-left">
                                        次回治療内容
                                    </div>
                                    <div class="text-right">
                                        <select name="treatment_next" class="form-select form-select-sm">
                                            <option>選択してください</option>
                                            <option value="1" {{ $val->next_treatment_id == 1 ? 'selected' : '' }}>初診
                                            </option>
                                            <option value="2" {{ $val->next_treatment_id == 2 ? 'selected' : '' }}>定期受診
                                            </option>
                                            <option value="3" {{ $val->next_treatment_id == 3 ? 'selected' : '' }}>検査
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div>
                                <div class="fs-5">
                                    ■服薬内容
                                </div>

                                @foreach($medicines as $key2 => $val2)
                                @if($val->hospital_id === $val2->hospital_id)
                                <div class="d-flex justify-content-between">
                                    <div class="form-check">
                                        <input class="form-check-input" name="medicine-delete[]" type="checkbox"
                                            value="{{ $val2->medicine_id }}">
                                        <div class="text-left">
                                            <input type="text" name="medicine_name[{{ $val2->medicine_id }}]"
                                                value="{{ $val2->medicine_name }}" accept-charset="UTF-8">
                                        </div>
                                    </div>

                                    <div class="text-right col-1">
                                        <input type="number" name="medicine[{{ $val2->medicine_id }}]"
                                            class="form-control form-control-sm" id="input-medicine-{{ $key2 }}"
                                            step="0.5" value="{{ $val2->medicine_stock }}" style="">
                                    </div>
                                </div>
                                @endif
                                @endforeach

                                <div class="d-flex justify-content-between">
                                    <div class="text-left">
                                        <input type="text" name="medicine_new_name" placeholder="新しい薬の名前を入力"
                                            accept-charset="UTF-8">
                                    </div>
                                    <div class="text-right col-1">
                                        <input type="number" name="medicine_new_stock"
                                            class="form-control form-control-sm" id="input-medicine-new-name" step="0.5"
                                            value="0" style="">
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div>
                                <div class="fs-5">
                                    ■病院情報
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="text-left">
                                        電話番号
                                    </div>
                                    <div class="text-right col-2">
                                        <input type="tel" name="phone_number" class="form-control form-control-sm"
                                            placeholder="電話番号を入力" value="{{ $val->hospital_phone_number }}">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="text-left">
                                        住所
                                    </div>
                                    <div class="text-right col-4">
                                        <input type="text" name="address" class="form-control form-control-sm"
                                            id="input-address-{{ $key }}" value="{{ $val->hospital_address }}">
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div>
                                <button type="submit" class="btn btn-primary btn-sm" name="action"
                                    value="update">更新</button>
                                <button type="submit" class="btn btn-primary btn-sm" name="action"
                                    value="delete">削除</button>
                                <button type="submit" class="btn btn-primary btn-sm" name="action"
                                    value="delete-medicine">チェックした薬を削除</button>
                            </div>
                        </div><!-- .accordion-body -->
                    </div>
                </form>
            </div><!-- .accordion-item -->
            @endforeach
            <div class="create-wrapper">
                <form method="POST" action="{{ route('hospital.create') }}" accept-charset="UTF-8">
                    @csrf
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-register">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#accordion-body-register">
                                <div>
                                    <div class="fs-3">
                                        新しい病院を登録
                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div>
                            <div id="accordion-body-register" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div>
                                        <div class="d-flex justify-content-between">
                                            <div class="text-left">
                                                病院名
                                            </div>
                                            <div class="text-right">
                                                <input type="text" id="attend-previous-register" name="hospital_name"
                                                    placeholder="病院名を入力">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="text-left">
                                                診療科
                                            </div>
                                            <div class="text-right">
                                                <select name="department_id" class="form-select form-select-sm">
                                                    <option selected value="0">選択してください</option>
                                                        @foreach($departments as $key => $val)
                                                            <option value="{{ $val->department_id }}">
                                                                {{ $val->department_name}}
                                                            </option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            新規登録
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- .create-wrapper -->
        </div><!-- .accordion -->
    </div><!-- .contents-wrapper -->
</div><!-- .main-container -->
@endsection