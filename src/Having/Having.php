<?php

/*
 * This file is part of the denniscarrazeiro/php-sql-builder-module package.
 *
 * (c) Dennis Santana Carrazeiro <dennis.carrazeiro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DennisCarrazeiro\Php\Sql\Builder\Module\Having;

use \Exception;
use \DennisCarrazeiro\Php\Sql\Builder\Module\SqlInterface;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Operator\Operator;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Condition\Condition;

class Having implements SqlInterface {

	const CLAUSE = "HAVING";
	private $having;

	public function __construct(){
		if(!empty(func_get_args())){
			$parameters = is_array(func_get_arg(0)) ? func_get_arg(0) : func_get_args();
			foreach($parameters as &$parameter){
				if(!$this->checkIfIsAllowedInstance($parameter)){
					throw new Exception("The parameters needs be an Operator or Condition instance.");
				}
				$this->having .= sprintf(" %s ", $parameter->queryBuild());
			}
		}
	}

	public function checkIfIsAllowedInstance($parameter){
		return $parameter instanceof Operator ||
			   $parameter instanceof Condition;
	}

	public function queryBuild(){
		return $this->having ? 
			   sprintf("%s %s", self::CLAUSE, $this->having) : 
			   "";
	}
	
}