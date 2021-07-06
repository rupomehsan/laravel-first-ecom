@extends('layouts.admin')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h3 class="mt-4">Add Product Category</h3>
             
        </div>
        <div class="container justify-content-center">
            <div class="col-md-6">

                <form id="categoryform">
                    <div class="form-group">
                        <label for="">Create Category</label>
                        <input type="text" id="cat_name" name="cat_name" class="form-control" placeholder="Enter Category name">
                      
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </main>
@endsection

@push('customjs')
<script>
   
       $('#categoryform').submit(function(e) {
               e.preventDefault()
               var cat_name = $('#cat_name').val()

               $.ajax({
                   method: 'post',
                   url: '{{ route('categories.store') }}',
                   data   :{
                           "_token"  : '{{csrf_token()}}',
                           "name" : cat_name,
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
              
       })

    



</script>
@endpush