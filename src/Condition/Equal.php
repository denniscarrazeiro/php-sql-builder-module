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

class Equal extends Condition {

	const CONDITION = "=";
	private $element1;
	private $element2;

	public function __construct($element1, $element2){
		if($this->checkIfIsAllowedInstance($element1) && 
			$this->checkIfIsAllowedInstance($element2))
		{
			$this->element1 = $element1;
			$this->element2 = $element2;
		}
	}

	public function queryBuild(){
		return sprintf("%s %s %s",
						$this->element1->queryBuild(),
						self::CONDITION,
						$this->element2->queryBuild());
	}
	
}