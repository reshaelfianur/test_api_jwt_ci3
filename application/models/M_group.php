<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_group extends MY_Model
{
    private $table;
    private $primary;

    public function __construct()
    {
        parent::__construct();

        $this->table   = 'groups';
        $this->primary = 'group_id';

        $this->user = 'users';
    }

    public function find($id)
    {
        return $this->db->where($this->primary, $id)->get($this->table)->row();
    }

    public function get($where = [], $args = [])
    {
        return $this->read($this->table, $this->primary, $where, $args);
    }

    public function insert($data, $created = true, $lastId = false)
    {
        return $this->created($this->table, $data, $created, $lastId);
    }

    public function update($data, $where = [])
    {
        return $this->updated($this->table, $data, $where);
    }

    public function delete($data, $where)
    {
        return $this->deleted($this->table, $data, $where);
    }

    public function hard_delete($where)
    {
        return $this->hard_deleted($this->table, $where);
    }

    public function get_user($where = [])
    {
        if (!empty($where))
            $this->db->where($where);

        return $this->db->select('a.*, b.*')
            ->join($this->user . ' b', 'a.user_id = b.user_id')
            ->where('a.deleted_at', NULL)
            ->get($this->table . ' a');
    }
}
