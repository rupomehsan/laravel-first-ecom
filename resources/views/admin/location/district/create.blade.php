@extends('layouts.admin')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Add district</h1>
          
            
        </div>
        <div class="container justify-content-center">
            <div class="col-md-6">
    


                <form id="districtform">
                  
                    <div class="form-group">
                        <label for="">Create district</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="enter district name">
                    </div>
               
                <div class="form-group">
                    <label for="">Division</label>
                      <select name="division_id" id="division_id" class="form-control">
                       <option selected disabled>Select Division</option>
                       @foreach ($divisions as $division)
                           <option value="{{$division->id}}">{{$division->name}}</option>
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
   
       $('#districtform').submit(function(e) {
               e.preventDefault()
               var name = $('#name').val()
               var division_id = $('#division_id').val() 
               if (!name.length) {
                Swal.fire({
                    title: 'Validation Error',
                    text: "Name field is required",
                    icon: 'error',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                })
            } else $.ajax({
                   method: 'post',
                   url: '{{ url('admin/districts') }}',
                   data   :{
                           "_token"  : '{{csrf_token()}}',
                           "name"    : name,
                           "division_id" : division_id,
                       },

                       
                   success: function(res) {
                      
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