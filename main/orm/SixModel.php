<?php

namespace six\orm;

use think\Db;
use think\Model;
use think\helper\Str;

/**
 * 扩展模型。
 * 
 */
abstract class SixModel extends Model
{
    /**
     * 构造子。
     *
     * @param string $name 表名
     */
    public function __construct($data = [])
    {
        $fullname = explode('\\', static::class);
        $n = $fullname[count($fullname) - 1];
        $this->name = Str::snake(substr($n, 0, strlen($n) - 5));
        parent::__construct($data);
    }

    /**
     * 获取字段。
     *
     * @param array $exclude
     * @param array $annexe
     * @return array
     */
    public function getFields($exclude, $annexe = null)
    {
        $fields = $this->checkAllowFields();
        $fields = array_diff($fields, $exclude);
        return array_merge($fields, $annexe);
    }

    /**
     * 批量范围。
     *
     * @param array $param
     * @param array $fields
     * @return void
     */
    public function batchRange($param, $fields)
    {
        foreach ($fields as $key => $field) {
            if (!empty($param[$key])) {
                $value = $param[$key];
                if (!empty($value[0])) {
                    $this->where($field, '>=', $value[0]);
                }
                if (!empty($value[1])) {
                    $this->where($field, '<=', $value[1]);
                }
            }
        }
    }

    /**
     * 批量模糊。
     *
     * @param array $param
     * @param array $fields
     * @return void
     */
    public function batchLike($param, $fields)
    {
        foreach ($fields as $key => $field) {
            if (!empty($param[$key])) {
                $text = trim($param[$key]);
                if (strlen($text) > 0) {
                    $this->where($field, 'like', "%{$text}%");
                };
            }
        }
    }

    /**
     * 批量等于。
     *
     * @param array $param
     * @param array $fields
     * @return void
     */
    public function batchEqual($param, $fields)
    {
        foreach ($fields as $key => $field) {
            if (array_key_exists($key, $param)) {
                $value = $param[$key];
                if (is_string($value)) {
                    $text = trim($value);
                    if (strlen($text) > 0) {
                        $this->where($field, '=', $text);
                    }
                } else {
                    $operation = is_array($value) ? 'in' : '=';
                    $this->where($field, $operation, $value);
                }
            }
        }
    }

    public function batchUpdate($data, $field = 'id')
    {
        $keys = [];
        $items = [];
        foreach ($data as $row) {
            $key = $row[$field];
            $keys[] = $key;
            foreach ($row as $k => $v) {
                if (is_string($v)) {
                    $items[$k] = "WHEN $key THEN '$v'";
                } else {
                    $items[$k] = "WHEN $key THEN $v";
                }
            }
        }
        $cases = [];
        foreach ($items as $f => $i) {
            $cases[$f] = Db::raw("CASE $field " . join(' ', $i) . ' END');
        }
        $this->where($field, 'in', $keys)
            ->update($cases);
    }
}
