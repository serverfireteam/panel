<?php

namespace Serverfireteam\Panel;

use Serverfireteam\Panel\CrudController;

class RoleController extends CrudController {

	public function all($entity) {

		parent::all($entity);

		$this->filter = \DataFilter::source(Role::with('permissions'));
		$this->filter->add('id', 'ID', 'text');
		$this->filter->add('name', 'Name', 'text');
		$this->filter->submit('search');
		$this->filter->reset('reset');
		$this->filter->build();

		$this->grid = \DataGrid::source($this->filter);
		$this->grid->add('id', 'ID', true)->style("width:100px");
		$this->grid->add('name', 'Name')->style('width:100px');
		$this->grid->add('label', 'Description');
		$this->grid->add('{{ implode(", ", $permissions->lists("name")->all()) }}', 'name' );


		$this->addStylesToGrid();

		return $this->returnView();
	}

	public function edit($entity) {

		parent::edit($entity);

		$this->edit = \DataEdit::source(new Role());

		$helpMessage = \Lang::get('panel::fields.roleHelp');

		$this->edit->label('Edit Role');
		$this->edit->link("rapyd-demo/filter", "Role", "TR")->back();
		$this->edit->add('name', 'Name', 'text')->rule('required');
		$this->edit->add('label', 'Description', 'text')->rule('required');
		$this->edit->add('permissions','Permissions','checkboxgroup')->options(Permission::lists('name', 'id')->all());
		$this->edit->saved(function () use ($entity) {
			$this->edit->message(\Lang::get('panel::fields.dataSavedSuccessfull'));
			$this->edit->link('panel/Permission/all', \Lang::get('panel::fields.back'));
		});


		$this->addHelperMessage($helpMessage);

		return $this->returnEditView();
	}
}
