# PHP Sql Builder Module

[![Maintainer](http://img.shields.io/badge/maintainer-@denniscarrazeiro-blue.svg?style=flat-square)](https://www.linkedin.com/in/dennis-carrazeiro)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/denniscarrazeiro/php-sql-builder-module.svg?style=flat-square)](https://packagist.org/packages/denniscarrazeiro/php-sql-builder-module)
[![Latest Version](https://img.shields.io/github/release/denniscarrazeiro/php-sql-builder-module.svg?style=flat-square)](https://github.com/denniscarrazeiro/php-database-modul/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Total Downloads](https://img.shields.io/packagist/dt/denniscarrazeiro/php-sql-builder-module.svg?style=flat-square)](https://packagist.org/packages/denniscarrazeiro/php-sql-builder-module)

Módulo que gera comandos sql simples ou até de alta complexidade.
Também foram contemplados consultas de banco de dados especificos.

Rode o comando:

```bash
curl -sS https://getcomposer.org/installer | php && php composer.phar install
```

O composer é um gerenciador de dependencia da linguagem de programação PHP. 
Então, após rodar o comando acima o composer fará a instalação de todas as 
dependencias necessárias para que o projeto funcione com a melhor condição possível.


#### Exemplo básico de uso:

```php
	
require_once(__DIR__."/vendor/autoload.php");

use \DennisCarrazeiro\Php\Sql\Builder\Module\Select;

$table = "test";
$column = "id";
$primaryKey = 1;

$select = new Select();
$select->table($table)->where(new Equal(new Column($column), new Value($primaryKey)));

```

#### Exemplo relationship:

```php

require_once(__DIR__."/vendor/autoload.php");

use \DennisCarrazeiro\Php\Sql\Builder\Module\Joins\LeftJoin\LeftJoin;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Select\Select;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Condition\Equal;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Columns\Column;
use \DennisCarrazeiro\Php\Sql\Builder\Module\Values\Value;

$table = 'user as u';
$leftJoinAddress = new LeftJoin('address e',new Equal(new Column('e.id_user'),new Column('u.id')));
$leftJoinCreditCard = new LeftJoin('credit_card c',new Equal(new Column('c.id_user'),new Column('u.id')));

$select = new Select();
$select->table('user as u')
	   ->joins($leftJoinEndereco,$leftJoinCreditCard)
	   ->groupBy(new Column('u.id'))
	   ->where(new Equal(new Column('u.id'),new Value(78)));

```

## Mais exemplos

Para mais exemplos veja a pasta [Exemplos](https://github.com/denniscarrazeiro/php-sql-builder-module/blob/master/examples).

## Licença

A licença MIT. Por favor ver [Arquivo licença](https://github.com/denniscarrazeiro/php-sql-builder-module/blob/master/LICENSE) para mais informações.