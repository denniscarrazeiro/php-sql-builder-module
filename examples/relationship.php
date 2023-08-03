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

use \DennisCarrazeiro\Php\Sql\Builder\Module\Joins\LeftJoin\LeftJoin;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Select\Select;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Condition\Equal;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Columns\Column;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Values\Value;

$table = 'usuario as u';
$leftJoinEndereco = new LeftJoin('endereco e',new Equal(new Column('e.id_usuario'),new Column('u.id')));
$leftJoinCreditCard = new LeftJoin('credit_card c',new Equal(new Column('c.id_usuario'),new Column('u.id')));

$select = new Select();
$select->table('usuario as u')
	   ->joins($leftJoinEndereco,$leftJoinCreditCard)
	   ->groupBy(new Column('u.id'))
	   ->where(new Equal(new Column('u.id'),new Value(78)));

echo "<h1>READ:</h1>";
echo "<pre>";
echo "SQL Generate: ";
echo print_r($select->getQuery(), true);
echo "</pre>";