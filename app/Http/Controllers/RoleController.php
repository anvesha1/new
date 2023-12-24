<?php

// app/Http/Controllers/RoleController.php

// app/Http/Controllers/RoleController.php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function assignForm()
    {
        $users = User::all();
        $roles = Role::all();

        return view('roles.choose', compact('users', 'roles'));
    }

//    public function assignRole(Request $request)
//    {
//        $request->validate([
//            'user' => 'required|exists:users,id',
//            'role' => 'required|exists:roles,id',
//        ]);
//
//        $userId = $request->input('user');
//        $roleId = $request->input('role');
//
//        $user = User::find($userId);
//
//        if (!$user) {
//            return redirect()->route('roles.choose')->with('error', 'User not found');
//        }
//
//        // Sync the roles for the user
//        $user->roles()->sync([$roleId]);
//
//        return redirect()->route('roles.choose')->with('success', 'Role assigned successfully');
//    }

    public function chooseRole(Request $request, $roleId)
    {
        $user = Auth::user();

        // Sync the selected role for the user
        $user->roles()->sync([$roleId]);

        // Determine which view to render based on the selected role
        switch ($roleId) {
            case 1:
                $view = 'users.admin.admin';
                break;
            case 2:
                $view = 'users.manager';
                break;
            case 3:
                $view = 'users.member';
                break;
            default:
                $view = 'users.index'; // Display the default view
                break;
        }

        // Render the appropriate view
        return view($view)->with('success', 'Role assigned successfully.');
    }
}
