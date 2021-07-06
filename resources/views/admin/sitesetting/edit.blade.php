@extends('layouts.admin')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h3 class="mt-4">Site Setting</h3>    
        </div>
        
        <div class="container justify-content-center">
            
                <form id="sitesettingForm"  >

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Site Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="enter Heading" value="{{$sitesetting->title}}">
                        </div>
                        <div class="form-group">
                            <label for="">Site Email</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="enter Title" value="{{$sitesetting->email}}">
                        </div>
                        <div class="form-group">
                            <label for="">Site phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="enter Title" value="{{$sitesetting->phone}}">
                        </div>
                        <div class="form-group">
                            <label for="">Site Fb_LInk</label>
                            <input type="text" name="fb_link" id="fb_link" class="form-control" placeholder="enter Description" value="{{$sitesetting->fb_link}}">
                        </div>
                        <div class="form-group">
                            <label for="">Site Logo</label><br>
                            <img src="{{asset($sitesetting->logo)}}" alt="" height="60" width="90">
                            <input type="file" name="site_logo" id="site_logo" class="form-control" >
                        </div>
                    </div>

                    <div class="col-md-6">
 
                        <div class="form-group">
                            <label for="">Site twi_link</label>
                            <input type="text" name="twitter_link" id="twitter_link" class="form-control" placeholder="enter Description" value="{{$sitesetting->twitter_link}}">
                        </div>
                        <div class="form-group">
                            <label for="">Site YT_Link</label>
                            <input type="text" name="youtube_link" id="youtube_link" class="form-control" placeholder="enter Description" value="{{$sitesetting->youtube_link}}">
                        </div>
                        <div class="form-group">
                            <label for="">Site Copyright</label>
                            <input type="text" name="copyright" id="copyright" class="form-control" placeholder="enter Description" value="{{$sitesetting->copyright}}">
                        </div>
                        <div class="form-group">
                            <label for="">Site Address</label>
                            <input type="text" name="address" id="address" class="form-control" placeholder="enter Description" value="{{$sitesetting->address}}">
                        </div>
                       
                    </div>
                  
                  
                   
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
                </form>

             
          
        </div>
    </main>
@endsection
@push('customjs')

<script>
   
 $(document).ready(function() {
        var site_logo= null;

            $('#site_logo').change(function(e) {
                site_logo = e.target.files[0]
            })

        $('#sitesettingForm').submit(function(e) {
                e.preventDefault()
                var title = $('#title').val()
                var email = $('#email').val()
                var phone = $('#phone').val()
                var fb_link = $('#fb_link').val()
                var twitter_link = $('#twitter_link').val()
                var youtube_link = $('#youtube_link').val()
                var copyright = $('#copyright').val()
                var address = $('#address').val()
              
                var formData = new FormData()

                formData.append('_token', '{{ csrf_token() }}')
                formData.append('_method', 'PATCH')
                formData.append('title', title)
                formData.append('email', email)
                formData.append('phone', phone)
                formData.append('fb_link', fb_link)
                formData.append('twitter_link', twitter_link)
                formData.append('youtube_link', youtube_link)
                formData.append('copyright', copyright)
                formData.append('address', address)
                if(site_logo){
                    formData.append('site_logo', site_logo)
                }

                $.ajax({
                    method: 'post',
                    url: '{{ url('admin/sitesettings') }}/' + 1,
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