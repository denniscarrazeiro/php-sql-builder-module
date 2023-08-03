<?php

/*
 * This file is part of the denniscarrazeiro/php-sql-builder-module package.
 *
 * (c) Dennis Santana Carrazeiro <dennis.carrazeiro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DennisCarrazeiro\Php\Sql\Builder\Module\GroupBy;

use \Exception;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Columns\Column;
use \DennisCarrazeiro\Php\Sql\Builder\Module\SqlInterface;

class GroupBy implements SqlInterface {

	const STATEMENT = "GROUP BY";
	private $groupBy;

	public function __construct(){
		if(!empty(func_get_args())){
			$parameters = is_array(func_get_arg(0)) ? func_get_arg(0) : func_get_args();
			foreach($parameters as &$parameter){
				if(!$this->checkIfIsAllowedInstance($parameter)){
					throw new Exception("The parameters needs be object of Column instance.");
				}
				$this->groupBy .= sprintf("%s,",$parameter->queryBuild());
			}
			$this->groupBy = substr($this->groupBy, 0, -1);
		}
	}

	public function checkIfIsAllowedInstance($parameter){
		return $parameter instanceof Column;
	}

	public function queryBuild(){
		return $this->groupBy ? 
			   sprintf("%s %s",self::STATEMENT, $this->groupBy) : 
			   "";
	}
	
}