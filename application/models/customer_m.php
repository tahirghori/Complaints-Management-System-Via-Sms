<?php

class Customer_m extends CI_Model {
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
    	function customerAdd($data)
	{
		$insert = $this->db->insert('tbl_customer', $data);
		return $this->db->insert_id();
	}
//==============================================================
//**************************************************************
//==============================================================	
	function updateCustomerById($data,$id)
	{
		$this->db->where('customer_id',$id);
		$this->db->update('tbl_customer',$data);
		return $this->db->affected_rows() > "";
	}
//==============================================================
//**************************************************************
//==============================================================	
	function  getCustomerById($id){
		$this->db->select();
		$this->db->from('tbl_customer');
		$this->db->where('customer_id',$id);
		$query= $this->db->get();
		return $query->result_array();
	}
	
//==============================================================
//**************************************************************
//==============================================================	
	function  getAllMachineByCustomerId($id){
		$this->db->select();
		$this->db->from('tbl_machine');
		$this->db->where('customer_id',$id);
		$query= $this->db->get();
		return $query->result_array();
	}	
//==============================================================
//**************************************************************
//==============================================================	
	function  getCustomerAll($per_pg,$offset){
		$this->db->order_by('customer_id','desc');
		$query=$this->db->get('tbl_customer',$per_pg,$offset);	
		return $query->result_array();
	}
//==============================================================
//**************************************************************
//==============================================================	
	function  countAllCustomer(){

		return $this->db->count_all('tbl_customer');
	}
//==============================================================
//**************************************************************
//==============================================================	
	function  deleteCustomerById($id){
	$this->db->where('customer_id', $id)->delete('tbl_customer');
	return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
//==============================================================
//**************************************************************
//==============================================================	

}