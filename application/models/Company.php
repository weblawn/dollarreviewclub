<?php

class Company extends CI_Model {

    private $table;

    public function __construct() {
        parent::__construct();

        // Assign Table
        $this->table = $this->db->dbprefix('companies');
    }

    public function add(array $input) {
        if ($this->db->insert($this->table, $input)) {
            $result = $this->get($this->db->insert_id());
            return $result;
        }
        return false;
    }

    public function get($cid) {
        $this->db->select("*");
        $this->db->where("cid", $cid);

        // Find company data
        $q = $this->db->get($this->table);
        if ($q->num_rows() > 0) {
            $result = $q->row();
            return $result;
        }

        return false;
    }

    public function get_where(array $args = array(), $limit = NULL, $offset = NULL, array $orderBy = array()) {
        $this->db->select("*");

        // Bind Condition
        if (!empty($args)) {
            foreach ($args as $key => $val) {
                $this->db->where($key, $val);
            }
        }

        // Order By
        if (!empty($orderBy)) {
            $this->db->order_by($orderBy[0], $orderBy[1]);
        }

        $q = $this->db->get($this->table, $limit, $offset);
        if ($q->num_rows() > 0) {
            $result = $q->result_object();
            return $result;
        }

        return false;
    }

    public function total() {
        $total = 0;
        $q = $this->db->query("SELECT COUNT(*) AS `rec` FROM {$this->table}");
        if ($q->num_rows() > 0) {
            $r = $q->row();
            $total = $r->rec;
        }
        return $total;
    }

    public function update(array $data, array $where) {
        // Set where condition
        if (!empty($where)) {
            foreach ($where as $cond => $vals) {
                $this->db->where($cond, $vals);
            }
        }

        // Update Records
        if ($this->db->update($this->table, $data)) {
            return true;
        }
        return false;
    }

    public function __destruct() {
        $this->db->close();
    }

}
