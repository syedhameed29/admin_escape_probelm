@extends("admin.layout.master")
@section('title')
dash
@stop
@section('content')
@include('admin.layout.nav')
<br>
<h2 class="container">Service Locations</h2>
<br>
<div class="container row">
<section class="container col-md-4">
    <h2>Countries <button class="btn btn-success float-right" data-toggle="modal" data-target="#additem2"><i
                class="fa fa-plus" aria-hidden="true"></i>
        </button>
    </h2>
    <div class="table-responsive">
        <table role="table" class="table">
            <thead role="rowgroup">
                <tr role="row">
                    <th role="columnheader">Country</th>
                    <th role="columnheader">Action</th>
                </tr>
            </thead>
            <tbody role="rowgroup">
                @foreach($country as $countri)
                <tr role="row">
                    <td role="cell" data-title="First name">{{$countri->country}}</td>
                    <td role="cell" data-title="action">
                        <div class="button">
                            <button class="btn btn-warning mr-1" data-toggle="modal"
                                data-target="#edititem{{$countri->id}}" data-placement="top" title="Edit"><i
                                    class="fa fa-pencil" aria-hidden="true"></i>
                            </button>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteitem{{$countri->id}}"
                                data-placement="top" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <!-- edit modal-->

                <div id="edititem{{$countri->id}}" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-sm">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">Edit Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/country/{{$countri->id}}" method="POST">
                                    @csrf
                                    {{method_field('PATCH')}}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="cc-exp" class="control-label mb-1">Country</label>
                                                <input type="text" id="text-input" name="country"
                                                    value="{{$countri->country}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>

                <!-- del modal-->

                <div class="modal" tabindex="-1" role="dialog" id="deleteitem{{$countri->id}}">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Do you really want to delete these records?</p>
                            </div>

                            <form action="/country/{{$countri->id}}" method="post">
                                <div class="modal-footer justify-content-between">

                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
<section class="container col-md-4">
    <h2>States<button class="btn btn-success float-right" data-toggle="modal" data-target="#addstate"><i
                class="fa fa-plus" aria-hidden="true"></i>
        </button>
    </h2>
    <div class="table-responsive">
        <table role="table" class="table">
            <thead role="rowgroup">
                <tr role="row">
                    <th role="columnheader">State</th>
                    <th role="columnheader">Action</th>
                </tr>
            </thead>
            <tbody role="rowgroup">
                @foreach($statess as $state)
                <tr role="row">
                    <td role="cell" data-title="First name">{{$state->state}}</td>
                    <td role="cell" data-title="action">
                        <div class="button">
                            <button class="btn btn-warning mr-1" data-toggle="modal"
                                data-target="#editstate{{$state->id}}" data-placement="top" title="Edit"><i
                                    class="fa fa-pencil" aria-hidden="true"></i>
                            </button>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deletestate{{$state->id}}"
                                data-placement="top" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <!-- edit modal-->

                <div id="editstate{{$state->id}}" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-sm">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">Edit Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/state/{{$state->id}}" method="POST">
                                    @csrf
                                    {{method_field('PATCH')}}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <select for="cc-exp" name="country_id"
                                                    class="control-label mb-1 form-control col-md-12">
                                                    <option value="">Choose...</option>
                                                    @foreach($country as $countrii)
                                                    <option value="{{$countrii->id}}"
                                                        {{($countrii->id==$state->country_id )? "selected" :""}}>
                                                        {{$countrii->country}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="cc-exp" class="control-label mb-1">State</label>
                                                <input type="text" autocomplete="off" id="text-input" name="state"
                                                    value="{{$state->state}}" class="form-control">
                                            </div>
                                        </div>



                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>

                <!-- del modal-->

                <div class="modal" tabindex="-1" role="dialog" id="deletestate{{$state->id}}">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Do you really want to delete these records?</p>
                            </div>
                            <form action="/state/{{$state->id}}" method="post">
                                <div class="modal-footer justify-content-between">

                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
<section class="container col-md-4">
    <h2>Districts<button class="btn btn-success float-right" data-toggle="modal" data-target="#adddis"><i
                class="fa fa-plus" aria-hidden="true"></i>
        </button>
    </h2>
    <div class="table-responsive">
        <table role="table" class="table">
            <thead role="rowgroup">
                <tr role="row">
                    <th role="columnheader">District</th>
                    <th role="columnheader">Action</th>
                </tr>
            </thead>
            <tbody role="rowgroup">
                @foreach($district as $dis)
                <tr role="row">
                    <td role="cell" data-title="First name">{{$dis->district}}</td>
                    <td role="cell" data-title="action">
                        <div class="button">
                            <button class="btn btn-warning mr-1" data-toggle="modal" data-target="#editdis{{$dis->id}}"
                                data-placement="top" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i>
                            </button>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deletedis{{$dis->id}}"
                                data-placement="top" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <!-- edit modal-->

                <div id="editdis{{$dis->id}}" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-sm">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">Edit District</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/district/{{$dis->id}}" method="POST">
                                    @csrf
                                    {{method_field('PATCH')}}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <select for="cc-exp" name="state_id"
                                                    class="control-label mb-1 form-control col-md-12">
                                                    <option value="">Choose...</option>
                                                    @foreach($statess as $states)
                                                    <option value="{{$states->id}}"
                                                        {{($states->id==$dis->state_id )? "selected" :""}}>
                                                        {{$states->state}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="cc-exp" class="control-label mb-1">District</label>
                                                <input type="text" autocomplete="off" id="text-input" name="district"
                                                    value="{{$dis->district}}" class="form-control">
                                            </div>
                                        </div>



                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>

                <!-- del modal-->

                <div class="modal" tabindex="-1" role="dialog" id="deletedis{{$dis->id}}">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Do you really want to delete these records?</p>
                            </div>
                            <form action="/district/{{$dis->id}}" method="post">
                                <div class="modal-footer justify-content-between">

                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
</div>
<div id="additem2" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Add Country</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/country" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="cc-exp" class="control-label mb-1">Country</label>
                                <input type="text" id="text-input" name="country" autocomplete="off" value=""
                                    class="form-control">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>
<div id="addstate" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Add State</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/state" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <select for="cc-exp" name="country_id"
                                    class="control-label mb-1 form-control col-md-12">
                                    <option value="">Choose...</option>
                                    @foreach($country as $country)
                                    <option value="{{$country->id}}">{{$country->country}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="cc-exp" class="control-label mb-1">State</label>
                                <input type="text" id="text-input" autocomplete="off" name="state" class="form-control">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>
<div id="adddis" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Add District</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/district" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <select for="cc-exp" name="state_id" class="control-label mb-1 form-control col-md-12">
                                    <option value="">Choose...</option>
                                    @foreach($statess as $statess)
                                    <option value="{{$statess->id}}">{{$statess->state}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="cc-exp" class="control-label mb-1">District</label>
                                <input type="text" autocomplete="off" id="text-input" name="district"
                                    class="form-control">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>


@stop