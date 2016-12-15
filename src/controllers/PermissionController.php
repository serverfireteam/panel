<?php

namespace Serverfireteam\Panel;

use Serverfireteam\Panel\CrudController;

class PermissionController extends CrudController {

	public function all($entity) {

		parent::all($entity);

		$this->filter = \DataFilter::source(new Permission());
		$this->filter->add('id', 'ID', 'text');
		$this->filter->add('name', 'Name', 'text');
		$this->filter->submit('search');
		$this->filter->reset('reset');
		$this->filter->build();

		$this->grid = \DataGrid::source($this->filter);
		$this->grid->add('id', 'ID', true)->style("width:100px");
		$this->grid->add('name', 'Url')->style('width:100px');
		$this->grid->add('label', 'Description');

		$this->addStylesToGrid();

		return $this->returnView();
	}

	public function edit($entity) {

		parent::edit($entity);

		$this->edit = \DataEdit::source(new Permission());

		$helpMessage = (\Lang::get('panel::fields.roleHelp'));

		$this->edit->label('Edit Permission');
		$this->edit->link("rapyd-demo/filter", "Articles", "TR")->back();
		$this->edit->add('name', 'Url', 'text')->rule('required');
		$this->edit->add('label', 'Description', 'text')->rule('required');

		$this->edit->saved(function () use ($entity) {
			$this->edit->message('Awesome, Data Saved successfully');
			$this->edit->link('panel/Permission/all', 'Back');
		});

		$this->addHelperMessage($helpMessage);

		return $this->returnEditView();
	}
}
