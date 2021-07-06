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


                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="">edit stasion</label>
                        <input type="text" name="name" class="form-control" value="">
                        {{-- @error('name')
                            <div class="text-danger">
                                <strong>{{$message}}</strong>
                            </div>
                        @enderror --}}
                    </div>
                    <div class="form-group">
                        <label for="">stasion</label>
                          <select name="" id="" class="form-control">
                           <option value="">Select stasion</option>
                           <option value=""> dhaka</option>
                       </select>
    
                        </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </main>
@endsection