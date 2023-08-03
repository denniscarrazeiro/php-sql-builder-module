<?php

/*
 * This file is part of the denniscarrazeiro/php-sql-builder-module package.
 *
 * (c) Dennis Santana Carrazeiro <dennis.carrazeiro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DennisCarrazeiro\Php\Sql\Builder\Module\Limit;

use \Exception;
use \DennisCarrazeiro\Php\Sql\Builder\Module\SqlInterface;

class Limit implements SqlInterface {

	const CLAUSE = "LIMIT";
	private $limit = -1;

	public function __construct($limit = null){
		if($limit && !is_int($limit)){
			throw new Exception('First parameter needs be int type.');
		}
		$this->limit = $limit;
	}

	public function queryBuild(){
		return $this->limit && $this->limit >= 0 ? 
			   sprintf("%s %s", self::CLAUSE, $this->limit) : 
			   "";
	}
	
}