@extends('dashboard.dashboardlayout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <form class="form-inline">
                        <div class="row">
                            <div class="col">
                                <input >
                            </div>
                        </div>
                    </form>
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
