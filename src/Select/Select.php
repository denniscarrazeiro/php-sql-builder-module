<?php

/*
 * This file is part of the denniscarrazeiro/php-sql-builder-module package.
 *
 * (c) Dennis Santana Carrazeiro <dennis.carrazeiro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DennisCarrazeiro\Php\Sql\Builder\Module\Select;

use \DennisCarrazeiro\Php\Sql\Builder\Module\Sql;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Columns\Columns;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Table\Table;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Joins\Joins;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Where\Where;
use \DennisCarrazeiro\Php\Sql\Builder\Module\GroupBy\GroupBy;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Having\Having;
use \DennisCarrazeiro\Php\Sql\Builder\Module\OrderBy\OrderBy;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Limit\Limit;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Offset\Offset;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Top\Top;
use \DennisCarrazeiro\Php\Sql\Builder\Module\OffsetFetch\OffsetFetch;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Fetch\Fetch;

class Select extends Sql {

	const STATEMENT = "SELECT";
	private $columns;
	private $joins;
	private $where;
	private $groupBy;
	private $orderBy;
	private $limit;
	private $offset;
	private $top;
	private $offsetFetch;
	private $fetch;

	public function __construct($columns = null,
							    $table = null,
								$joins = null,
								$where = null, 
								$groupBy = null, 
								$having = null, 
								$orderBy = null, 
								$limit = null, 
								$offset = null,
								$top = null,
								$offsetFetch = null,
								$fetch = null)
	{
		$this->columns = $columns instanceof Columns ? $columns : new Columns();
		$table instanceof Table ? $this->table($table) : null;
		$this->joins = $joins instanceof Joins ? $joins : new Joins();
		$this->where = $where instanceof Where ? $where : new Where();
		$this->groupBy = $groupBy instanceof GroupBy ? $groupBy : new GroupBy();
		$this->having = $having instanceof Having ? $having : new Having();
		$this->orderBy = $orderBy instanceof OrderBy ? $orderBy : new OrderBy();
		$this->limit = $limit instanceof Limit ? $limit : new Limit();
		$this->offset = $offset instanceof Offset ? $offset : new Offset();
		$this->top = $top instanceof Top ? $top : new Top();
		$this->offsetFetch = $offsetFetch instanceof OffsetFetch ? $offsetFetch : new OffsetFetch();
		$this->fetch = $fetch instanceof Fetch ? $fetch : new Fetch();
	}

	public function columns(){
		$columns = is_array(func_get_arg(0)) ? func_get_arg(0) : func_get_args();
		$this->columns = new Columns($columns);
		return $this;
	}

	public function getColumns(){
		return $this->columns->queryBuild();
	}

	public function joins(){
		$joins = is_array(func_get_arg(0)) ? func_get_arg(0) : func_get_args();
		$this->joins = new Joins($joins);
		return $this;
	}

	public function getJoins(){
		return $this->joins->queryBuild();
	}

	public function where(){
		$where = is_array(func_get_arg(0)) ? func_get_arg(0) : func_get_args();
		$this->where = new Where($where);
		return $this;
	}

	public function getWhere(){
		return $this->where->queryBuild();
	}

	public function groupBy(){
		$groupBy = is_array(func_get_arg(0)) ? func_get_arg(0) : func_get_args();
		$this->groupBy = new GroupBy($groupBy);
		return $this;
	}

	public function getGroupBy(){
		return $this->groupBy->queryBuild();
	}

	public function having(){
		$having = is_array(func_get_arg(0)) ? func_get_arg(0) : func_get_args();
		$this->having = new Having($having);
		return $this;
	}

	public function getHaving(){
		return $this->having->queryBuild();
	}

	public function orderBy(){
		$orderBy = is_array(func_get_arg(0)) ? func_get_arg(0) : func_get_args();
		$this->orderBy = new OrderBy($orderBy);
		return $this;
	}

	public function getOrderby(){
		return $this->orderBy->queryBuild();
	}

	public function limit($limit){
		$this->limit = new Limit($limit);
		return $this;
	}

	public function getLimit(){
		return $this->limit->queryBuild();
	}

	public function offset($offset){
		$this->offset = new Offset($offset);
		return $this;
	}

	public function getOffset(){
		return $this->offset->queryBuild();
	}

	public function top($top = -1, $percent = false){
		$this->top = new Top($top,$percent);
		return $this;
	}

	public function getTop(){
		return $this->top->queryBuild();
	}

	public function offsetFetch($offset = -1,
								$rowsOrRowOffset = "ROWS",
								$fetch = -1,
								$nextOrFirst = "NEXT", 
								$rowsOrRowFetch = "ROWS")
	{
		$this->offsetFetch = new OffsetFetch($offset,
										  	 $rowsOrRowOffset,
										   	 $fetch,
										  	 $nextOrFirst, 
										     $rowsOrRowFetch);
		return $this;
	}

	public function getOffsetFetch(){
		return $this->offsetFetch->queryBuild();
	}

	public function fetch($rowsCountOrPercent = -1, 
						  $nextOrFirst = "NEXT", 
						  $percent = false, 
						  $onlyOrWithTies = "ONLY")
	{
		$this->fetch = new Fetch($rowsCountOrPercent,
								 $nextOrFirst,
								 $percent,
								 $onlyOrWithTies);
		return $this;
	}

	public function getFetch(){
		return $this->fetch->queryBuild();
	}

	public function queryBuild(){
		$query = sprintf("%s %s %s %s %s %s %s %s %s %s %s",
						  self::STATEMENT,
						  $this->getTop(),
						  $this->getColumns() ? $this->getColumns() : "*" ,
						  $this->getTable() ? sprintf("FROM %s",$this->getTable()) : "",
						  $this->getJoins(),
						  $this->getWhere(),
						  $this->getGroupBy(),
						  $this->getHaving(),
						  $this->getOrderby(),
						  $this->getLimit(),
						  $this->getOffset(),
						  $this->getFetch());
		$this->query(trim($query));
	}
	
}