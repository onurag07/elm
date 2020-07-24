<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeaveRequest;
use App\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {
        $user=auth()->user();
        $leave=auth()->user()->leaves;
        return view('user.index',compact('user','leave'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user=auth()->user();
        return view('user.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeaveRequest $request)
    {

        $date_from = strtotime($request->date_from);
        $date_to = strtotime($request->date_to);
        $days=(int)((($date_to - $date_from)/86400)+1);

        Leave::create([
            'user_id'       => Auth::user()->id,
            'leave_type'    => $request->leave_type,
            'date_from'     => $request->date_from,
            'date_to'       => $request->date_to,
            'days'          => $days,
            'reason'        => $request->reason,
        ]);



        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show(Leave $leave)
    {
        $user=auth()->user();
        $leave=Leave::where('is_approved',0)->where('status','Pending')->get();

        return view('admin.pendingleave',compact('user','leave'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit(Leave $leave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {
        //
    }

    public function leaveapproval(Request $request)
    {
        $balance    =  (auth()->user()->leaves_count)-(auth()->user()->leaves->whereIn('status',['Approved','Pending'])->sum('days'));
        if($balance >= $request->days){
            if($request->status == 'Approved'){
                Leave::where('id',$request->id)->update([
                    'status'=>$request->status,
                    'is_approved'=>1,
                ]);
            }else{
                Leave::where('id',$request->id)->update([
                    'status'=>$request->status,
                ]);
            }
        }
        return redirect()->back();
    }

    public function status()
    {
        $user=auth()->user();
        $leave=Leave::where('status',['Approved', 'Cancel'])->get();

        return view('admin.leavestatus',compact('user','leave'));
    }

    public function userleavestatus()
    {
        $user=auth()->user();
        $leave=$user->leaves()->get();

        return view('user.index',compact('user','leave'));
    }

}
