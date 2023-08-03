<?php

/*
 * This file is part of the denniscarrazeiro/php-sql-builder-module package.
 *
 * (c) Dennis Santana Carrazeiro <dennis.carrazeiro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DennisCarrazeiro\Php\Sql\Builder\Module\Joins;

use \Exception;
use \DennisCarrazeiro\Php\Sql\Builder\Module\SqlInterface;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Joins\CrossJoin\CrossJoin;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Joins\InnerJoin\InnerJoin;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Joins\LeftJoin\LeftJoin;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Joins\RightJoin\RightJoin;

class Joins implements SqlInterface {

	private $joins;

	public function __construct(){
		if(!empty(func_get_args())){
			$parameters = is_array(func_get_arg(0)) ? func_get_arg(0) : func_get_args();
			foreach($parameters as &$parameter){
				$this->checkIfIsAllowedInstance($parameter);
				$this->joins .= sprintf(" %s ",$parameter->queryBuild());
			}
		}
	}

	public function checkIfIsAllowedInstance($parameter){
		if($parameter instanceof CrossJoin ||
		   $parameter instanceof InnerJoin ||
		   $parameter instanceof LeftJoin  ||
		   $parameter instanceof RightJoin){
			return true;
		}
		throw new Exception("The parameters needs be a LeftJoin, RightJoin, 
						     InnerJoin or CrossJoin instance.");
	}

	public function queryBuild(){
		return $this->joins ? sprintf("%s",$this->joins) : "";
	}
	
}