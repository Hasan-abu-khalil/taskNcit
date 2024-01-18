<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\subjectController;
use App\Http\Controllers\StudentSubjectController;


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('auth/login');
// });


Route::middleware(['admin'])->group(function () {
    Route::resource('admin/admin_user', UserController::class);
    Route::post('/admin_user/toggleAccess/{id}', [UserController::class, 'toggleAccess'])->name('admin_user.toggleAccess');
    Route::put('/admin/admin_user/{id}', [UserController::class, 'update'])->name('admin_user.update');
    Route::post('admin/admin_user/create', [UserController::class, 'creat_user'])->name('admin_user.creat_user');
    Route::post('/subjects/create', [SubjectController::class, 'create'])->name('subject.create');
    Route::get('/assign-subject', [StudentSubjectController::class, 'showAssignSubjectForm'])->name('assign.subject.form');
    Route::post('/assign-subject', [StudentSubjectController::class, 'assignSubjectToUser'])->name('assign.subject');
    Route::get('/set-mark', [StudentSubjectController::class, 'showSetMarkForm'])->name('set-mark-form');
    Route::post('/set-mark', [StudentSubjectController::class, 'setMark'])->name('set-mark');
});


Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [UserController::class, 'login'])->name('auth.login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('auth.register');
Route::post('/register', [UserController::class, 'register']);





















// /**
//      * Display a listing of the resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function index()
//     {
//         //
//     }

//     /**
//      * Show the form for creating a new resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function create()
//     {
//         //
//     }

//     /**
//      * Store a newly created resource in storage.
//      *
//      * @param  \App\Http\Requests\Storestudent_subjectRequest  $request
//      * @return \Illuminate\Http\Response
//      */
//     public function store(Storestudent_subjectRequest $request)
//     {
//         //
//     }

//     /**
//      * Display the specified resource.
//      *
//      * @param  \App\Models\student_subject  $student_subject
//      * @return \Illuminate\Http\Response
//      */
//     public function show(student_subject $student_subject)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      *
//      * @param  \App\Models\student_subject  $student_subject
//      * @return \Illuminate\Http\Response
//      */
//     public function edit(student_subject $student_subject)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      *
//      * @param  \App\Http\Requests\Updatestudent_subjectRequest  $request
//      * @param  \App\Models\student_subject  $student_subject
//      * @return \Illuminate\Http\Response
//      */
//     public function update(Updatestudent_subjectRequest $request, student_subject $student_subject)
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  \App\Models\student_subject  $student_subject
//      * @return \Illuminate\Http\Response
//      */
//     public function destroy(student_subject $student_subject)
//     {
//         //
//     }