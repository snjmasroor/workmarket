<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    
    public function viewProfile(){
        // dd('asdasd');
        return view('user.profile');
    }

    public function store(Request $request) {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'string', 'max:20'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // // 2. Validate Address Data
        $request->validate([
            'address' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'zipcode' => ['required', 'string', 'max:10'],
            'city' => ['required', 'string', 'max:255'],
        ]);

        // 3. Validate Skills Data
        // $request->validate([
        //     'skills' => ['nullable', 'array'],
        //     'skills.*' => [
        //         'string',
        //         Rule::in(['Laravel', 'SQL', 'JavaScript', 'Python', 'Vue.js']), // Ensure selected skills are from your predefined list
        //     ],
        // ]);

        // Create the User
        $user = new User();
        $user->user_id = (String) Str::uuid();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->name = $request->firstname.' '.$request->lastname; 
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->addFLag(User::FLAG_ACTIVE); // Hash the password
        if(!$user->save()) {
            return redirect(route('register'))->with(['req_error' => 'There is some error!']);
        }
        // Create the User Address
        $address = new Address();
        $address->address_id = (String) Str::uuid();
        $address->user_id = $user->id;
        $address->address = $request->address;
        $address->country = $request->country;
        $address->state = $request->state;
        $address->postal_code = $request->zipcode;
        $address->city = $request->city;
        $address->addFLag(Address::FLAG_ACTIVE);

        if(!$address->save()) {
            return redirect(route('register'))->with(['req_error' => 'There is some error!']);
        }
        print_r($request->all());

        // Create User Skills
        // if ($request->has('skills') && is_array($request->skills)) {
        //     foreach ($request->skills as $skill) {
        //         $user->skills()->create([
        //             'skill_name' => $skill,
        //         ]);
        //     }
        // }

       // return redirect()->back()->with('success', 'Registration successful!');
    }
}
