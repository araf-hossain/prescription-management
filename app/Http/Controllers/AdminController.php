<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin/dashboard');
    }

    public function profile() {
        $user = User::find(Auth()->user()->id);
        return view('admin.profile', ['target' => $user]);
    }

    public function doctor_list() {
        $targets = Doctor::select('*')->paginate(25);
        return view('admin.doctor.list',compact('targets'));
    }

    public function doctor_status(Request $request) {

        $target = Doctor::findOrFail($request->id);
        $target->status = $request->status;
        $target->save();

        return redirect(route('admin.doctor.list'));
    }

    public function patient_list() {
        $targets = Patient::select('*')->paginate(25);
        return view('admin.patient.list',compact('targets'));
    }

    public function patient_status(Request $request) {

        $target = Patient::findOrFail($request->id);
        $target->status = $request->status;
        $target->save();

        return redirect(route('admin.patient.list'));

    }
}
