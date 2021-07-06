@extends('layouts.admin')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">All User List</h1>

                {{-- <ol class="breadcrumb mb-4">
               <a href="{{route('admin.product.brand.create')}}" class="btn btn-success">Add new brand</a>
               <a href="{{route('admin.product.brand.create')}}" class="btn btn-success">Add new Category</a>
            </ol> --}}


            </div>
            <div class="container justify-content-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>User Name </th>
                            <th>User Email </th>
                            <th>User Role </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($users))
                          @foreach ($users as $user)
                          <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            @if ($user->id == 1)
                            <td>SuperAdmin</td>
                            @else
                            <td>User</td>
                            @endif
                           
                            <td>
                                <a href="" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <button type="submit" onclick="deluser({{$user->id}})" class="btn btn-warning"><i class="fa fa-trash"></i></button>
                            </td>
                           </tr>
                          @endforeach  
                        @else
                            
                        @endif
                      
                    </tbody>
                </table>
            </div>
        </main>
    @endsection
    <script>
        function deluser(id) {
            console.log(id)
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
    
                        method: 'post',
                        url: '{{ url('admin/users') }}/' + id,
                        data: {
                            "_token": '{{ csrf_token() }}',
                            "_method": 'DELETE',
                            "id": id
                        },
    
                        success: function(res) {
    
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            setTimeout(() => {
                                window.location.reload()
                            }, 1000);
                        },
                        error: function(err) {
                            console.log(err)
                        }
                    })
                }
            })
    
    
        }
    
    </script>