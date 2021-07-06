@extends('layouts.admin')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h3 class="mt-4">Edit Product Category</h3>
             
        </div>
        <div class="container justify-content-center">
            <div class="col-md-6">

                <form id="categoryform">
                    <div class="form-group">
                        <label for="">Create Category</label>
                        <input type="hidden" id="category_id" value="{{$category->id}}">
                        <input type="text" id="cat_name" name="cat_name" class="form-control" placeholder="Enter Category name" value="{{$category->name}}">
                      
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
               var category_id = $('#category_id').val()
               $.ajax({
                   method: 'post',
                   url: '{{ url('admin/categories') }}/' + category_id,
                   data   :{
                           "_token"  : '{{csrf_token()}}',
                           "name"    : cat_name,
                           "_method" : 'PATCH',
                       },

                       
                   success: function(res) {
                      
                       Swal.fire({
                           title: 'Success',
                           text: res.message,
                           icon: 'success',
                       }).then(function(res) {
                           if (res.isConfirmed) {
                               window.location.reload()
                           }
                       })
                   },
                   error: function(err) {
                       console.log(err)
                   }
               })
              
       })

    



</script>
@endpush