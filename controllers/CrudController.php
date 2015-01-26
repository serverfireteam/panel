<?php
namespace Serverfireteam\Panel;

use \Illuminate\Routing\Controllers; 
use \Illuminate\Support\Facades\Lang;
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


    public function getEntity()
    {
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
        $configFile = \Config::get('panel::config.crudItems');
                
        if ( !isset($configFile) || $configFile == null ){   
            throw new Exception('Config File Has Not Been Properly Set Yet');                                                      
        } else if( !in_array($this->entity, $configFile)){
            throw new Exception('This Controller is not set in Config file yet!');                                                                            
        } else {        
            return \View::make('panelViews::all', array(
             'grid' => $this->grid,
             'filter' => $this->filter
            ));   
        }                      
    }
    
    public function returnEditView()
    {
        $configFile = \Config::get('panel::config.crudItems');
                
        if ( !isset($configFile) || $configFile == null ){                      
            return \View::make('panelViews::configError', array(
                 'message' => 'Config File Has Not Been Properly Set Yet'
            ));             
        } else if( !in_array($this->entity, $configFile)){
             return \View::make('panelViews::configError', array(
                 'message' => 'This Controller is not set in Config file yet!'
            ));            
        } else {        
           return \View::make('panelViews::edit', array(
             'edit' => $this->edit
            )); 
        }           
    }
    
    public function finalizeFilter(){
        $this->filter->submit(Lang::get('panel::fields.search'));
        $this->filter->reset('reset');
    }
}
