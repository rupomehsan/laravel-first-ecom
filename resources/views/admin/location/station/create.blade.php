@extends('layouts.admin')
@section('content')
<div id="layoutSidenav_content">
    <main>

        <div class="container-fluid">
            <h1 class="mt-4">Add stasion</h1> 
        </div>
        <div class="container justify-content-center">
            <div class="col-md-6">
                <form id="stasionform">
                 
                    <div class="form-group">
                        <label for="">Create stasion</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="enter stasion name">
                      
                    </div>
                    <div class="form-group">
                        <label for="">division</label>
                          <select name="division_id" id="division_id" class="form-control">
                           <option selected disabled>Select Division</option>
                           @foreach ($divisions as $division)
                           <option value="{{$division->id}}">{{$division->name}}</option>
                           @endforeach
                         
                       </select>
    
                        </div>
                    <div class="form-group">
                    <label for="">district</label>
                      <select name="district_id" id="district_id" class="form-control">
                       <option disable selected>Select stasion</option>
                   </select>

                    </div>
                  
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </main>
@endsection

@push('customjs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.6.2/tinymce.min.js"></script>
<script>
    

      
 $(document).ready(function() {
       
            $('#division_id').change(function(e) {
                var division_id = $(this).val()
                $.ajax({
                    method: 'get',
                    url: '{{ url('api/districts') }}/' + division_id,
                    dataType: 'json',
                    success: function(res) {
                        console.log(res)
                        $('#district_id').empty()
                        $('#district_id').append(
                            "<option disabled selected>Select Sub Category</option>"
                            )
                        res.districts.forEach(function(item) {
                            $('#district_id').append(
                                `<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(err) {
                        console.log(err)
                    }
                })
            })

         

        $('#stasionform').submit(function(e) {
                e.preventDefault()
                var name = $('#name').val()
                var district_id = $('#district_id').val()
           
                $.ajax({
                    method: 'post',
                    url: '{{ route('stations.store') }}',
                    data: {
                           "_token"  : '{{csrf_token()}}',
                           "name" : name,
                           "district_id" : district_id,
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

 })




</script>
@endpush