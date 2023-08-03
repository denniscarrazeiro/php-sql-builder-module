<?php

/*
 * This file is part of the denniscarrazeiro/php-sql-builder-module package.
 *
 * (c) Dennis Santana Carrazeiro <dennis.carrazeiro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DennisCarrazeiro\Php\Sql\Builder\Module\Update\Sets;

use \Exception;
use \DennisCarrazeiro\Php\Sql\Builder\Module\SqlInterface;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Update\Sets\Set;

class Sets implements SqlInterface {

	private $sets;

	public function __construct(){
		if(!empty(func_get_args())){
			$parameters = is_array(func_get_arg(0)) ? func_get_arg(0) : func_get_args();
			foreach($parameters as &$parameter){
				if(!$this->checkIfIsAllowedInstance($parameter)){
					throw new Exception("The parameters needs be object of Set type.");
				}
				$this->sets .= sprintf("%s,", $parameter->queryBuild());
			}
			$this->sets = substr($this->sets, 0, -1);
		}
	}

	public function checkIfIsAllowedInstance($parameter){
		return $parameter instanceof Set;
	}

	public function queryBuild(){
		return $this->sets ? sprintf("%s",$this->sets) : "";
	}

}