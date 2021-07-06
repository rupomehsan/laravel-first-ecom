@extends('layouts.admin')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h3 class="mt-4">Edit Sub_Category</h3>
             
        </div>
        <div class="container justify-content-center">
            <div class="col-md-6">
    

                <form id="sucateditform" >
                    <div class="form-group">
                        <label for="">Create Sub_category</label>
                        <input type="hidden" id="sub_category_id" value="{{$subcategory->id}}">
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter Category name" value="{{$subcategory->name}}">
                    </div>
                    <div class="form-group">
                        <label for="">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option selected disabled>select category</option>
                            @foreach ($categorys as $category)
                            <option value="{{$category->id}}" {{$subcategory->category_id === $category->id ? 'selected':'' }}>{{$category->name}}</option>
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
        $('#sucateditform').on('submit', function(e) {
            e.preventDefault()
            var name = $('#name').val()
            var category_id = $('#category_id').val()
            var sub_category_id = $('#sub_category_id').val()
            if (!name.length) {
                Swal.fire({
                    title: 'Validation Error',
                    text: "Name field is required",
                    icon: 'error',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                })
              
            } else {
                $.ajax({
                    method: 'post',
                    url: '{{ url('admin/subcategories') }}/' + sub_category_id,
                   data   :{
                           "_token"  : '{{csrf_token()}}',
                           "name"    :    name,
                           "category_id" : category_id,
                           "_method" : 'PATCH',
                       },
                    success: function(res) {
                        console.log(res)
                        $('#name').empty()
                        Swal.fire({
                            title: 'Success',
                            text: res.message,
                            icon: 'success',
                            showCancelButton: true,
                            cancelButtonColor: '#d33',
                        })
                        setTimeout(() => {
                            window.location.reload()
                        }, 1000);
                    },
                    error: function(err) {
                        console.log(err)
                    }
                })
            }
        })

    </script>
@endpush
