<?php

class Order_Model extends CI_Model{
    public $master_db = FALSE;

    public function __construct(){
        parent::__construct();
        $this->master_db = $this->load->database('master', TRUE);
    }

    //通过邻居一起装预约
    public function neighbor_order($arr, $source, &$user_id){
        if(empty($arr)) return -1;

        $order_no = build_order_no();
        $order = array('product_id' => 1, 'serial_number' => $order_no,
            'status' => ORDER_STATUS_FIRST, 'source' => $source, 'price' => TOTAL_PRICE);

        if($arr['user_id'] > 0){
            $order['user_id'] = $arr['user_id'];
        }else{
            $user = array('phone' => $arr['phone'], 'name' => $arr['uname']);
            $user_id = $this->user->insert_user_arr($user);
            $order['user_id'] = $user_id;
        }

        return $this->insert_order($order);
    }

    public function is_order_by_uid($user_id){
        if($user_id < 0) return false;
        $this->master_db->select('id');
        $this->master_db->from('orders');
        $this->master_db->where('user_id', $user_id);
        if($query = $this->master_db->get()){
            if($query->row_array()) return true;
        }

        return false;
    }

    public function is_order_by_phone($phone, &$user_id = 0){
        if(!$phone) return false;
        if($user = $this->user->get_user($phone)){
            $user_id = $user->user_id;
            return $this->is_order_by_uid($user_id);
        }

        return false;
    }

    public function get_order_list($user_id){
        if(!$user_id || $user_id <= 0) return array();
        $this->master_db->select('*');
        $this->master_db->from('orders');
        $this->master_db->where('user_id', $user_id);
        if($query = $this->master_db->get()){
            $ret = array();

            foreach($query->result_array() as $row){
                $ret[] = $row;
            }

            return $ret;
        }

        return array();
    }

    public function get_order_detail($order_id){
        if(!$order_id || $order_id < 0) return array();
        $ret = array();

        $sql = "select user.user_id as user_id, user.phone as phone, user.name as name, orders.product_id as product_id, orders.deposit as deposit,
                orders.status as status, orders.price as price, house.id as house_id, house.province as province, house.city as city, house.district as district,
                house.area as area, house.acreage as acreage 
                from orders inner join user on orders.user_id = user.user_id inner join house on orders.house_id = house.id where orders.id = ?";
        if($query = $this->master_db->query($sql, array($order_id))){
            if($row = $query->row_array()){
                $ret['user_id'] = $row['user_id'];
                $ret['order_id'] = $order_id;
                $ret['phone'] = $row['phone'];
                $ret['name'] = $row['name'];
                $ret['product_id'] = $row['product_id'];
                $ret['product_name'] = $this->config->item($ret['product_id'], 'product');
                $ret['deposit'] = $row['deposit'];
                $ret['init_deposit'] = INIT_DEPOSIT;
                $ret['status'] = $row['status'];
                $ret['house_id'] = $row['house_id'];
                $ret['acreage'] = $row['acreage'];
                if($city = array_search($row['city'], $this->config->item('city'))){
                    $ret['location'] = trim($city . $row['area']);
                }
                //$ret['location'] = trim($row['province'] . ' ' . $row['city'] . ' ' . $row['district'] . ' ' . $row['area']);
                if(!isset($ret['location']) || !$ret['location']) $ret['location'] = '北京';
                $ret['price'] = $row['price'];
            }

            return $ret;
        }

        return array();
    }

    public function get_my_order($user_id){
        if(!$user_id || $user_id < 0) return array();
        $ret = array();

        $sql = "select user.user_id as user_id, user.phone as phone, user.name as name, orders.serial_number as serial_number, orders.id as order_id,
                orders.create_time as create_time, orders.product_id as product_id, orders.deposit as deposit, orders.status as status 
                from orders inner join user on orders.user_id = user.user_id where orders.user_id = ? limit 20";
        if($query = $this->master_db->query($sql, array($user_id))){
            foreach($query->result_array() as $row){
                $v = array();
                $v['user_id'] = $row['user_id'];
                $v['serial_number'] = $row['serial_number'];
                $v['order_id'] = $row['order_id'];
                $v['phone'] = $row['phone'];
                $v['name'] = $row['name'];
                $v['product_id'] = $row['product_id'];
                $v['product_name'] = $this->config->item($v['product_id'], 'product');
                $v['deposit'] = $row['deposit'];
                $v['init_deposit'] = INIT_DEPOSIT;
                $v['status'] = $row['status'];
                $v['status_name'] = $this->config->item($v['status'], 'order_status');
                $v['action_name'] = $this->config->item($v['status'], 'order_action');
                $v['create_time'] = $row['create_time'];

                $ret[] = $v;
            }

            return $ret;
        }

        return array();
    }

    //预约第三步，个性化选择
    public function appoint_personal($order_id, $price, $config, $acreage){
        if(!$order_id || $order_id <= 0 || $price <= 0 || $acreage < MIN_ACREAGE || $acreage > MAX_ACREAGE) return -1;

        $order = $this->get_order($order_id);
        if(!$order) return -2;

        $arr = array('price' => $price, 'personal_config' => $config, 'is_personal' => 1);
        $this->update_order_arr($order_id, $arr);

        $house_id = $order->house_id;
        $this->house->update_house($house_id, array('acreage' => $acreage));

        return 0;
    }

    public function update_order_arr($order_id, $arr){
        if($order_id <= 0 || empty($arr)) return false;

        $this->master_db->where('id', $order_id);
        return $this->master_db->update('orders', $arr);
    }

    //预约第二步，完善房屋信息与装修时间
    public function appointsec($order){
        if(empty($order)) return -1; 
        if(!$db_order = $this->get_order($order['order_id'])) return -2;
        if($db_order->status == ORDER_STATUS_SEC) return -3;
        if($db_order->status == ORDER_STATUS_THIRD) return -4;
        if($db_order->status != ORDER_STATUS_FIRST) return -5;

        //$this->user->update_user_agerange($order['user_id'], $order['age']);
        $this->user->update_user($order['user_id'], array('name' => $order['name']));
        $house = array('order_id' => $order['order_id'], 'user_id' => $order['user_id'], 'acreage' => $order['acreage'],
                    'city' => $order['city'], 'area' => $order['xiaoqu']);
        //if(($house_id = $this->house->insert_house($order['order_id'], $order['user_id'], $order['acreage'])) > 0){
        if($house_id = $this->house->insert_house_arr($house)){
            $this->update_order($order['order_id'], $order['decor_date'], $order['status'], $house_id, $order['price']);
        }
        return 0;
    }

    public function update_order($order_id, $decor_date, $status, $house_id, $price = 0){
        $cur_month = @date('n');
        if(!$order_id || $order_id < 0 || $status < 0 || $house_id <= 0 || !$decor_date || intval($decor_date) < $cur_month || intval($decor_date) > 12) return false;
        if($decor_date < 10) $decor_date = '0' . $decor_date;
        $final_date = @date('Y') . '-' . $decor_date . '-01 00:00:00';
        $arr = array('decor_time' => $final_date, 'status' => $status, 'house_id' => $house_id, 'price' => $price);
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

    //预约第一步，填写手机号
    public function appointment($phone, $product_id, $source = ORDER_SOURCE_WEB){
        if(!$phone || !$product_id) return array();
        if(!check_phone($phone)) return array();

        $order_no = build_order_no();
        $order = array('product_id' => $product_id, 'serial_number' => $order_no, 'status' => ORDER_STATUS_FIRST, 'source' => $source);
        if($user = $this->user->get_user($phone)){
            $order['user_id'] = $user->user_id;
            $order_id = $this->insert_order($order);
            return array('order_id' => $order_id, 'user_id' => $user->user_id, 'serial_number' => $order_no);
        }else{
            if($user_id = $this->user->insert_user($phone)){
                $order['user_id'] = $user_id;
                $order_id = $this->insert_order($order);
                return array('order_id' => $order_id, 'user_id' => $user_id, 'serial_number' => $order_no);
            }else{
                return array();
            }
        }
    }

    //微信预约
    public function appointment_wechat($name, $phone, $acreage, $location,
                                       $decor_time, $product_id, $source){
        if(!check_phone($phone)) return array();

        $order_no = build_order_no();
        $order = array('product_id' => $product_id, 'serial_number' => $order_no,
            'status' => ORDER_STATUS_SEC, 'source' => $source, 'decor_time' => $decor_time);
        $house = array('acreage' => $acreage, 'area' => $location);
        $user_arr = array('phone' => $phone, 'name' => $name);

        $order_id = 0;
        $user_id = 0;
        if($user = $this->user->get_user($phone)){
            $order['user_id'] = $user->user_id;
            $order_id = $this->insert_order($order);
            $user_id = $user->user_id;

            $this->user->update_user($user->user_id, $user_arr);

            $house['order_id'] = $order_id;
            $house['user_id'] = $user->user_id;
        }else{
            if(($user_id = $this->user->insert_user_arr($user_arr)) <= 0) return array();
            $order['user_id'] = $user_id;
            $order_id = $this->insert_order($order);

            $house['user_id'] = $user_id;
            $house['order_id'] = $order_id;
        }

        $house_id = $this->house->insert_house_arr($house);
        $this->update_house_id($order_id, $house_id);

        return array('order_id' => $order_id, 'user_id' => $user_id, 'serial_number' => $order_no);
    }

    public function update_house_id($order_id, $house_id){
        if($order_id <= 0 || $house_id <= 0) return false;

        $arr = array('house_id' => $house_id);
        $this->master_db->where('id', $order_id);
        return $this->master_db->update('orders', $arr);
    }

    public function get_personal_config(){
        $ret = array();

        $this->master_db->select('*');
        $this->master_db->from('personal_config');
        if($query = $this->master_db->get()){
            foreach($query->result_array() as $row){
                $tmp = array();
                $tmp['name'] = $row['name'];
                $tmp['price'] = $row['price'];
                $tmp['color'] = explode('|', $row['color_list']);
                $tmp['id'] = $row['id'];
                $ret[] = $tmp;
            }
        }

        return $ret;
    }

    public function update_status($order_id, $status){
        if($order_id <= 0 || ($status != ORDER_STATUS_THIRD && $status != ORDER_STATUS_FIRST && $status != ORDER_STATUS_SEC)) return -1;
        if(!$this->get_order($order_id)) return -2;

        $arr = array('status' => $status);
        $this->master_db->where('id', $order_id);
        return $this->master_db->update('orders', $arr);
    }

}
