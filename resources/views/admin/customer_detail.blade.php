 @extends("admin.layout.master")
 @section('title')
 dash
 @stop
 @section('content')
 @include('admin.layout.nav')

 <section id="content-wrapper">
     <div class="container">
     	<h5>{{$customer->name}}</h5>
         <h3>Addresses</h3>
         <div class="d-flex justify-content-end my-3">
         </div>
         <div class="container table-responsive ">
             <table class="table table-bordered table-hover">
                 <thead class="thead-dark">
                     <tr>
                        <th scope="col">Code</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Address</th>
                        <th scope="col">Location</th>
                        <th scope="col">Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach($customer_address as $addresses)
                     <tr>
                        <td>{{$addresses->code}}</td>
                        <td>{{$addresses->mobile}}</td>
                        <td>{{$addresses->address}}</td>
                        <td>{{$addresses->district}}, {{$addresses->state}}, {{$addresses->country}}</td>
                        <td><div class="d-flex">
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