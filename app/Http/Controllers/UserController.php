<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {

    function __construct() {
        $this->middleware('auth');
    }

    function create() {
        return view('user.create');
    }

    public function destroy(User $user) {
        if($user->email != Auth::user()->email) {
            $name = $user->name;
            if($user->deleteUser()) {
                $message = 'User ' . $name . ' has been removed.';
                return redirect('user')->with(['message' => $message]);
            }
        }
        $message = 'User ' . $user->name . ' has not been removed.';
        return redirect('user')->withErrors(['message' => $message]);
    }

    public function edit(User $user) {
        return view('user.edit', ['user' => $user]);
    }

    function index() {
        return view('user.index', ['user' => Auth::user()]);
    }

    public function show(User $user) {
        return view('user.show');
    }

    public function store(Request $request) {
        $user = new User($request->all());
        $user->password = Hash::make($user->password);
        $user->email_verified_at = Carbon::parse(Carbon::now());
        if($user->storeUser()) {
            $message = 'User has been created.';
            return redirect('user')->with('message', $message);
        } else {
            return back()
                ->withInput()
                ->withErrors(['message' => 'An unexpected error occurred while creating.']);
        }
    }

    function update(Request $request) {
        $validatedData = $this->validateInput($request);
        $message = 'User data has been updated.';
        $sendEmail = false;
        $user = Auth::user();
        $user->name = $request->name;
        if($request->password != null && Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->input('password'));
        } elseif($request->password != null) {
            return back()->withInput()->withErrors([
                                                'message' => 'User hasn\'t been updated',
                                                'old_password' => 'Old password does not match password.']);
        }
        if($request->email != $user->email) {
            $user->email = $request->email;
            $user->email_verified_at = null;
            $sendEmail = true;
        }
        if (!$user->updateUser($sendEmail)) {
            return back()
                     ->withInput()
                     ->withErrors(['message' => 'An unexpected error occurred while updating.']);
        }
        if($sendEmail) {
            $user->sendEmailVerificationNotification();
        }
        return redirect('home')->with('message', $message);
    }

    private function validateInput(Request $request) {
        return $request->validate([
            'email'         => 'required|email',
            'name'          => 'required|min:2|max:100',
            'old_password'  => 'nullable|min:8',
            'password'      => 'nullable|min:8|confirmed',
        ]);
    }
}