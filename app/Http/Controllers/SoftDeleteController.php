<?php

namespace App\Http\Controllers;

use App\Models\CustomUser;
use Illuminate\Http\Request;

class SoftDeleteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $deletedUsers = CustomUser::onlyTrashed()->get();
      
        return view('users.deleted', compact('deletedUsers'));
    }



    public function restore($id, CustomUser $customuser)
    {
        $customuser = CustomUser::withTrashed()->findOrFail($id);
        $customuser->restore();
        return redirect()->route('customuser.index')->with('success', 'User restored successfully');
    }

    public function destroyPermanently($id, CustomUser $customuser)
    {
         $customuser = CustomUser::withTrashed()->findOrFail($id);
        $customuser->forceDelete();
        return redirect()->route('customuser.index')->with('success', 'User permanently deleted');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomUser $customUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomUser $customUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomUser $customUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomUser $customUser)
    {
        //
    }
}
