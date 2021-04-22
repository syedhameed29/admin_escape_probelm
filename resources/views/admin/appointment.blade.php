 @extends("admin.layout.master")
 @section('title')
 dash
 @stop
 @section('content')
 @include('admin.layout.nav')

 <section id="content-wrapper">
     <div class="container">
         <h3>Appointments</h3>
         <div class="d-flex justify-content-end my-3">
         </div>
         <div class="container table-responsive ">
             <table class="table table-bordered table-hover">
                 <thead class="thead-dark">
                     <tr>
                         <th scope="col">Customer Name</th>
                         <th scope="col">Customer Area</th>
                         <th scope="col">Booking Address</th>
                         <th scope="col">Category</th>
                         <th scope="col">Sub-Category</th>
                         <th scope="col">Service</th>
                         <th scope="col">Partner Name</th>
                         <th scope="col">Amount</th>
                         <th scope="col">Status</th>
                         <!-- <th scope="col"> Action
                         </th> -->
                     </tr>
                 </thead>
                 <tbody>
                     @foreach($appointment as $appointment)
                     <tr>
                         <td>{{$appointment->customer->name}}</td>
                         <td>{{$appointment->customer->district}},{{$appointment->customer->state}},{{$appointment->customer->country}}
                         </td>
                         <td>{{$appointment->service->sub->category->name}}</td>
                         <td>{{$appointment->service->sub->name}}</td>
                         <td>{{$appointment->service->name}}</td>
                         <td>{{$appointment->partner->name}}</td>
                         <td>{{$appointment->service->amount}}</td>
                         <td>{{$appointment->status}}</td>
                         <!-- <td>
                             <div class="d-flex">
                                 <button type="button" class="btn btn-primary mr-2" data-toggle="modal"
                                     data-target="#editcont">
                                     <i class="fa fa-edit "></i>
                                 </button>
                                 <button type="button" class="btn btn-danger" data-toggle="modal"
                                     data-target="#deldash">
                                     <i class="fa fa-trash"></i>
                                 </button>
                             </div>
                         </td> -->
                     </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>

     </div>
 </section>
 <!-- -------------------------------modal --------------------------------->


 <!--edit modal-->
 <div class="modal fade" id="editcont" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Edit Appointments</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form>
                     <div class="row">
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label>User Name</label>
                                 <input type="text" class="form-control" id="exampleFormControlInput1"
                                     placeholder="name" required="">
                             </div>
                             <div class="form-group">
                                 <label>Service</label>
                                 <input type="text" class="form-control" id="exampleFormControlInput1"
                                     placeholder="name" required="">
                             </div>
                             <div class="form-group">
                                 <label>Sub-Service </label>
                                 <select id="cars" name="cars" class="form-control">
                                     <option value="volvo">Volvo XC90</option>
                                     <option value="saab">Saab 95</option>
                                     <option value="mercedes">Mercedes SLK</option>
                                     <option value="audi">Audi TT</option>
                                 </select>
                             </div>
                             <div class="form-group">
                                 <label>Status </label>
                                 <select id="cars" name="cars" class="form-control">
                                     <option value="Requested">Requested</option>
                                     <option value="Processing">Processing</option>
                                     <option value="Finished">Finished</option>
                                 </select>
                             </div>
                             <div class="form-group">
                                 <label>Amount</label>
                                 <input type="number" class="form-control" id="exampleFormControlInput1"
                                     placeholder="Amount" required="">
                             </div>

                         </div>
                     </div>
                 </form>
             </div>
             <div class="modal-footer justify-content-between">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="button" class="btn btn-primary">Save changes</button>
             </div>
         </div>
     </div>
 </div>
 <!-- del modal-->
 <div class="modal fade" id="deldash" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
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
             <div class="modal-footer justify-content-between">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="button" class="btn btn-primary">Save changes</button>
             </div>
         </div>
     </div>
 </div>
 @stop