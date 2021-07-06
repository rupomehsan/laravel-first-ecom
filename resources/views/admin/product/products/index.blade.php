@extends('layouts.admin')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h3 class="mt-4">All Products</h3>
         
        
           
            
        </div>
        <div class="container justify-content-center">
           <table class="table">
               <thead>
                   <tr>
                       <th>No</th>
                       <th>Name</th>
                       <th>Descp</th>
                       <th>Price</th> 
                       <th>Category</th>
                       <th>Sub_Category</th>
                       <th>Brand</th> 
                       <th>Image</th> 
                       <th>Status</th>
                       <th>Action</th>
                   </tr>
               </thead>
               <tbody>
                @if (count($products))
                    @foreach ($products as $product)
                    <tr>
                        <td>{{$loop->iteration}}</td>

                        <td>{{$product->name}}</td>
                        <td>{!!$product->description!!}</td> 
                        <td>{{$product->price}}</td>
                        <td>{{$product->category->name}}</td>
                        <td>{{$product->subcategory->name}}</td>
                        <td>{{$product->brand->name}}</td>
                        <td><img src="{{ asset($product->image_1) }}" alt="" height="60" width="80"></td>
                        <td>{{$product->status}}</td>
                   
                         
                        <td>
                            <a href="{{route('products.edit', ['product' => $product->id])}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                            <button type="submit" onclick="delItem({{ $product->id }})" class="btn btn-warning"><i class="fa fa-trash"></i></button>
                        </td>
                       </tr>
                    @endforeach
                   
                @else
                <td colspan="4" class="text-color-primary">Data Not Found</td>
                @endif
               
               
               </tbody>
              
           </table>
         
        </div>
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>  
    </main>
@endsection

<script>
    function delItem(id){
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if(result.isConfirmed){
                $.ajax({

                        method : 'post',
                        url    : '{{url('/admin/products')}}/'+id,
                        data   :{
                            "_token"  : '{{csrf_token()}}',
                            "_method" : 'DELETE',
                            "id"     :id
                        },

                        success :function(res){
                                Swal.fire(
                                'Deleted!',
                                res.message,
                                'success'
                                )
                                setTimeout(() => {
                        window.location.reload()
                    }, 1000);
                        },
                        error :function(err){
                            console.log(err)
                        }


                 })
            }
       

       
        })


    }
  

</script>