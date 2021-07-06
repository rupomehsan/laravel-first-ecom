@extends('layouts.admin')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Edit Product</h1> 
        </div>
        <div class="container justify-content-center">
            <div class="col-md-12">
                @if (Session::has('message'))
                    <div class="alert alert-success">
                        {{Session::get('message')}}
                    </div>
                @endif


                <form id="productForm" action="" method="post" enctype="multipart/form-data">
                  
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="hidden" id="product_id" name="product_id" class="form-control" value="{{$product->id}}">
                                <label for="">Product name</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{$product->name}}">
        
                           
        
                            </div>
                         
                            <div class="form-group">
                              <label for="">Product Category</label>
                            <select name="category_id" id="category_id" class="form-control">
                               <option  disabled selected>Select Category</option>
                               @foreach ($categorys as $category)

                               <option value="{{$category->id}}" {{$product->category_id === $category->id ? 'selected':'' }}> {{$category->name}}</option>
                               @endforeach
                               
                            </select>
        
                           
        
                            </div>
                            <div class="form-group">
                                <label for="">Product sub_Category</label>
                              <select name="sub_category_id" id="sub_category_id" class="form-control">
                               <option disabled selected>Select Category</option>
                           </select>
        
                          
        
                            </div>
                            <div class="form-group">
                                <label for="">Price</label>
                            <input type="text" id="price" name="price" class="form-control" value="{{$product->price}}">
        
                         
        
                            </div>
                            <div class="form-group">
                                <label for="">Product Type</label>
                              <select name="product_type" id="product_type" class="form-control">
                               <option disabled selected>Select Category</option>
                               <option value="Featured" {{$product->product_type == 'Featured'?'selected':''}}>Featured</option>    
                              
                             
                               <option value="Nonfeatured"{{$product->product_type == 'Nonfeatured'?'selected':''}}>Nonfeatured</option>
                             
                               <option value="Recommonded" {{$product->product_type == 'Recommonded'?'selected':''}}>Recommonded</option>
                            
                        
                              
                           </select>
        
                    
                            </div>
                          
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="">Code</label>
                            <input type="text" id="code" name="code" class="form-control"  value="{{$product->code}}">
                            </div>
                            <div class="form-group">
                                <label for="">Product Brand</label>
                           <select name="brand_id" id="brand_id"  class="form-control">
                               <option disabled selected>Select Brand</option>
                               @foreach ($brands as $brand)
                               <option value="{{$brand->id}}" {{$product->brand_id === $brand->id ? 'selected':''}}> {{$brand->name}}</option>
                               @endforeach  
                           </select>
        
        
                        
                            </div>
                            <div class="form-group">
                                <label for="">Promo code</label>
                            <input type="text" id="promo_code" name="promo_code" class="form-control" value="{{$product->promo_code_id}}">
        
                           
                            </div>
                            <div class="form-group">
                                <label for="">Stock</label>
                            <input type="number" id="stock" name="stock" class="form-control" value="{{$product->stock}}">
        
                  
                            </div>

                            <div class="form-group">
                                <label for="">Product Tags</label>
                            <input type="text" id="tags" name="tags" class="form-control" value="{{$product->tags}}">
        
                  
                            </div>
                       
                        </div>
                        <div class="col-md-4">
                           
                            <div class="form-group">
                                <label for="">Product image</label><br>
                             <img src="{{ asset($product->image_1) }}" alt="" height="60" width="80"></td>
                             <input type="file" id="image_1" name="image_1" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="">Product gallery image</label><br>
                                <img src="{{ asset($product->image_2) }}" alt="" height="60" width="80"></td>
                             <input type="file"id="image_2" name="image_2" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="">Product gallery image</label><br>
                                <img src="{{ asset($product->image_3) }}" alt="" height="60" width="80"></td>
                             <input type="file"id="image_3" name="image_3" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="">Product gallery image</label><br>
                                <img src="{{ asset($product->image_4) }}" alt="" height="60" width="80"></td>
                             <input type="file"id="image_4" name="image_4" class="form-control" value="">
                            </div>    
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                           
                            <label for="description">Product descripsion</label>
                            <textarea name="description" id="description" rows="10"
                                class="form-control descriptionBox">{{$product->description}}</textarea>
                            
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success sm">submit</button>
                  </form>
            </div>
        </div>
    
    </main>

    
    <div id="ModalbrandForm" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Add Brand</h1>
                </div>
                <div class="modal-body">
                    <form id="brandform">
                        <div class="form-group">
                            <label for="">Create brand</label>
                            <input type="text" id="brand_name" name="brand_name" class="form-control" placeholder="enter name">
                            @error('name')
                                <div class="text-danger">
                                    <strong>{{$message}}</strong>
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                  
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <div id="ModalcategoryForm" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Add Category</h1>
                </div>
                <div class="modal-body">
                    <form id="catform">
                    
                        <div class="form-group">
                            <label for="">Category Name</label>
                            <input type="text" id="cat_name" name="name" class="form-control" placeholder="enter name">
                           
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                  
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection


@push('customjs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.6.2/tinymce.min.js"></script>
<script>
     tinymce.init({
            selector: '.descriptionBox'
        })

        var productId = '{{ $product->id }}'
        var productSubCategoryId = '{{ $product->sub_category_id }}'

        $.ajax({
            method: 'get',
            url: '{{ url('api/sub-categories') }}/' + $('#category_id').val(),
            dataType: 'json',
            success: function(res) {
                console.log(res)

                $('#sub_category_id').empty()
                $('#sub_category_id').append("<option disabled selected>Select Sub Category</option>")
                res.subCategories.forEach(function(item) {
                    $('#sub_category_id').append(
                        `<option value="${item.id}"
                    ${parseInt(productSubCategoryId) === item.id ? 'selected' : ''}
                    >${item.name}</option>
                `)
                })
            },
            error: function(err) {
                console.log(err)
            }
        })

 $(document).ready(function() {
        var image_1 = null;
        var image_2 = null;
        var image_3 = null;
        var image_4 = null;

            $('#category_id').change(function(e) {
                var category_id = $(this).val()

                $.ajax({
                    method: 'get',
                    url: '{{ url('api/sub-categories') }}/' + category_id,
                    dataType: 'json',
                    success: function(res) {
                        console.log(res)

                        $('#sub_category_id').empty()
                        $('#sub_category_id').append(
                            "<option disabled selected>Select Sub Category</option>")
                        res.subCategories.forEach(function(item) {
                            $('#sub_category_id').append(
                                `<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(err) {
                        console.log(err)
                    }
                })
            })

            $('#image_1').change(function(e) {
                image_1 = e.target.files[0]
            })

            $('#image_2').change(function(e) {
                image_2 = e.target.files[0]
            })

            $('#image_3').change(function(e) {
                image_3 = e.target.files[0]
            })

            $('#image_4').change(function(e) {
                image_4 = e.target.files[0]
            })


        $('#productForm').submit(function(e) {
                e.preventDefault()
                var name = $('#name').val()
                var product_id = $('#product_id').val()
                var category_id = $('#category_id').val()
                var sub_category_id = $('#sub_category_id').val()
                var stock = $('#stock').val()
                var price = $('#price').val()
                var description = $('#description').val()
                var tags = $('#tags').val()
                var brand_id = $('#brand_id').val()
                var product_type = $('#product_type').val()
                var code = $('#code').val()
                var promo_code = $('#promo_code').val() || ''
             
            
                var formData = new FormData()
                formData.append('_token', '{{ csrf_token() }}')
                formData.append('_method', 'PATCH')
                formData.append('name', name)
                formData.append('category_id', category_id)
                formData.append('sub_category_id', sub_category_id)
                formData.append('price', price)
                formData.append('stock', stock)
                formData.append('description', description)
                formData.append('tags', tags)
                formData.append('brand_id', brand_id)
                formData.append('product_type', product_type)
                formData.append('code',code)
                formData.append('promo_code',promo_code)
                formData.append('image_1', image_1)
                formData.append('image_2', image_2)
                formData.append('image_3', image_3)
                formData.append('image_4', image_4)

               

                $.ajax({
                    method: 'post',
                    url: '{{ url('admin/products') }}/' + product_id,
                    data:formData, 
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        console.log(res)
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

 })




</script>
@endpush
