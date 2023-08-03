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

use \DennisCarrazeiro\Php\Sql\Builder\Module\Values\Values;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Condition\Condition;

class In extends Condition {

	const CONDITION = "IN";
	private $element;
	private $values;

	public function __construct($element, $values){
		$this->element = $this->checkIfIsAllowedInstance($element) ? $element : "";
		$this->values = $values instanceof Values ? $values : "";
	}

	public function queryBuild(){
		return sprintf("%s %s (%s)",
						$this->element->queryBuild(),
						self::CONDITION,
						$this->values->queryBuild());
	}
	
}
