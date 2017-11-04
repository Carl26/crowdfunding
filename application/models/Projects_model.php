<?php 
class Projects_model extends CI_Model {
	public $id;
	public $title;
	public $description;
	public $start_date;
	public $duration;
	public $category;
	public $aim_amount;
	public $current_raised;
	public $fund_status;
	public $creator_email;

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function get_all_entries() {
		$query = $this->db->query("SELECT * FROM projects");
		return $query->result_array();
	}

	public function insert_entry() {
		$this->$title = $_POST['title'];
		$this->$description = $_POST['description'];
		$this->$start_date = $_POST['start_date'];
		$this->$duration = $_POST['duration'];
		$this->$category = $_POST['category'];
		$this->$aim_amount = $_POST['aim_amount'];
		$this->$current_raised = $_POST['current_raised'];
		$this->$fund_status = $_POST['fund_status'];
		$this->$creator_email = $_POST['creator_email'];
		// since its too long to add every single item, we just used query builder for simplicity
		$this->db->insert('projects', $this);
	}

	public function update_entry() {
		$this->$id = $_POST['id'];
		$this->$title = $_POST['title'];
		$this->$description = $_POST['description'];
		$this->$start_date = $_POST['start_date'];
		$this->$duration = $_POST['duration'];
		$this->$category = $_POST['category'];
		$this->$aim_amount = $_POST['aim_amount'];
		$this->$current_raised = $_POST['current_raised'];
		$this->$fund_status = $_POST['fund_status'];
		$this->$creator_email = $_POST['creator_email'];
		// using query builder, same reason as above
		$this->db->update('projects', $this);
	}

	public function delete_entry() {
		$query = $this->db->query("DELETE FROM projects WHERE id = '".$_POST['id']."'");
		return $query->result();
	}
}
?>