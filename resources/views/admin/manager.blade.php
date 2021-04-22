@extends("admin.layout.master")
@section('title')
dash
@stop
@section('content')
@include('admin.layout.nav')

<section id="content-wrapper">
    <div class="container">
        <h3>Manager</h3>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
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
                        <th scope="col">Email</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Ditrict</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($manager as $manager)
                    <tr>
                        <td>{{$manager->code}}</td>
                        <td>{{$manager->name}}</td>
                        <td>{{$manager->email}}</td>
                        <td>{{$manager->mobile}}</td>
                        <td>{{$manager->district}}</td>
                        <td>
                            <div class="d-flex">
                                <button type="button" class="btn btn-primary mr-2" data-toggle="modal"
                                    data-target="#editcont{{$manager->id}}">
                                    <i class="fa fa-edit "></i>
                                </button>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#deldash{{$manager->id}}">
                                    <i class="fa fa-trash"></i>

                                </button>
                            </div>
                        </td>
                    </tr>
                    <!--edit modal-->
                    <div class="modal fade" id="editcont{{$manager->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Manager</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/manager/{{$manager->id}}" method="post">
                                        @csrf
                                        {{method_field('PATCH')}}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="phone"> Phone Number</label>
                                                    <input type="tel" class="form-control" id="phone" name="mobile"
                                                        pattern="[6-9]{1}[0-9]{9}" value="{{$manager->mobile}}"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone">District</label>
                                                    <select class="form-control" name="district" required>
                                                        @foreach($district as $dis)
                                                        <option value="{{$dis->district}}"
                                                            {{$manager->district == $dis->district  ? 'selected' : ''}}>
                                                            {{$dis->district}}</option>
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
                    <div class="modal fade" id="deldash{{$manager->id}}" tabindex="-1" role="dialog"
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
                                <form action="/manager/{{$manager->id}}" method="post">
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
                <h5 class="modal-title" id="exampleModalLabel">Add Manager</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/manager" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Name" required="">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" id="exampleFormControlInput1"
                                    placeholder="e-mail" required="">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control"
                                    id="exampleFormControlInput1" placeholder="Password" required="">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    id="exampleFormControlInput1" placeholder="Confirm Password" required="">
                            </div>
                            <div class="form-group">
                                <label> Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="mobile" placeholder="Mobile Number"
                                    pattern="[6-9]{1}[0-9]{9}" required>
                            </div>
                            <div class="form-group">
                                <label>District</label>
                                <select class="form-control" id="districtval" name="district" required>
                                    <option>Choose..</option>
                                    @foreach($district as $district)
                                    <option value="{{$district->district}}">{{$district->district}}</option>
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