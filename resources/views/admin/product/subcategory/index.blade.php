@extends('layouts.admin')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h3 class="mt-4">All Sub_Category list</h3>       
        </div>
        <div class="container justify-content-center">
           <table class="table">
               <thead>
                   <tr>
                    <tr>
                        <th>No</th>
                        <th>Sub_category Name</th>
                        <th>Category Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                   </tr>
               </thead>
               <tbody>
                   @if (count($subcategorys))
                    @foreach ($subcategorys as $subcategory)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$subcategory->name}}</td>
                        <td>{{$subcategory->category->name}}</td>
                        <td>{{$subcategory->status}}</td>
                        <td>
                            <a href="{{route('subcategories.edit',['subcategory'=>$subcategory->id])}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                            <button type="submit" onclick="delsub_cat({{$subcategory->id}})" class="btn btn-warning"><i class="fa fa-trash"></i></button>
                        </td>
                       </tr>
                    @endforeach
                   @else
                   <td colspan="4" class="text-color-primary">Data Not Found</td>
                   @endif
                
                 
               </tbody>
           </table>
        </div>
    </main>
@endsection

<script>
    function delsub_cat(id){
      console.log(id)
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
                        url    : '{{url('/admin/subcategories')}}/'+id,
                        data   :{
                            "_token"  : '{{csrf_token()}}',
                            "_method" : 'DELETE',
                            "id"     :id
                        },

                        success :function(res){
                          
                                Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
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