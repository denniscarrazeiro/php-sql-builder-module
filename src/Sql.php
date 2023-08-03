<?php

/*
 * This file is part of the denniscarrazeiro/php-sql-builder-module package.
 *
 * (c) Dennis Santana Carrazeiro <dennis.carrazeiro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DennisCarrazeiro\Php\Sql\Builder\Module;

use \DennisCarrazeiro\Php\Sql\Builder\Module\Table\Table;
use \DennisCarrazeiro\Php\Sql\Builder\Module\SqlInterface;

abstract class Sql implements SqlInterface {

	private $query;
	private $table;

	public function table($table){
		$this->table = new Table($table);
		return $this;
	}

	public function getTable(){
		if($this->table instanceof Table){
			$this->table = $this->table->queryBuild();
		}
		return $this->table;
	}
		
	public function query($query){
		$this->query = $query;
		return $this;
	}

	public function getQuery(){
		$this->queryBuild();
		return $this->query;
	}

	abstract function queryBuild();

}