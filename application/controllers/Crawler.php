<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crawler extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($page = 1, $limit = 20){
        $this->card($page, $limit);
	}

    public function card($page = 1, $limit = 20){
        $this->load->model('crawler_model', 'crawler');
        $city = '';
        $decor = 1;
        $source = 1;
        if(isset($_GET['city'])) $city = trim($_GET['city']);
        if(isset($_GET['decor'])) $decor = trim($_GET['decor']);
        if(isset($_GET['source'])) $source = trim($_GET['source']);
        $type = isset($_GET['ctype']) ? $_GET['ctype'] : 1;
 
        if($type == 0){
            if(($count = $this->crawler->getRecentCommentCardCount($source, $city, $decor)) > 0){
                $data['list'] = $this->crawler->getRecentCommentCard($limit, ($page - 1) * $limit, $source, $city, $decor);
            }else{
                $data['list'] = array();
            }
        }else{
            if(($count = $this->crawler->getRecentCardCount($city, $decor, $source)) > 0){
                $data['list'] = $this->crawler->getRecentCard($limit, ($page - 1) * $limit, $source, $city, $decor);
            }else{
                $data['list'] = array();
            }
        }
    
        $this->load->library('pagination');

        $config['first_link'] = '第一页';
        $config['last_link'] = '最后一页';
        $config['use_page_numbers'] = TRUE;
        $config['base_url'] = $this->config->item('base_url') . "crawler/card?ctype={$type}&city={$city}&decor={$decor}";
        $config['total_rows'] = $count;
        $config['per_page'] = $limit;
        $config['reuse_query_string'] = TRUE;
        $config['suffix'] = '?';
        $config['first_url'] = $this->config->item('base_url') . "crawler?ctype={$type}&city={$city}&decor={$decor}";

        $this->pagination->initialize($config);
        $page = $this->pagination->create_links();

        $data['cur_city'] = $city;
        $data['cur_decor'] = $decor;
        $data['cur_type'] = $type;
        $data['city_name'] = empty($city) ? '全国' : $city;
        $data['content_name'] = ($decor == 1) ? '只包含装修' : '全部';
        $data['type_name'] = ($type == 0) ? '主题贴+评论' : '只看主题帖';
        $data['page'] = $page;
        $data['cur_source'] = $source;
        $data['source_site_name'] = $this->config->item('card_source')[$source];
        $this->load->view('crawler', $data);
    }
}
