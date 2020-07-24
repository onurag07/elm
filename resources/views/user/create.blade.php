@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('leave.store')}}" method="post" class="form-horizontal">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title">Apply Leave</h4>
                            <div class="form-group row">
                                <label for="leave_type" class="col-sm-3 text-right control-label col-form-label">Leave type</label>
                                <div class="col-sm-9">
                                    <select name="leave_type" class="form-control @error('leave_type') is-invalid @enderror" id="leave_type" required>
                                        <option value="Causal Leave">Causal Leave</option>
                                        <option value="Sick Leave">Sick Leave</option>
                                        <option value="Short Leave">Short Leave</option>
                                    </select>
                                    @error('leave_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="date_from" class="col-sm-3 text-right control-label col-form-label">Date Range </label>
                                <div class="col-sm-4">
                                    <input required type="date" name="date_from" class="form-control @error('date_from') is-invalid @enderror" id="FromDate">
                                    @error('date_from')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <input required type="date" name="date_to" class="form-control @error('date_to') is-invalid @enderror" id="ToDate">
                                    @error('date_to')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="reason" class="col-sm-3 text-right control-label col-form-label">Reason</label>
                                <div class="col-sm-9">
                                    <textarea type="text" name="reason" class="form-control" placeholder="Reason" @error('reason') is-invalid @enderror></textarea>
                                    @error('reason')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="border-top text-right">
                            <div class="card-body">

                                <button type="submit" class="btn btn-outline-success btn-block" @if (($user->leaves_count)-($user->leaves()->whereYear('created_at',Date('Y'))->sum('days')) <= 0) disabled @endif>Apply</button>
                                @if (($user->leaves_count)-($user->leaves->sum('days')) <= 0)
                                    <small class="text-danger">You, already taken the given leave, Wait for the Leave</small>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
