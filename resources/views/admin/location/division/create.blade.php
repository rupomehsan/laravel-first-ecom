@extends('layouts.admin')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Add division</h1>
                {{-- <ol class="breadcrumb mb-4">
                <a href="{{route('admin.product.brand.show')}}" class="btn btn-success">All brand</a>
            </ol> --}}


            </div>
            <div class="container justify-content-center">
                <div class="col-md-6">
                    <form id="createForm">
                        <div class="form-group">
                            <label for="name">Create division</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="enter division name">

                        </div>

                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
@endsection
@push('customjs')
    <script>
        $('#createForm').on('submit', function(e) {
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
                    url: '{{route('divisions.store') }}',
                    data: {
                        "_token": '{{ csrf_token() }}',
                        "name": name,
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
