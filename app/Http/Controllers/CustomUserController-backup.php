<?php

namespace App\Http\Controllers;

use App\Models\CustomUser;
use App\Services\UserService;
use Illuminate\Http\Request;
use Storage;

class CustomUserController extends Controller
{
    public function index()
    {
        $users = CustomUser::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }
    public function store(Request $request)
    {
        $save=$request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:custom_users,email',
            'password' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $CustomUser = new CustomUser();
        $CustomUser->name = $request->name;
        $CustomUser->email = $request->email;
        $CustomUser->password = bcrypt($request->password);
        

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $CustomUser->photo = $photoPath;
        }

        $save=$CustomUser->save();
        
        return redirect()->route('customuser.index')->with('success', 'User created successfully');
    }
    public function edit(CustomUser $customuser)
    {
  
        return view('users.edit', compact('customuser'));

    }
      public function show(CustomUser $customuser)
    {
  
        return view('users.show', compact('customuser'));

    }

    public function update(Request $request, CustomUser $customuser)
    {
         $validatedData = $request->validate([
            'name' => 'string',
            'email' => 'required|email',
         
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photo=$customuser->photo;

        if($request->hasFile('photo')){
            if($photo){
                  Storage::delete($photo);
                   $photoPath = $request->file('photo')->store('photos', 'public');
                  
                
            }

        }
     
        $customuser->update([
            'name' => $request->name,
            'email'=>$request->email,
            'photo'=>$photoPath ?? $photo
          
        ]);

        return redirect()->route('customuser.index')->with('success', 'User updated successfully');
    }
    public function destroy(Request $request, CustomUser $customuser)
    {
       
        if($customuser->photo){
            Storage::delete($customuser->photo);
        }
        $customuser->delete();

        return redirect()->route('customuser.index')->with('success', 'User deleted successfully');
    }

}
