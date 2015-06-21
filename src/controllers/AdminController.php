<?php

namespace Serverfireteam\Panel;

use Serverfireteam\Panel\CrudController;
use \Illuminate\Http\Request;
use Serverfireteam\Panel\Admin;
use Serverfireteam\Panel\Role;

class AdminController extends CrudController {

	public function all($entity) {

	        parent::all($entity);

		$admin = Admin::with('Role');

	        $this->filter = \DataFilter::source($admin);
        	$this->filter->add('id', 'ID', 'text');
	        $this->filter->add('email', 'Email', 'text');
        	$this->filter->submit('search');
	        $this->filter->reset('reset');
        	$this->filter->build();

	        $this->grid = \DataGrid::source($this->filter);
        	$this->grid->add('id', 'ID', true)->style("width:100px");
		$this->grid->add('email', 'Email');
	        $this->grid->add('first_name', 'Name');
		$this->grid->add('last_name', 'Surname');
		$this->grid->add('{{ $Role->name }}', 'Role');

        	$this->addStylesToGrid();

	        return $this->returnView();
	}

	public function edit($entity) {

	        if (\Request::input('password') != null) {
        		$new_input = array('password' => \Hash::make(\Request::input('password')));
			\Request::merge($new_input);
	        }

	        parent::edit($entity);

	        $this->edit = \DataEdit::source(new Admin());

	        $this->edit->label('Edit Admin');
        	$this->edit->link("rapyd-demo/filter", "Articles", "TR")->back();
	        $this->edit->add('email', 'Email', 'text')->rule('required|min:5');
        	$this->edit->add('first_name', 'Name', 'text');
	        $this->edit->add('last_name', 'Surname', 'text');
        	$this->edit->add('password', 'Password', 'password')->rule('required');
		$this->edit->add('role_id', 'Role', 'select')->options(Role::lists("name", "id"))->rule('required');

	        return $this->returnEditView();
	}
}
