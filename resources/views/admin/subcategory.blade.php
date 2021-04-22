 @extends("admin.layout.master")
 @section('title')
 dash
 @stop
 @section('content')
 @include('admin.layout.nav')

 <section id="content-wrapper">
     <div class="container">
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
                 <tbody>
                     @foreach($sub as $sub)
                     <tr>
                         <td>{{$sub->code}}</td>
                         <td>{{$sub->name}}</td>
                         <td>{{$sub->category->name}}</td>
                         <td>
                             <div class="d-flex">
                                <a type="button" class="btn btn-primary mr-2" href="
                                /subcategory/{{$sub->id}}">
                                     <i class="fa fa-info "></i>
                                </a>
                                <button type="button" class="btn btn-primary mr-2" data-toggle="modal"
                                     data-target="#editcont{{$sub->id}}">
                                     <i class="fa fa-edit "></i>
                                </button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deldash{{$sub->id}}">
                                     <i class="fa fa-trash"></i>
                                </button>
                             </div>
                         </td>
                     </tr>
                     <!--edit modal-->
                     <div class="modal fade" id="editcont{{$sub->id}}" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
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

 @stop