<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class subjectController extends Controller
{

    //to create new subject
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'minimun_mark' => 'required|integer|min:0|max:100',
        ]);


        $subject = Subject::create([
            'name' => $request->input('name'),
            'minimun_mark' => $request->input('minimun_mark'),
        ]);

        return redirect('admin/admin_user')->with('success', 'Subject created successfully');
    }

}
