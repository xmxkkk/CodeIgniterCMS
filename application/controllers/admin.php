<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper("form");
		$this->load->library("session");
		$info=$this->session->userdata("info");
		if($info==null){
			header("location:".site_url()."/login/login1");
		}
	}

	public function update_admin()
	{
		$this->load->library("form_validation");

		$this->form_validation->set_rules("site_name","网站标题","trim|required|xss_clean");
		$this->form_validation->set_rules("site_description","网站描述","trim|xss_clean");
		$this->form_validation->set_rules("site_username","站长昵称","trim|required|xss_clean");
		$this->form_validation->set_rules("site_admin","后台账号","trim|required|min_length[5]|xss_clean");
		$this->form_validation->set_rules("site_passwd","后台密码","trim|required|min_length[5]|matches[site_passwd_conf]|xss_clean");
		$this->form_validation->set_rules("site_passwd_conf","确认密码","trim|required|min_length[5]|xss_clean");
		

		$this->form_validation->set_message('required', '%s不能为空！');
		$this->form_validation->set_message('matches', '%s和%s不一样！');
		$this->form_validation->set_message('min_length', "%s不能少于%s位！");

		if ($this->form_validation->run()==FALSE) {
			//没有通过
		}else{
			//通过
			$site_name=$this->input->post("site_name");
			$this->db->query("update sc_option set t_value = ? where t_name=? ",array($site_name,"site_name"));
			$site_description=$this->input->post("site_description");
			$this->db->query("update sc_option set t_value = ? where t_name=?",array($site_description,"site_description"));
			$site_username=$this->input->post("site_username");
			$this->db->query("update sc_option set t_value=? where t_name=?",array($site_username,"site_username"));
			$site_admin=$this->input->post("site_admin");
			$this->db->query("update sc_option set t_value=? where t_name=?",array($site_admin,"site_admin"));
			$site_passwd=md5($this->input->post("site_passwd"));
			$this->db->query("update sc_option set t_value=? where t_name=?",array($site_passwd,"site_passwd"));
		}
		$query=$this->db->query("select * from sc_option");
		$rows=$query->result();
		
		foreach($rows as $row){
			if($row->t_name=="site_name"){
				$data['site_name']=$row->t_value;
			}else if($row->t_name=="site_description"){
				$data['site_description']=$row->t_value;
			}else if($row->t_name=="site_username"){
				$data['site_username']=$row->t_value;
			}else if($row->t_name=="site_admin"){
				$data['site_admin']=$row->t_value;
			}
		}

		$data['menu']=3;
		$this->load->view("setting",$data);
	}
	public function index($status=1)
	{
		//header("location:".site_url()."/main/index");
		header("location:".site_url()."/admin/post/".$status."/_/_/0");
	}
	public function manager($status=1)
	{
		header("location:".site_url()."/admin/post/".$status."/_/_/0");
	}
	public function post($status=1,$tag="_",$date="_",$page=0)
	{
		$status=intval($status);
		$page=intval($page);
		$sql_tag="";
		if($tag!="_"){
			$sql_tag="and id in (select pid from sc_tags where tag='$tag')";
		}
		$sql_date="";
		if($date!="_"){
			$sql_date="and DATE_FORMAT( pub_time,  '%Y-%m')='$date'";
		}
		$per_page=20;

		$query=$this->db->query("select * from sc_posts where status=? and post_or_page = ? $sql_tag $sql_date order by pub_time desc limit ?,$per_page",array($status,'post',$page));
		$query_cnt=$this->db->query("select count(1) as cnt from sc_posts where status=? and post_or_page = ? $sql_tag $sql_date",array($status,'post'));
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
		if($data['cnt']%$per_page==0){
			$data['totalpage']=$data['cnt']/$per_page;
		}else{
			$data['totalpage']=intval($data['cnt']/$per_page)+1;
		}
		$data['currentpage']=intval($page/$per_page)+1;


		$rows=$query->result();
		for($i=0;$i<count($rows);$i++){
			$id=$rows[$i]->id;
			$query_tags=$this->db->query("select * from sc_tags where pid=?",array($id));
			$rows_tags=$query_tags->result();
			$rows[$i]->tags=$rows_tags;
		}
		$data['list']=$rows;
		$data['status']=$status;


		//日期分类
		$query=$this->db->query("SELECT DATE_FORMAT( pub_time,  '%Y-%m' ) AS df_tm FROM sc_posts GROUP BY df_tm ORDER BY df_tm ASC");
		$data['date']=$query->result();

		//标签分类
		$query=$this->db->query("select distinct tag from sc_tags");
		$data["tags"]=$query->result();

		$data['date_']=$date;
		$data['tag_']=$tag;

		$data['menu']=1;
		$this->load->view('post',$data);
	}

	public function edit($id=0)
	{
		$id=intval($id);
		
		$str=$this->input->post("datetime");
		$datetime=date("Y-m-d H:i:s",strtotime($str));
		// echo $datetime;exit();

		$title=$this->input->post("title");
		$content=$this->input->post("content");
		$tags=$this->input->post("tags");
		if($tags=="在此输入标签，多个标签用英语逗号（,）分割"){
			$tags="";
		}
		$enable_comment=intval($this->input->post("enable_comment"));
		$status=intval($this->input->post("status"));
		$post_or_page=$this->input->post("post_or_page");

		$data['id']=$id;
		$data['title']=$title;
		$data['content']=$content;
		$data['tags']=$tags;
		$data['enable_comment']=$enable_comment;
		$data['status']=$status;


		if($title==null||$content==null){
			exit();
		}
		$this->db->trans_start();

		if($id==0){
			//insert	
			$this->db->query("insert into sc_posts (title,content,pub_time,enable_comment,status,post_or_page) values (?,?,?,?,?,?)"
				,array($title,$content,$datetime,intval($enable_comment),intval($status),$post_or_page));
			$id=$this->db->insert_id();
			if($id<=0){
				$this->db->trans_rollback();
				exit();
			}
		}else{
			//update
			$this->db->query("update sc_posts set title=?,content=?,pub_time=?,enable_comment=?,status=?,post_or_page=? where id=?"
				,array($title,$content,$datetime,$enable_comment,$status,$post_or_page,$id));
			$this->db->query("delete from sc_tags where pid=?",array($id));
		}
		$tags=explode(",", $tags);
		for($i=0;$i<count($tags);$i++)
		{
			$tag=trim($tags[$i]);
			if($tag==""){
				continue;
			}
			$this->db->query("insert into sc_tags (pid,tag) values (?,?)",array($id,$tag));
		}
		$this->db->trans_complete();


		header("location:".site_url()."/admin/".$post_or_page);
	}

	public function addPost($id=0)
	{
		$id=intval($id);

		if($id>0){
			$query=$this->db->query("select * from sc_posts where id=$id");
			$rows=$query->result();
			if(count($rows)==0){
				exit();
			}
			$title=$rows[0]->title;
			$content=$rows[0]->content;
			$enable_comment=$rows[0]->enable_comment;
			$status=$rows[0]->status;
			$datetime=$rows[0]->pub_time;
			
			$query=$this->db->query("select * from sc_tags where pid=?",array($id));
			$rows=$query->result();
			$tags="";
			for($i=0;$i<count($rows);$i++){
				$tags.=$rows[$i]->tag.",";
			}
			$tags=trim($tags,",");
			
		}else{
			$title=$this->input->post("title");
			$content=$this->input->post("content");
			$tags=$this->input->post("tags");
			$enable_comment=intval($this->input->post("enable_comment"));
			$status=intval($this->input->post("status"));
			$datetime=$this->input->post("pub_time");
		}
		
		$data['id']=$id;
		$data['title']=$title;
		$data['content']=$content;
		$data['tags']=$tags;
		$data['enable_comment']=$enable_comment;
		$data['status']=$status;
		$data['post_or_page']="post";
		$data['datetime']=$datetime;

		$data['menu']=1;
		$this->load->view("addPost",$data);
	}
	public function page($status=1,$tag="_",$date="_",$page=0)
	{
		$status=intval($status);
		$page=intval($page);
		$sql_tag="";
		$sql_date="";
		if($date!="_"){
			$sql_date="and DATE_FORMAT( pub_time,  '%Y-%m')='$date'";
		}
		$per_page=20;

		$query=$this->db->query("select * from sc_posts where status=? and post_or_page = ? $sql_tag $sql_date order by pub_time desc limit ?,$per_page",array($status,'page',$page));
		$query_cnt=$this->db->query("select count(1) as cnt from sc_posts where status=? and post_or_page = ? $sql_tag $sql_date",array($status,'page'));
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
		if($data['cnt']%$per_page==0){
			$data['totalpage']=$data['cnt']/$per_page;
		}else{
			$data['totalpage']=intval($data['cnt']/$per_page)+1;
		}
		$data['currentpage']=intval($page/$per_page)+1;


		$rows=$query->result();
		for($i=0;$i<count($rows);$i++){
			$id=$rows[$i]->id;
			$query_tags=$this->db->query("select * from sc_tags where pid=?",array($id));
			$rows_tags=$query_tags->result();
			$rows[$i]->tags=$rows_tags;
		}
		$data['list']=$rows;
		$data['status']=$status;


		//日期分类
		$query=$this->db->query("SELECT DATE_FORMAT( pub_time,  '%Y-%m' ) AS df_tm FROM sc_posts GROUP BY df_tm ORDER BY df_tm ASC");
		$data['date']=$query->result();

		$data['date_']=$date;

		$data['menu']=2;
		$this->load->view('page',$data);
	}
	public function addPage($id=0)
	{
		$id=intval($id);

		if($id>0){
			$query=$this->db->query("select * from sc_posts where id=$id");
			$rows=$query->result();
			if(count($rows)==0){
				exit();
			}
			$title=$rows[0]->title;
			$content=$rows[0]->content;
			$enable_comment=$rows[0]->enable_comment;
			$status=$rows[0]->status;
			$datetime=$rows[0]->pub_time;
			$tags="";
		}else{
			$title=$this->input->post("title");
			$content=$this->input->post("content");
			$tags=$this->input->post("tags");
			$enable_comment=intval($this->input->post("enable_comment"));
			$status=intval($this->input->post("status"));
			$datetime=$this->input->post("datetime");
		}

		
		$data['id']=$id;
		$data['title']=$title;
		$data['content']=$content;
		$data['tags']=$tags;
		$data['enable_comment']=$enable_comment;
		$data['status']=$status;
		$data['post_or_page']="page";
		$data['datetime']=$datetime;

		$data['menu']=2;
		$this->load->view("addPage",$data);
	}
	public function setting()
	{
		$query=$this->db->query("select * from sc_option");
		$rows=$query->result();

		foreach($rows as $row){
			if($row->t_name=="site_name"){
				$data['site_name']=$row->t_value;
			}else if($row->t_name=="site_description"){
				$data['site_description']=$row->t_value;
			}else if($row->t_name=="site_username"){
				$data['site_username']=$row->t_value;
			}else if($row->t_name=="site_admin"){
				$data['site_admin']=$row->t_value;
			}
		}

		$data['menu']=3;
		$this->load->view("setting",$data);
	}

	public function recycle($post_or_page="post",$status=1,$opid=0,$method="recycle"){
		
		$opid=intval($opid);
		if($opid==0){
			$opids=$this->input->post("opid");
			$date=$this->input->post("date");
			$tag=$this->input->post("tag");
			if($tag==""){
				$tag="_";
			}
			$status=$this->input->post("status");
			$method=$this->input->post("method");
		}else{
			$opids=array($opid);
			$tag="_";
			$date="_";
		}
		
		if($method=="recycle"){
			for($i=0;$i<count($opids);$i++){
				$this->db->query("update sc_posts set status=3 where id=?",array(intval($opids[$i])));
			}
		}else if($method=="delete"){
			for($i=0;$i<count($opids);$i++){
				$this->db->query("delete from sc_posts where id=?",array(intval($opids[$i])));
				$this->db->query("delete from sc_tags where pid=?",array(intval($opids[$i])));
			}
		}else if($method=="publish"){
			for($i=0;$i<count($opids);$i++){
				$this->db->query("update sc_posts set status=1 where id=?",array(intval($opids[$i])));
			}
		}
		header("location:".site_url()."/admin/$post_or_page/$status/$tag/$date/0");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */