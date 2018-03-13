<?php
class Restaurant extends CI_Model {
	public $name;
	public $email;
	public $telephone;
	public $address1;
	public $address2;
	public $city;
	public $province;
	public $postcode;
	public $country;
	public $description;
	public $imagepath;
	public $status;
	public $latitude;
	public $longitude;
	
	public function insert_entry($file_name = "empty")
	{
		$this->name = $this->input->post('name');
		$this->email = $this->input->post('email');
		$this->telephone = $this->input->post('telephone');
		$this->address1 = $this->input->post('addr1');
		$this->address2 = $this->input->post('addr2');
		$this->city = $this->input->post('city');
		$this->province = $this->input->post('province');
		$this->postcode = $this->input->post('pcode');
		$this->country = $this->input->post('country');
		$this->description = $this->input->post('desc');
		//$this->imagepath = $this->input->post('image');
		$this->imagepath = "./assets/images/restaurants/$file_name";
		$this->status = 'Enable';
		$this->latitude = 0000;
		$this->longitude = 0000;
		$this->db->insert('Restaurants', $this);
    }
	
	public function get_restaurants($id = FALSE)
	{
        if ($id === FALSE)
        {
                $query = $this->db->get('restaurants');
                return $query->result_array();
        }

        $query = $this->db->get_where('restaurants', array('RestaurantId' => $id));
        return $query->row_array();
	}
	
	public function edit_restaurant($file_name = "empty") 
	{
		$id = $this->input->post('id');
		
		$arr = $this->get_restaurants($id);
		
		$this->name = $this->input->post('name');
		$this->email = $this->input->post('email');
		$this->telephone = $this->input->post('telephone');
		$this->address1 = $this->input->post('addr1');
		$this->address2 = $this->input->post('addr2');
		$this->city = $this->input->post('city');
		$this->province = $this->input->post('province');
		$this->postcode = $this->input->post('pcode');
		$this->country = $this->input->post('country');
		$this->description = $this->input->post('desc');
		//$this->imagepath = $this->input->post('image');
		$this->imagepath = $arr['ImagePath'];
		$this->status = 'Enable';
		$this->latitude = 0000;
		$this->longitude = 0000;
		
		$this->db->reset_query();
		
		$this->db->where('RestaurantId', $id);
		$sql_stmt2 = $this->db->update('restaurants', $this);
		if($sql_stmt2 === true) {
			return true; 
		} else {
			return false;
		}	
	}
	
	public function delete_restaurant($id = null) {
		if($id) {
			$sql_stmt = "DELETE FROM restaurants WHERE RestaurantId = ?";
			$query = $this->db->query($sql_stmt, array($id));

			// ternary operator
			return ($query === true) ? true : false;			
		} // /if
	}
}
