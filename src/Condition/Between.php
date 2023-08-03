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

class Between extends Condition {

	const CONDITION = "BETWEEN";
	private $column;
	private $element1;
	private $element2;

	public function __construct($column, $element1, $element2){
		$this->column = $column instanceof Column ? $column  : "";
		$this->element1 = $this->checkIfIsAllowedInstance($element1) ? $element1  : "";
		$this->element2 = $this->checkIfIsAllowedInstance($element2) ? $element2  : "";
	}

	public function queryBuild(){
		return sprintf("%s %s %s AND %s",
						$this->column->queryBuild(),
						self::CONDITION,
						$this->element1->queryBuild(),
						$this->element2->queryBuild());
	}
	
}