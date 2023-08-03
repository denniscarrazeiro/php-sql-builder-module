<?php

/*
 * This file is part of the denniscarrazeiro/php-sql-builder-module package.
 *
 * (c) Dennis Santana Carrazeiro <dennis.carrazeiro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DennisCarrazeiro\Php\Sql\Builder\Module\Fetch;

use \Exception;
use \DennisCarrazeiro\Php\Sql\Builder\Module\SqlInterface;

class Fetch implements SqlInterface {

	const CLAUSE = "FETCH %s %s %s ROWS %s";
	private $rowsCountOrPercent = -1;
	private $nextOrFirst = ['NEXT','FIRST'];
	private $percent;
	private $onlyOrWithTies = ['ONLY','WITH TIES'];

	public function __construct($rowsCountOrPercent = -1, 
								$nextOrFirst = "NEXT", 
								$percent = false, 
								$onlyOrWithTies = "ONLY")
	{
		if($rowsCountOrPercent != -1 && $rowsCountOrPercent && !is_int($rowsCountOrPercent)){
			throw new Exception('First parameter needs be int type.');
		}
		$this->rowsCountOrPercent = $rowsCountOrPercent;
		$this->nextOrFirst = in_array(strtoupper($nextOrFirst), $this->nextOrFirst) ? strtoupper($nextOrFirst) : "";
		$this->percent = $percent ? "PERCENT" : "";
		$this->onlyOrWithTies = in_array(strtoupper($onlyOrWithTies), $this->onlyOrWithTies) ? strtoupper($onlyOrWithTies) : "";
	}

	public function queryBuild(){
		if($this->rowsCountOrPercent != -1){
			return sprintf(self::CLAUSE,
						   $this->rowsCountOrPercent,
						   $this->nextOrFirst,
						   $this->percent,
						   $this->onlyOrWithTies);
		}
		return "";
	}
	
}