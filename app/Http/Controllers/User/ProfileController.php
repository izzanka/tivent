<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    
    public function index()
    {
        $user = auth()->user();
        return view('user.profile.index',compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if($user->id != auth()->id()){
            abort(403);
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'phone_number' => 'numeric|min:12',
            'bank_account_number' => 'numeric|min:15',
        ]);

        $req = $request->only(['name','email','phone_number','bank_account_number']);
        
        if($request->password){
            $request->validate(['password' => 'required|string|min:8|confirmed']);
            $password = Hash::make($request->password);
            $user->update(['password' => $password],$req);
        }

        $user->update($req);

        return back()->with('message',['class' => 'success','text' => 'Profile updated succesfully!']);
    }

    public function destroy(User $user)
    {
        if($user->id != auth()->id()){
            abort(403);
        }
      
        $user->delete();
        return redirect('home')->with('message',['class' => 'success','text' => 'Account deleted successfully!']);
        
    }
}
