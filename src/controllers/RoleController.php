<?php

namespace Serverfireteam\Panel;

use Serverfireteam\Panel\CrudController;
use \Illuminate\Http\Request;
use Serverfireteam\Panel\Role;

class RoleController extends CrudController {

	public function all($entity) {

	        parent::all($entity);

	        $this->filter = \DataFilter::source(new Role());
        	$this->filter->add('id', 'ID', 'text');
	        $this->filter->add('name', 'Name', 'text');
        	$this->filter->submit('search');
	        $this->filter->reset('reset');
        	$this->filter->build();

	        $this->grid = \DataGrid::source($this->filter);
        	$this->grid->add('id', 'ID', true)->style("width:100px");
		$this->grid->add('name', 'Name');

		$setPermissionsUrl = url('/panel/setRoleLinks/id/{{ $id }}');

		$this->grid->add('<a href="' . $setPermissionsUrl . '">Set Permissions</a>', '');

        	$this->addStylesToGrid();

	        return $this->returnView();
	}

	public function edit($entity) {

	        parent::edit($entity);

	        $this->edit = \DataEdit::source(new Role());

	        $this->edit->label('Edit Role');
        	$this->edit->add('name', 'Name', 'text')->rule('required');

	        return $this->returnEditView();
	}
}
