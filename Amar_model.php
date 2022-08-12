<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Amar_Model extends CI_Model {

   public $Id;

   public function Save_Data($table, $data) {
      if ($this->db->insert($table, $data)) {
         $this->Id = $this->db->insert_id();
         return TRUE;
      }
      return FALSE;
   }

   public function Update_Data($table, $data, $where) {
      if ($where) {
         $this->db->where($where);
      }
      if ($this->db->update($table, $data)) {
         return TRUE;
      }
      return FALSE;
   }

   public function Delete_Data($table, $where) {
      $this->db->where($where);
      $this->db->delete($table);
      if ($this->db->affected_rows()) {
         return TRUE;
      }
      return FALSE;
   }

   public function View_Data($table, $sel, $where, $order1 = NULL, $order2 = NULL, $pos = NULL, $limit = NULL) {
      if ($where) {
         $this->db->where($where);
      }
      $this->db->select($sel);
      $this->db->from($table);
      if ($order1 != NULL) {
         $this->db->order_by($order1, $order2);
      }
      if ($limit > 0) {
         $this->db->limit($limit, $pos);
      }
      return $this->db->get()->result();
   }

   public function View_Data_Two_Table($table1, $table2, $sel, $rel, $where, $order1 = NULL, $order2 = NULL, $pos = NULL, $limit = NULL) {
      if ($where) {
         $this->db->where($where);
      }
      $this->db->select($sel);
      $this->db->from($table1);
      $this->db->join($table2, $rel);
      if ($order1 != NULL) {
         $this->db->order_by($order1, $order2);
      }
      if ($limit > 0) {
         $this->db->limit($limit, $pos);
      }
      return $this->db->get()->result();
   }

   public function home() {
      return $this->GetMultipleQueryResult("CALL home()");
   }
   public function category($id, $start, $limit) {
      return $this->GetMultipleQueryResult("CALL category($id, $start, $limit)");
   }
   
   public function subcategory($id, $start, $limit) {
      return $this->GetMultipleQueryResult("CALL subcategory($id, $start, $limit)");
   }
   
   public function cart($ids) {
      return $this->GetMultipleQueryResult("CALL cart('$ids')");
   }
   
   public function details($id) {
      return $this->GetMultipleQueryResult("CALL details($id)");
   }
   
   public function common() {
      return $this->GetMultipleQueryResult("CALL common()");
   }
   
   public function order_details($id, $cid) {
      return $this->GetMultipleQueryResult("CALL order_details($id, $cid)");
   }
   
   public function order_summary($cid) {
      return $this->GetMultipleQueryResult("CALL order_summary($cid)");
   }

   public function TotalData($table) {
      $this->db->select("id");
      $this->db->from($table);
      return $this->db->count_all_results();
   }

   public function GetMultipleQueryResult($queryString) {
      if (empty($queryString)) {
         return false;
      }
      $index = 0;
      $ResultSet = array();
      if (mysqli_multi_query($this->db->conn_id, $queryString)) {
         do {
            if (false != $result = mysqli_store_result($this->db->conn_id)) {
               $rowID = 0;
               while ($row = $result->fetch_object()) {
                  $ResultSet[$index][$rowID] = $row;
                  $rowID++;
               }
            }
            $index++;
         } while (mysqli_more_results($this->db->conn_id) && mysqli_next_result($this->db->conn_id));
      }
      return $ResultSet;
   }

   public function ResizeImg($source, $dest, $width, $height) {
      $this->load->library('image_lib');
      $config['source_image'] = $source;
      $config['new_image'] = $dest;
      $config['maintain_ratio'] = TRUE;
      $config['width'] = $width;
      $config['height'] = $height;
      $this->image_lib->initialize($config);
      $this->image_lib->resize();
      $this->image_lib->clear();
   }

   public function UploadImg($dest, $name, $field) {
      $this->load->library('upload');
      $config['upload_path'] = "./{$dest}";
      $config['allowed_types'] = 'gif|jpg|png|jpeg';
      $config['max_size'] = '10000';
      $config['max_width'] = '3000';
      $config['max_height'] = '4000';
      $config['file_name'] = $name;
      $this->upload->initialize($config); //upload image data
      $this->upload->do_upload($field);
   }

}
