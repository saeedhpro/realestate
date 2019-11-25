@extends('dashboard.dashboardlayout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2-bs4.min.css') }}">
    <style>
        #search-form, .form-control, label{
            color: #fff !important;
        }
        option{
            color: #000;
        }
    </style>
    <style>
        .form-control, .select2-selection{
            height: 2.5rem !important;
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff !important;
            background-clip: padding-box;
            border: 1px solid #ced4da !important;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            text-align: right !important;
            direction: rtl !important;
        }
        .select2-container{
            max-width: 100%;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow{
            left: 1px !important;
            right: unset !important;
            bottom: 0 !important;
            height: unset !important;
        }
        .select2-results{
            text-align: right !important;
            direction: rtl !important;
        }
        .select2-dropdown.select2-dropdown--below, .select2-dropdown.select2-dropdown--above{
            overflow-y: scroll;
            max-height: 250px !important;
        }
        </style>
    <link rel="stylesheet" href="{{ asset('/css/pretty.min.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12">
                            <form id="search-form" action="{{ route('dashboard.advertise.search') }}" method="get">
                                <input id="st" type="hidden" value="buy">
                                <div class="form-row">
                                    <div class="col-6 col-sm-6 col-md">
                                        <label class="bmd-label-static" for="choose-sector-select">نوع کاربری</label>
                                        <select name="ets[]" class="form-control" id="choose-sector-select">
                                            @foreach($estate_types as $ets)
                                                <option value="{{ $ets->id }}">{{ $ets->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6 col-sm-6 col-md">
                                        <label class="bmd-label-static" for="choose-type-select">نوع واگذاری</label>
                                        <select name="ets[]" class="select2-box form-control" id="choose-type-select">
                                            <option value="0">همه آگهی ها</option>
                                            <option value="1">فروش</option>
                                            <option value="2">رهن و اجاره</option>
                                        </select>
                                    </div>
                                    <div class="col-6 col-sm-6 col-md">
                                        <span style="margin: 0 10px;"></span>
                                        <div class="form-check" style="display: inline; top: -6px !important;">
                                            <label class="form-check-label">
                                                <input class="form-check-input" name="ares" id="ares" type="checkbox" @if($ares) checked @endif>
                                                <span class="form-check-sign">
                                                 <span class="check"></span>
                                              </span>
                                            </label>
                                        </div>
                                        <span style="margin: 0 5px;"></span>
                                        <label for="ares" class="bmd-label-static">جستجو در همه آگهی ها؟</label>

                                    </div>
                                    <div class="col-12 col-sm-12 col-md">
                                        <button type="submit" class="btn btn-danger search-form-btn">جستجو</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                            <th>
                                ردیف
                            </th>
                            <th>
                                عنوان
                            </th>
                            <th>
                                نوع واگذاری
                            </th>
                            @if($user->type == \App\User::ADMIN)
                                <th>
                                    آژانس املاک
                                </th>
                                <th>
                                    آگهی دهنده
                                </th>
                            @endif
                            @if($user->type == \App\User::ADMIN || $user->type == \App\User::MANAGER)
                                <th>
                                    آگهی دهنده
                                </th>
                            @endif
                            <th>
                                تاریخ ثبت
                            </th>
                            <th>
                                عملیات
                            </th>
                            </thead>
                            <tbody>
                            @foreach($advertises as $i => $a)
                            <tr>
                                <td>
                                    {{ $advertises->firstItem() + $i }}
                                </td>
                                <td>
                                    {{ $a->title }}
                                </td>
                                <td>
                                    {{ $a->advertise_type == 1 ? 'برای فروش' : 'برای رهن و اجاره' }}
                                </td>
                                @if($user->type == \App\User::ADMIN)
                                    <td>
                                        {{ $a->real_estate->name }}
                                    </td>
                                    <td>
                                        {{ $a->user->name }}
                                    </td>
                                @endif
                                @if($user->type == \App\User::ADMIN || $user->type == \App\User::MANAGER)
                                    <td>
                                        {{ $a->user->name }}
                                    </td>
                                @endif
                                <td>
                                    {{ $a->releaseAgo() }}
                                </td>
                                <td>
                                    <a href="{{ route('adv.show', $a->id) }}" class="btn btn-success"><i class="fas fa-eye"></i>  نمایش</a>
                                    <a href="{{ route('dashboard.advertise.edit', $a->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i>  ویرایش</a>
                                    <a href="#" onclick="deleteAdvertise({{ $a->id }})" class="btn btn-danger"><i class="fas fa-trash"></i>  حذف</a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="">
                        {{ $advertises->appends(\Illuminate\Support\Facades\Input::except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#choose-sector-select").select2({
                theme: 'material'
            });
            $("#choose-type-select").select2({
                theme: 'material'
            });
        });
    </script>
    <script>
        function deleteAdvertise(id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/dashboard/advertise/' + id,
                type: 'DELETE',
                success: (response) =>{
                    location.reload();
                },
                error: (error) =>{
                    console.log(error)
                },

            });
        }
    </script>
@endsection
