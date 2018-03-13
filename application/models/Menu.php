<?php
class Menu extends CI_Model {
	public $name;
    public $description;
	public $price;
	public $categoryid;
    public $imagepath;
	public $mealtimeid;
	public $stockquantity;
	public $minquantity;
	public $menuoption;
	public $special;
	public $status;
	
	public function insert_entry($file_name = "empty")
	{
		$this->name = $this->input->post('name');
		$this->description = $this->input->post('desc');
		$this->price = $this->input->post('price');
		$this->categoryid = $this->input->post('category');
		//$this->imagepath = $this->input->post('image');
		$this->imagepath = "./assets/images/menus/$file_name";
		$this->mealtimeid = $this->input->post('mtime');
		$this->stockquantity = $this->input->post('sqnt');
		$this->minquantity = $this->input->post('mqnt');
		$this->menuoption = $this->input->post('option');
		$this->special = 'No';
		$this->status = 'Enable';
		$this->db->insert('Menus', $this);
    }
	public function get_menus($id = FALSE)
	{
		
		
		$this->db->select('m.MenuId, m.Name, m.Price, m.Description, c.CategoryId, c.Name AS "CategoryName", m.ImagePath, mt.MealTimeId, mt.Name AS "MTName", m.StockQuantity, m.MinQuantity, m.MenuOption')
			  ->from('menus as m, categories as c, mealtimes as mt')
			  ->where('c.CategoryId=m.CategoryId')
			  ->where('mt.MealTimeId=m.MealTimeId');		
			  
        if ($id === FALSE)
        {			
			$query = $this->db->get();
            return $query->result_array();
        }
		
		$sql_stmt = 'SELECT m.MenuId, m.Name, m.Price, m.Description, c.CategoryId, c.Name AS "CategoryName", m.ImagePath, mt.MealTimeId, mt.Name AS "MTName", m.StockQuantity, m.MinQuantity, m.MenuOption FROM menus as m, categories as c, mealtimes as mt WHERE c.CategoryId=m.CategoryId AND mt.MealTimeId=m.MealTimeId AND M.MenuId = ?'; 
        $query = $this->db->query($sql_stmt, array($id));
        return $query->row_array();
	}
	
	public function get_menus_by_category($cat_id = FALSE)
	{		
		$this->db->select('m.MenuId, m.Name, m.Price, m.Description, c.CategoryId, c.Name AS "CategoryName", m.ImagePath, mt.MealTimeId, mt.Name AS "MTName", m.StockQuantity, m.MinQuantity, m.MenuOption')
			  ->from('menus as m, categories as c, mealtimes as mt')
			  ->where('c.CategoryId=m.CategoryId')
			  ->where('mt.MealTimeId=m.MealTimeId')
			  ->where('c.CategoryId =' . $cat_id);		
			  
        $query = $this->db->get();
        return $query->result_array();
	}
	
	public function edit_menu($file_name = "empty") 
	{
		$id = $this->input->post('id');
		
		$arr = $this->get_menus($id);
		
		$this->name = $this->input->post('name');
		$this->description = $this->input->post('desc');
		$this->price = $this->input->post('price');
		$this->categoryid = intval($this->input->post('category'));
		$this->imagepath = $this->input->post('image');
		$this->imagepath = $arr["ImagePath"];
		$this->mealtimeid = intval($this->input->post('mtime'));
		$this->stockquantity = $this->input->post('sqnt');
		$this->minquantity = $this->input->post('mqnt');
		$this->menuoption = $this->input->post('option');
		$this->special = 'No';
		$this->status = 'Enable';
		
		$this->db->reset_query();
		
		$this->db->where('MenuId', $id);
		$sql_stmt2 = $this->db->update('menus', $this);
		if($sql_stmt2 === true) {
			return true; 
		} else {
			return false;
		}	
	}
	
	public function delete_menu($id = null) {
		if($id) {
			$sql_stmt = "DELETE FROM menus WHERE MenuId = ?";
			$query = $this->db->query($sql_stmt, array($id));

			// ternary operator
			return ($query === true) ? true : false;			
		} // /if
	}
	
	public function validate_add_cart_item()
	{
		$id = $this->input->post('menuId');
		$qty = $this->input->post('quantity');
		
		$this->db->where('MenuId', $id);
		$query = $this->db->get('menus', 1);
		if($query->num_rows() >0) 
		{
			foreach ($query->result() as $oneRec)
			{
				$data = array(
					'id' => $id,
					'qty' => $qty,
					'price' => $oneRec->Price,
					'name' => $oneRec->Name					
				);
				$this->cart->insert($data);
			}
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	function validate_update_cart()
	{		 
		// Get the total number of items in cart
		$total = $this->cart->total_items();
		 
		// Retrieve the posted information
		$item = $this->input->post('rowid');
		$qty = $this->input->post('qty');
		// Cycle true all items and update them
		for($i=0; $i<count($item); $i++)
		{
			// Create an array with the products rowid's and quantities. 
			$data = array(
			   'rowid' => $item[$i],
			   'qty'   => $qty[$i]
			);
			 
			// Update the cart with the new information
			$this->cart->update($data);
		}
	 
	}
	
	function update_menu_stock()
	{
		foreach($this->cart->contents() as $items)
		{
			$arr = $this->get_menus($items['id']);
			$sQnt = $arr['StockQuantity'] - $items['qty'];
			$data=array('StockQuantity' => $sQnt);
			
			$this->db->reset_query();
			$this->db->where('MenuId', $items['id']);
			$sql_stmt = $this->db->update('menus', $data);
		}	 
	}
	
	function check_menu_stock()
	{
		$str = "";
		foreach($this->cart->contents() as $items)
		{
			$arr = $this->get_menus($items['id']);
			
			if($arr['StockQuantity'] < $items['qty'])
			{
				$str = $str . $arr['Name'] . " : " . $arr['StockQuantity'] . ", " ; 
			}			
		}	
		return $str;
	}
}
