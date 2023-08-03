<?php

/*
 * This file is part of the denniscarrazeiro/php-sql-builder-module package.
 *
 * (c) Dennis Santana Carrazeiro <dennis.carrazeiro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DennisCarrazeiro\Php\Sql\Builder\Module\Top;

use \Exception;
use \DennisCarrazeiro\Php\Sql\Builder\Module\SqlInterface;

class Top implements SqlInterface {

	const CLAUSE = "TOP %s %s";
	private $top = -1;
	private $percent = false;

	public function __construct($top = -1, $percent = false){
		if($top != -1 && $top && !is_int($top)){
			throw new Exception('First parameter needs be int type.');
		}
		if(!is_bool($percent)){
			throw new Exception('Second parameter needs be boolean type.');	
		}
		$this->top = $top;
		$this->percent = $percent ? "PERCENT" : "";
	}

	public function queryBuild(){
		if($this->top != -1){
			return sprintf(self::CLAUSE,$this->top,$this->percent);	
		}
		return "";
	}

}