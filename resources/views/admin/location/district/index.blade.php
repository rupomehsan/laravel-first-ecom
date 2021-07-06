@extends('layouts.admin')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h3 class="mt-4">All District</h3>

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
                            <th>District Name</th>
                            <th>Division Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (count($districts))
                    
                          @foreach ($districts as $district)
                          <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$district->name}}</td>
                            {{-- <td>{{$district->disision_id}}</td> --}}
                            <td>{{$district->division->name}}</td>
                            <td>{{$district->status}}</td>
                            <td>
                                <a href="{{route('districts.edit',['district'=>$district->id])}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <button type="submit" onclick="deldistrict({{$district->id}})" class="btn btn-warning"><i class="fa fa-trash"></i></button>
                            </td>
                           </tr>
                          @endforeach  
                        @else
                        <td colspan="4">Data is Not Found</td>
                        @endif
                       
                    </tbody>
                </table>
            </div>
        </main>
    @endsection
    <script>
        function deldistrict(id) {
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
                        url: '{{ url('admin/districts') }}/' + id,
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