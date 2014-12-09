<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Sadra\Pack1\Controllers;

class MainController extends \Controller{
    
    
    public function anyEdit()
    {
        if (Input::get('do_delete')==1) return  "not the first";

        $edit = DataEdit::source(new Article());
        $edit->label('Edit Article');
        $edit->link("rapyd-demo/filter","Articles", "TR")->back();
        $edit->add('title','Title', 'text')->rule('required|min:5');

        $edit->add('body','Body', 'redactor');
        $edit->add('detail.note','Note', 'textarea')->attributes(array('rows'=>2));
        $edit->add('detail.note_tags','Note tags', 'text');
        $edit->add('author_id','Author','select')->options(Author::lists("firstname", "id"));
        $edit->add('publication_date','Date','date')->format('d/m/Y', 'it');
        $edit->add('photo','Photo', 'image')->move('uploads/demo/')->fit(240, 160)->preview(120,80);
        $edit->add('public','Public','checkbox');
        $edit->add('categories.name','Categories','tags');

        return $edit->view('rapyd::demo.edit', compact('edit'));
    }    
}
