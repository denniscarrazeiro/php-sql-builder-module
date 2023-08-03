<?php

/*
 * This file is part of the denniscarrazeiro/php-sql-builder-module package.
 *
 * (c) Dennis Santana Carrazeiro <dennis.carrazeiro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DennisCarrazeiro\Php\Sql\Builder\Module\AntiInjection;

class AntiInjection {

	private const REGEX_ANTI_INJECTION = '/(from all_users|from dba_users|from user_users|select user|select database|insert into|delete from|drop database|drop table|show databases|show database|show tables|\\\\)/i';

	public static function sanitizeColumn($column){
		if(is_null($column)){
			return $column;
		}
		$defaultColumn = $column;
		$column = preg_replace('!\s+!',' ', $column);
		preg_match(self::REGEX_ANTI_INJECTION,$column,$matches,PREG_OFFSET_CAPTURE);
		$column = empty($matches) ? $defaultColumn : preg_replace(self::REGEX_ANTI_INJECTION,'',$column);
		if(strpos(strtolower($column),'select') && strpos(strtolower($column),'from')){
			$column = preg_replace('/(select|from)/i','',$column);
		}
		$column = preg_replace(self::REGEX_ANTI_INJECTION,'',$column);
		$column = trim($column);
		return $column;
	}

	public static function sanitizeValue($value){
		if(is_bool($value) || is_int($value) || is_float($value) || is_null($value)){
			return $value;
		}
		$defaultValue = $value;
		$value = preg_replace('!\s+!',' ', $value);
		preg_match(self::REGEX_ANTI_INJECTION,$value,$matches,PREG_OFFSET_CAPTURE);
		$value = empty($matches) ? $defaultValue : preg_replace(self::REGEX_ANTI_INJECTION,'',$value);
		$value = addslashes($value);
		$value = trim($value);
		return $value;
	}
	
}
