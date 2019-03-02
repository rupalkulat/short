<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shortlink extends CI_Controller {
public function __construct()
    {
        parent::__construct();
        $this->load->model('short_link');
       $this->load->helper('url');
    }   
	
	public function index($id=null)
	{
		$this->load->helper('url');
		//short link redirect
		if($id!==null){
			$long_url=$this->short_link->getById(base64_decode($id));
			redirect($long_url['long_url']);
			exit;
	    }
		
		//show last generated link
		$data=[];
		if($this->input->get('id')){
			$short_link=$this->short_link->getById($this->input->get('id'));	
			$data=$short_link;
		}
		
		//show last redirected data
		if($this->input->get('redirect')==true && $this->input->get('id')){
			$data=[];
			$redirect_link=$this->short_link->reGetById($this->input->get('id'));	
			$data=$redirect_link;
		}
        $sql="Select * from short_link";
        $data['data']=$this->short_link->getSqlData($sql);
		$this->load->view('form',$data);
	}

	public function process()
	{
       $uuid=uniqid();
       $data=[
       	'campaign_name'=>$this->input->post('campaign_name'), 
       	'long_url'=>$this->input->post('long_url'),
       	'link_id'=>$uuid,
       	'short_url'=>base_url($uuid),
       ];
	   
	   
       $result=$this->short_link->create($data);
       redirect(base_url('?show=last&id='.$result));

	}
	
	public function reprocess()
	{
		$data=[
			'short_id'=>$this->input->get('id'),
			'redirect_to'=>$this->input->post('redirect_url'),			
		];
		
		$result=$this->short_link->recreate($data);
		
		$redirect_link=$this->short_link->reGetById($result);
		$short_link=$this->short_link->getById($redirect_link['short_id']);
		$short_link['long_url']=$short_link['long_url'].'&redirect_to='.urlencode($this->input->post('redirect_url'));
		
		$update=$this->short_link->update($short_link);	
		redirect(base_url('?show=last&id='.$result.'&redirect=true'));
	}

	public function getUrl($id){

        
	    $sql="SELECT * FROM short_link  WHERE id=".$id; 
        $data['data']=$this->short_link->getSqlData($sql);
		$this->load->view('update',$data);
		
	}	

	public function update($id)
	{
		
		$long_url=$this->input->post('long_url');
		$long_url=parse_url($long_url);
		$long_url_query_string=parse_str($long_url['query'],$query_string);
		$long_url='http://'.$long_url['host'].'?utm_source='.$query_string["utm_source"].'&redirect_to='.urlencode($this->input->post('redirect_url'));
		$data=[
			'long_url'=>$long_url,
			'id'=>$id
		];
		//update in short link
		$this->db->where('id', $id);
		$result=$this->db->update('short_link', $data);
		//insert in redirect link
		if($result){
			$redirect_url=$this->input->post("redirect_url");


			$checkExists=$this->db
					        ->where('short_id', $id)
					        ->count_all_results('redirection_link');
			if($checkExists>0){
				//update query
					$sql="update redirection_link set redirect_to='$redirect_url' where short_id='$id' "; 
         		$this->db->query($sql);	
			}else{
				//insert query
				$sql="INSERT into redirection_link (redirect_to,short_id) values('$redirect_url','$id')"; 
         		$this->db->query($sql);	
			}
		}
		
		redirect(base_url());

    }
}	
	