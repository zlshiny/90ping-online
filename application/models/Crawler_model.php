<?php
class Crawler_Model extends CI_Model{
    public $master_db = FALSE;

    public function __construct(){
        parent::__construct();
        $this->master_db = $this->load->database('master', TRUE);
    }

    public function getRecentCardCount($city = '', $decor = 0, $source = 1){
        if(!$this->master_db) return array();
        $this->master_db->select('count(*) as cou');
        $this->combieRecentCardSql($city, $decor, $source);
        if($rows = $this->master_db->get()){
            return $rows->row()->cou;
        }

        return 0;
    }

    public function getRecentCard($limit = 10, $offset = 0, $source = 1, $city = '', $decor = 0){
        if(!$this->master_db) return array();
        $ret = array();

        $this->master_db->select('card.id as c_id, card.user_id as c_uid, card.title as c_title, card.acreage as c_acr, card.is_decorate as c_decor,
                    card.time as c_time, card.url as c_url, card.fcity as c_fcity, card.scity as c_scity');
        $this->combieRecentCardSql($city, $decor, $source);
        $this->master_db->order_by('card.time', 'desc');
        $this->master_db->limit($limit, $offset);
        if($rows = $this->master_db->get()){
            foreach($rows->result_array() as $row){
                $user = $this->getUser($row['c_uid']);
                $row['c_uid_url'] = 'http://i.libaclub.com/' . $user['user_id'] . '/profile';
                $row['c_uname'] = $user['name'];
                $row['c_area'] = $user['area'];
                $row['sour'] = $this->config->item('card_source')[$source];
                $row['c_city'] = trim($row['c_fcity'] . ' ' . $row['c_scity']);
                $ret[] = $row;
            }
        }

        return $ret;
    }

    private function combieRecentCardSql($city, $decor, $source){
        $table = 'card';
        $this->master_db->from($table);
        $this->master_db->where('card.source', $source);

        if(!empty($city)){
            $this->master_db->where("(card.fcity = '$city' or card.scity in ('" . implode('\',\'', $this->config->item($city, 'city')) . "'))");
            //$this->master_db->where("card.fcity", $city);
            //$this->master_db->or_where_in("card.scity", $this->config->item($city, 'city'));
        }

        if($decor > 0){
            $this->master_db->where('card.is_decorate', $decor);
        }
    }

    public function getRecentCommentCard($limit = 10, $offset = 0, $source = 1, $city = '', $decor = 0){
        if(!$this->master_db) return array();

        $ret = array();

        $table = 'comment';
        $this->master_db->select('comment.id as m_id, comment.source, comment.content as m_con, comment.time as m_time, comment.url as m_url, 
                    comment.user_id as m_uid, comment.fcity as m_fcity, comment.scity as m_scity, comment.acreage as m_acr, comment.is_decorate as m_decor,
                    card.id as c_id, card.user_id as c_uid, card.title as c_title, card.acreage as c_acr, card.is_decorate as c_decor,
                    card.time as c_time, card.url as c_url, card.fcity as c_fcity, card.scity as c_scity');
        $this->master_db->from($table);
        $this->master_db->where('comment.source', $source);
        if(!empty($city)){
            //$this->master_db->where("comment.fcity", $city);
            //$this->master_db->or_where_in("comment.scity", $this->config->item($city, 'city'));
            $this->master_db->where("(comment.fcity = '$city' or comment.scity in ('" . implode('\',\'', $this->config->item($city, 'city')) . "'))");
        }
        
        if($decor > 0){
            $this->master_db->where('comment.is_decorate', $decor);
        }

        $this->master_db->join('card', 'comment.native_card_id = card.id');
        $this->master_db->order_by('comment.time', 'desc');
        $this->master_db->limit($limit, $offset);
        if($rows = $this->master_db->get()){
            foreach($rows->result_array() as $row){
                $user = $this->getUser($row['m_uid']);
                $row['m_uid_url'] = 'http://i.libaclub.com/' . $user['user_id'] . '/profile';
                $row['m_uname'] = $user['name'];
                $row['m_area'] = $user['area'];
                $row['m_city'] = trim($row['m_fcity'] . ' ' . $row['m_scity']);
                $user = $this->getUser($row['c_uid']);
                $row['c_uid_url'] = 'http://i.libaclub.com/' . $user['user_id'] . '/profile';
                $row['c_uname'] = $user['name'];
                $row['c_area'] = $user['area'];
                $row['sour'] = $this->config->item('card_source')[$source];
                $row['m_con'] = strip_tags(htmlspecialchars_decode($row['m_con'])) . "....";
                $row['c_city'] = trim($row['c_fcity'] . ' ' . $row['c_scity']);
                $ret[] = $row;
            }
        }

        return $ret;
    }

    public function getRecentCommentCardCount($source = 1, $city = '', $decor = 0){
        if(!$this->master_db) return array();

        $table = 'comment';
        $this->master_db->select('count(*) as cou');
        $this->master_db->from($table);
        $this->master_db->where('comment.source', $source);
        if(!empty($city)){
            //$this->master_db->where("comment.fcity", $city);
            //$this->master_db->or_where_in("comment.scity", $this->config->item($city, 'city'));
            $this->master_db->where("(comment.fcity = '$city' or comment.scity in ('" . implode('\',\'', $this->config->item($city, 'city')) . "'))");
        }
        
        if($decor > 0){
            $this->master_db->where('comment.is_decorate', $decor);
        }

        $this->master_db->join('card', 'comment.native_card_id = card.id');
        if($rows = $this->master_db->get()){
            return $rows->row()->cou;
        }

        return 0;
    }

    public function getUname($uid){
        if($user = $this->getUser($uid)){
            return $user['name'];
        }else{
            return '未知';
        }
    }

    public function getUser($uid){
        if(!$uid || !$this->master_db) return array();

        $ret = array();
        $table = 'user';
        $this->master_db->select('*');
        $this->master_db->from($table);
        $this->master_db->where('id', $uid);
        if($rows = $this->master_db->get()){
            return $rows->row_array();
        }

        return array();
    }

    public function __destruct(){
        $this->master_db->close();
    }
}
