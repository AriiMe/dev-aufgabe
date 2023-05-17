<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Leave;

class LeaveController extends Controller
{
    public function home()
    {
        $events = Leave::all();

        // Pass the events to the home view
        return view('home', ['events' => $events]);
    }

    public function request(Request $request)
    {
        // Validate the request data
        $request->validate([
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            'comments' => 'nullable|string',
        ]);

        // Get the authenticated user
        $employee = auth()->user();

        // Create a new leave request
        $leave = new Leave;
        $leave->start_time = $request->input('start_time');
        $leave->end_time = $request->input('end_time');
        $leave->comments = $request->input('comments');
        $leave->status = 'pending';
        $leave->employee_id = $employee->id;

        // Save the leave request
        $leave->save();

        // Redirect the user back to the home page with a success message
        return redirect()->route('home')->with('success', 'Leave request submitted successfully!');
    }


    public function approve(Request $request)
{
    // Validate the request data
    $request->validate([
        'leave_id' => 'required|exists:leaves,id',
    ]);

    try {
        // Find the leave request
        $leave = Leave::find($request->input('leave_id'));

        // Change its status to "approved"
        $leave->status = 'approved';

        // Save the changes
        $leave->save();

        // Redirect the user back to the home page with a success message
        return redirect()->route('home')->with('success', 'Leave request approved successfully!');
    } catch (\Exception $e) {
        // Log the error message
        Log::error($e->getMessage());

        // Redirect the user back with an error message
        return redirect()->route('home')->with('error', 'There was a problem approving the leave request.');
    }
}
public function deny(Request $request)
{
    // Validate the request data
    $request->validate([
        'leave_id' => 'required|exists:leaves,id',
    ]);

    try {
        // Find the leave request
        $leave = Leave::find($request->input('leave_id'));

        // Change its status to "denied"
        $leave->status = 'denied';

        // Save the changes
        $leave->save();

        // Redirect the user back to the home page with a success message
        return redirect()->route('home')->with('success', 'Leave request denied successfully!');
    } catch (\Exception $e) {
        // Log the error message
        Log::error($e->getMessage());

        // Redirect the user back with an error message
        return redirect()->route('home')->with('error', 'There was a problem denying the leave request.');
    }
}
}
