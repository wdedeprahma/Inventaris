<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notification_model extends CI_Model
{

    public function save_notification($title, $message)
    {
        $data = array(
            'title' => $title,
            'message' => $message,
            'created_at' => date('Y-m-d H:i:s') // Tanggal dan waktu saat notifikasi dibuat
        );
        $this->db->insert('notifications', $data);
        return ($this->db->affected_rows() > 0);
    }

    public function get_notifications()
    {
        $this->db->order_by('created_at', 'desc');
        $query = $this->db->get('notifications');
        return $query->result_array();
    }
}
