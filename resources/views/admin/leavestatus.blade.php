@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Status </h4>
                    <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Leave Type</th>
                            <th scope="col">From</th>
                            <th scope="col">To</th>
                            <th scope="col">No Of Days</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($leave as $leave)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{  $leave->user->name  }}</td>
                                <td>{{  $leave->leave_type  }}</td>
                                <td>{{  $leave->date_from  }}</td>
                                <td>{{  $leave->date_to  }}</td>
                                <td>{{  $leave->days  }}</td>
                                <td>{{  $leave->status  }}</td>
                                <td>
                                <button onclick="$('#modelInput').val($(this).attr('profile_id'));$('#actionModel').modal('show')" profile_id="{{  $leave->user->id  }}" class="btn btn-outline-primary">Action</button>
                                </td>
                              </tr>
                            @endforeach


                        </tbody>
                      </table>

                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="actionModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Action</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-right">

        <form action="{{ route('leave.approval')  }}" method="post">
            @csrf
            @method('patch')
                <input id="modelInput" value="" name="id" type="hidden">
                <select class="form-control my-2" name="status">
                    <option value="Approved">Approved</option>
                    <option value="Cancel">Cancel</option>
                </select>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>

      </div>
    </div>
  </div>
@endsection
