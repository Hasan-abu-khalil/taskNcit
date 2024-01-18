<?php

namespace App\Http\Controllers;

use App\Models\student_subject;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class StudentSubjectController extends Controller
{

    // to show assign subject
    public function showAssignSubjectForm()
    {
        $subjects = Subject::all();
        $adminUser = User::all();

        return view('admin.admin_user', compact('subjects', 'adminUser'));
    }

    public function assignSubjectToUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        // Retrieve the user and subject based on the provided IDs
        $adminUser = User::find($request->input('user_id'));
        $subject = Subject::find($request->input('subject_id'));

        // Check if the entry already exists
        $existingAssignment = student_subject::where('user_id', $adminUser->id)
            ->where('subject_id', $subject->id)
            ->first();

        if (!$existingAssignment) {
            // Attach the subject to the user
            $adminUser->subjects()->attach($subject);

            // Update the 'assign' column in the student_subjects table
            student_subject::updateOrCreate(
                ['user_id' => $adminUser->id, 'subject_id' => $subject->id],
                ['assign' => $subject->id] // Assuming 'assign' column should store subject_id
            );

            return redirect()->back()->with('success', 'Subject assigned successfully.');
        } else {
            // Entry already exists, you may want to handle this case
            return redirect()->back()->with('error', 'Subject is already assigned to the user.');
        }
    }









    //to show mark form
    public function showSetMarkForm()
    {
        $adminUser = User::all();
        $subjects = Subject::all();

        return view('admin.admin_user', compact('adminUser', 'subjects'));
    }

    public function setMark(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
            'mark' => 'required|integer|min:0|max:100',
        ]);

        $user = User::find($request->user_id);
        $subject = Subject::find($request->subject_id);
        

        $user->subjects()->sync([$subject->id => ['mark' => $request->mark]], false);

        return redirect()->back()->with('success', 'Mark assigned successfully.');
    }

}
