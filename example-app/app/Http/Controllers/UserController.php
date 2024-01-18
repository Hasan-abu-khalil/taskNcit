<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    // login function if role == admin he can sgin in without access if he user he need access to can login 
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Check if the user exists with the given email
        $user = User::where('email', $email)->first();

        if ($user) {
            // Check if the user's account has access (you may have a specific column for this, e.g., 'has_access')
            // or the user's role is 'admin'
            if ($user->has_access || $user->role === 'admin') {

                if (Auth::attempt(['email' => $email, 'password' => $password])) {

                    session(['admin_logged_in' => true]);
                    return redirect('admin/admin_user');
                } else {

                    return redirect()->route('login')->with('error', 'Invalid email or password');
                }
            } else {

                return redirect()->route('login')->with('error', 'This account is inactive , please wait for the admin to activate you account');
            }
        } else {

            return redirect()->route('login')->with('error', 'Invalid email or password');
        }
    }



    // to create new account
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:8|max:40',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
        ], [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.min' => 'The name must be at least 8 characters.',
            'name.max' => 'The name may not be greater than 40 characters.',

            'email.required' => 'The email field is required.',
            'email.string' => 'The email must be a string.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already taken.',

            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password.regex' => 'The password must meet the complexity requirements.
            At least one lowercase letter 
            At least one uppercase letter 
            At least one digit
            At least one special character',
        ]);



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        return redirect('/login')->with('success', 'Registration successful');
    }


    // to logout accounts
    public function logout()
    {
        Auth::logout();
        session()->forget('admin_logged_in');
        return redirect()->route('login');
    }



    // to give user access to can login 
    public function toggleAccess($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        // Toggle the user's access status
        $user->has_access = !$user->has_access;
        $user->save();

        return redirect()->back()->with('success', 'Access status toggled successfully');
    }


    //to give admin access to can create account form dashboard
    public function creat_user(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:8|max:40',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
        ], [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.min' => 'The name must be at least 8 characters.',
            'name.max' => 'The name may not be greater than 40 characters.',

            'email.required' => 'The email field is required.',
            'email.string' => 'The email must be a string.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already taken.',

            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password.regex' => 'The password must meet the complexity requirements.
            At least one lowercase letter 
            At least one uppercase letter 
            At least one digit
            At least one special character',
        ]);



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect('admin/admin_user')->with('success', 'Registration successful');
    }



    public function index()
    {
        $adminUser = User::all();
        $subjects = Subject::all();
        return view('admin/admin_user', compact('adminUser', 'subjects'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
    }

    //to can edit user 
    public function edit($id)
    {

        $user = User::find($id);

        return view('admin.edit_user', compact('user'));

    }

    //to update user data 
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin_user.index')->with('error', 'User not found');
        }

        $request->validate([
            'name' => 'required|string|min:8|max:40',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);


        $user->name = $request->name;
        $user->email = $request->email;


        $user->save();

        return redirect()->route('admin_user.index')->with('success', 'User updated successfully');
    }



    // to delete the user
    public function destroy($id)
    {
        $adminUser = User::find($id);
        $adminUser->delete();
        return redirect()->route('admin_user.index', ['adminUser' => $id])->with('success', 'User deleted successfully');
    }
}
