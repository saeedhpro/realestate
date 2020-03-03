@extends('dashboard.dashboardlayout')

@section('styles')
    <style>
        .avatar{
            max-width: 55px;
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">کارمندان</h4>
                    <a href="{{ url()->previous() }}" class="back-button mr-auto d-inline-flex">
                        <i class="fas fa-arrow-alt-left"></i>
                    </a>
                    <p class="card-category"> مشاهده ی همه ی کارمندان مشاور املاک شما</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                            <th>
                                ردیف
                            </th>
                            <th>
                                آواتار
                            </th>
                            <th>
                                نام و نام خانوادگی
                            </th>
                            @if($user->type == \App\User::ADMIN)
                                <th>
                                    آژانس املاک
                                </th>
                                <th>
                                    نقش کاربری
                                </th>
                            @endif
                            @if($user->type == \App\User::ADMIN || $user->type == \App\User::MANAGER)
                                <th>
                                    شماره تماس
                                </th>
                                <th>
                                    آدرس
                                </th>
                            @endif
                            <th>
                                عملیات
                            </th>
                            </thead>
                            <tbody>
                            @foreach($employees as $i => $emp)
                                <tr>
                                    <td>
                                        {{ $employees->firstItem() + $i }}
                                    </td>
                                    <td>
                                        <img class="avatar" src="{{ $emp->avatar ? url($emp->avatar): url('images/dashboard/avatar.png') }}">
                                    </td>
                                    <td>
                                        <a href="{{ route('dashboard.realestate.employee.show', ['id' => $emp->real_estate->id, 'eid' => $emp->id]) }}">{{ $emp->name }}</a>
                                    </td>
                                    @if($user->type == \App\User::ADMIN)
                                        <td>
                                            {{ $emp->real_estate->name }}
                                        </td>
                                        <td>
                                            {{ $emp->role->title }}
                                        </td>
                                    @endif
                                    @if($user->type == \App\User::ADMIN || $user->type == \App\User::MANAGER)
                                        <td>
                                            {{ $emp->phone ? $emp->phone : '-' }}
                                        </td>
                                        <td>
                                            {{ $emp->address ? $emp->address : '-' }}
                                        </td>
                                    @endif
                                    <td>
                                        <a href="{{ route('dashboard.realestate.employee.show',['id' => $emp->real_estate->id, 'eid' => $emp->id] ) }}" class="btn btn-success"><i class="fas fa-eye"></i>  نمایش</a>
                                        <a href="{{ route('dashboard.realestate.employee.edit', ['id' => $emp->real_estate->id, 'eid' => $emp->id]) }}" class="btn btn-primary"><i class="fas fa-edit"></i>  ویرایش</a>
                                        <a href="#" @click.prevent="deleteEmployee({{ $emp->id }})" class="btn btn-danger"><i class="fas fa-trash"></i>  حذف</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="">
                        {{ $employees->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div
@endsection
