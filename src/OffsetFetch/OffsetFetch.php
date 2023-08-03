<?php

/*
 * This file is part of the denniscarrazeiro/php-sql-builder-module package.
 *
 * (c) Dennis Santana Carrazeiro <dennis.carrazeiro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DennisCarrazeiro\Php\Sql\Builder\Module\OffsetFetch;

use \Exception;
use \DennisCarrazeiro\Php\Sql\Builder\Module\SqlInterface;

class OffsetFetch implements SqlInterface {

	const CLAUSE = "OFFSET %s %S %s %s %S %s %s";
	private $offset = -1;
	private $rowsOrRowOffset = ['ROWS','ROW'];
	private $fetch = -1;
	private $nextOrFirst = ['NEXT','FIRST'];
	private $rowsOrRowFetch = ['ROWS','ROW'];

	public function __construct($offset = -1,
								$rowsOrRowOffset = "ROWS",
								$fetch = -1,
								$nextOrFirst = "NEXT", 
								$rowsOrRowFetch = "ROWS")
	{
		if($offset != -1 && $offset && !is_int($offset)){
			throw new Exception('First parameter needs be int type.');
		}
		if($fetch != -1 && $fetch && !is_int($fetch)){
			throw new Exception('Third parameter needs be int type.');
		}
		$this->offset = $offset;
		$this->rowsOrRowOffset = in_array(strtoupper($rowsOrRowFetch), $this->rowsOrRowOffset) ? strtoupper($rowsOrRowOffset) : "";
		$this->fetch = $fetch;
		$this->nextOrFirst = in_array(strtoupper($nextOrFirst), $this->nextOrFirst) ? strtoupper($nextOrFirst) : "";
		$this->rowsOrRowFetch = in_array(strtoupper($rowsOrRowFetch), $this->rowsOrRowFetch) ? strtoupper($rowsOrRowFetch) : "";
	}

	public function queryBuild(){
		if($this->offset != -1){
			return sprintf(self::CLAUSE,
						   $this->offset,
						   $this->rowsOrRowOffset,
						   $this->fetch ? "FETCH" : "",
						   $this->fetch ? $this->fetch : "",
						   $this->fetch && $this->nextOrFirst ? $this->nextOrFirst : "",
						   $this->fetch && $this->rowsOrRowFetch ? $this->rowsOrRowFetch : "",
						   $this->fetch ? "ONLY" : "");	
		}
		return "";
	}
	
}
