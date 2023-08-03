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

use \Exception;
use \DennisCarrazeiro\Php\Sql\Builder\Module\SqlInterface;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Columns\Column;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Values\Value;

abstract class Condition implements SqlInterface {

	public function checkIfIsAllowedInstance($parameter){
		if($parameter instanceof Column || $parameter instanceof Value){
			return true;
		}
		throw new Exception("The parameters needs be Column Or Value instance.");
	}

	abstract function queryBuild();

}