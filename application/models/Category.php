<?php
class Category extends CI_Model {
	public $name;
    public $description;
    public $imagepath;
	public $status;
	
	public function insert_entry($file_name = "empty")
	{
		$this->name = $this->input->post('name');
		$this->description = $this->input->post('desc');
		//$this->imagepath = $this->input->post('image');
		$this->imagepath = "./assets/images/categories/$file_name";
		$this->status = 'Enable';
		$sql_stmt = $this->db->insert('Categories', $this);
		
		if($sql_stmt === true) {
			return true; 
		} else {
			return false;
		}
    }
	public function get_categories($id = FALSE)
	{
        if ($id === FALSE)
        {
                $query = $this->db->get('categories');
                return $query->result_array();
        }

        $query = $this->db->get_where('categories', array('CategoryId' => $id));
        return $query->row_array();
	}
	
	public function edit_category($file_name = "empty") 
	{
		$id = $this->input->post('id');
		$this->name = $this->input->post('name');
		$this->description = $this->input->post('desc');
		//$this->imagepath = $this->input->post('image');
		$this->imagepath = "./assets/images/categories/$file_name";
		$this->status = 'Enable';
		$this->db->where('CategoryId', $id);
		$sql_stmt = $this->db->update('categories', $this);

		if($sql_stmt === true) {
			return true; 
		} else {
			return false;
		}	
	}
	
	public function delete_category($id = null) {
		if($id) {
			$sql_stmt = "DELETE FROM categories WHERE CategoryId = ?";
			$query = $this->db->query($sql_stmt, array($id));

			// ternary operator
			return ($query === true) ? true : false;			
		} // /if
	}
}
