@extends('dashboard.dashboardlayout')

@section('styles')
    <style>
        .card-profile .card-avatar{
            max-width: 160px;
            max-height: 160px;
            box-shadow: 0 3px 18px -12px rgba(0,0,0,.56), 0 4px 25px 0 rgba(0,0,0,.12), 0 8px 10px -5px rgba(0,0,0,.2);
        }
        .card-text, .card-title{
            margin-top: 15px;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-avatar">
                    <a href="#pablo">
                        <img class="img" src="{{ $employee->avatar ? $employee->avatar : url(asset('images/dashboard/avatar.png')) }}" />
                    </a>
                </div>
                <div class="card-body">
                    <h4 class="card-title" style="font-size: 22px;">{{ $employee->name }}</h4>
                    <h6 class="card-text" style="font-size: 15px;">مشاور املاک : {{ $employee->real_estate->name }}</h6>
                    <p class="card-text">
                        <i class="material-icons">map</i> آدرس :  {{ $employee->address }}
                    </p>
                    <p class="card-text">
                        <i class="material-icons">phone</i> شماره تماس : {{ $employee->phone }}
                    </p>
                    <p class="card-text">
                        <i class="material-icons">email</i> ایمیل : {{ $employee->email }}
                    </p>
                    <a href="{{ route('dashboard.realestate.employee.edit', ['id' => $employee->real_estate->id, 'eid' => $employee->id]) }}" class="btn btn-primary btn-round">ویرایش</a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">آگهی های {{ $employee->name }}</h4>
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
                            @if($employee->type == \App\User::ADMIN || $employee->type == \App\User::MANAGER)
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
                            @foreach($advertises as $a)
                                <tr>
                                    <td>
                                        {{ $a->id }}
                                    </td>
                                    <td>
                                        {{ $a->title }}
                                    </td>
                                    <td>
                                        {{ $a->advertise_type == 1 ? 'برای فروش' : 'برای رهن و اجاره' }}
                                    </td>
                                    @if($employee->type == \App\User::ADMIN || $employee->type == \App\User::MANAGER)
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
                                        <a href="#" @click.prevent="deleteAdvertise({{ $a->id }})" class="btn btn-danger"><i class="fas fa-trash"></i>  حذف</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="">
                        {{ $advertises->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
