<?php

/*
 * This file is part of the denniscarrazeiro/php-sql-builder-module package.
 *
 * (c) Dennis Santana Carrazeiro <dennis.carrazeiro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DennisCarrazeiro\Php\Sql\Builder\Module\Columns;

use \Exception;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Sql;
use \DennisCarrazeiro\Php\Sql\Builder\Module\SqlInterface;
use \DennisCarrazeiro\Php\Sql\Builder\Module\AntiInjection\AntiInjection;

class Column implements SqlInterface { 

	private $column;
	private $subQuery = false;

	public function __construct($column){
		if($column instanceof Sql){
			$column->queryBuild();
			$column = $column->getQuery();
			$this->subQuery = true;
		}
		if(!is_string($column)){
			throw new Exception("First parameter needs be string, numeric, 
								 boolean or null type.");
		}
		$this->column = !$this->subQuery ? AntiInjection::sanitizeColumn($column) : $column;
	}

	public function queryBuild(){
		if($this->subQuery){
			return sprintf("(%s)",$this->column);
		}
		$this->column = is_null($this->column) ? "NULL" : $this->column;
		return sprintf("%s",$this->column);
	}
	
}