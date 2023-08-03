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
use \DennisCarrazeiro\Php\Sql\Builder\Module\Columns\Column;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Values\Value;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Condition\Equal;

class Set implements SqlInterface {

	private $set;
	private $element1;
	private $element2;

	public function __construct($element1,$element2){
		$this->element1 = $this->checkIfIsAllowedInstance($element1) ? $element1 : null;
		$this->element2 = $this->checkIfIsAllowedInstance($element2) ? $element2 : null;
	}

	public function checkIfIsAllowedInstance($parameter){
		return $parameter instanceof Column ||
			   $parameter instanceof Value;
	}

	public function queryBuild(){
		$condition = new Equal($this->element1,$this->element2);
		return $condition->queryBuild();
	}
	
}