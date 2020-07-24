@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- <div class="card border-success">
                <div class="card-header">{{ __('Dashboard') }}</div>
                {{  $user  }}
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div> --}}
            <div class="text-center font-weight-bold">Current Year Status</div>
            @if($user->role == 'user' && $user->status == 1)
            <div class="card-group">
                <div class="card border-success">
                    <div class="card-body">
                    <h6 class="card-title text-center">Pending</h6>
                    <p class="card-text font-weight-bolder text-center">{{  $user->leaves()->where('status','Pending')->whereYear('created_at',date('Y'))->count()  }}</p>
                    </div>
                </div>
                <div class="card border-success">
                    <div class="card-body">
                    <h6 class="card-title text-center">Approved</h6>
                    <p class="card-text font-weight-bolder text-center">{{  $user->leaves()->where('status','Approved')->whereYear('created_at',date('Y'))->count()  }}</p>
                    </div>
                </div>
                <div class="card border-success">
                    <div class="card-body">
                    <h6 class="card-title text-center">Cancel</h6>
                    <p class="card-text font-weight-bolder text-center">{{  $user->leaves()->where('status','Cancel')->whereYear('created_at',date('Y'))->count()  }}</p>
                    </div>
                </div>
                <div class="card border-success">
                    <div class="card-body">
                        <h6 class="card-title text-center">Balance</h6>
                        {{-- <p class="card-text font-weight-bolder text-center">{{  ($user->leaves_count)-($user->leaves()->whereIn('status',['Approved','Pending'])->count())  }}</p> --}}
                        <p class="card-text font-weight-bolder text-center">{{  ($user->leaves_count)-($user->leaves()->whereIn('status',['Approved','Pending'])->whereYear('created_at',date('Y'))->sum('days'))  }}</p>
                    </div>
                    </div>
                    <div class="card border-success">
                    <div class="card-body">
                        <h6 class="card-title text-center">Total</h6>
                        <p class="card-text font-weight-bolder text-center">{{  $user->leaves_count  }}</p>
                    </div>
                    </div>
                </div>
            @endif

            @if($user->role == 'admin' && $user->status == 1)
            <div class="card-group">
                <div class="card border-success">
                    <div class="card-body">
                    <h6 class="card-title text-center">Pending</h6>
                    <p class="card-text font-weight-bolder text-center">{{  $user->leaves()->where('status','Pending')->whereYear('created_at',date('Y'))->count()  }}</p>
                    </div>
                </div>
                <div class="card border-success">
                    <div class="card-body">
                    <h6 class="card-title text-center">New Registration</h6>
                    <p class="card-text font-weight-bolder text-center">{{  $user->where('status',0)->where('role','user')->count()  }}</p>
                    </div>
                </div>
            </div>
            @endif

            @if($user->status == 0)
            <div class="text-center font-weight-bolder">Kindly Wait For The Admin Approval</div>
            @endif
        </div>
    </div>
</div>
@endsection
