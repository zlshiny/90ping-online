<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>90平方智能家装</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
        text-decoration:none;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}

    .city_tag{
        margin-left:15px;
        margin-bottom:15px;
        height:40px;
    }

    .city_tag h2{
        display:inline;
    }

    .select_condition{
        margin-left:20px;
        width:240px;
        float:left;
    }

    .list{
        margin-top:20px;
    }

    .page a{
        margin-left:5px;
        margin-right:5px;
    }

	</style>
</head>
<body>

<div id="container">
    <div style="display:none">
        <input type="hidden" id="cur_city" name="cur_city" value="<?=$cur_city;?>"/>
        <input type="hidden" id="cur_decor" name="cur_decor" value="<?=$cur_decor;?>"/>
    </div>
	<h1>各个论坛最新帖子！</h1>

	<div id="body">
        <div class="city_tag">
            <div class="city_type select_condition">
                <div>
                    <span>选择城市：</span>
                    <h2><a href="<?=$this->config->item('base_url') . 'crawler?city=&decor=' . $cur_decor . '&ctype=' . $cur_type . '&source=' . $cur_source;?>">全国</a></h2>
                    <h2 style="margin-left:5px;margin-right:5px;">|</h2>
                    <h2><a href="<?=$this->config->item('base_url') . 'crawler?city=上海&decor=' . $cur_decor . '&ctype=' . $cur_type . '&source=' . $cur_source;?>">上海</a></h2>
                    <h2 style="margin-left:5px;margin-right:5px;">|</h2>
                    <h2><a href="<?=$this->config->item('base_url') . 'crawler?city=北京&decor=' . $cur_decor . '&ctype=' . $cur_type . '&source=' . $cur_source;?>">北京</a></h2>
                </div>
                <div>
                    <span>当前城市：</span><strong><?=$city_name;?></strong>
                </div>
            </div>
            <div class="content_type select_condition">
                <div>
                    <span>关键字：</span>
                    <h2><a href="<?=$this->config->item('base_url') . 'crawler?decor=0&city=' . $cur_city . '&ctype=' . $cur_type . '&source=' . $cur_source;?>">全部</a></h2>
                    <h2 style="margin-left:5px;margin-right:5px;">|</h2>
                    <h2><a href="<?=$this->config->item('base_url') . 'crawler?decor=1&city=' . $cur_city . '&ctype=' . $cur_type . '&source=' . $cur_source;?>">只包含装修</a></h2>
                </div>
                <div>
                    <span>当前关键字：</span><strong><?=$content_name;?></strong>
                </div>
            </div>
            <div class="subject_type select_condition">
                <div>
                    <span>内容：</span>
                    <h2><a href="<?=$this->config->item('base_url') . 'crawler?ctype=0&decor=' . $cur_decor . '&city=' . $cur_city . '&source=' . $cur_source;?>">主题+评论</a></h2>
                    <h2 style="margin-left:5px;margin-right:5px;">|</h2>
                    <h2><a href="<?=$this->config->item('base_url') . 'crawler?ctype=1&decor=' . $cur_decor . '&city=' . $cur_city . '&source=' . $cur_source;?>">只看主题</a></h2>
                </div>
                <div>
                    <span>当前内容：</span><strong><?=$type_name;?></strong>
                </div>
            </div>
            <div class="source_type select_condition">
                <div>
                    <span>来源：</span>
                    <h2><a href="<?=$this->config->item('base_url') . 'crawler?ctype=' . $cur_type . '&decor=' . $cur_decor . '&city=' . $cur_city . '&source=1';?>">篱笆</a></h2>
                    <h2 style="margin-left:5px;margin-right:5px;">|</h2>
                    <h2><a href="<?=$this->config->item('base_url') . 'crawler?ctype=' . $cur_type . '&decor=' . $cur_decor . '&city=' . $cur_city . '&source=2';?>">高老庄</a></h2>
                    <h2 style="margin-left:5px;margin-right:5px;">|</h2>
                    <h2><a href="<?=$this->config->item('base_url') . 'crawler?ctype=' . $cur_type . '&decor=' . $cur_decor . '&city=' . $cur_city . '&source=3';?>">搜狐</a></h2>
                </div>
                <div>
                    <span>当前来源：</span><strong><?=$source_site_name;?></strong>
                </div>
            </div>
        </div>
        <div class="list">
        <ul>
        <?php foreach($list as $v):?>
            <li>
                <div>
                    <span>来源:<?=$v['sour'];?></span>
                </div>
                <?php if($cur_type == 0):?>
                <div style="border:1px solid;">
                    <div>
                        <strong>评论内容：</strong><a target="_blank" href="<?=$v['m_url'];?>"><?=$v['m_con'];?></a>
                    </div>
                    <div>
                        <span>是否包含“装修”关键字：</span>
                        <?php if($v['m_decor']):?>是<?php else:?>否<?php endif;?>
                    </div>
                    <div>
                        <span>户型和城市：</span>
                        <?php if(!empty($v['m_city']) || $v['m_acr'] > 0):?>
                            <?php if($v['m_city']):?>
                                <strong><?=$v['m_city'];?></strong><?php echo '&nbsp;&nbsp;&nbsp;&nbsp';?>
                            <?php endif;?>
                            <?php if($v['m_acr'] > 0):?>
                                <strong><?=$v['m_acr'];?>平</strong>
                            <?php endif;?>
                        <?php else:?>
                            <span>暂无信息</span>
                        <?php endif;?>
                    </div>
                    <div>
                        <span>评论者：</span><a target="_blank" href="<?=$v['m_uid_url'];?>"><?=$v['m_uname'];?>(地区：<strong><?=$v['m_area'];?>)</strong></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;<span><?=$v['m_time'];?></span>
                    </div>
                </div>
                <?php endif;?>
                <div style="border:1px solid;margin-top:2px;">
                    <div>
                        <strong><?php if($cur_type == 0):?>所属<?php endif;?>帖子：</strong><a target="_blank" href="<?=$v['c_url'];?>"><?=$v['c_title'];?></a>
                    </div>
                    <div>
                        <span>是否包含“装修”关键字：</span>
                        <?php if($v['c_decor']):?>是<?php else:?>否<?php endif;?>
                    </div>
                    <div>
                        <span>户型和城市：</span>
                        <?php if(!empty($v['c_city']) || $v['c_acr'] > 0):?>
                            <?php if($v['c_city']):?>
                                <strong><?=$v['c_city'];?></strong><?php echo '&nbsp;&nbsp;&nbsp;&nbsp';?>
                            <?php endif;?>
                            <?php if($v['c_acr'] > 0):?>
                                <strong><?=$v['c_acr'];?>平</strong>
                            <?php endif;?>
                        <?php else:?>
                            <span>暂无信息</span>
                        <?php endif;?>
                    </div>
                    <div>
                        <span>帖子作者：</span><a target="_blank" href="<?=$v['c_uid_url'];?>"><?=$v['c_uname'];?>(地区：<strong><?=$v['c_area'];?></strong>)</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;<span><?=$v['c_time'];?></span>
                    </div>
                </div>
            </li>
            <br/>
        <?php endforeach;?>
        </ul>
        </div>
        <div class="page">
            <?=$page;?>
        </div>
	</div>
</div>

</body>
</html>
