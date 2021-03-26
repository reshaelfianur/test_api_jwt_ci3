<?php defined('BASEPATH') or exit('No direct script access allowed');

class MY_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function read($table, $primary, $where = [], $args = [], $deleted = true)
    {
        if (!empty($where)) {
            $this->db->escape($where);
            $this->db->where($where);
        }

        foreach ($args as $key => $value) {
            if ($key == 'distinct') {
                $this->db->distinct();
            } elseif ($key == 'select') {
                $this->db->select($args[$key]);
            } elseif ($key == 'whereIn') {
                $this->db->escape($args[$key]);
                for ($i = 0; $i < count($args[$key]); $i++) {
                    $this->db->where_in(array_keys($args[$key])[$i], $args[$key][array_keys($args[$key])[$i]]);
                }
            } elseif ($key == 'whereNotIn') {
                $this->db->escape($args[$key]);
                for ($i = 0; $i < count($args[$key]); $i++) {
                    $this->db->where_not_in(array_keys($args[$key])[$i], $args[$key][array_keys($args[$key])[$i]]);
                }
            } elseif ($key == 'orWhereIn') {
                $this->db->escape($args[$key]);
                for ($i = 0; $i < count($args[$key]); $i++) {
                    $this->db->or_where_in(array_keys($args[$key])[$i], $args[$key][array_keys($args[$key])[$i]]);
                }
            } elseif ($key == 'orWhereNotIn') {
                $this->db->escape($args[$key]);
                for ($i = 0; $i < count($args[$key]); $i++) {
                    $this->db->or_where_not_in(array_keys($args[$key])[$i], $args[$key][array_keys($args[$key])[$i]]);
                }
            } elseif ($key == 'like') {
                $this->db->escape($args[$key]);
                for ($i = 0; $i < count($args[$key]); $i++) {
                    $this->db->where_in(array_keys($args[$key])[$i], $args[$key][array_keys($args[$key])[$i]]);
                }
            } elseif ($key == 'notLike') {
                $this->db->escape($args[$key]);
                for ($i = 0; $i < count($args[$key]); $i++) {
                    $this->db->where_not_in(array_keys($args[$key])[$i], $args[$key][array_keys($args[$key])[$i]]);
                }
            } elseif ($key == 'orLike') {
                $this->db->escape($args[$key]);
                for ($i = 0; $i < count($args[$key]); $i++) {
                    $this->db->or_where_in(array_keys($args[$key])[$i], $args[$key][array_keys($args[$key])[$i]]);
                }
            } elseif ($key == 'orNotLike') {
                $this->db->escape($args[$key]);
                for ($i = 0; $i < count($args[$key]); $i++) {
                    $this->db->or_where_not_in(array_keys($args[$key])[$i], $args[$key][array_keys($args[$key])[$i]]);
                }
            } elseif ($key == 'group') {
                $this->db->group_by($args[$key]);
            } elseif ($key == 'having') {
                $this->db->having($args[$key]);
            } elseif ($key == 'orHaving') {
                $this->db->or_having($args[$key]);
            } elseif ($key == 'limit') {
                $this->db->limit($args[$key]);
            }
        }

        if (!empty($args['orderBy']))
            $this->db->order_by($args['orderBy']);
        else
            $this->db->order_by($primary);

        if ($deleted)
            $this->db->where($table . ".deleted_at", NULL);

        return $this->db->get($table);
    }

    public function created($table, $data, $created = true, $lastId = false)
    {
        $data = array_filter($data, function ($value) {
            return !is_null($value) && $value !== '';
        });

        if ($created) {
            $data = array_merge(
                $data,
                ['created_at' => dateTimeNow()]
            );
        }
        $this->db->escape($data);
        $this->db->insert($table, $data);

        if ($lastId) {
            return $this->db->insert_id();
        }

        return $this->db->affected_rows();
    }

    public function updated($table, $data, $where = [], $update = true, $whereIn = [], $whereNotIn = [])
    {
        $data = array_filter($data, function ($value) {
            return !is_null($value) && $value !== '';
        });

        if (!empty($where)) {
            $this->db->escape($where);
            $this->db->where($where);
        }

        if ($update) {
            $data = array_merge(
                $data,
                ['updated_at' => dateTimeNow()]
            );
        }

        if (!empty($whereIn)) {
            for ($i = 0; $i < count($whereIn); $i++) {
                $this->db->where_in(array_keys($whereIn)[$i], $whereIn[array_keys($whereIn)[$i]]);
            }
        }

        if (!empty($whereNotIn)) {
            for ($i = 0; $i < count($whereNotIn); $i++) {
                $this->db->where_not_in(array_keys($whereNotIn)[$i], $whereNotIn[array_keys($whereNotIn)[$i]]);
            }
        }
        $this->db->escape($data);
        $this->db->update($table, $data);

        return $this->db->affected_rows();
    }

    public function deleted($table, $data, $where, $deleted = true, $whereIn = [], $whereNotIn = [])
    {
        $data = array_filter($data, function ($value) {
            return !is_null($value) && $value !== '';
        });

        if ($deleted) {
            $data = array_merge(
                $data,
                ['deleted_at' => dateTimeNow()]
            );
        }

        if (!empty($whereIn)) {
            for ($i = 0; $i < count($whereIn); $i++) {
                $this->db->where_in(array_keys($whereIn)[$i], $whereIn[array_keys($whereIn)[$i]]);
            }
        }

        if (!empty($whereNotIn)) {
            for ($i = 0; $i < count($whereNotIn); $i++) {
                $this->db->where_not_in(array_keys($whereNotIn)[$i], $whereNotIn[array_keys($whereNotIn)[$i]]);
            }
        }
        $this->db->escape($where);
        $this->db->where($where);
        $this->db->escape($data);
        $this->db->update($table, $data);

        return $this->db->affected_rows();
    }

    public function hard_deleted($table, $where)
    {
        $this->db->escape($where);
        $this->db->where($where);
        $this->db->delete($table);

        return $this->db->affected_rows();
    }

    public function truncate($table)
    {
        $this->db->escape($table);

        return $this->db->affected_rows();
    }
}
