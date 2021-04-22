@extends("admin.layout.master")
@section('title')
Dashboard/Payment
@stop
@section('content')
@include('admin.layout.nav')
<br>
<section class="container">
    <h2>Payment Methods <button class="btn btn-success float-right" data-toggle="modal" data-target="#addPaymentMethod"><i
                class="fa fa-plus" aria-hidden="true"></i>
        </button>
    </h2>
    <div class="table-responsive">
        <table role="table" class="table">
            <thead role="rowgroup">
                <tr role="row">
                	<th role="columnheader">Code</th>
                    <th role="columnheader">Type</th>
                    <th role="columnheader">Action</th>
                </tr>
            </thead>
            <tbody role="rowgroup">
                @foreach($payment_methods as $payment_method)
                <tr role="row">
                    <td role="cell" data-title="First name">{{$payment_method->code}}</td>
                    <td role="cell" data-title="First name">{{$payment_method->type}}</td>
                    <td role="cell" data-title="action">
                        <div class="button">
                            <button class="btn btn-warning mr-1" data-toggle="modal"
                                data-target="#editPaymentMethod{{$payment_method->id}}" data-placement="top" title="Edit"><i
                                    class="fa fa-pencil" aria-hidden="true"></i>
                            </button>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deletePaymentMethod{{$payment_method->id}}"
                                data-placement="top" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <!-- edit modal-->

                <div id="editPaymentMethod{{$payment_method->id}}" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-sm">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">Edit Payment Method</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/payment_method/{{$payment_method->id}}" method="POST">
                                    @csrf
                                    {{method_field('PATCH')}}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="cc-exp" class="control-label mb-1">Type</label>
                                                <input type="text" id="text-input" name="type" value="{{$payment_method->type}}" class="form-control">
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

                <div class="modal" tabindex="-1" role="dialog" id="deletePaymentMethod{{$payment_method->id}}">
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

                            <form action="/payment_method/{{$payment_method->id}}" method="POST">
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

<div id="addPaymentMethod" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Add Payment Method</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/payment_method" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="cc-exp" class="control-label mb-1">Type</label>
                                <input type="text" id="text-input" name="type" autocomplete="off" value=""
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