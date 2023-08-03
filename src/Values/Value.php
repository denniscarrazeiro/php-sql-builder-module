<?php

/*
 * This file is part of the denniscarrazeiro/php-sql-builder-module package.
 *
 * (c) Dennis Santana Carrazeiro <dennis.carrazeiro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DennisCarrazeiro\Php\Sql\Builder\Module\Values;

use \Exception;
use \DennisCarrazeiro\Php\Sql\Builder\Module\SqlInterface;
use \DennisCarrazeiro\Php\Sql\Builder\Module\AntiInjection\AntiInjection;

class Value implements SqlInterface {

	private $value;
	private $subQuery = false;

	public function __construct($value){
		if($value instanceof Sql){
			$value->queryBuild();
			$value = $value->getQuery();
			$this->subQuery = true;
		}
		if(!is_string($value) && !is_int($value) && 
		   !is_float($value) && !is_bool($value) && 
		   !is_null($value))
		{
			throw new Exception("First parameter needs be string, numeric, 
								 boolean or null type.");
		}
		$this->value = !$this->subQuery ? AntiInjection::sanitizeValue($value) : $this->value;
	}

	public function queryBuild(){
		if($this->subQuery){
			return sprintf("(%s)");
		}
		if(is_null($this->value)){
			return sprintf("%s","NULL");
		}
		$singleQuotes = is_string($this->value) ? "'" : "";
		return sprintf("%s%s%s",
					   $singleQuotes,
					   $this->value,
					   $singleQuotes);
	}
	
}
