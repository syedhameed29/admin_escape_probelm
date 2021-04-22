 @extends("admin.layout.master")
 @section('title')
 dash
 @stop
 @section('content')
 @include('admin.layout.nav')
 <section id="content-wrapper">
     <div class="container">
         <h3>Partners</h3>
         <div class="d-flex justify-content-end my-3">
         </div>
         <div class="container table-responsive ">
             <table class="table table-bordered table-hover">
                 <thead class="thead-dark">
                     <tr>
                         <th scope="col">Name</th>
                         <th scope="col">Mobile</th>
                         <th scope="col">Email Address</th>
                         <th scope="col"> Address</th>
                         <th scope="col">District</th>
                         <th scope="col"> State</th>
                         <th scope="col">Country</th>
                         <th scope="col">Status</th>
                         <th scope="col"> Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach($partner as $partner)

                     <tr>
                         <td>{{$partner->name}}</td>
                         <td>{{$partner->mobile}}</td>
                         <td>{{$partner->email}}</td>
                         <td>{{$partner->address}}</td>
                         <td>{{$partner->district}}</td>
                         <td>{{$partner->state}}</td>
                         <td>{{$partner->country}}</td>
                         <td>{{$partner->status}}</td>
                         <td>
                             <div class="d-flex">
                                 <button type="button" class="btn btn-primary mr-2" data-toggle="modal"
                                     data-target="#editcont">
                                     <i class="fa fa-edit "></i>
                                 </button>
                             </div>
                         </td>
                     </tr>

                     <!-- edit modal-->
                     <div class="modal fade" id="editcont" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                         <div class="modal-dialog modal-sm" role="document">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h5 class="modal-title" id="exampleModalLabel">Edit Partner</h5>
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                     </button>
                                 </div>
                                 <form method="post" action="/partner/{{$partner->id}}">
                                     @csrf
                                     {{method_field('PATCH')}}
                                     <div class="modal-body">
                                         <div class="row">
                                             <div class="col-md-12">
                                                 <div class="form-group">
                                                     <label for="exampleFormControlInput1">Status</label>
                                                     <select name="status" class="form-control" placeholder="name"
                                                         required="">
                                                         @if($partner->status=='approved')
                                                         <option value="approved">Approved</option>
                                                         <option value="rejected">Rejected</option>
                                                         @else
                                                         <option value="rejected">Rejected</option>
                                                         <option value="approved">Approved</option>
                                                         @endif

                                                     </select>
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
                     @endforeach


                 </tbody>
             </table>
         </div>

     </div>
 </section>
 <!-- -------------------------------modal --------------------------------->
 @stop