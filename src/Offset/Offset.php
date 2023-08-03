<?php

/*
 * This file is part of the denniscarrazeiro/php-sql-builder-module package.
 *
 * (c) Dennis Santana Carrazeiro <dennis.carrazeiro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DennisCarrazeiro\Php\Sql\Builder\Module\Offset;

use \Exception;
use \DennisCarrazeiro\Php\Sql\Builder\Module\SqlInterface;

class Offset implements SqlInterface {

	const CLAUSE = "OFFSET";
	private $offset = -1;

	public function __construct($offset = null){
		if($offset && !is_int($offset)){
			throw new Exception('First parameter needs be int type.');
		}
		$this->offsset = $offset;
	}

	public function queryBuild(){
		return $this->offsset && $this->offset >= 0 ? 
			   sprintf("%s %s", self::CLAUSE, $this->offset) : 
			   "";
	}
	
}