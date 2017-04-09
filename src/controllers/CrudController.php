<?php
namespace Serverfireteam\Panel;

use Illuminate\Routing\Controller;

class CrudController extends Controller
{
    const ID_COLUMN = 'id';

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
        if($route = $route::current())
        {
            $routeParamters = $route->parameters();
            if(isset($routeParamters['entity']))
                $this->setEntity($routeParamters['entity']);
        }
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

    public function getEntityModel() {

        $entity = $this->getEntity();

        $appHelper = new libs\AppHelper;

        $modelClass = $appHelper->getModel($entity);

        return new $modelClass;
    }

    public function addStylesToGrid($orderByColumn = self::ID_COLUMN, $paginateCount = 10)
    {
        $this->grid->edit('edit', trans('panel::fields.edit'), 'show|modify|delete');


        if ($orderByColumn === self::ID_COLUMN) {
            $orderByColumn = $this->getEntityModel()->getKeyName();
        }

        $this->grid->orderBy($orderByColumn, 'desc');
        $this->grid->paginate($paginateCount);
    }

    public function addHelperMessage($message)
    {
        $this->helper_message = $message;
    }

    /**
     * Check whether a link is defined for the given URL / model name
     * @param $url
     * @throws \Exception
     */
    private function validateEntity($url) {
        if (!\Links::all()->pluck('url')->contains($url)) {
            throw new \Exception('This url is not set yet!');
        }
    }

    public function returnView()
    {
        $this->validateEntity($this->entity);
        return \View::make('panelViews::all', array(
         'grid'           => $this->grid,
         'filter'         => $this->filter,
         'title'          => $this->entity ,
         'current_entity' => $this->entity,
         'import_message' => (\Session::has('import_message')) ? \Session::get('import_message') : ''
        ));
    }

    public function returnEditView()
    {
        $this->validateEntity($this->entity);
        return \View::make('panelViews::edit', array('title'		 => $this->entity,
                                'edit' 		 => $this->edit,
                        'helper_message' => $this->helper_message));
    }

    public function finalizeFilter() {
        $lang = \App::make('lang');
        $this->filter->submit($this->lang->get('panel::fields.search'));
        $this->filter->reset($this->lang->get('panel::fields.reset'));
    }
}
