<?php
namespace Serverfireteam\Panel;

use Illuminate\Routing\Controller;

class CrudController extends Controller
{
    public    $grid;
    public    $entity;
    public    $set;
    public    $edit;
    public    $filter;
    protected $lang;
    public    $helper_message;

    public function __construct(\Lang $lang)
    {
       // $this->entity = $params['entity'];
        $route = \App::make('route');
        $this->lang = $lang;
        $this->route = $route;
        $routeParamters = $route::current()->parameters();
        $this->setEntity($routeParamters['entity']);
    }

    /**
    * @param string $entity name of the entity
    */
    public function all($entity)
    {
        //$this->addStylesToGrid();
    }

    /**
    * @param string $entity name of the entity
    */
    public function edit($entity)
    {

    }

    public function getEntity() {
        return $this->entity;
    }

    public function setEntity($entity) {
        $this->entity = $entity;
    }

    public function addStylesToGrid($orderByColumn = 'id', $paginateCount = 10)
    {
        $this->grid->edit('edit', trans('panel::fields.edit'), 'show|modify|delete');

        $this->grid->orderBy($orderByColumn, 'desc');
        $this->grid->paginate($paginateCount);        
    }

    public function addHelperMessage($message)
    {
	$this->helper_message = $message;
    }

    public function returnView()
    {
        $configs = \Serverfireteam\Panel\Link::returnUrls();

        if (!isset($configs) || $configs == null) {
            throw new \Exception('NO URL is set yet !');
        } else if (!in_array($this->entity, $configs)) {
            throw new \Exception('This url is not set yet!');
        } else {
            return \View::make('panelViews::all', array(
             'grid' 	      => $this->grid,
             'filter' 	      => $this->filter,
             'title'          => $this->entity ,
	     'current_entity' => $this->entity,
	     'import_message' => (\Session::has('import_message')) ? \Session::get('import_message') : ''
            ));
        }
    }

    public function returnEditView()
    {
        $configs = \Serverfireteam\Panel\Link::returnUrls();

        if (!isset($configs) || $configs == null) {
            throw new \Exception('NO URL is set yet !');
        } else if (!in_array($this->entity, $configs)) {
            throw new \Exception('This url is not set yet !');
        } else {
           return \View::make('panelViews::edit', array('title'		 => $this->entity,
					                'edit' 		 => $this->edit,
							'helper_message' => $this->helper_message));
        }
    }

    public function finalizeFilter() {
        $lang = \App::make('lang');
        $this->filter->submit($this->lang->get('panel::fields.search'));
        $this->filter->reset($this->lang->get('panel::fields.reset'));
    }
}
