<?php

namespace Serverfireteam\Panel;

use Serverfireteam\Panel\CrudController;

class LinkController extends CrudController {

    public function all($entity) {

        parent::all($entity);

        $this->filter = \DataFilter::source(new Link());
        $this->filter->add('id', 'ID', 'text');
        $this->filter->add('name', 'Name', 'text');
        $this->filter->submit('search');
        $this->filter->reset('reset');
        $this->filter->build();

        $this->grid = \DataGrid::source($this->filter);
        $this->grid->add('id', 'ID', true)->style("width:100px");
        $this->grid->add('display', 'Display');
        $this->grid->add('url', 'Model');

        $this->addStylesToGrid();

        return $this->returnView();
    }

    public function edit($entity) {

        parent::edit($entity);

        $this->edit = \DataEdit::source(new Link());

        Link::creating(function($link)
        {
            $appHelper = new libs\AppHelper();
            return ( class_exists( $appHelper->getNameSpace() . $link['url'] ));
        });

	$helpMessage = trans('rapyd::rapyd.links_help');

        $this->edit->label('Edit Links');
        $this->edit->link("rapyd-demo/filter", "Articles", "TR")->back();
        $this->edit->add('display', 'Display', 'text');
        $this->edit->add('url', 'link', 'text');

	$this->addHelperMessage($helpMessage);

        return $this->returnEditView();
    }
}
