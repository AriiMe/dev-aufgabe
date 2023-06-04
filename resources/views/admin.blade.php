@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Admin Dashboard</h1>

                @foreach($leaveRequests as $request)
                    <div class="card mt-4">
                        <div class="card-header">
                            Leave Request
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Request from: {{ $request->employee->name }}</h5>
                            <p class="card-text">From {{ $request->start_time }} to {{ $request->end_time }}</p>

                            <form action="/approve" method="post">
                                @csrf
                                <input type="hidden" name="leave_id" value="{{ $request->id }}">
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>

                            <form action="/deny" method="post" class="mt-2">
                                @csrf
                                <input type="hidden" name="leave_id" value="{{ $request->id }}">
                                <button type="submit" class="btn btn-danger">Deny</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
