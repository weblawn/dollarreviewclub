<?php

class Product extends CI_Model {

    private $table;
    private $category;
    private $promoTable;
    private $history;

    public function __construct() {
        parent::__construct();

        // Assign Table 
        $this->table = $this->db->dbprefix('products');
        $this->category = $this->db->dbprefix('category');
        $this->promoTable = $this->db->dbprefix("promo_codes");
        $this->history = $this->db->dbprefix("users_history");
        $this->approve_request_table = $this->db->dbprefix('approve_request');
    }

    public function add(array $input) {
        if ($this->db->insert($this->table, $input)) {
            $id = $this->db->insert_id();
            return $id;
        }
        return false;
    }
  

    public function category($args = array()) {

        //$this->db->select("*");

        if (!empty($args)) {
            foreach ($args as $key => $val) {
                if (!empty($val)) {$this->db->where($key, $val);}
            }
        }
$this->db->order_by("name", "asc"); 
        $q = $this->db->get($this->category);
        if ($q->num_rows() > 0) {
            $result = $q->result_object();
            return $result;
        }

        return false;
    }
public function secondsToTime($inputSeconds) {

    $secondsInAMinute = 60;
    $secondsInAnHour  = 60 * $secondsInAMinute;
    $secondsInADay    = 24 * $secondsInAnHour;

    // extract days
    $days = floor($inputSeconds / $secondsInADay);

    // extract hours
    $hourSeconds = $inputSeconds % $secondsInADay;
    $hours = floor($hourSeconds / $secondsInAnHour);

    // extract minutes
    $minuteSeconds = $hourSeconds % $secondsInAnHour;
    $minutes = floor($minuteSeconds / $secondsInAMinute);

    // extract the remaining seconds
    $remainingSeconds = $minuteSeconds % $secondsInAMinute;
    $seconds = ceil($remainingSeconds);

    // return the final array
    $obj = array(
        'd' => (int) $days,
        'h' => (int) $hours,
        'm' => (int) $minutes,
        's' => (int) $seconds,
    );
    return $obj;
}    
    public function insert_approve_request(array $input) {
        if ($this->db->insert($this->approve_request_table, $input)) {
            $result = $this->get($this->db->insert_id());
            return $result;
        }
        return 'false';
    }
    

    public function get_approve_request($pid) {
        $this->db->select("*");
        $this->db->where("id", $pid);

        // Find company data
        $q = $this->db->get($this->approve_request_table);
        if ($q->num_rows() > 0) {
            $result = $q->row();
            return $result;
        }
        return false;
    }
    public function update_approve_request(array $input, array $where) {

        // Set where condition
        if (!empty($where)) {
            foreach ($where as $cond => $vals) {
                $this->db->where($cond, $vals);
            }
        }

        // Update Records
        if ($this->db->update($this->approve_request_table, $input)) {
            return true;
        }
        return 'false';
    }
    public function get_request_table_data_for_product($pid,array $where, $limit, $start_point) {
        $result =array();
        $this->db->select("*");
        $this->db->where("product_id", $pid);
        // Set where condition
        if (!empty($where)) {
            foreach ($where as $cond => $vals) {
                if($cond == 'seller_approve_status')
                {
                    foreach($vals as $val)
                    {//echo $val;
                        if($val == 'disapprove'){$vals[]= 'auto_reject';}
                    }
                    $this->db->where_in('seller_approve_status', $vals);
                }
                else
                {
                    $this->db->where($cond, $vals);
                }
                
            }
        }
        $q_count = $this->db->get($this->approve_request_table);
        
        $result_array = $q_count->result_object();
        if($result_array[0]!='')
        {
            $result['count'] = $q_count->num_rows();
        }
        else
        {
            $result['count'] = 0;
        }
        
        
        
        $this->db->select("*");
        $this->db->where("product_id", $pid);
        // Set where condition
        if (!empty($where)) {
            foreach ($where as $cond => $vals) {
                if($cond == 'seller_approve_status')
                {
                    foreach($vals as $val)
                    {//echo $val;
                        if($val == 'disapprove'){$vals[]= 'auto_reject';}
                    }
                    $this->db->where_in('seller_approve_status', $vals);
                }
                else if($cond == 'review_date <=')
                {
                    $this->db->order_by("review_date", "ASC"); 
                }
                else
                {
                    $this->db->where($cond, $vals);
                }
            }
        }
        if($limit != '0')
        {
            $this->db->limit($limit, $start_point);
        }
        
        $this->db->order_by("id","desc");
        // Find company data
        $q = $this->db->get($this->approve_request_table);
        if ($q->num_rows() > 0) {
            $result['result'] = $q->result_object();
            return $result;
        }
        return 'false';
    }
    public function get_manual_pending_by_user($user_id, $type) {
        $this->db->select("*");
        if($type == 'companies')
        {
            $this->db->where("seller_id", $user_id);
        }
        else if($type == 'shopper')
        {
            $this->db->where("customer_id", $user_id);
        }
        $this->db->where_in("seller_approve_status", array('pending',''));//$this->db->where("seller_approve_status", 'pending');
        // Find company data
        $q = $this->db->get($this->approve_request_table);
        if ($q->num_rows() > 0) {
            $results = $q->result_object();
            foreach($results as $result)
            {
                //print_r($result);
                //echo $result->date.'</br>';
                $start_date_strtotime = strtotime($result->date);
                $now_strtotime = strtotime(date ("Y-m-d H:i:s"));
                $diff = 48*3600;
                //$diff = 3600;
                $next_date = $start_date_strtotime + $diff;
                if($now_strtotime >= $next_date)
                {
                    $update = array('seller_approve_status'=>'auto_reject', 'notification'=>'yes', "finished" => '1');
                    $where = array("id" => $result->id);
                    $get_result = $this->product->update_approve_request($update,$where);
                    //$data = $this->product->get_approve_request($single);
                    $getUsermata_quota = getUsermata($result->customer_id, 'quota');       $getUsermata_quota    = $getUsermata_quota->mval;
                    $this->userm->updateUsermeta($result->customer_id, 'quota', $getUsermata_quota+1);
                    //echo $result->id ;
                }
                //echo date ("Y-m-d H:i:s",$start_date_strtotime);
                //echo '</br>'.'</br>';
            }
            return $results;
        }
        return '0';
    }
    public function get_manual_pending_by_id($pid) {
        $this->db->select("*");
        $this->db->where("product_id", $pid);
        $this->db->where("seller_approve_status", 'pending');
        // Find company data
        $q = $this->db->get($this->approve_request_table);
        if ($q->num_rows() > 0) {
            $result = $q->result_object();
            return $result;
        }
        return '0';
    }
    public function get_manual_approve_by_id($pid) {
        $this->db->select("*");
        $this->db->where("product_id", $pid);
        $this->db->where("seller_approve_status", 'approve');
        // Find company data
        $q = $this->db->get($this->approve_request_table);
        if ($q->num_rows() > 0) {
            $result = $q->result_object();
            return $result;
        }
        return '0';
    }
    public function get_manual_disapprove_by_id($pid) {
        $this->db->select("*");
        $this->db->where("product_id", $pid);
        $this->db->where_in("seller_approve_status", array('disapprove','auto_reject'));//$this->db->where("seller_approve_status", 'disapprove');
        // Find company data
        $q = $this->db->get($this->approve_request_table);
        if ($q->num_rows() > 0) {
            $result = $q->result_object();
            return $result;
        }
        return '0';
    }
    public function get_finished_review_for_product($pid) {
        $this->db->select("*");
        $this->db->where("product_id", $pid);
        $this->db->where("review_status", 'pass');

        // Find company data
        $q = $this->db->get($this->approve_request_table);
        if ($q->num_rows() > 0) {
            $result = $q->result_object();
            return $result;
        }
        return 'false';
    }
    public function get_finished_review($cid) {
        $this->db->select("*");
        $this->db->where("customer_id", $cid);
        $this->db->where("finished", '1');
        $this->db->order_by('id', 'DESC');
        //$this->db->where("review_status", 'pass');
        //$this->db->where('seller_approve_status !=', 'disapprove');

        // Find company data
        $q = $this->db->get($this->approve_request_table);
        if ($q->num_rows() > 0) {
            $result = $q->result_object();
            return $result;
        }
        return 'false';
    }

    public function get_unfinished_review($cid) {
        $this->db->select("*");
        $this->db->where("customer_id", $cid);
        $this->db->where("finished", '0');
        $this->db->order_by('id', 'DESC');
        //$this->db->where("review_status", 'fail');
        //$this->db->where('seller_approve_status !=', 'disapprove');

        // Find company data
        $q = $this->db->get($this->approve_request_table);
        if ($q->num_rows() > 0) {
            $result = $q->result_object();
            return $result;
        }
        return 'false';
    }
    public function get_online_product($pid) {
        $this->db->select("*");
        $this->db->where("uid", $pid);
        $this->db->where("disabled", '0');

        // Find company data
        $q = $this->db->get($this->table);
        if ($q->num_rows() > 0) {
            $result = $q->result_object();
            return $result;
        }
        return 'false';
    }

    public function get_offline_product($pid) {
        $this->db->select("*");
        $this->db->where("uid", $pid);
        $this->db->where("disabled", '1');

        // Find company data
        $q = $this->db->get($this->table);
        if ($q->num_rows() > 0) {
            $result = $q->result_object();
            return $result;
        }
        return 'false';
    }

    public function get($pid) {
        $this->db->select("*");
        $this->db->where("pid", $pid);

        // Find company data
        $q = $this->db->get($this->table);
        if ($q->num_rows() > 0) {
            $result = $q->row();
            return $result;
        }
        return false;
    }

    public function get_where(array $args = array(), array $orderBy = array(), $limit = NULL, $offset = NULL) {
        $this->db->select("*");

        // Bind Condition
        if (!empty($args)) {
            foreach ($args as $key => $arg) {
                $this->db->where("{$arg['field']} {$arg['cond']}", $arg['value']);
            }
        }/* else{
          $this->db->where("disabled", 0);
          } */

        // Order By
        if (!empty($orderBy)) {
            $this->db->order_by($orderBy[0], $orderBy[1]);
        }
        else
        {
            $this->db->order_by('pid', 'DESC');
        }

        $q = $this->db->get($this->table, $limit, $offset);
        if ($q->num_rows() > 0) {
            $result = $q->result_object();
            return $result;
        }

        return false;
    }
    
    public function with_review($pid = null) {
        $products = $this->get_where();
        
        if(!$products){
            return false;
        }
        
        $withReview = array();
        $i = 0;
        foreach($products as $product){
            
            $withReview[$i]['product'] = $product;
            $withReview[$i]['review'] = array();
            
            $q = $this->db->query("SELECT * FROM {$this->history} WHERE product_id = '{$product->pid}'");
            if($q->num_rows() > 0){
                $withReview[$i]['review'] = $q->result_object();
            }            
            $i++;
        }
        
        return $withReview;
    }
    
    public function display($pid = null, $sqlPart = null, array $extra = array()) {
        
        $where = (!empty($pid)) ? " AND p.pid = '{$pid}'" : "";

        if(!empty($extra)){            
            foreach($extra as $key => $val){
                $where .= " AND {$val['field']} {$val['cond']} {$val['value']}";
            }
        }
        
        $sql = "SELECT DISTINCT p.* FROM {$this->table} AS `p`
                INNER JOIN {$this->promoTable} AS `c` ON p.pid = c.product_id 
                WHERE p.disabled = 0 AND c.is_used = 0" . $where . " " . $sqlPart;
                
        $q = $this->db->query($sql);
        if($q->num_rows() > 0){
            //return $q->result_object();
            $lists = $q->result_object();
            $final_list = array();
            $can_get = 'false';
            $date = strtotime("now");
            foreach ($lists as $pro)
            { 
            $start_date = strtotime($pro->start_date);
            $end_date = strtotime($pro->end_date);
                    if($pro->end_date_type == 'product_end_time_until')
                    { //echo $pro->total_count.' '.$pro->product_end_time_until_count.'</br>';
                        if($pro->total_count < $pro->product_end_time_until_count)
                        {
                            $can_get = 'true';  $can_get_error = 'no';
                        }
                        else
                        {
                            $can_get = 'false';  $can_get_error = 'stock out';
                        }
                    }
                    else
                    {
                        if($start_date<=$date && $end_date>=$date)
                        {
                            $can_get = 'true';  $can_get_error = 'no';
                        }
                        else
                        {
                            $can_get = 'false';  $can_get_error = 'out of date';
                        }
                        
                    }
                    
                    if($can_get === 'true')
                    {
                        $final_list[] = $pro;
                    }
                    else
                    {
                        $update = array("disabled" => 1);
                        $where = array("pid" => $pro->pid);
                        $this->update($update, $where);
                    }
                    //echo $pro->pid.' '.$pro->end_date_type.' '.$can_get_error."</br>";
            }
            return $final_list;
        }
        return false;
    }
    
    public function update(array $input, array $where) {

        // Set where condition
        if (!empty($where)) {
            foreach ($where as $cond => $vals) {
                $this->db->where($cond, $vals);
            }
        }

        // Update Records
        if ($this->db->update($this->table, $input)) {
            return true;
        }
        return false;
    }
    
        public function category_item_count() {
        $new_results = array();
        $this->db->select("*");
        $q = $this->db->get($this->category);
        if ($q->num_rows() > 0) {
            $results = $q->result_object();
            foreach ($results as $result) {
                $single_cat = array();
                $single_cat['cid'] = $result->cid;
                $single_cat['name'] = $result->name;
                $single_cat['slug'] = $result->slug;
                $single_cat['since'] = $result->since;
                if(isset($result->image)){$single_cat['image'] = $result->image;}else{$single_cat['image'] = '';}
                $this->db->where('category', $result->cid);
                $count = $this->db->count_all_results('dlr_products');
                $single_cat['count'] = $count;
                $new_results[] = $single_cat;
                }
            return $new_results;
        }

        return false;
    }

    public function category_item(array $args = array(), $single = false, $orderBy = false) {

        $sql = "SELECT * FROM {$this->category}  AS c ";

        // Bind where category
        $where = "";
        if (!empty($args)) {
            $where .= " WHERE ";
            foreach ($args as $key => $arg) {
                $value = ($arg['value'] == "") ? '' : "'{$arg['value']}'";
                $where .= "{$arg['field']} {$arg['cond']} {$value} {$arg['comp']}";
            }
        }

        // If Not single then join products
        if ($single === false && !empty($where)) {
            $sql.= "INNER JOIN {$this->table} AS p ON c.cid = p.category" . $where;
        } else if ($single) {
            $sql .= $where;
        }

        $sql = rtrim($sql, "AND ");
        $sql = rtrim($sql, "OR ");

        //IF Order By
        if ($orderBy && is_array($orderBy)) {
            $sql .= " ORDER BY {$orderBy[0]} {$orderBy[1]}";
        }

        $q = $this->db->query($sql);
        if ($q->num_rows() > 0) {
            $result = $q->result_object();
            return $result;
        }

        return array();
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

    public function add_promo_codes($productId, $sellerId, array $codes) {
        if (!empty($productId) && !empty($codes)) {

            $sql = "INSERT INTO {$this->promoTable}(promo_code, product_id, seller_id) VALUES ";
            foreach ($codes as $code) {
                if($code != ''){$code = trim($code); $sql .= "('{$code}', '". trim( trim($productId), "\r\n") ."', '". trim( trim($sellerId), "\r\n") ."'), ";}
            }

            $sql = rtrim($sql, ", ") . ";";

            $this->db->query($sql);
        }
    }

    public function get_promo_codes_by_id($pid, $isUsed = false) {
        $this->db->select("*");
        $this->db->from($this->promoTable);
        
        $this->db->where('promo_id', $pid);
        if($isUsed != 'null')
        {
            $isUsed = ($isUsed) ? 1 : 0;
            $this->db->where('is_used', $isUsed);
        }
        
        $this->db->limit(1);
        $q = $this->db->get();
        if($q->num_rows() > 0){
            return $q->result_object()[0];
        }
        
        return false;
    }

    public function get_promo_codes($pid, $isUsed = false) {
        $this->db->select("*");
        $this->db->from($this->promoTable);
        
        $this->db->where('product_id', $pid);
        
        $isUsed = 0;//$isUsed = ($isUsed) ? 1 : 0;
        $this->db->where('is_used', $isUsed);
        $this->db->limit(1);
        $q = $this->db->get();
        if($q->num_rows() > 0){
            return $q->result_object()[0];
        }
        
        return false;
    }
    
    public function update_promo_codes(array $data, array $where) {
        if(!empty($where)){
            foreach($where as $whereKey => $whereVal){
                $this->db->where($whereKey, $whereVal);
            }
        }
        
        if( $this->db->update($this->promoTable, $data) ){
            return true;
        }
        
        return false;
        
    }
    
    public function all_promo_codes($pid) {
        $this->db->select("*");
        $this->db->from($this->promoTable);
        
        $this->db->where('product_id', $pid);
               
        $q = $this->db->get();
        if($q->num_rows() > 0){
            return $q->result_object();
        }
        
        return false;
    }
        public function all_promo_codes_filter($pid, $limit, $start_point) {
        $result =array();
        $this->db->select("*");
        $this->db->where("product_id", $pid);
        // Set where condition
        $q_count = $this->db->get($this->promoTable);
        
        $result_array = $q_count->result_object();
        if($result_array[0]!='')
        {
            $result['count'] = $q_count->num_rows();
        }
        else
        {
            $result['count'] = 0;
        }
        
        
        
        $this->db->select("*");
        $this->db->where("product_id", $pid);
        // Set where condition
        
        if($limit != '0')
        {
            $this->db->limit($limit, $start_point);
        }

        
        // Find company data
        $q = $this->db->get($this->promoTable);
        if ($q->num_rows() > 0) {
            $result['result'] = $q->result_object();
            return $result;
        }
        return 'false';
    }
    public function get_promo_code_details($pid,$cid,$sid) {
        $this->db->select("*");
        $this->db->from($this->promoTable);
        
        $this->db->where('product_id', $pid);
        $this->db->where('customer_id', $cid);        
        $this->db->where('promo_id', $prid);   
        $this->db->where('is_used', '1');
               
        $q = $this->db->get();
        if($q->num_rows() > 0){
            return $q->row();
        }
        
        return false;
    }
    
    public function get_promo_code_details_approve_request_table($promo_id) {
        $this->db->select("*");
        $this->db->from($this->approve_request_table);
        
        $this->db->where('promo_id', $promo_id);
               
        $q = $this->db->get();
        if($q->num_rows() > 0){
            return $q->row();
        }
        
        return false;
    }
    
    
    public function auto_update_product_total_count($user_id) {
        $this->db->select("pid");
        $this->db->from($this->table);
        $this->db->where('uid', $user_id);
               
        $q = $this->db->get();
        if($q->num_rows() > 0){
            $results = $q->result_object();
            foreach($results as $result)
            {
                $this->db->select("*");
                $this->db->from($this->approve_request_table);
                
                $this->db->where('product_id', $result->pid);
                $this->db->where('code_taken', 'yes');
                       
                $q = $this->db->get();
                if($q->num_rows() > 0){
                    $input = array('total_count'=>$q->num_rows() );
                    $where = array('pid'=>$result->pid );
                    $this->update($input,$where);
                }
            }
        }
        return false;
    }
    
    public function __destruct() {
        $this->db->close();
    }

}
