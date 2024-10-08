<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
	/**
	 * @var Role
	 */
	private $role;

	public function __construct(Role $role)
	{
		$this->role = $role;
	}

	/**
     * Prikazuje listu uloga.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$roles = $this->role->paginate(10);

        return view('manager.roles.index', compact('roles'));
    }

    /**
     * Prikazuje formu za kreiranje nove uloge.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    return view('manager.roles.create');
    }

	/**
	 * Čuva novo kreiranu ulogu u skladište.
	 *
	 * @param RoleRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function store(RoleRequest $request)
    {
	    try {
	    	$this->role->create($request->all());

		    flash('Uloga uspešno sačuvana!')->success();
		    return redirect()->route('roles.index');

	    }catch (\Exception $e) {
		    $message = env('APP_DEBUG') ? $e->getMessage() : 'Greška prilikom kreiranja...';

		    flash($message)->error();
		    return redirect()->back();
	    }
    }

    /**
     * Prikazuje određenu ulogu.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('roles.edit', $id);
    }

    /**
     * Prikazuje formu za izmenu određene uloge.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$role = $this->role->find($id);
	    return view('manager.roles.edit', compact('role'));
    }

	/**
	 * Ažurira određenu ulogu u skladištu.
	 *
	 * @param RoleRequest $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function update(RoleRequest $request, $id)
    {
	    try {
		    $role = $this->role->find($id);
		    $role->update($request->all());

		    flash('Uloga uspešno ažurirana!')->success();
		    return redirect()->route('roles.index');

	    }catch (\Exception $e) {
		    $message = env('APP_DEBUG') ? $e->getMessage() : 'Greška prilikom ažuriranja...';

		    flash($message)->error();
		    return redirect()->back();
	    }
    }

    /**
     * Briše određenu ulogu iz skladišta.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
			$role = $this->role->find($id);
			$role->delete();

			flash('Uloga uspešno obrisana!')->success();
			return redirect()->route('roles.index');

        }catch (\Exception $e) {
        	$message = env('APP_DEBUG') ? $e->getMessage() : 'Greška prilikom brisanja...';

        	flash($message)->error();
        	return redirect()->back();
        }
    }

	/**
	 * @param int $role
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function syncResources(int $role)
	{
		$role = $this->role->find($role);
		$resources = \App\Models\Resource::all(['id', 'resource']);

		return view('manager.roles.sync-resources', compact('role', 'resources'));
	}

	/**
	 *
	 */
	public function updateSyncResources($role, Request $request)
	{
		try{
			$role = $this->role->find($role);
			$role->resources()->sync($request->resources);

			flash('Resursi uspešno dodati!')->success();
			return redirect()->route('roles.resources', $role);

		}catch (\Exception $e) {
			$message = env('APP_DEBUG') ? $e->getMessage() : 'Greška prilikom dodavanja resursa...';

			flash($message)->error();
			return redirect()->back();
		}
	}
}
