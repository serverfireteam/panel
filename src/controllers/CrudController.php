<?php
namespace Serverfireteam\Panel;


/*  
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class CrudController extends \App\Http\Controllers\Controller
{

    
    public $grid;
    public $entity;
    public $set;
    public $edit;
    public $filter;
    
     public function __construct()
    {         
       // $this->entity = $params['entity'];
        $routeParamters = \Route::current()->parameters();      
        $this->setEntity($routeParamters['entity']);
                      
    }

    
    public function all($entity)
    {
                                
                          
        //$this->addStylesToGrid();
                   
    }
    
    public function edit($entity)
    {
        
    }


    public function getEntity(){
        return $this->entity;
    }

     public function setEntity($entity){
        $this->entity = $entity;
    }
    
    public function addStylesToGrid()
    {
        

        $this->grid->edit('edit', 'Edit', 'show|modify|delete');

        $this->grid->orderBy('id', 'desc');     
        $this->grid->paginate(10);

        $this->grid->row(function ($row) {
            if ($row->cell('id')->value == 20) {
                $row->style("background-color:#CCFF66");
            } elseif ($row->cell('id')->value > 15) {
                $row->cell('title')->style("font-weight:bold");
                $row->style("color:#f00");
            }
        });
    }

    public function returnView()
    {
        $configs = \Serverfireteam\Panel\Link::returnUrls();
               
        if ( !isset($configs) || $configs == null ){   
            throw new \Exception('NO URL is set for yet');                                                      
        } else if( !in_array($this->entity, $configs)){
            throw new \Exception('This url is not set yet!');                                                                            
        } else {        
            return \View::make('panelViews::all', array(
             'grid' 	      => $this->grid,
             'filter' 	      => $this->filter,
	     'current_entity' => $this->entity,
	     'import_message' => (\Session::has('import_message')) ? \Session::get('import_message') : ''
            ));   
        }                      
    }
    
    public function returnEditView()
    {
        $configs = \Serverfireteam\Panel\Link::returnUrls();
                
        if ( !isset($configs) || $configs == null ){   
            throw new \Exception('NO URL is set for yet');                                                      
        } else if( !in_array($this->entity, $configs)){
            throw new \Exception('This url is set yet !');                                                                            
        }  else {        
           return \View::make('panelViews::edit', array(
             'edit' => $this->edit
            )); 
        }           
    }
    
     public function finalizeFilter(){
        $this->filter->submit(\Lang::get('panel::fields.search'));
        $this->filter->reset(\Lang::get('panel::fields.reset'));
    }
    
    
}
