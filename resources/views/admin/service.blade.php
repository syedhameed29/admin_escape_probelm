@extends("admin.layout.master")
@section('title')
dash
@stop
@section('content')
@include('admin.layout.nav')

<section id="content-wrapper">
    <div class="container">
        <h3>Services</h3>

        <div class="d-flex justify-content-end my-3">

            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addservice">

                <i class="fa fa-plus"></i>
            </button>
        </div>

        <div class="container table-responsive ">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Sub Service</th>
                        <th scope="col">Description</th>
                        <th scope="col">Amount</th>
                        <th scope="col"> Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($service as $ser )
                    <tr>
                        <td>{{$ser->code}}</td>
                        <td>{{$ser->name}}</td>
                        <td><img src="data:image/png;base64,{{$ser->image}}" class="img-fluid" id="adimg"></td>
                        <td>{{$ser->sub->name}}</td>
                        <td>{{$ser->description}}</td>
                        <td>{{$ser->amount}}</td>
                        <td>
                            <div class="d-flex">
                                <button type="button" class="btn btn-primary mr-2" data-toggle="modal"
                                    data-target="#editcont{{$ser->id}}">
                                    <i class="fa fa-edit "></i>
                                </button>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#deldash{{$ser->id}}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!--edit modal-->
                    <div class="modal fade" id="editcont{{$ser->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/service/{{$ser->id}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        {{method_field('PATCH')}}
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">Name</label>
                                                    <input type="text" name="name" value="{{$ser->name}}"
                                                        class="form-control" id="exampleFormControlInput1"
                                                        placeholder="name" required="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="cars">Sub Category</label>
                                                    <select id="cars" name="sub_id" required class="form-control">
                                                        @foreach($sub as $subcat)
                                                        <option value="{{$subcat->id}}"
                                                            {{$ser->sub_id == $subcat->id  ? 'selected' : ''}}>
                                                            {{$subcat->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <input type="image" id="editmenu" width="180" height="100"
                                                        src="data:image/png;base64,{{$ser->image}}" alt=" img" class="">
                                                    <div class="input-group p-3">
                                                        <div class="custom-file">
                                                            <input name="image" type="file" accept="image/*"
                                                                onchange="document.getElementById('editmenu').src = window.URL.createObjectURL(this.files[0])">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">Amount</label>
                                                    <input type="text" name="amount" value="{{$ser->amount}}"
                                                        class="form-control" id="exampleFormControlInput1"
                                                        placeholder="name" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Description</label>
                                            <textarea type="text" name="description" class="form-control"
                                                id="exampleFormControlInput1" placeholder="name"
                                                required="">{{$ser->description}}</textarea>
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
                    <div class="modal fade" id="deldash{{$ser->id}}" tabindex="-1" role="dialog"
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
                                <form action="/service/{{$ser->id}}" method="post">
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
<div class="modal fade" id="addservice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/service" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Name</label>
                                <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Name" required="">
                            </div>
                            <div class="form-group">
                                <label for="cars">Sub Category</label>
                                <select id="cars" name="sub_id" required class="form-control">
                                    <option value="">Choose....</option>
                                    @foreach($sub as $sub)
                                    <option value="{{$sub->id}}">{{$sub->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="image" id="editmenuu" width="180" height="100"
                                    src="https://static.thenounproject.com/png/749121-200.png" alt=" img" class="">
                                <div class="input-group p-3">
                                    <div class="custom-file">
                                        <input name="image" type="file" accept="image/*"
                                            onchange="document.getElementById('editmenuu').src = window.URL.createObjectURL(this.files[0])">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Amount</label>
                                <input type="text" name="amount" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Price" required="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Description</label>
                        <textarea type="text" name="description" class="form-control" id="exampleFormControlInput1"
                            placeholder="Description" required=""></textarea>
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