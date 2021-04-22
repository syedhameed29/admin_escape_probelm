@extends("admin.layout.master")
@section('title')
dash
@stop
@section('content')
@include('admin.layout.nav')
<section id="content-wrapper">
    <div class="container">
        <h3>Dashboard</h3>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <a href="/appointment">
                        <div class="card mt-5 " id="card">
                            <div class="card-body">
                                <h3>Appointments</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="/service">
                        <div class="card mt-5 " id="card">
                            <div class="card-body">
                                <h3>Service</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="/sub">
                        <div class="card mt-5 " id="card">
                            <div class="card-body">
                                <h3>Sub-Service</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="/customer">
                        <div class="card mt-5 " id="card">
                            <div class="card-body">
                                <h3>Customer</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="/partner">
                        <div class="card mt-5 " id="card">
                            <div class="card-body">
                                <h3>Partners</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @stop