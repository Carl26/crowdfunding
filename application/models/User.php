<?php

Class User extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Insert registration data in database
    public function registration_insert($data) {
        $query = $this->db->query("SELECT * FROM users WHERE username = ?", array($data['username']))->result();

        if (!$query) {
            // Query to insert data in database
            $insert_values = array($data['email'], $data['username'], false, $data['password']);
            $this->db->query("INSERT INTO users VALUES (?, ?, ?, ?)", $insert_values);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        } else {
            return false;
        }
    }

    // Read data using username and password
    public function login($data) {
        $insert_values = array($data['username'], $data['password']);
        $query = $this->db->query("SELECT * FROM users WHERE username = ? AND password = ?", $insert_values)->result();

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    // Read data from database to show data in admin page
    public function read_user_information($username) {

        $query = $this->db->query("SELECT * FROM users WHERE username = ?", array($username))->result();

        if ($query) {
            return $query;
        } else {
            return false;
        }
    }
}

?>