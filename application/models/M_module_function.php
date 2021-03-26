<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_module_function extends MY_Model
{
    private $table;
    private $primary;

    public function __construct()
    {
        parent::__construct();

        $this->table   = 'module_functions';
        $this->primary = 'mf_id';

        $this->module = 'modules';
    }

    public function find($id)
    {
        return $this->db->where($this->primary, $id)->get($this->table)->row();
    }

    public function get($where = [], $args = [])
    {
        return $this->read($this->table, $this->primary, $where, $args, false);
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

    public function get_module($where = [])
    {
        if (!empty($where))
            $this->db->where($where);

        return $this->db->select('a.*, b.*')
            ->join($this->module . ' b', 'a.module_id = b.module_id')
            ->get($this->table . ' a');
    }
}
