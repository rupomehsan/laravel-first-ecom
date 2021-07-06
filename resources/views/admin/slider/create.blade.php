@extends('layouts.admin')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Add Slider</h1>    
        </div>
        
        <div class="container justify-content-center">
            <div class="col-md-6">
                <form id="sliderForm" >
                    @csrf
                    <div class="form-group">
                        <label for="">Slider Heading</label>
                        <input type="text" id="heading" name="heading" class="form-control" placeholder="enter Heading">
                    </div>
                    <div class="form-group">
                        <label for="">Slider Title</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="enter Title">
                    </div>
                    <div class="form-group">
                        <label for="">Slider image</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Slider Description</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control descriptionBox"></textarea>
                        
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
     tinymce.init({
            selector: '.descriptionBox'
        })
       

 $(document).ready(function() {
        var image= null;

            $('#image').change(function(e) {
                image = e.target.files[0]
            })

        $('#sliderForm').submit(function(e) {
                e.preventDefault()
                var heading = $('#heading').val()
                var title = $('#title').val()
                var description = $('#description').val()

                var formData = new FormData()

                formData.append('_token', '{{ csrf_token() }}')
                formData.append('heading', heading)
                formData.append('title', title)
                formData.append('description', description)
                if(image){
                    formData.append('image', image)
                }
                

                $.ajax({
                    method: 'post',
                    url: '{{ route('sliders.store') }}',
                    data: formData,
                    processData: false,
                    contentType: false,
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