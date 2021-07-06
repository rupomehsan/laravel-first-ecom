@extends('layouts.admin')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">edit division</h1>
                {{-- <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Create brand</li>
            </ol> --}}


            </div>
            <div class="container justify-content-center">
                <div class="col-md-6">

                    <form id="editdivisionForm" >
                        <div class="form-group">
                            <label for="name">Division Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $division->name }}">
                            <input type="hidden" name="id" id="division_id" class="form-control" value="{{ $division->id }}">
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
   
       $('#editdivisionForm').submit(function(e) {
               e.preventDefault()
               var name = $('#name').val()
               var division_id = $('#division_id').val()
               $.ajax({
                   method: 'post',
                   url: '{{ url('admin/divisions') }}/' + division_id,
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