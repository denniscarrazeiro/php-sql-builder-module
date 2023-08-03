<?php

/*
 * This file is part of the denniscarrazeiro/php-sql-builder-module package.
 *
 * (c) Dennis Santana Carrazeiro <dennis.carrazeiro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DennisCarrazeiro\Php\Sql\Builder\Module\OrderBy;

use \Exception;
use \DennisCarrazeiro\Php\Sql\Builder\Module\SqlInterface;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Columns\Column;
use \DennisCarrazeiro\Php\Sql\Builder\Module\OrderBy\Sort\Sort;

class OrderBy implements SqlInterface {

	const STATEMENT = "ORDER BY";
	private $orderBy; 

	public function __construct(){
		if(!empty(func_get_args())){
			$parameters = is_array(func_get_arg(0)) ? func_get_arg(0) : func_get_args();
			$index = 1;
			foreach($parameters as &$parameter){
				if(!$this->checkIfIsAllowedInstance($parameter)){
					throw new Exception("The parameters needs be a Column or Sort instance.");
				}
				$this->orderBy .= sprintf("%s %s", 
										  $parameter->queryBuild(),
									 	  $this->commaAdder($this->getNextParameter($index,$parameters)));
				$index++;
			}
			$this->orderBy = substr($this->orderBy,0,-1);
		}
	}

	public function checkIfIsAllowedInstance($parameter){
		return $parameter instanceof Column ||
		       $parameter instanceof Sort;
	}

	public function getNextParameter($index,$parameters){
		return $index < count($parameters) ? $parameters[$index] : "";
	}

	public function commaAdder($parameter){
		return $parameter instanceof Sort ? "" : ",";
	}

	public function queryBuild(){
		return $this->orderBy ? 
			   sprintf("%s %s",self::STATEMENT,$this->orderBy) :
			   "";
	}
	
}