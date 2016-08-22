<?php

class History extends CI_Model {

    private $table;
    private $product;
    private $promoTable;

    public function __construct() {
        parent::__construct();
        $this->table = $this->db->dbprefix("users_history");
        $this->product = $this->db->dbprefix("products"); 
        $this->promoTable = $this->db->dbprefix("promo_codes");
    }

    public function add(array $data) {
        if ($this->db->insert($this->table, $data)) {
            return $this->get(null, $this->db->insert_id());
        }
        return false;
    }

    public function get($uid = null, $hid = null) {

        $sql = "SELECT * FROM {$this->product} AS `p` "
                . "INNER JOIN {$this->table} AS `h` ON h.product_id = p.pid "
                . "INNER JOIN {$this->promoTable} AS `c` ON h.promo_id = c.promo_id WHERE ";

        if (!empty($uid)) {
            $sql .= " h.user_id = '{$uid}'";
        }
        
        if (!empty($uid) && !empty($hid)) {
            $sql .= " AND h.history_id = '{$hid}'";
        }else if(!empty($hid)){
            $sql .= " h.history_id = '{$hid}'";
        }

        $q = $this->db->query($sql);
        if ($q->num_rows() > 0) {
            return (empty($hid)) ? $q->result_object() : $q->row();
        }

        return false;
    }
    
    public function by_product_id($pid) {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where("product_id", $pid);

        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->row();
        }

        return false;
    }

    public function by_product($pid, $uid, $bulk = false) {
        
        $uid = (empty($uid)) ? '0' : $uid;
        
        $sql = "SELECT * FROM {$this->table} AS `h` "
                . "INNER JOIN {$this->promoTable} AS `p` ON p.product_id = h.product_id "
                . "WHERE h.product_id = '{$pid}' AND h.user_id = '{$uid}';";

        $q = $this->db->query($sql);
        if ($q->num_rows() > 0) {
            return ($bulk) ? $q->result_object() : $q->row();
        }

        return false;
    }

    public function update(array $data, array $where) {

        if (!empty($where)) {
            foreach ($where as $whereKey => $whereVal) {
                $this->db->where($whereKey, $whereVal);
            }
        }

        if ($this->db->update($this->table, $data)) {
            return true;
        }

        return false;
    }

    public function __destruct() {
        $this->db->close();
    }

}
