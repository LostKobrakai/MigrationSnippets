<?php

class Migration_0000_00_00_00_00 extends Migration {

	public static $description = "Add new permission to allow frontend download of some files";

	const permissionName = "frontend-download";

	public function update() {
		// Create permission
		$permission = $this->permissions->add(self::permissionName);
		$permission->title = 'Is allowed to download files on the frontend';
		$permission->save();

		// Assign to some roles
		foreach(array("editor", "superuser") as $roleName){
			$role = $this->roles->get($roleName);
			$role->addPermission(self::permissionName);
			$role->save();
		}
	}

	public function downgrade() {
		// Delete permission
		$role = $this->roles->get(self::roleName);
		$this->roles->delete($role);
	}

}