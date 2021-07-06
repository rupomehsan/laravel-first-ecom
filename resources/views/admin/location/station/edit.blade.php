@extends('layouts.admin')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">edit stasion</h1>
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


                <form id="stationedit">
                    <div class="form-group">
                        <label for="">Edit stasion</label>
                        <input type="hidden" name="" id="station_id" value="{{$station->id}}">
                        <input type="text" id="name" name="name" class="form-control" value="{{$station->name}}">
    
                    </div>
                    <div class="form-group">
                        <label for="">Division</label>
                          <select name="division_id" id="division_id" class="form-control">
                           <option selected disabled>Select Division</option>
                           @foreach ($divisions as $division)
                           <option value="{{$division->id}}" {{$station->district->division_id === $division->id?'selected':''}}>{{$division->name}}</option>
                           @endforeach 
                       </select>
    
                        </div>
                        <div class="form-group">
                            <label for="">District</label>
                              <select name="district_id" id="district_id" class="form-control">
                               <option selected disabled>Select District</option>
                               @foreach ($districts as $district)
                               <option value="{{$district->id}}" {{$station->district_id=== $district->id?'selected':''}}>{{$district->name}}</option>
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

            $('#stationedit').submit(function(e) {
                    e.preventDefault()
                    var name = $('#name').val()
                    var district_id = $('#district_id').val()
                    var station_id = $('#station_id').val()
                    console.log(district_id)
                    $.ajax({
                        method: 'post',
                        url: '{{ url('admin/stations') }}/' + station_id,
                        data   :{
                                "_token"  : '{{csrf_token()}}',
                                "name"    : name,
                                "district_id" : district_id,
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
                                "<option disabled selected>Select Sub Category</option>")
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

                

         

            })


          

      

</script>
@endpush