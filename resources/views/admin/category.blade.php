@extends("admin.layout.master")
@section('title')
dash
@stop
@section('content')
@include('admin.layout.nav')

 <!-- add modal-->
 <div class="modal fade" id="addcontact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="/category" method="post" enctype="multipart/form-data">
                     @csrf
                     <div class="row">
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="exampleFormControlInput1">Name</label>
                                 <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                                     placeholder="name" required="">
                             </div>
                             <div class="form-group">
                                 <input type="image" id="editmenuu" width="180" height="100"
                                     src="https://static.thenounproject.com/png/749121-200.png" alt=" img" class="">
                                 <div class="input-group p-3">
                                     <div class="custom-file">
                                         <input name="image" type="file" accept="image/*"
                                             onchange="document.getElementById('editmenuu').src = window.URL.createObjectURL(this.files[0])"
                                             required>
                                     </div>
                                 </div>
                             </div>


                         </div>
                     </div>
                     <div class="modal-footer justify-content-between">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-primary">Save changes</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>

<!-- Sub Category Starts -->
<section id="content-wrapper">
     <div class="container">
        <div class="row">
                     <div class="col-md-6">
         <h3>Categories</h3>

         <div class="d-flex justify-content-end my-3">

             <button type="button" class="btn btn-success" data-toggle="modal" 
             data-target="#addcontact"> <i class="fa fa-plus"></i>
             </button>
         </div>

         <div class="container table-responsive ">
             <table class="table table-bordered table-hover">
                 <thead class="thead-dark">
                     <tr>
                        <th scope="col" style="max-width: 80px;overflow-wrap: break-word;">Availability</th>
                         <th scope="col">Code</th>
                         <th scope="col">Name</th>
                         <th scope="col">Image</th>
                         <th scope="col">Action</th>
                     </tr>
                 </thead>
    
                 <tbody style="overflow-wrap: anywhere;">
                     @foreach($category as $cat)
                     <tr>
                         <td>{{$cat->available}}</td>
                         <td>{{$cat->code}}</td>
                         <td>{{$cat->name}}</td>
                         <td><img src="data:image/png;base64,{{$cat->image}}" class="img-fluid" id="adimg"></td>
                         <td>
                             <div class="d-flex">
                                 <button type="button" class="btn-sm btn-primary mr-1" data-toggle="modal"
                                     data-target="#editcont{{$cat->id}}">
                                     <i class="fa fa-edit "></i>
                                 </button>
                                 <button type="button" class="btn-sm btn-danger" data-toggle="modal"
                                     data-target="#deldash{{$cat->id}}">
                                     <i class="fa fa-trash"></i>
                                 </button>
                             </div>
                         </td>
                     </tr>
                     <!--edit modal-->
                     <div class="modal fade" id="editcont{{$cat->id}}" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                         <div class="modal-dialog modal-lg" role="document">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                     </button>
                                 </div>
                                 <div class="modal-body">
                                     <form action="/category/{{$cat->id}}" method="post" enctype="multipart/form-data">
                                         @csrf
                                         {{method_field('PATCH')}}
                                         <div class="row">
                                             <div class="col-md-12">
                                                 <div class="form-group">
                                                     <label for="exampleFormControlInput1">Name</label>
                                                     <input type="text" class="form-control" name="name"
                                                         id="exampleFormControlInput1" value="{{$cat->name}}"
                                                         placeholder="name" required="">
                                                 </div>
                                                 <div class="form-group">
                                                    
                                                     <input type="checkbox" id="available" name="available" @if($cat->available == "on")checked @endif>
                                                     
                                                     <label for="vehicle1"> Availability</label><br>
                                                 
                                                     
                                                 </div>
                                                 <div class="form-group">
                                                     <input type="image" id="addmenuu" width="180" height="100"
                                                         src="data:image/png;base64,{{$cat->image}}" alt=" img"
                                                         class="">
                                                     <div class="input-group p-3">
                                                         <div class="custom-file">
                                                             <input name="image" type="file" accept="image/*"
                                                                 onchange="document.getElementById('addmenuu').src = window.URL.createObjectURL(this.files[0])">
                                                         </div>
                                                     </div>
                                                 </div>


                                             </div>
                                         </div>
                                         <div class="modal-footer justify-content-between">
                                             <button type="button" class="btn btn-secondary"
                                                 data-dismiss="modal">Close</button>
                                             <button type="submit" class="btn btn-primary">Save changes</button>
                                         </div>
                                     </form>
                                 </div>

                             </div>
                         </div>
                     </div>
                     <!-- del modal-->
                     <div class="modal fade" id="deldash{{$cat->id}}" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                         <div class="modal-dialog" role="document">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                     </button>
                                 </div>
                                 <div class="modal-body">
                                     <p>Are you sure you want to delete this item?
                                     </p>
                                 </div>
                                 <form action="/category/{{$cat->id}}" method="post">
                                     @csrf
                                     {{method_field('DELETE')}}
                                     <div class="modal-footer justify-content-between">
                                         <button type="button" class="btn btn-secondary"
                                             data-dismiss="modal">Close</button>
                                         <button type="submit" class="btn btn-primary">Save changes</button>
                                     </div>
                                 </form>
                             </div>
                         </div>
                     </div>
                     @endforeach
                 </tbody>
             </table>
         </div>
</div>
            <div class="col-md-6">
         <h3>Sub Categories</h3>
         <div class="d-flex justify-content-end my-3">
             <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addcontact">

                 <i class="fa fa-plus"></i>
             </button>
         </div>

         <div class="container table-responsive ">
             <table class="table table-bordered table-hover">
                 <thead class="thead-dark">
                     <tr>
                         <th scope="col">Code</th>
                         <th scope="col">Name</th>
                         <th scope="col">Category</th>
                         <th scope="col">Action</th>
                     </tr>
                 </thead>
    
                 <tbody style="overflow-wrap: anywhere;">
                     @foreach($sub as $sub)
                     <tr>
                         <td>{{$sub->code}}</td>
                         <td>{{$sub->name}}</td>
                         <td>{{$sub->category->name}}</td>
                         <td>
                             <div class="d-flex">
                                <a type="button" class="btn-sm btn-primary mr-1" href="
                                /subcategory/{{$sub->id}}"> <i class="fa fa-info "></i>
                                </a>
                                <button type="button" class="btn-sm btn-primary mr-1" data-toggle="modal" data-target="#editcont{{$sub->id}}">
                                     <i class="fa fa-edit "></i>
                                </button>
                                <button type="button" class="btn-sm btn-danger" data-toggle="modal" data-target="#deldash{{$sub->id}}">
                                     <i class="fa fa-trash"></i>
                                </button>
                             </div>
                         </td>
                     </tr>
                     <!--edit modal-->
                     <div class="modal fade" id="editcont{{$sub->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                         <div class="modal-dialog modal-lg" role="document">
                             <div class="modal-content">
                                <div class="modal-header">
                                     <h5 class="modal-title" id="exampleModalLabel">Edit Sub Category</h5>
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                     </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="/subcategory/{{$sub->id}}">
                                         @csrf
                                         {{method_field('PATCH')}}
                                         <div class="row">
                                             <div class="col-md-12">
                                                 <div class="form-group">
                                                     <label for="exampleFormControlInput1">Name</label>
                                                     <input type="text" name="name" value="{{$sub->name}}"
                                                         class="form-control" id="exampleFormControlInput1"
                                                         placeholder="name" required="">
                                                 </div>
                                                 <div class="form-group">
                                                     <label for="cars">Category </label>
                                                     <select id="cars" name="category_id" required class="form-control">
                                                         @foreach($category as $cat)
                                                         <option value="{{$cat->id}}"
                                                             {{$sub->category_id == $cat->id  ? 'selected' : ''}}>
                                                             {{$cat->name}}</option>
                                                         @endforeach
                                                     </select>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="modal-footer justify-content-between">
                                             <button type="button" class="btn btn-secondary"
                                                 data-dismiss="modal">Close</button>
                                             <button type="submit" class="btn btn-primary">Save changes</button>
                                         </div>
                                     </form>
                                 </div>

                             </div>
                         </div>
                     </div>
                     <!-- del modal-->
                     <div class="modal fade" id="deldash{{$sub->id}}" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                         <div class="modal-dialog" role="document">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                     </button>
                                 </div>
                                 <div class="modal-body">
                                     <p>Are you sure you want to delete this item?

                                     </p>

                                 </div>
                                 <form action="/subcategory/{{$sub->id}}" method="post">
                                     @csrf
                                     {{method_field('DELETE')}}
                                     <div class="modal-footer justify-content-between">
                                         <button type="button" class="btn btn-secondary"
                                             data-dismiss="modal">Close</button>
                                         <button type="submit" class="btn btn-primary">Save changes</button>
                                     </div>
                                 </form>
                             </div>
                         </div>
                     </div>
                     @endforeach
                 </tbody>
             </table>
         </div>
</div>
</div>

     </div>
 </section>
 <!-- -------------------------------modal --------------------------------->


 <!-- add modal-->
 <div class="modal fade" id="addcontact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Add Sub Category</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="/subcategory" method="post">
                     @csrf
                     <div class="row">
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="exampleFormControlInput1">Name</label>
                                 <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                                     placeholder="name" required="">
                             </div>
                             <div class="form-group">
                                 <label for="cars">Category</label>
                                 <select id="cars" name="category_id" required class="form-control">
                                     <option value="">Choose....</option>
                                     @foreach($category as $cat)
                                     <option value="{{$cat->id}}">{{$cat->name}}</option>
                                     @endforeach
                                 </select>
                             </div>
                         </div>
                     </div>
                     <div class="modal-footer justify-content-between">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-primary">Save changes</button>
                     </div>
                 </form>
             </div>

         </div>
     </div>
 </div>
<!-- Sub Category Ends -->
 @stop