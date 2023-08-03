<?php

/*
 * This file is part of the denniscarrazeiro/php-sql-builder-module package.
 *
 * (c) Dennis Santana Carrazeiro <dennis.carrazeiro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DennisCarrazeiro\Php\Sql\Builder\Module\Joins\CrossJoin;

use \Exception;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Table\Table;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Joins\Joins;

class CrossJoin extends Joins {

	const CLAUSE = "CROSS JOIN";
	private $table;

	public function __construct($table){
		$this->table = new Table($table);
	}

	public function queryBuild(){
		return sprintf("%s %s", 
						self::CLAUSE, 
						$this->table->queryBuild());
	}
	
}