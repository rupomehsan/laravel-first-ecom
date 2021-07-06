@extends('layouts.admin')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">edit district</h1>
            {{-- <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Create brand</li>
            </ol> --}}
           
            
        </div>
        <div class="container justify-content-center">
            <div class="col-md-6">
                {{-- @if (Session::has('message'))
                    <div class="alert alert-success">
                        {{Session::get('message')}}
                    </div>
                @endif --}}


                <form id="editdistrict">
                
                    <div class="form-group">
                        <label for="">edit district</label>
                        <input type="hidden" id="district_id" value="{{$district->id}}">
                        <input type="text" id="name" name="name" class="form-control" value="{{$district->name}}">
                    </div>
                    <div class="form-group">
                        <label for="">district</label>
                          <select name="division_id" id="division_id" class="form-control">
                           <option selected disabled>Select district</option>
                           @foreach ($divisions as $division)
                               <option value="{{$division->id}}" {{$district->division_id === $division->id? 'selected':''}}>{{$division->name}}</option>
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
   
       $('#editdistrict').submit(function(e) {
               e.preventDefault()
               var name = $('#name').val()
               var division_id = $('#division_id').val()
               var district_id = $('#district_id').val()
               if (!name.length) {
                Swal.fire({
                    title: 'Validation Error',
                    text: "Name field is required",
                    icon: 'error',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                })
            } 
            else {
               $.ajax({
                   method: 'post',
                   url: '{{ url('admin/districts') }}/' + district_id,
                   data   :{
                           "_token"  : '{{csrf_token()}}',
                           "division_id" : division_id,
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
            }
              
       })

    



</script>
@endpush