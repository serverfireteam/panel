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
                      
    }

    
    public function all($entity)
    {
                                
                          
        //$this->addStylesToGrid();
                   
    }
    
    public function edit($entity)
    {
        
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
         return \View::make('panelViews::all', array(
             'grid' => $this->grid,
             'filter' => $this->filter
        ));
    }
    
    public function returnEditView()
    {
         return \View::make('panelViews::edit', array(
             'edit' => $this->edit
        ));
    }
}
