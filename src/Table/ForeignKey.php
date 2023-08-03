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

class ForeignKey implements SqlInterface { 

	private $foreignKey;

	public function __construct($foreignKey){
		if(!is_string($foreignKey) || !$foreignKey){
			throw new Exception("First parameter needs be string type.");
		}

		$this->foreignKey = AntiInjection::sanitizeValue($foreignKey);
	}

	public function queryBuild(){
		return sprintf("%s", $this->foreignKey);
	}
	
}