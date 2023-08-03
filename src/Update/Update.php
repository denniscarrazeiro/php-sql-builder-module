<?php

/*
 * This file is part of the denniscarrazeiro/php-sql-builder-module package.
 *
 * (c) Dennis Santana Carrazeiro <dennis.carrazeiro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DennisCarrazeiro\Php\Sql\Builder\Module\Update;

use \Exception;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Sql;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Update\Sets\Set;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Update\Sets\Sets;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Where\Where;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Joins\Joins;

class Update extends Sql {
	
	const STATEMENT = "UPDATE";
	private $set = [];
	private $where;
	private $joins;

	public function __construct($sets = null, $where = null, $joins = null){
		$this->sets = $sets instanceof Sets ? $set : new Sets();
		$this->where = $where instanceof Where ? $where : new Where();
		$this->joins = $joins instanceof Joins ? $joins : new Joins();
	}

	public function set($set){
		$this->set[] = $set instanceof Set ? $set : "";
		return $this;
	}

	public function sets(){
		$sets = is_array(func_get_arg(0)) ? func_get_arg(0) : func_get_args();
		$this->sets = new Sets($sets);
		return $this;
	}

	public function getSets(){
		if(is_array($this->set) && !empty($this->set)){
			$this->sets($this->set);
		}
		return $this->sets->queryBuild();
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
		$query = sprintf("%s %s %s SET %s %s;",
						 self::STATEMENT,
						 $this->getTable(),
						 $this->getJoins(),
						 $this->getSets(),
						 $this->getWhere());
		$this->query(trim($query));
	}

	public function rowsAffected(){
		return $this->rowsAffected;
	}

}