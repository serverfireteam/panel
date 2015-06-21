<?php
namespace Serverfireteam\Panel\libs;

class CheckPermission
{
	public static function hasPermission($pathToCheck = null)
        {
		$roleId    = \Auth::user()->role_id;
		$roleLinks = \Serverfireteam\Panel\RoleLink::where('role_id', '=', $roleId)->get();
		$patterns  = array();
		if (!empty($roleLinks)) {
			foreach ($roleLinks as $roleLink) {
				$link = \Serverfireteam\Panel\Link::find($roleLink->link_id);
				if (!empty($link)) {
					$patterns[] = "/^" . $link->pattern . "(\/.*)?$/";
				}
			}
		}

		$path = (empty($pathToCheck)) ? \Request::path() : $pathToCheck;
		$path = substr($path, strpos($path, 'panel/') + 6);
		if (!empty($patterns)) {
			foreach ($patterns as $pattern) {
				if (preg_match($pattern, $path, $matches)) {
					return true;
				}
			}
		}

		return false;
	}

	public static function getUserLinks()
	{
		$roleId    = \Auth::user()->role_id;
		$roleLinks = \Serverfireteam\Panel\RoleLink::where('role_id', '=', $roleId)->get();
		$userLinks = array();
		$linkIds   = array();
		if (!empty($roleLinks)) {
			foreach ($roleLinks as $roleLink) {
				$linkIds[] = $roleLink->link_id;
			}

			if (!empty($linkIds)) {
				$linkIds   = implode(",", $linkIds);
				$whereStmt = "id in (" . $linkIds . ")";
				$userLinks = \Serverfireteam\Panel\Link::whereRaw($whereStmt)->get();
			}
		}

		return $userLinks;
	}
}
