<?php

/*
 * This file is part of the denniscarrazeiro/php-sql-builder-module package.
 *
 * (c) Dennis Santana Carrazeiro <dennis.carrazeiro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DennisCarrazeiro\Php\Sql\Builder\Module\Table;

use \Exception;
use \DennisCarrazeiro\Php\Sql\Builder\Module\SqlInterface;
use \DennisCarrazeiro\Php\Sql\Builder\Module\AntiInjection\AntiInjection;

class Table implements SqlInterface {

	private $table;

	public function __construct($table){
		if(!is_string($table) || !$table){
			throw new Exception("First parameter needs be string type and not empty.");
		}
		$this->table = AntiInjection::sanitizeValue($table);
	}

	public function queryBuild(){
		return $this->table ? sprintf("%s",$this->table) : "";
	}
	
}