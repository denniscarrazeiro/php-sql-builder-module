<?php

/*
 * This file is part of the denniscarrazeiro/php-sql-builder-module package.
 *
 * (c) Dennis Santana Carrazeiro <dennis.carrazeiro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DennisCarrazeiro\Php\Sql\Builder\Module\Insert;

use \Exception;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Sql;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Columns\Columns;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Values\Values;

class Insert extends Sql {
	
	const STATEMENT = "INSERT";
	private $columns;
	private $values;

	public function __construct($columns = null, $values = null){
		$this->columns = $columns instanceof Columns ? $columns : null;
		$this->values = $values instanceof Values ? $values : null;
	}

	public function columns(){
		$columns = is_array(func_get_arg(0)) ? func_get_arg(0) : func_get_args();
		$this->columns = new Columns($columns);
		return $this;
	}

	public function getColumns(){
		return $this->columns->queryBuild();
	}

	public function values(){
		$values = is_array(func_get_arg(0)) ? func_get_arg(0) : func_get_args();
		$this->values = new Values($values);
		return $this;
	}

	public function getValues(){
		return $this->values->queryBuild();
	}

	public function queryBuild(){
		$query = sprintf("%s INTO `%s` (%s) VALUES (%s);",
						 self::STATEMENT,
						 $this->getTable(),
						 $this->getColumns(),
						 $this->getValues());
		$this->query(trim($query));
	}
	
}