<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
	/**
	 * @var User
	 */
	private $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	/**
     * Prikazuje listu korisnika.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
    	$users = $this->user->paginate(10);

        return view('manager.users.index', compact('users'));
    }

    /**
     * Prikazuje formu za izmenu određenog korisnika.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);
        $roles = \App\Models\Role::all('id', 'name');

        return view('manager.users.edit', compact('user', 'roles'));
    }

	/**
	 * Ažurira određenog korisnika u skladištu.
	 *
	 * @param UserRequest $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function update(UserRequest $request, $id)
    {
        try{
        	$data = $request->all();

        	if($data['password']){

        		$validator = Validator::make($data, [
        			'password' => 'required|string|min:8|confirmed'
		        ]);

        		if($validator->fails())
        			return redirect()->back()->withErrors($validator);

				$data['password'] = bcrypt($data['password']);

	        } else {
        		unset($data['password']);
	        }

			$user = $this->user->find($id);
			$user->update($data);

			$role = \App\Models\Role::find($data['role']);
			$user = $user->role()->associate($role);
			$user->save();

			flash('Korisnik uspešno ažuriran!')->success();
			return redirect()->route('users.index');

        }catch (\Exception $e) {
	        $message = env('APP_DEBUG') ? $e->getMessage() : 'Greška prilikom ažuriranja...';

	        flash($message)->error();
	        return redirect()->back();
        }
    }
}
