<?php
namespace Serverfireteam\Panel;

use \Illuminate\Routing\Controllers; 
/*  
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class CrudController extends \Controller
{

    
    public $grid;
    public $entity;
    public $set;
    public $edit;
    public $filter;
    
     public function __construct()
    {
         
        $this->entity = 'users';
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
        $configFile = \Config::get('config.crudItems');
        
        if ( !isset($configFile) || $configFile == null ){
             return \View::make('panelViews::noConfig');
        } else {
            return \View::make('panelViews::all', array(
             'grid' => $this->grid,
             'filter' => $this->filter
            ));   
        }                      
    }
    
    public function returnEditView()
    {
         return \View::make('panelViews::edit', array(
             'edit' => $this->edit
        ));
    }
}
