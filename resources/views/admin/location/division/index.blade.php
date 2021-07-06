@extends('layouts.admin')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">All Divisions</h1>

                {{-- <ol class="breadcrumb mb-4">
               <a href="{{route('admin.product.brand.create')}}" class="btn btn-success">Add new brand</a>
               <a href="{{route('admin.product.brand.create')}}" class="btn btn-success">Add new Category</a>
            </ol> --}}


            </div>
            <div class="container">
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Division Name</th>
                                <th>Division Code</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($divisions))
                                @foreach ($divisions as $division)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$division->name}}</td>
                                    <td>{{$division->status}}</td>
                                    <td>
                                        <a href="{{route('divisions.edit',['division'=>$division->id])}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                        <button type="submit" onclick="deldivision({{$division->id}})" class="btn btn-warning"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                            <td>DATA IS NOT FOUND</td>
                            @endif
                          
                        </tbody>
                    </table>

                </div>
            </div>

        </main>
    </div>
@endsection

<script>
    function deldivision(id) {
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
                    url: '{{ url('admin/divisions') }}/' + id,
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
