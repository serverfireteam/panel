<?php

namespace Serverfireteam\Panel;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Serverfireteam\Panel\CrudController;
use \Illuminate\Http\Request;
/**
 * Description of PagePanel
 *
 * @author alireza
 */
class AdminController extends CrudController{
    
    public function all($entity){
        parent::all($entity); 

        $this->filter = \DataFilter::source(Admin::with('roles'));
        $this->filter->add('id', 'ID', 'text');
        $this->filter->add('firstname', 'First name', 'text');
        $this->filter->add('last_name', 'Last Name', 'text');
        $this->filter->add('email', 'Email', 'text');
        $this->filter->submit('search');
        $this->filter->reset('reset');
        $this->filter->build();
                
        $this->grid = \DataGrid::source($this->filter);
        $this->grid->add('id','ID', true)->style("width:100px");
        $this->grid->add('{{ $first_name }} {{ $last_name}}','first name');
        $this->grid->add('email','Email');
       $this->grid->add('{{ implode(", ", $roles->lists("name")->all()) }}', 'Role');

        $this->addStylesToGrid();
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        if (\Request::input('password') != null )
        {
            $new_input = array('password' => \Hash::make(\Request::input('password'))); 
            \Request::merge($new_input);
        }
        
        parent::edit($entity);

        $this->edit = \DataEdit::source(new Admin());

        $this->edit->label('Edit Admin');
        $this->edit->link("rapyd-demo/filter","Articles", "TR")->back();
        $this->edit->add('email','Email', 'text')->rule('required|min:5');
        $this->edit->add('first_name', 'firstname', 'text');
        $this->edit->add('last_name', 'lastname', 'text');
        $this->edit->add('password', 'password', 'password')->rule('required');  
        $this->edit->add('roles','Roles','checkboxgroup')->options(Role::lists('name', 'id')->all());

        return $this->returnEditView();
    }

}
