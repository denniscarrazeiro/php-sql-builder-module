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

use \DennisCarrazeiro\Php\Sql\Builder\Module\Insert\Insert;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Select\Select;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Columns\Column;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Values\Value;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Update\Update;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Update\Sets\Set;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Delete\Delete;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Condition\Equal;

$table = "usuario";
$primaryKey = 1;

// CREATE
$insert = new Insert();
$insert->table($table)
       ->columns(new Column('nome'),
       			 new Column('email'),
   				 new Column('username'),
   				 new Column('data_criacao'),
   				 new Column('data_alteracao'))
       ->values( new Value('xpto'),
   				 new Value('xpto@example.com'),
   				 new Value('xp.to'),
   				 new Value(date('Y-m-d H:i:s')),
   				 new Value(null));

echo "<h1>CREATE:</h1>";
echo "<pre>";
echo "SQL Generate: ";
echo print_r($insert->getQuery(), true);
echo "</pre>";

//READ
$select = new Select();
$select->table($table)->where(new Equal(new Column('id'), new Value($primaryKey)));
echo "<h1>READ:</h1>";
echo "<pre>";
echo "SQL Generate: ";
echo print_r($select->getQuery(), true);
echo "</pre>";

//UPDATE
$update = new Update();
$update->table($table)
	   ->sets(
	   		new Set(new Column('nome'),new Value('xyz')),
	   		new Set(new Column('email'),new Value('xyz@email.com')),
	   		new Set(new Column('username'),new Value('xyz')),
	   		new Set(new Column('data_alteracao'),new Value(date('Y-m-d H:i:s'))),
	   )
	   ->where(new Equal(new Column('id'),new Value($primaryKey)));
echo "<h1>UPDATE:</h1>";
echo "<pre>";
echo "SQL Generate: ";
echo print_r($update->getQuery(), true);
echo "</pre>";

// DELETE
$delete = new Delete();
$delete->table($table)->where(new Equal(new Column('id'), new Value($primaryKey)));
echo "<h1>DELETE:</h1>";
echo "<pre>";
echo "SQL Generate: ";
echo print_r($delete->getQuery(), true);
echo "</pre>";
