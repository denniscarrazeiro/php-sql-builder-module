<?php

/*
 * This file is part of the denniscarrazeiro/php-sql-builder-module package.
 *
 * (c) Dennis Santana Carrazeiro <dennis.carrazeiro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DennisCarrazeiro\Php\Sql\Builder\Module\Delete;

use \Exception;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Sql;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Where\Where;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Joins\Joins;

class Delete extends Sql {
	
	const STATEMENT = "DELETE";
	private $where;
	private $joins;

	public function __construct($where = null, $joins = null){
		$this->where = $where instanceof Where ? $where : new Where();
		$this->joins = $joins instanceof Joins ? $joins : new Joins();
	}

	public function where(){
		$where = is_array(func_get_arg(0)) ? func_get_arg(0) : func_get_args();
		$this->where = new Where($where);
		return $this;
	}

	public function getWhere(){
		return $this->where->queryBuild();
	}

	public function joins(){
		$joins = is_array(func_get_arg(0)) ? func_get_arg(0) : func_get_args();
		$this->joins = new Joins($joins);
		return $this;
	}

	public function getJoins(){
		return $this->joins->queryBuild();
	}

	public function queryBuild(){
		$query = sprintf("%s FROM %s %s %s;",
						  self::STATEMENT,
						  $this->getTable(),
						  $this->getJoins(),
						  $this->getWhere());
		$this->query(trim($query));
	}

}