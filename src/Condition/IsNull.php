<?php

/*
 * This file is part of the denniscarrazeiro/php-sql-builder-module package.
 *
 * (c) Dennis Santana Carrazeiro <dennis.carrazeiro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DennisCarrazeiro\Php\Sql\Builder\Module\Condition;

use \DennisCarrazeiro\Php\Sql\Builder\Module\Condition\Condition;

use \Exception;

class IsNull extends Condition { 

	const CONDITION = "IS NULL";
	private $element;

	public function __construct($element){
		$this->element = $this->checkIfIsAllowedInstance($element) ? $element : "";
	}

	public function queryBuild(){
		return sprintf("%s %s", $this->element->queryBuild(), self::CONDITION);
	}
	
}