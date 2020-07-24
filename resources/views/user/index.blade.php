@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Status </h4>
                    <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Leave Type</th>
                            <th scope="col">From</th>
                            <th scope="col">To</th>
                            <th scope="col">No Of Days</th>
                            <th scope="col">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($leave as $leave)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{  $leave->leave_type  }}</td>
                                <td>{{  $leave->date_from  }}</td>
                                <td>{{  $leave->date_to  }}</td>
                                <td>{{  $leave->days  }}</td>
                                <td>{{  $leave->status  }}</td>
                              </tr>
                            @endforeach


                        </tbody>
                      </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
