<?php

namespace Evgeny\CarrotQuestApiPhpClient;

use Exception;

/**
 * Класс для формирования фильтров, для фильтрации списка пользователей
 */
class UsersFilter
{
    const AND = 'and';
    const OR = 'or';
    
    /**
     * Единицы измерения для
     * фильтров с датами
     */
    const UNIT_MINUTES = 'minutes';
    const UNIT_HOURS = 'hours';
    const UNIT_DAYS = 'days';
    const UNIT_WEEKS = 'weeks';

    /**
     * Любое значение
     *
     * @param String $propertyName
     * @return Array
     */
    public static function known(String $propertyName): Array
    {
        return [
            'type' => 'known',
            'property_name' => $propertyName,
            'value' => ''
        ];
    }

    /**
     * Не определено
     *
     * @param String $propertyName
     * @return Array
     */
    public static function unknown(String $propertyName): Array
    {
        return [
            'type' => 'unknown',
            'property_name' => $propertyName,
            'value' => ''
        ];
    }

    /**
     * Больше чем
     *
     * @param String $propertyName
     * @param Int $value
     * @return Array
     */
    public static function moreThan(String $propertyName, Int $value): Array
    {   
        $valueData = json_encode([
            'value' => $value
        ]);

        return [
            'type' => 'gt',
            'property_name' => $propertyName,
            'value' => $valueData
        ];
    }
    
    /**
     * Больше чем или не определено
     *
     * @param String $propertyName
     * @param Int $value
     * @return Array
     */
    public static function moreThanOrUnknown(String $propertyName, Int $value): Array
    {   
        $valueData = json_encode([
            'value' => $value
        ]);

        return [
            'type' => 'gt_or_unknown',
            'property_name' => $propertyName,
            'value' => $valueData
        ];
    }

    /**
     * Меньше чем
     *
     * @param String $propertyName
     * @param Int $value
     * @return Array
     */
    public static function lessThan(String $propertyName, Int $value): Array
    {
        $valueData = json_encode([
            'value' => $value
        ]);

        return [
            'type' => 'lt',
            'property_name' => $propertyName,
            'value' => $valueData
        ];
    }

    /**
     * Меньше чем
     *
     * @param String $propertyName
     * @param Int $value
     * @return Array
     */
    public static function lessThanOrUnknown(String $propertyName, Int $value): Array
    {
        $valueData = json_encode([
            'value' => $value
        ]);

        return [
            'type' => 'lt_or_unknown',
            'property_name' => $propertyName,
            'value' => $valueData
        ];
    }

    /**
     * В диапазоне (включая обе границы)
     *
     * @param String $propertyName
     * @param Int $value1
     * @param Int $value2
     * @return Array
     */
    public static function range(String $propertyName, Int $value1, Int $value2): Array
    {
        $valueData = json_encode([
            'value1' => $value1,
            'value2' => $value2
        ]);

        return [
            'type' => 'range',
            'property_name' => $propertyName,
            'value' => $valueData
        ];
    }

    /**
     * Равно (для чисел)
     *
     * @param String $propertyName
     * @param Int $value
     * @return Array
     */
    public static function equalForNumber(String $propertyName, Int $value): Array
    {
        $valueData = json_encode([
            'value' => $value
        ]);

        return [
            'type' => 'eq',
            'property_name' => $propertyName,
            'value' => $valueData
        ];
    }

    /**
     * Не равно (для чисел)
     *
     * @param String $propertyName
     * @param Int $value
     * @return Array
     */
    public static function notEqualForNumber(String $propertyName, Int $value): Array
    {
        $valueData = json_encode([
            'value' => $value
        ]);

        return [
            'type' => 'neq',
            'property_name' => $propertyName,
            'value' => $valueData
        ];
    }
    
    /**
     * Равно (для строки)
     *
     * @param String $propertyName
     * @param String $value
     * @return Array
     */
    public static function equalForString(String $propertyName, String $value): Array
    {
        $valueData = json_encode([
            'value' => $value
        ]);

        return [
            'type' => 'str_eq',
            'property_name' => $propertyName,
            'value' => $valueData
        ];
    }

    /**
     * Не равно (для строки)
     *
     * @param String $propertyName
     * @param String $value
     * @return Array
     */
    public static function notEqualForString(String $propertyName, String $value): Array
    {
        $valueData = json_encode([
            'value' => $value
        ]);

        return [
            'type' => 'str_neq',
            'property_name' => $propertyName,
            'value' => $valueData
        ];
    }

    /**
     * Содержит (для строки)
     *
     * @param String $propertyName
     * @param String $value
     * @return Array
     */
    public static function stringContains(String $propertyName, String $value): Array
    {
        $valueData = json_encode([
            'value' => $value
        ]);

        return [
            'type' => 'str_contains',
            'property_name' => $propertyName,
            'value' => $valueData
        ];
    }

     /**
     * Не содержит (для строки)
     *
     * @param String $propertyName
     * @param String $value
     * @return Array
     */
    public static function stringNoContains(String $propertyName, String $value): Array
    {
        $valueData = json_encode([
            'value' => $value
        ]);

        return [
            'type' => 'str_notcontains',
            'property_name' => $propertyName,
            'value' => $valueData
        ];
    }

    /**
     * True (булев)
     *
     * @param String $propertyName
     * @return Array
     */
    public static function boolTrue(String $propertyName): Array
    {
        return [
            'type' => 'bool_true',
            'property_name' => $propertyName,
            'value' => ''
        ];
    }

    /**
     * False (булев)
     *
     * @param String $propertyName
     * @return Array
     */
    public static function boolFalse(String $propertyName): Array
    {
        return [
            'type' => 'bool_false',
            'property_name' => $propertyName,
            'value' => ''
        ];
    }

    /**
     * Больше чем (дата)
     *
     * @param String $propertyName
     * @param Int $value
     * @param String $unit
     * @return void
     */
    public static function daysMore(String $propertyName, String $unit, Int $value)
    {
        $units = [
            self::UNIT_DAYS,
            self::UNIT_HOURS,
            self::UNIT_MINUTES,
            self::UNIT_WEEKS
        ];

        try{
            if (!in_array($unit, $units)){
                throw new Exception(__FUNCTION__ . ' Единицы измерения не существует');
            }

            $valueData = json_encode([
                'value' => $value,
                'unit' => $unit
            ]);
    
            return [
                'type' => 'daysmore',
                'property_name' => $propertyName,
                'value' => $valueData
            ];            

        } catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * Больше чем или не определено (дата)
     *
     * @param String $propertyName
     * @param Int $value
     * @param String $unit
     * @return void
     */
    public static function daysMoreOrUnknown(String $propertyName, Int $value, String $unit)
    {
        $units = [
            self::UNIT_DAYS,
            self::UNIT_HOURS,
            self::UNIT_MINUTES,
            self::UNIT_WEEKS
        ];

        try{
            if (!in_array($unit, $units)){
                throw new Exception(__FUNCTION__ . ' Единицы измерения не существует');
            }

            $valueData = json_encode([
                'value' => $value,
                'unit' => $unit
            ]);
    
            return [
                'type' => 'daysmore_or_unknown',
                'property_name' => $propertyName,
                'value' => $valueData
            ];            

        } catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * Меньше чем (дата)
     *
     * @param String $propertyName
     * @param Int $value
     * @param String $unit
     * @return void
     */
    public static function daysLess(String $propertyName, Int $value, String $unit)
    {
        $units = [
            self::UNIT_DAYS,
            self::UNIT_HOURS,
            self::UNIT_MINUTES,
            self::UNIT_WEEKS
        ];

        try{
            if (!in_array($unit, $units)){
                throw new Exception(__FUNCTION__ . ' Единицы измерения не существует');
            }

            $valueData = json_encode([
                'value' => $value,
                'unit' => $unit
            ]);
    
            return [
                'type' => 'daysless',
                'property_name' => $propertyName,
                'value' => $valueData
            ];            

        } catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * Меньше чем или не определено (дата)
     *
     * @param String $propertyName
     * @param Int $value
     * @param String $unit
     * @return void
     */
    public static function daysLessOrUnknown(String $propertyName, Int $value, String $unit)
    {
        $units = [
            self::UNIT_DAYS,
            self::UNIT_HOURS,
            self::UNIT_MINUTES,
            self::UNIT_WEEKS
        ];

        try{
            if (!in_array($unit, $units)){
                throw new Exception(__FUNCTION__ . ' Единицы измерения не существует');
            }

            $valueData = json_encode([
                'value' => $value,
                'unit' => $unit
            ]);
    
            return [
                'type' => 'daysless_or_unknown',
                'property_name' => $propertyName,
                'value' => $valueData
            ];            

        } catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * Содержит (для списков)
     *
     * @param String $propertyName
     * @param String $value
     * @return Array
     */
    public static function listContains(String $propertyName, String $value): Array
    {
        $valueData = json_encode([
            'value' => $value
        ]);

        return [
            'type' => 'lcontains',
            'property_name' => $propertyName,
            'value' => $valueData
        ];
    }

    /**
     * Складывает фильтры в
     * финальную оболочку
     *
     * @param String $type
     * @param Array $data
     * @return String
     */
    public static function makeWrapper(String $type, Array $data): String
    {
        $result = [
            'type' => $type,
            'filters' => $data
        ];
        return json_encode($result);
    }
}