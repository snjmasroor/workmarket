<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\Models\State;
use App\Models\UserEducation;
use App\Models\Country;
use Hash;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


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
         
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|confirmed|min:5'
        ]);
        if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Validation errors occurred.',
            'errors' => $validator->errors()
        ], 422);
    }

        try {
            DB::beginTransaction();

            $user = new User(); // or your relevant model

            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->username = $request->username;
            $user->name = $request->firstname.' '.$request->lastname; 
            $user->email = $request->email;
            $user->password = bcrypt($request->password); // always hash passwords
            $user->phone = $request->full_phone;
            $user->industry_id = $request->industry_id;
            $user->save();

            if (isset($request->school) && isset($request->degree)) {
                $userEducation = new UserEducation();
                $userEducation->user_id = $user->id;
                $userEducation->school = $request->school;
                $userEducation->degree = $request->degree;
                $userEducation->field = $request->field;
                $userEducation->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
                $userEducation->end_date =   Carbon::parse($request->end_date)->format('Y-m-d');
                $userEducation->description = htmlspecialchars($request->description);
                $userEducation->save();
            }

            if (isset($request->state) && isset($request->country)) {
                $stateName = State::where('id', $request->state)->value('name');
                $countryName = Country::where('id', $request->country)->value('name');

                $address = new Address();
                $address->user_id = $user->id; // assume $user is already saved
                $address->country = $countryName;
                $address->state = $stateName;
                $address->city = $request->city;
                $address->postal_code = $request->postal_code;
                $address->address = $request->address;
                $address->save();
            }

            if ($request->has('skill_ids')) {
                 $user->skills()->sync($request->skill_ids);
                 $user->save(); 
            }           

            // You can change this path
            if ($request->hasFile('resume')) {
                $file = $request->file('resume');
                $path = public_path('storage/users/resume'); 
                $name = rand(99, 9999999);
                $filenameWithExt = $request->resume->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->resume->getClientOriginalExtension();
                $fileNameToStore = $name . '.' . $extension;
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                $path = $request->resume->storeAs("public/users/resume".$user->id.'/', $fileNameToStore); 
                $address->resume = $fileNameToStore;
                $address->save();
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'User saved successfully.'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            // Log the error for debugging
            \Log::error('User save failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while saving the user.',
                'error' => $e->getMessage()
            ], 500);
        }
   
    }

    public function view_jobs (Request $request) {
        return view('user.view-jobs');
    }

    public function getState($countryCode) {
       $states = State::where('country_id', $countryCode)->get();
       return response()->json($states);
    }
}
