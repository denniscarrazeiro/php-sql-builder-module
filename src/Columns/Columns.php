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
use \DennisCarrazeiro\Php\Sql\Builder\Module\SqlInterface;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Columns\Column;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Values\Value;

class Columns implements SqlInterface {

	private $columns;

	public function __construct(){
		if(!empty(func_get_args())){
			$parameters = is_array(func_get_arg(0)) ? func_get_arg(0) : func_get_args();
			foreach($parameters as &$parameter){
				if(!$this->checkIfIsAllowedInstance($parameter)){
					throw new Exception("The parameters needs be a Column instance.");
				}
				$columnOrValue = $parameter->queryBuild();
				if($columnOrValue != ""){
					$this->columns .= sprintf("%s,",$columnOrValue);
				}
			}
			$this->columns = substr($this->columns, 0, -1);
		}
	}

	public function checkIfIsAllowedInstance($parameter){
		return $parameter instanceof Column ||
			   $parameter instanceof Value;
	}

	public function queryBuild(){
		return $this->columns ? sprintf("%s",$this->columns) : "";
	}

}