@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pending User Profile </h4>
                    <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Date Of Birth</th>
                            <th scope="col">Date Of Join</th>
                            <th scope="col">Address</th>
                            <th scope="col">&nbsp;</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($profile as $profile)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{  $profile->name  }}</td>
                                <td>{{  $profile->email  }}</td>
                                <td>{{  $profile->phone  }}</td>
                                <td>{{  $profile->gender  }}</td>
                                <td>{{  $profile->dob  }}</td>
                                <td>{{  $profile->doj  }}</td>
                                <td>{{  $profile->address  }}</td>
                                <td>
                                <button onclick="$('#modelInput').val($(this).attr('profile_id'));$('#actionModel').modal('show')" profile_id="{{  $profile->id  }}" class="btn btn-outline-primary">Action</button>
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

        <form action="{{ route('userProfile.approval')  }}" method="post">
            @csrf
            @method('patch')
                <input id="modelInput" value="" name="id" type="hidden">
                <select class="form-control my-2" name="status">
                    <option value="1">Approved</option>
                    <option value="2">Remove</option>
                </select>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>

      </div>
    </div>
  </div>


@endsection
