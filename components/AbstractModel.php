<?php

namespace app\components;

use Yii;
use yii\db\ActiveRecord;

abstract class AbstractModel extends ActiveRecord {

    public function getAll($order = ['id' => SORT_ASC]) {
        return self::find()->orderBy($order)->all();
    }

    public function getOne($order = ['id' => SORT_ASC]) {
        return self::find()->orderBy($order)->one();
    }

    public function findByColumn($params, $operator = '', $order = ['id' => SORT_ASC], $request = true) {
        $query = '';
        if (count($params) > 1) {
            $query = self::find()->where($params[0]);
            if ($operator == 'and') {
                for ($i = 1; $i < count($params); ++$i) {
                    $query->andWhere($params[$i]);
                }
            }
            if ($operator == 'or') {
                for ($i = 1; $i < count($params); ++$i) {
                    $query->orWhere($params[$i]);
                }
            }
        } else {
            $query = self::find()->where($params);
        }

        if (!empty($order)) {
            $query->orderBy($order);
        }

        if ($request) {
            return $query->all();
        } else {
            return $query;
        }
    }

    public function updateData($table, $column, $data, $caseColumn = false) {
        $dataCases = [];
        $createCase = '';

        if (is_array($data)) {
            if ($caseColumn) {
                $ids = [];
                foreach ($data as $key => $items) {
                    $dataCases[] = ' WHEN ' . $caseColumn . ' = '. $key . ' THEN ' . (!empty($items) ? '\'' . $items . '\'' : 'NULL');
                    $ids[] = $key;
                }
                $dataCases[] = 'ELSE ' . $caseColumn . ' END WHERE ' . $caseColumn . ' in (' . implode(', ', $ids) . ')';
                $createCase = ' CASE ' . implode(' ', $dataCases);
            }
        } else {
            return false;
        }
        
        return Yii::$app->db->createCommand(
            'UPDATE ' . $table . ' SET ' . $column . '=' . $createCase
        )->execute();
    }

    public function insertData($table, $data) { // ['id' => 2]
        $value = [];
        $values = [];
        $keys = [];

        if (is_array($data)) {
            $keys = array_keys($data[0]);
            if (count($data) > 1) {
                foreach ($data as $key => $items) {
                    $value = [];
                    foreach ($items as $k => $item) {
                        $value[$k] = $item;
                    }
                    $values[] = '(\'' . implode('\', \'', $value) . '\')';
                }
            } else {
                $values[] = '(\'' . implode('\', \'', $data[0]) . '\')';

            }
            $sql = 'INSERT INTO ' . $table . ' (' . implode(', ', $keys) . ')' .
                ' VALUES ' . implode(', ', $values);

            Yii::$app->db->createCommand($sql)->execute();
            return true;
        } else {
            return false;
        }
    }

    public function filter($object, $options = []) {
        if (!empty($options)) {
            if (count($options) > 1) {
                foreach ($options as $key => $value) {
                    $object = $object->andWhere($key . '=' . $value);
                }
            } else {
                $object =  $object->where($options);
            }
        }

        return $object;
    }

}