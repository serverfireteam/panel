<?php
namespace Serverfireteam\Panel;

use Illuminate\Routing\Controller;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UsersController extends Controller{
    
    
    public  function all($entity){
        
        parent::all($entity);
       
        $this->filter = \DataFilter::source(new \User());
        $this->filter->add('id', 'ID', 'text');
        $this->filter->add('name', 'Name', 'text');
        $this->filter->submit('search');
        $this->filter->reset('reset');
        $this->filter->build();
                
        $this->grid = \DataGrid::source($this->filter);
        $this->grid->add('id','ID', true)->style("width:100px");
        $this->grid->add('name','Name');
        $this->addStylesToGrid();           
                       
        return $this->returnView();
    }
           
    
    
    
    public function edit($entity){
                
        parent::edit($entity);
              
        $this->edit = \DataEdit::source(new \User());
        
        $this->edit->label('Edit User');
        $this->edit->link("rapyd-demo/filter","Articles", "TR")->back();
        $this->edit->add('name','Name', 'text')->rule('required|min:5');
        $this->edit->add('username','userame', 'text')->rule('required|min:5');
        return $this->returnEditView();
    }
   
    public function getCreateUser(){
        return \View::make('panelViews::createUser');
    }

    public function postCreateUser(){
        
    }
}