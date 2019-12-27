@extends('dashboard.dashboardlayout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">آگهی ها</h4>
                    <p class="card-category"> مشاهده ی همه ی آگهی های ثبت شده توسط شما</p>
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
                                @endif
                                @if($user->type == \App\User::ADMIN || $user->type == \App\User::MANAGER)
                                    <td>
                                        {{ $a->user ? $a->user->name : $a->name }}
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
                        {{ $advertises->links() }}
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
                {{--"_token": "{{ csrf_token() }}",--}}
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
