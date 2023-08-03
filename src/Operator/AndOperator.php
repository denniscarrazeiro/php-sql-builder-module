<?php

/*
 * This file is part of the denniscarrazeiro/php-sql-builder-module package.
 *
 * (c) Dennis Santana Carrazeiro <dennis.carrazeiro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DennisCarrazeiro\Php\Sql\Builder\Module\Operator;

class AndOperator  extends Operator {
		
	const OPERATOR = "AND";

	public function queryBuild(){
		return sprintf("%s",self::OPERATOR);
	}

}