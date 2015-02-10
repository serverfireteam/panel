<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Serverfireteam\Panel;

class ExportController extends \Controller {

    public function index($entity, $fileType) {

	$data = $entity::get();
	if (strcmp($fileType, "excel") == 0) {
		$excel = \App::make('Excel');
		\Excel::create($entity, function($excel) use ($data) {
			$excel->sheet('Sheet1', function($sheet) use ($data) {
				$sheet->fromModel($data);
			});
		})->export('xls');
	}
    }
}
