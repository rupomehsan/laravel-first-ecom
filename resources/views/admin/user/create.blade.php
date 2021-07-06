@extends('layouts.admin')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Add User</h1>
            
        </div>
        <div class="container justify-content-center">
            <div class="col-md-6">
                <form id="userForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="text">Create User Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="enter user name">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="enter Email address">
    
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="enter your password">
        
                            </div>
                    <div class="form-group">
                    <label for="">User Role</label>
                      <select name="role_id" id="role_id" class="form-control">
                       <option selected disabled>Select Role</option>
                       @foreach ($roles as $role)
                       <option value="{{$role->id}}">{{$role->name}}</option>
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
    
       

 $(document).ready(function() {

        $('#userForm').submit(function(e) {
                e.preventDefault()
                var name = $('#name').val()
                var email = $('#email').val()
                var password = $('#password').val()
                var role_id = $('#role_id').val()

                $.ajax({
                    method: 'post',
                    url: '{{route('users.store')}}',
                    data   :{
                           "_token"  : '{{csrf_token()}}',
                           "name"    : name,
                           "email"    : email,
                           "password"    : password,
                           "role_id" : role_id,
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
                                text: 'Validation Error',
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