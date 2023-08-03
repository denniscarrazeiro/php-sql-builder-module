<?php

/*
 * This file is part of the denniscarrazeiro/php-sql-builder-module package.
 *
 * (c) Dennis Santana Carrazeiro <dennis.carrazeiro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(__DIR__."/../vendor/autoload.php");

use \DennisCarrazeiro\Php\Sql\Builder\Module\Select\Select;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Columns\Column;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Values\Value;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Condition\Equal;

$table = "usuario";
$column = "*";
$value = '<a href="xpto  dqwqdqwd"> dqwdqw </a> xp.to OR 1=1';

$subQuery = new Select();
$subQuery->columns(new Column('CONCAT("1","2","3")'));

$select = new Select();
$select->columns(new Column($column), new column('nome'),new Column($subQuery))
	   ->table($table)
	   ->where(new Equal(new Column('nome'), new Value($value)));

echo "<h1>SQL Generate:</h1>";
echo "<pre>";
echo print_r($select->getQuery(),1);
echo "</pre>";