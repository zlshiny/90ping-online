<?php

class Order_Model extends CI_Model{
    public $master_db = FALSE;

    public function __construct(){
        parent::__construct();
        $this->master_db = $this->load->database('master', TRUE);
    }

    public function get_order_detail($order_id){
        if(!$order_id || $order_id < 0) return array();
        $ret = array();

        $sql = "select user.user_id as user_id, user.phone as phone, orders.product_id as product_id, orders.deposit as deposit, 
                orders.status as status, house.id as house_id, house.province as province, house.city as city, house.district as district,
                house.area as area, house.acreage as acreage 
                from orders inner join user on orders.user_id = user.user_id inner join house on orders.house_id = house.id where orders.id = ?";
        if($query = $this->master_db->query($sql, array($order_id))){
            if($row = $query->row_array()){
                $ret['user_id'] = $row['user_id'];
                $ret['order_id'] = $order_id;
                $ret['phone'] = $row['phone'];
                $ret['product_id'] = $row['product_id'];
                $ret['product_name'] = $this->config->item($ret['product_id'], 'product');
                $ret['deposit'] = $row['deposit'];
                $ret['init_deposit'] = INIT_DEPOSIT;
                $ret['status'] = $row['status'];
                $ret['house_id'] = $row['house_id'];
                $ret['acreage'] = $row['acreage'];
                $ret['location'] = trim($row['province'] . ' ' . $row['city'] . ' ' . $row['district'] . ' ' . $row['area']);
            }

            return $ret;
        }

        return array();
    }

    public function get_my_order($user_id){
        if(!$user_id || $user_id < 0) return array();
        $ret = array();

        $sql = "select user.user_id as user_id, user.phone as phone, orders.serial_number as serial_number, orders.id as order_id, 
                orders.create_time as create_time, orders.product_id as product_id, orders.deposit as deposit, orders.status as status 
                from orders inner join user on orders.user_id = user.user_id where orders.user_id = ? limit 10";
        if($query = $this->master_db->query($sql, array($user_id))){
            foreach($query->result_array() as $row){
                $v = array();
                $v['user_id'] = $row['user_id'];
                $v['serial_number'] = $row['serial_number'];
                $v['order_id'] = $row['order_id'];
                $v['phone'] = $row['phone'];
                $v['product_id'] = $row['product_id'];
                $v['product_name'] = $this->config->item($v['product_id'], 'product');
                $v['deposit'] = $row['deposit'];
                $v['init_deposit'] = INIT_DEPOSIT;
                $v['status'] = $row['status'];
                $v['status_name'] = $this->config->item($v['status'], 'order_status');
                $v['action_name'] = $this->config->item($v['status'], 'order_action');

                $ret[] = $v;
            }

            return $ret;
        }

        return array();
    }

    public function appointsec($order){
        if(empty($order)) return -1; 
        if(!$db_order = $this->get_order($order['order_id'])) return -2;
        if($db_order->status == ORDER_STATUS_SEC) return -3;
        if($db_order->status == ORDER_STATUS_THIRD) return -4;
        if($db_order->status != ORDER_STATUS_FIRST) return -5;

        $this->user->update_user_agerange($order['user_id'], $order['age']);
        if(($house_id = $this->house->insert_house($order['order_id'], $order['user_id'], $order['acreage'])) > 0){
            $this->update_order($order['order_id'], $order['decor_date'], $order['status'], $house_id);
        }

        return 0;
    }

    public function update_order($order_id, $decor_date, $status, $house_id){
        $cur_month = @date('n');
        if(!$order_id || $order_id < 0 || $status < 0 || $house_id <= 0 || !$decor_date || intval($decor_date) < $cur_month || intval($decor_date) > 12) return false;
        if($decor_date < 10) $decor_date = '0' . $decor_date;
        $final_date = @date('Y') . '-' . $decor_date . '-01 00:00:00';
        $arr = array('decor_time' => $final_date, 'status' => $status, 'house_id' => $house_id);
        $this->master_db->where('id', $order_id);
        return $this->master_db->update('orders', $arr);
    }

    public function get_order($order_id){
        if(!$order_id || $order_id < 0) return array();

        $this->master_db->select('*');
        $this->master_db->from('orders');
        $this->master_db->where('id', $order_id);

        if($query = $this->master_db->get()){
            return $query->row();
        }

        return array();
    }

    public function insert_order($order){
        if(empty($order)) return -1;
        if($this->master_db->insert('orders', $order)){
            return $this->master_db->insert_id();
        }else{
            return -1;
        }
    }

    public function appointment($phone, $product_id){
        if(!$phone || !$product_id) return array();
        if(!check_phone($phone)) return array();

        $order_no = build_order_no();
        $order = array('product_id' => $product_id, 'serial_number' => $order_no, 'status' => ORDER_STATUS_FIRST);
        if($user = $this->user->get_user($phone)){
            $order['user_id'] = $user->user_id;
            $order_id = $this->insert_order($order);
            return array('order_id' => $order_id, 'user_id' => $user->user_id);
        }else{
            if($user_id = $this->user->insert_user($phone)){
                $order['user_id'] = $user_id;
                $order_id = $this->insert_order($order);
                return array('order_id' => $order_id, 'user_id' => $user_id);
            }else{
                return array();
            }
        }
    }


}
