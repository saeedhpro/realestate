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
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">لیست مشاوران املاک</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                            <th>
                                ردیف
                            </th>
                            <th>
                                نام مشاور املاک
                            </th>
                            <th>
                                نام مدیر
                            </th>
                            <th>
                                شماره تماس
                            </th>
                            <th>
                                ایمیل
                            </th>
                            <th>
                                عملیات
                            </th>
                            </thead>
                            <tbody>
                            @foreach($realestates as $i => $r)
                                <tr>
                                    <td>
                                        {{ $realestates->firstItem() + $i }}
                                    </td>
                                    <td>
                                        {{ $r->name }}
                                    </td>
                                    <td>
                                        {{ $r->manager()->name }}
                                    </td>
                                    <td style="direction: ltr;">
                                        {{ $r->phone ? $r->phone : '-' }}
                                    </td>
                                    <td>
                                        {{ $r->email ? $r->email : '-' }}
                                    </td>
                                    <td>
                                        <a href="{{ route('realestate.show', $r->id) }}" class="btn btn-success"><i class="fas fa-eye"></i>  نمایش</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="">
                        {{ $realestates->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
