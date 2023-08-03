<?php

/*
 * This file is part of the denniscarrazeiro/php-sql-builder-module package.
 *
 * (c) Dennis Santana Carrazeiro <dennis.carrazeiro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DennisCarrazeiro\Php\Sql\Builder\Module\Joins\InnerJoin;

use \Exception;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Sql;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Joins\Joins;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Table\Table;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Condition\Condition;

class InnerJoin extends Joins {

	const CLAUSE = "INNER JOIN";
	private $table;
	private $condition;

	public function __construct($table, $condition){
		$this->table  = new Table($table);
		$this->condition = $condition instanceof Condition ? $condition : "";
	}

	public function queryBuild(){
		return sprintf("%s %s ON %s", 
						self::CLAUSE, 
						$this->table->queryBuild(),
						$this->condition->queryBuild());
	}

}