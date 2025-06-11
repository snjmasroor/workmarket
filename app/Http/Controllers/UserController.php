<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\Models\State;
use Hash;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    
    public function index() {
        return view('admin.users.user-index');
    }

    public function data(Request $request)
    {
        $query = User::where('type', '!=', 1);
        return DataTables::of($query)
         ->addColumn('firstname', fn($row) => $row->firstname ?: '-')
         ->addColumn('lastname', fn($row) => $row->lastname ?: '-')
         ->addColumn('username', fn($row) => $row->username ?: '-')
            ->addColumn('flags', function ($row) {
                if ($row->active === true || $row->active == 1) {
                    return '<span class="badge bg-label-success me-1">Active</span>';
                } elseif ($row->active === false || $row->active == 0) {
                    return '<span class="badge bg-label-warning me-1">Inactive</span>';
                } else {
                    return '<span class="badge bg-secondary">None</span>';
                }
            })
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.user.edit', $row->id);
                $deleteUrl = route('admin.industries.destroy', $row->id);
                $detailUrl = route('admin.user.detail', $row->id);

                return '
                    <a href="'.$editUrl.'" class="btn btn-sm btn-primary">Edit</a>
                    <a href="'.$detailUrl.'" class="btn btn-sm btn-success">Detail</a>
                ';
            })
            ->rawColumns(['flags', 'action']) // allow HTML rendering
            ->make(true);
    }

    public function detail(Request $request, $id)
    {
      // return $id;
        $user = User::with(['industry', 'skills', 'latestAddress'])->where('id', $id)->first();
        return view('admin.users.profile', compact('user'));
    }
    
    
    public function viewProfile(){
        $user = User::with('industry')->where('id', auth()->id())->first();
        return view('user.profile', compact('user'));
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
         $user->industry_id = $request->industry_id;
        
        $file = $request->file('image');
        $path = public_path('storage/users');// You can change this path
        // Create directory if it doesn't exist
        if ($request->hasFile('image')) { 
            // Create a unique filename
            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();

            // ✅ For Intervention Image v3 — just pass 'gd' or 'imagick' as string
            // $manager = new ImageManager('gd'); // or 'imagick'
            $manager = new ImageManager(new Driver());
            // Create the image
            $image = $manager->read($file)->resize(800, 800);

            $path = public_path('storage/users');
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            // Save the image
            $image->save($path . '/' . $filename);
        }
    // Example: Save user with image path
        $user->image = $filename;
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
        // Create User Skills
        if ($request->has('skill_ids')) {
            $user->skills()->sync($request->skill_ids);
            auth()->login($user);
        }

       return redirect()->route('home');//return redirect()->back()->with('success', 'Registration successful!');
    }

    public function view_jobs (Request $request) {
        return view('user.view-jobs');
    }

    public function getState($countryCode) {
       $states = State::where('country_id', $countryCode)->get();
       return response()->json($states);
    }
}
