@extends("admin.layout.master")
@section('title')
dash
@stop
@section('content')
@include('admin.layout.nav')

<section id="content-wrapper">
    <div class="container">
        <h3>Queries</h3>
        <div class="d-flex justify-content-end my-3">
        </div>
        <div class="container table-responsive ">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email Address</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Message</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contact as $contact)
                    <tr>
                        <td>{{$contact->name}}</td>
                        <td>{{$contact->email}}</td>
                        <td>{{$contact->subject}}</td>
                        <td>{{$contact->message}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</section>
<!-- -------------------------------modal --------------------------------->
@stop