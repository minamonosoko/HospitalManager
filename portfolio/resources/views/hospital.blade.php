@extends('base')

@section('content')
@if(config('app.debug'))
    @foreach(session('post_data', []) as $data)
    <li>{{ $data['key'] }}: {{ $data['value'] }}</li>
    @endforeach
@endif

<div class="main-container">
    <div class="d-flex">
        <div class="accordion w-100">
            @foreach($hospitals as $hospital)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-1">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#accordion-body-1" aria-expanded="true" aria-controls="accordion-body-1">
                            <div>
                                <div class="fs-3">
                                    {{ $hospital->hospital_name }}
                                </div>
                                @foreach($departments as $department)
                                    @if($hospital->department_id === $department->department_id)
                                        {{ $department->department_name }}
                                    @endif
                                @endforeach
                            </div>
                        </button>
                    </h2>
                    <form method="POST" action="{{ route('hospital.update') }}">
                        @csrf
                        <div id="accordion-body-1" class="accordion-collapse collapse show" aria-labelledby="heading-1">
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
                                            <input type="datetime-local" id="previous-attend-1" name="previous-attend-1"
                                                value="{{ $hospital->previous_attend }}">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div class="text-left">
                                            次回通院日
                                        </div>
                                        <div class="text-right">
                                            <input type="datetime-local" id="next-attend-1" name="next-attend-1"
                                                value="{{ $hospital->next_attend }}">
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
                                            <select name="treatment-previous" class="form-select form-select-sm" aria-label="Default select example">
                                                <option>選択してください</option>
                                                <option value="1" {{ $hospital->previous_treatment_id == 1 ? 'selected' : '' }}>初診</option>
                                                <option value="2" {{ $hospital->previous_treatment_id == 2 ? 'selected' : '' }}>定期受診</option>
                                                <option value="3" {{ $hospital->previous_treatment_id == 3 ? 'selected' : '' }}>検査</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div class="text-left">
                                            次回治療内容
                                        </div>
                                        <div class="text-right">
                                            <select name="treatment-next" class="form-select form-select-sm" aria-label="Default select example">
                                                <option>選択してください</option>
                                                <option value="1" {{ $hospital->next_treatment_id == 1 ? 'selected' : '' }}>初診</option>
                                                <option value="2" {{ $hospital->next_treatment_id == 2 ? 'selected' : '' }}>定期受診</option>
                                                <option value="3" {{ $hospital->next_treatment_id == 3 ? 'selected' : '' }}>検査</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div>
                                    <div class="fs-5">
                                        ■服薬内容
                                    </div>
                                    @foreach($medicines as $medicine)
                                        @if($hospital->hospital_id === $medicine->hospital_id)
                                            <div class="d-flex justify-content-between">
                                                <div class="text-left">
                                                    {{ $medicine->medicine_name }}
                                                </div>
                                                <div class="text-right">
                                                    <input type="number" name="medicine-1-1" class="form-control" id="input-medicine-1-1"
                                                        step="0.5" value="{{ $medicine->medicine_stock }}">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
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
                                        <div class="text-right">
                                            <input type="tel" name="tel" placeholder="電話番号を入力" value="{{ $hospital->hospital_phone_number }}">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div class="text-left">
                                            住所
                                        </div>
                                        <div class="text-right">
                                            <input type="text" class="form-control" id="input-address-1"
                                                aria-describedby="emailHelp" value="{{ $hospital->hospital_address }}">
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div>
                                    <button type="submit" class="btn btn-primary btn-sm">更新</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div><!-- .main-container -->
@endsection