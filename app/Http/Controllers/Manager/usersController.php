<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\user;
use Illuminate\Http\Request;

class usersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $users = user::where('userID', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('username', 'LIKE', "%$keyword%")
                ->orWhere('storeName', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->orWhere('userBirthday', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('gender', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->orWhere('userTypeID', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('password', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $users = user::latest()->paginate($perPage);
        }

        return view('manager.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('manager.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        user::create($requestData);

        return redirect('manager/users')->with('flash_message', 'user added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = user::findOrFail($id);

        return view('manager.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = user::findOrFail($id);

        return view('manager.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $user = user::findOrFail($id);
        $user->update($requestData);

        return redirect('manager/users')->with('flash_message', 'user updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        user::destroy($id);

        return redirect('manager/users')->with('flash_message', 'user deleted!');
    }
}
