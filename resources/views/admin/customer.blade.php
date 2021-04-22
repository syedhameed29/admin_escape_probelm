 @extends("admin.layout.master")
 @section('title')
 dash
 @stop
 @section('content')
 @include('admin.layout.nav')

 <section id="content-wrapper">
     <div class="container">
         <h3>Customer</h3>
         <div class="d-flex justify-content-end my-3">
         </div>
         <div class="container table-responsive ">
             <table class="table table-bordered table-hover">
                 <thead class="thead-dark">
                     <tr>
                        <th scope="col">Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Email Address</th>
                        <th scope="col">Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach($customer as $customer)
                     <tr>
                        <td>{{$customer->code}}</td>
                        <td>{{$customer->name}}</td>
                        <td>{{$customer->mobile}}</td>
                        <td>{{$customer->email}}</td>
                        <td><div class="d-flex">
                                 <a type="button" class="btn btn-primary mr-2" href="/customer/{{$customer->id}}">
                                     <i class="fa fa-info "></i>
                                 </a>
                                 <button type="button" class="btn btn-danger" data-toggle="modal"
                                     data-target="#">
                                     <i class="fa fa-trash"></i>
                                 </button>
                             </div></td>
                     </tr>

                     @endforeach
                 </tbody>
             </table>
         </div>

     </div>
 </section>
 <!-- -------------------------------modal --------------------------------->
 @stop