@extends('layouts.admin')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h3 class="mt-4">Edit Brand</h3>
             
        </div>
        <div class="container justify-content-center">
            <div class="col-md-6">
                @if (Session::has('message'))
                    <div class="alert alert-success">
                        {{Session::get('message')}}
                    </div>
                @endif


                <form  id="brandform"action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Create Brand</label>
                        <input type="hidden" id="brand_id" value="{{$brand->id}}">
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter Category name" value="{{$brand->name}}">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </main>
@endsection


@push('customjs')
<script>
   
       $('#brandform').submit(function(e) {
               e.preventDefault()
               var name = $('#name').val()
               var brand_id = $('#brand_id').val()
               $.ajax({
                   method: 'post',
                   url: '{{ url('admin/brands') }}/' + brand_id,
                   data   :{
                           "_token"  : '{{csrf_token()}}',
                           "name"    : name,
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