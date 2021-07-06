@extends('layouts.admin')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h3 class="mt-4">Add Brand</h3>
             
        </div>
        <div class="container justify-content-center">
            <div class="col-md-6">
                @if (Session::has('message'))
                    <div class="alert alert-success">
                        {{Session::get('message')}}
                    </div>
                @endif


                <form id="BrandForm">
                    <div class="form-group">
                        <label for="">Create Brand</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter Category name">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </main>
@endsection
@push('customjs')
    <script>
        $('#BrandForm').on('submit', function(e) {
            e.preventDefault()
            var name = $('#name').val()
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
                    url: '{{route('brands.store') }}',
                    data: {
                        "_token": '{{ csrf_token() }}',
                        "name": name,
                    },
                    success: function(res) {
                        console.log(res)
                        $('#name').empty()
                        Swal.fire({
                            title: 'Success',
                            text: res.message,
                            icon: 'success',
                            showCancelButton: true,
                            cancelButtonColor: '#d33',
                        })
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

    </script>
@endpush