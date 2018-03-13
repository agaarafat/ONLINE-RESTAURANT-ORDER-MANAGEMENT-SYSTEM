<?php
class Meal_time extends CI_Model {
	public $name;
    public $starttime;
    public $endtime;
	
	public function insert_entry()
	{
		$this->name = $this->input->post('name');
		$this->starttime = $this->input->post('start');
		$this->endtime = $this->input->post('end');
		$this->db->insert('mealtimes', $this);
    }
	public function get_mealtimes($id = FALSE)
	{
        if ($id === FALSE)
        {
                $query = $this->db->get('mealtimes');
                return $query->result_array();
        }

        $query = $this->db->get_where('mealtimes', array('mealtimeid' => $id));
        return $query->row_array();
	}
	public function edit_mealtime() 
	{
		$id = $this->input->post('id');
		$this->name = $this->input->post('name');
		$this->starttime = $this->input->post('start');
		$this->endtime = $this->input->post('end');
		
		$this->db->where('MealTimeId', $id);
		$sql_stmt = $this->db->update('mealtimes', $this);

		if($sql_stmt === true) {
			return true; 
		} else {
			return false;
		}	
	}
	
	public function delete_mealtime($id = null) {
		if($id) {
			$sql_stmt = "DELETE FROM mealtimes WHERE MealTimeId = ?";
			$query = $this->db->query($sql_stmt, array($id));

			// ternary operator
			return ($query === true) ? true : false;			
		} // /if
	}
}
