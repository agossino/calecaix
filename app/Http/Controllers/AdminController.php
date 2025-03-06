<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //

    public function index_users()
    {

        $user = auth()->user();
        $role = $user->role;
        $isadmin = $user->is_admin;
        $viewData = [];

        if (isset($user) && ($user->is_admin == 1)) {
            $viewData['utenti'] = User::all();
            return view('admin.index')->with('viewData', $viewData);
        }
        return view('admin.index')->with('message', 'Non autorizzato');
    }

    public function show_role($id)
    {
        $viewData = [];
        $viewData['utente'] = User::find($id);
        return view('admin.edit_role')->with('viewData', $viewData);
    }

    public function store_role(Request $request)
    {

        $utente = User::find($request->id);
        $utente->role = $request->role;
        $utente->published = $request->published;
        $utente->save();
        $viewData = [];

        $viewData['utenti'] = User::all();
        ;
        return view('admin.index')->with('viewData', $viewData);

    }

    public function destroyUtente($id)
    {
        User::destroy($id);
        $viewData = [];
        $viewData['utenti'] = User::all();

        return redirect('/admin/index')->with('viewData', $viewData);

    }

    public function disableUtente($id)
    {
        $utente = User::find($id);

        if ($utente->published == 1) {
            $utente->published = 0;
        } else {
            $utente->published = 1;
        }
        $utente->save();

        $viewData = [];

        $viewData['utenti'] = User::all();
        ;
        return redirect('/admin/index')->with('viewData', $viewData);
    }

}
