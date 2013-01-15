<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function index($tag="_",$date="_",$page=0)
	{
		$page=intval($page);
		$per_page=10;
		
		$sql_tag="";
		if($tag!="_"){
			$sql_tag="and id in (select pid from sc_tags where tag='$tag')";
			
		}
		$sql_date="";
		if($date!="_"){
			$sql_date="and DATE_FORMAT( pub_time,  '%Y-%m')='$date'";
		}
		$data['tag_']=$tag;
		$data['date_']=$date;


		$query=$this->db->query("select * from sc_posts where status=? and post_or_page=? and pub_time<now() $sql_tag $sql_date order by pub_time desc limit ?,?",array(1,'post',$page,$per_page));
		$query_cnt=$this->db->query("select count(1) as cnt from sc_posts where status=? and post_or_page=? and pub_time<now() $sql_tag $sql_date",array(1,'post',$page,$per_page));
		$query_cnt_row=$query_cnt->result();
		$data['cnt']=intval($query_cnt_row[0]->cnt);
		if($data['cnt']%$per_page==0){
			$data['lastpage']=$data['cnt']-$per_page;
		}else{
			$data['lastpage']=intval($data['cnt']/$per_page)*$per_page;
		}
		if($data['lastpage']<0)$data['lastpage']=0;


		$prevpage=($page-$per_page)<=0?0:($page-$per_page);
		$nextpage=($page+$per_page)>=$data['cnt']?$page:$page+$per_page;
		$data['prevpage']=$prevpage;
		$data['nextpage']=$nextpage;
		$data['page']=$page;

		$rows=$query->result();

		for($i=0;$i<count($rows);$i++){
			$id=$rows[$i]->id;
			$query_tags=$this->db->query("select * from sc_tags where pid=?",array($id));
			$rows_tags=$query_tags->result();
			$rows[$i]->tags=$rows_tags;
		}
		$data['list']=$rows;

		$query=$this->db->query("select * from sc_option where t_name='site_name' or t_name='site_description'");
		$result=$query->result();
		
		foreach($result as $item){
			if($item->t_name=="site_name"){
				$data['keywords']=$item->t_value;
			}else if($item->t_name=="site_description"){
				$data['description']=$item->t_value;
			}
		}

		$query=$this->db->query("select * from sc_option where t_name='site_username'");
		$result=$query->result();
		$data['site_username']=$result[0]->t_value;



		$this->load->view("index",$data);
	}
	public function archive()
	{
		//日期分类
		$query=$this->db->query("SELECT DATE_FORMAT( pub_time,  '%Y-%m' ) AS df_tm FROM sc_posts where status=1 and post_or_page = 'post' and pub_time<now() GROUP BY df_tm ORDER BY df_tm ASC");
		$data['date']=$query->result();

		//标签分类
		$query=$this->db->query("select distinct tag from sc_tags where pid in (select id from sc_posts where status=1 and post_or_page = 'post' and pub_time<now())");
		$data["tags"]=$query->result();

		$query=$this->db->query("select * from sc_option where t_name='site_description'");
		$result=$query->result();
		
		foreach($result as $item){
			if($item->t_name=="site_description"){
				$data['description']=$item->t_value;
			}
		}
		$data['keywords']="";
		foreach ($data['tags'] as $item) {
			$data['keywords'].=($item->tag.",");
		}
		$data['keywords']=trim($data['keywords'],",");

		$this->load->view("archive",$data);
	}
	public function detail($id)
	{
		$id=intval($id);
		$query=$this->db->query("select * from sc_posts where id=?",array($id));
		$rows=$query->result();
		$data['keywords']="";
		
		for($i=0;$i<count($rows);$i++){
			$id=$rows[$i]->id;
			$query_tags=$this->db->query("select * from sc_tags where pid=?",array($id));
			$rows_tags=$query_tags->result();
			$rows[$i]->tags=$rows_tags;
			foreach ($rows[$i]->tags as $item) {
				$data['keywords'].=($item->tag.",");
			}
		}

		$data['list']=$rows;

		$query=$this->db->query("select * from sc_option where t_name='site_description'");
		$result=$query->result();
		
		foreach($result as $item){
			if($item->t_name=="site_description"){
				$data['description']=$item->t_value;
			}
		}
		
		$data['keywords']=trim($data['keywords'],",");

		$query=$this->db->query("select * from sc_option where t_name='site_username'");
		$result=$query->result();
		$data['site_username']=$result[0]->t_value;

		$this->load->view("detail",$data);
	}
	public function rss()
	{
		$this->load->library("rss2");

		$query=$this->db->query("select * from sc_option where t_name='site_name' or t_name='site_description'");
		$result=$query->result();
		
		foreach($result as $item){
			if($item->t_name=="site_name"){
				$keywords=$item->t_value;
			}else if($item->t_name=="site_description"){
				$description=$item->t_value;
			}
		}


		$channel = $this->rss2->new_channel();
		$current_url=site_url()."/main/rss";
		$channel->atom_link($current_url);
		$channel->set_title($keywords);
		$channel->set_link(site_url());
		$channel->set_description($description);

		$query=$this->db->query("select * from sc_option where t_name='site_username'");
		$result=$query->result();
		$site_username=$result[0]->t_value;
		
		$query=$this->db->query("select * from sc_posts where status=? and post_or_page=? and pub_time<now() order by pub_time desc",array(1,'post'));
		$rows=$query->result();
		foreach($rows as $row){
			$item=$channel->new_item();
			$item->set_title($row->title);
			$item->set_link(site_url()."/main/detail/".$row->id);
			$item->set_guid("");
			$item->set_description($row->content);
			$item->set_author($site_username);
			$channel->add_item($item);
		}

		$this->rss2->pack($channel);
		header($this->rss2->headers());

		echo $this->rss2->render();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */