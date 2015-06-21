<?php

namespace Serverfireteam\Panel;

use \Serverfireteam\Panel\libs\PanelElements;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

use Serverfireteam\Panel\Link;
use Serverfireteam\Panel\Role;
use Serverfireteam\Panel\RoleLink;

class SetLinksController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() { }

	public function index($id)
	{
		$role 	  = Role::find($id);
		$roleName = (!empty($role)) ? $role->name : '';
 
		$permissions = null;
		$roleLinks   = RoleLink::where('role_id', '=', $id)->get();
		if (!empty($roleLinks)) {
			foreach ($roleLinks as $roleLink) {
				$permissions[] = $roleLink->link_id;
			}
		}

		$links    = Link::all();
		$allLinks = (!empty($links)) ? $links->toArray() : null;

		return view('panelViews::setRoleLinks')->with('id', $id)
						       ->with('links', $allLinks)
						       ->with('permissions', $permissions)
						       ->with('role', $roleName);
	}

	public function setLinks(Request $request)
	{
		$links  = $request['links'];
		$roleId = $request['id'];
		$status = false;

		if ($roleId) {
			// Delete previous data
			RoleLink::whereRaw('role_id = ?', [$roleId])->delete();
		}

		if ($roleId && !empty($links)) {
			foreach ($links as $link) {
				$roleLinkExists = RoleLink::whereRaw('role_id = ? and link_id = ?', [$roleId, $link])->get();
				if (empty($roleLinkExists->id)) { 

					$roleLink = new RoleLink;
					$roleLink->role_id = $roleId;
					$roleLink->link_id = $link;
					$roleLink->save();

					$status = true;
				}
			}
		}

		$permissions = null;
		$roleLinks   = RoleLink::where('role_id', '=', $roleId)->get();
		if (!empty($roleLinks)) {
			foreach ($roleLinks as $roleLink) {
				$permissions[] = $roleLink->link_id;
			}
		}

		$role 	  = Role::find($roleId);
		$roleName = (!empty($role)) ? $role->name : '';

		$links    = Link::all();
		$allLinks = (!empty($links)) ? $links->toArray() : null;

		return view('panelViews::setRoleLinks')->with('id', $roleId)
						       ->with('links', $allLinks)
						       ->with('permissions', $permissions)
						       ->with('role', $roleName)
						       ->with('permissions_set', $status);
	}
}
