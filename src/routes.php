<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Route::get('/panel', function () {
  return View::make('panelViews::dashboard');
});
        
Route::get('/panel/login', function () {
   return View::make('panelViews::login');
});
