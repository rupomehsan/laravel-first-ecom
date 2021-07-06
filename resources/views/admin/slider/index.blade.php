@extends('layouts.admin')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">All brand</h1>

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
                            <th>Slider Heading </th>
                            <th>Slider Title </th>
                            <th>Slider descripsion </th>
                            <th>Slider Image </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($sliders))
                           @foreach ($sliders as $slider)
                           <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$slider->heading}}</td>
                            <td>{{$slider->title}}</td>
                            <td>{!! $slider->descripsion !!}</td>
                            <td><img src="{{$slider->image}}" alt="" height="60" width="80"></td>
                            <td class="actionbtn">
                                <a href="{{route('sliders.edit', ['slider'=> $slider->id] )}}" class="btn btn-primary d-inline-block"><i class="fa fa-edit"></i></a>
                                <button type="submit" onclick="delslide({{$slider->id}})" class="btn btn-warning"><i class="fa fa-trash"></i></button>
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
        function delslide(id) {
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
                        url: '{{ url('admin/sliders') }}/' + id,
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