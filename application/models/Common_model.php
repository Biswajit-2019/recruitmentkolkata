<?php

class Common_model extends CI_Model {

	



	############################### Get Value from Database for specific field ########################

	

	function getValue($tableName, $field_name, $fetchid){

		$query = $this->db->get_where($tableName, array('id' => $fetchid));

		$row = $query->row_array();

		return $row[$field_name];

	}

	

	############################### Return array from specific table ########################

	

	function getData($tableName, $param){

		$query = $this->db->get_where($tableName, $param);

		return $query->result();

	}
	function get_data($tableName, $where, $order)
	{
		$this->db->select('*');
		$this->db->from($tableName);
		$this->db->where($where);
		$this->db->order_by($order, "desc");
		$query = $this->db->get();
		return $query->result();
	}

	############################### Return all array from specific table ########################

		function getAll($table,$where_clause,$order_by_fld,$order_by,$limit,$offset) {

		if($where_clause != '')

			$this->db->where($where_clause);

        if($order_by_fld != '')

		    $this->db->order_by($order_by_fld,$order_by);

		if($limit != '' && $offset !='')

		    $this->db->limit($limit,$offset);		

		$this->db->select('*');

		$this->db->from($table);

		$query = $this->db->get();  

		return $query->result();
		
	}

	

	############################### Return a array from specific table ########################

		function getSingle($table,$where_clause,$order_by_fld,$order_by,$limit,$offset) {

		if($where_clause != '')

			$this->db->where($where_clause);

        if($order_by_fld != '')

		    $this->db->order_by($order_by_fld,$order_by);

		if($limit != '' && $offset !='')

		    $this->db->limit($limit,$offset);		

		$this->db->select('*');

		$this->db->from($table);

		$query = $this->db->get();  

		 return $query->row(); 

	}
	function get_single($table,$where) {

		$this->db->where($where);
		$this->db->select('*');
		$this->db->from($table);
		$query = $this->db->get();  
		return $query->row(); 

	}

	

	############################### Delete array from specific table ########################

	function deleteData($table,$where)

	{
		$this->db->delete($table, $where); 
		//echo $this->db->last_query();exit;
	}

	

	############################### Update array for specific table ########################

	function updateValue($row,$table,$where_clause) {

		$this->db->where($where_clause);

		$this->db->update($table, $row);

		$temp=$this->db->affected_rows();

		return $temp;		

	}

	

	############################### Count array for specific table ########################

	function getCount($table,$where_clause,$order_by_fld,$order_by,$limit,$offset) {
		
		if($where_clause != '')

			$this->db->where($where_clause);

		 if($order_by_fld != '')

		    $this->db->order_by($order_by_fld,$order_by);

		if($limit != '' && $offset !='')

		    $this->db->limit($limit,$offset);			

		 $this->db->select('*');

		 $this->db->from($table);

		 $query = $this->db->get();  

		 return $query->num_rows(); 

	}

	

	############################### Insert array for specific table ########################

	function insertValue($table, $row)

	{

		$str = $this->db->insert_string($table, $row);        

		$query = $this->db->query($str);    

		$insertid = $this->db->insert_id();

		return $insertid;
	

	}
	
	function all($table_Name)
	{
		$query = $this->db->get($table_Name);
		return $query->result();
	}
	
	function getNumrows($tableName, $param){

		$query = $this->db->get_where($tableName, $param);

		return $query->num_rows(); 


	}
	
	function insertData($table,$data)
	{
		$this->db->insert($table, $data); 
		return $this->db->insert_id();
	}
	
	function getCounts($sql)
	{
		$query = $this->db->query($sql);
		return $query->result();
	}
	function numrowsDbQuery($sql)
	{

		$query = $this->db->query($sql);
		 return $query->num_rows();

	}
	function delete($id)
	{
		$query=$this->db->delete('cms_pages', array('id' => $id)); 
		if($query==true)
		{
			return 1;
		}
	}
	function view_edit_cms($id)
	{
		$query = $this->db->get_where('cms_pages', array('id' => $id));
		//$query = $this->db->query("select * from cms_pages where id='$id'");
        return $query->result();	
		
	}
	function updateData($table,$data)
	{
		
		$id=$data['id'];
		$this->db->where('id', $id);
		$this->db->update($table,$data);
		
	}
	function update_data($tableName,$where,$data)
	{
		$this->db->where($where);
		$this->db->update($tableName, $data);
	}
	function search($table,$string,$where)
	{
		$this->db->select('*');
		//$this->db->where($where);
		$this->db->like('page_title', $string, 'both');
		$this->db->or_like('content', $string, 'both'); 
		$this->db->where_not_in('id',$where);
		$this->db->from($table);
		$query = $this->db->get();  
		return $query->result(); 
	}
	function dbQuery1($query)
		{
			$query = $this->db->query($query);
			return $query->result();

		}
		function getDatawithlimit($tableName, $where,$order,$start,$end)
	{
		 $this->db->select('*');
		 $this->db->from($tableName);
		 if($where != ''){
		 	$this->db->where($where);
		 }
		 
		 $this->db->order_by($order, "desc");
		 $this->db->limit($end,$start);
		 $query = $this->db->get();
		 return $query->result();
	}
	
	

}

?>
