<?php

class Complaint_code_m extends CI_Model {
	
//==============================================================
//**************************************************************
//==============================================================	
	function __construct()
    {
    	parent::__construct();
    }
//==============================================================
//**************************************************************
//==============================================================
    	function complaintAdd($data)
	{
		$insert = $this->db->insert('tbl_complaint_code', $data);
		return $this->db->insert_id();
	}
//==============================================================
//**************************************************************
//==============================================================	
	function updateComplaintById($data,$id)
	{
		$this->db->where('complaint_code_id',$id);
		$this->db->update('tbl_complaint_code',$data);
		return $this->db->affected_rows() > "";
	}
//==============================================================
//**************************************************************
//==============================================================	
	function  getComplaintById($id){
		$this->db->select();
		$this->db->from('tbl_complaint_code');
		$this->db->where('complaint_code_id',$id);
		$query= $this->db->get();
		return $query->result_array();
	}
//==============================================================
//**************************************************************
//==============================================================	
	function  getComplaintAll($per_pg="",$offset=""){

		$this->db->order_by('complaint_code_id','desc');
		
		$query=$this->db->get('tbl_complaint_code',$per_pg,$offset);	
		
		return $query->result_array();
	}
//==============================================================
//**************************************************************
//==============================================================	
	function  countAllComplaint(){
		

		return $this->db->count_all('tbl_complaint_code');
	}
//==============================================================
//**************************************************************
//==============================================================	
	function  deleteComplaintCodeById($id){
	$this->db->where('complaint_code_id', $id)->delete('tbl_complaint_code');
	return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
//==============================================================
//**************************************************************
//==============================================================	

}