<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelPinjam extends CI_Model
{
    public function simpanPinjam($data)
    {
        $this->db->insert('pinjam', $data);
    }

    public function selectData($table, $where)
    {
        return $this->db->get($table, $where);
    }

    public function updateData($data, $where)
    {
        $this->db->update('pinjam', $data, $where);
    }

    public function deleteData($table, $where)
    {
        $this->db->delete($table, $where);
    }

    public function joinData()
    {
        $this->db->select('*');
        $this->db->from('pinjam');
        $this->db->join('detail_pinjam', 'detail_pinjam.no_pinjam = pinjam.no_pinjam', 'right');
        return $this->db->get()->result_array();
    }

    public function simpanDetail($idbooking, $nopinjam)
    {
        $sql = "INSERT INTO detail_pinjam (no_pinjam, id_buku) 
                SELECT pinjam.no_pinjam, booking_detail.id_buku 
                FROM pinjam, booking_detail 
                WHERE booking_detail.id_booking = $idbooking 
                AND pinjam.no_pinjam = '$nopinjam'";
        $this->db->query($sql);
    }
}
