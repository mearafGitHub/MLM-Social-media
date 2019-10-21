<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller{

    public function getDashboard(){
        return view('home');
    }

    public function postSignUp(Request $request){
        
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'full_name' => 'required|max:120',
            'password' => 'required|min:4',
            'birthdate' => 'required',
            'gender' => 'required',
            'phone_number'=> 'required',
            'country' => 'required'
        ]);

        $email = $request['email'];
        $full_name = $request['full_name'];
        $gender = $request['gender'];
        $birthdate = $request['birthdate'];
        $country = $request['country'];
        $phone_number = $request['phone_number'];
        $password = bcrypt($request['password']);

        $user = new User();
        $user->email = $email;
        $user->full_name = $full_name;
        $user->gender =$gender;
        $user->birthdate = $birthdate;
        $user->country = $country;
        $user->phone_number = $phone_number;
        $user->password=$password;
        
       $user->save(); 
       Auth::login($user);
       return redirect()->route('home');
    }

    public function postLogIn(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect()->route('home');
        }
        return redirect()->back();
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function getAccount()
    {
        return view('account', ['user' => Auth::user()]);
    }

    public function postSaveAccount(Request $request)
    {
        $this->validate($request, [
           'full_name' => 'required|max:120'
        ]);

        $user = Auth::user();
        $old_name = $user->full_name;
        $user->full_name = $request['full_name'];
        $user->update();
        $file = $request->file('image');
        $filename = $request['full_name'] . '-' . $user->id . '.jpg';
        $old_filename = $old_name . '-' . $user->id . '.jpg';
        $update = false;
        if (Storage::disk('local')->has($old_filename)) {
            $old_file = Storage::disk('local')->get($old_filename);
            Storage::disk('local')->put($filename, $old_file);
            $update = true;
        }
        if ($file) {
            Storage::disk('local')->put($filename, File::get($file));
        }
        if ($update && $old_filename !== $filename) {
            Storage::delete($old_filename);
        }
        return redirect()->route('account');
    }

    public function getUserImage($filename)
    {
        $user = Auth::user();
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }


}