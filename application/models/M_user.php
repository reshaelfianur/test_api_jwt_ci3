<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends MY_Model
{
    private $table;
    private $primary;

    private $group;
    private $employee;

    public function __construct()
    {
        parent::__construct();

        $this->table   = 'users';
        $this->primary = 'user_id';

        $this->group    = 'groups';
        $this->employee = 'employees';
    }

    public function find($id)
    {
        return $this->db->where($this->primary, $id)->get($this->table)->row();
    }

    public function get($where = [], $args = [])
    {
        return $this->read($this->table, $this->primary, $where, $args);
    }

    public function insert($data, $lastId = false)
    {
        return $this->created($this->table, $data, true, $lastId);
    }

    public function update($data, $where, $update = true)
    {
        return $this->updated($this->table, $data, $where, $update);
    }

    public function delete($data, $where)
    {
        return $this->deleted($this->table, $data, $where);
    }

    public function hard_delete($where)
    {
        return $this->hard_deleted($this->table, $where);
    }

    public function get_group($where = [])
    {
        if (!empty($where))
            $this->db->where($where);

        return $this->db->select('a.*, b.*')
            ->join($this->group . ' b', 'a.group_id = b.group_id')
            ->where('a.deleted_at', NULL)
            ->get($this->table . ' a');
    }
}
