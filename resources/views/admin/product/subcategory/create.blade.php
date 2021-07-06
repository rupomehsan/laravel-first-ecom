@extends('layouts.admin')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h3 class="mt-4">Add Sub_Category</h3>
             
        </div>
        <div class="container justify-content-center">
            <div class="col-md-6">
                @if (Session::has('message'))
                    <div class="alert alert-success">
                        {{Session::get('message')}}
                    </div>
                @endif


                <form id="sucatform" >
                    <div class="form-group">
                        <label for="">Create Sub_category</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter Category name">
                    </div>
                    <div class="form-group">
                        <label for="">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option selected disabled>select category</option>
                            @foreach ($categorys as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                          
                        </select>
                       
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </main>
@endsection

@push('customjs')
    <script>
        $('#sucatform').on('submit', function(e) {
            e.preventDefault()
            var name = $('#name').val()
            var category_id = $('#category_id').val()
            if (!name.length) {
                Swal.fire({
                    title: 'Validation Error',
                    text: "Name field is required",
                    icon: 'error',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                })
              
            } else {
                $.ajax({
                    method: 'post',
                    url: '{{route('subcategories.store') }}',
                    data: {
                        "_token": '{{ csrf_token() }}',
                        "name": name,
                        "category_id" : category_id,
                    },
                    success: function(res) {
                        console.log(res)
                        if(res.status === 'done'){
                            Swal.fire({
                                title: 'Success',
                                text: res.message,
                                icon: 'success',
                            }).then(function(res) {
                                if (res.isConfirmed) {
                                    window.location.reload()
                                }
                            })
                        }else if(res.status === 'validation_error'){
                            Swal.fire({
                                title: 'Error',
                                text: 'Field Must be Required ',
                                showCancelButton: true,
                                cancelButtonColor: '#d33',
                                // text: 'Validation Error',
                                // text: res.errors.name[0],
                                // text: res.errors.price[0],
                                // text: res.errors.stock[0],
                                icon: 'error',
                            }).then(function(res) {
                                if (res.isConfirmed) {
                                    window.location.reload()
                                }
                            })
                        }
                    },
                    error: function(err) {
                        console.log(err)
                    }
                })
            }
        })

    </script>
@endpush
