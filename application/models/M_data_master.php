<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_data_master extends CI_Model {
// --------------------------------------------------------------------------------------------------
// 1) Master Perusahaan
// --------------------------------------------------------------------------------------------------

	function data_master_perusahaan() {
		$query = $this->db->get('mst_perusahaan');
	    return $query;
	}
	
    function simpan_data_master_perusahaan($data){
		$this->db->empty_table('mst_perusahaan');
        $this->db->insert('mst_perusahaan', $data);
	}

// --------------------------------------------------------------------------------------------------
// 2) Master Cabang
// --------------------------------------------------------------------------------------------------

	function data_master_cabang_all() {
		$q_mst_cabang =
           " select * from mst_cabang     ".
           " order by ROUND(kdunit) asc   ";
        $query = $this->db->query($q_mst_cabang);
	    return $query;
	}

    function cek_data_master_cabang($kdunit) {
        $this->db->where('kdunit', $kdunit);
        $query = $this->db->get('mst_cabang');
        return $query;
    }

    function data_master_cabang_idktrpst($kdktrpusat){
        $this->db->where('kdktrpusat',$kdktrpusat);
        $this->db->order_by('kdunit', 'asc');
        $query = $this->db->get('mst_cabang');
        return $query; 
    }

    function show_data_master_cabang($kode){
        $this->db->where('kdunit', $kode);
        $query = $this->db->get('mst_cabang');
        return $query;
    }

	function insert_data_master_cabang($data){
        $this->db->insert('mst_cabang', $data);
        return true;
	}

    function update_data_master_cabang($kdunit,$data){
        $this->db->where('kdunit',$kdunit);
        $this->db->update('mst_cabang', $data);
        return true;
    }

    function hapus_data_master_cabang($kode){
        $this->db->where('kdunit', $kode);
        $this->db->delete('mst_cabang');
        return true;
    }

// --------------------------------------------------------------------------------------------------
// 3) Master data Pejabat
// --------------------------------------------------------------------------------------------------    
    function data_master_jabatan_all(){
        $q_mst_jabatan =
           " select z.*                                           ".
           "  from (                                              ".
           "  select 'P' ket,a.* from mst_pejabat a               ".
           "  union                                               ".
           "  select 'S' ket,b.* from mst_pejabat_petugas b       ".
           "  ) z  order by round(z.kdunit), z.ket, z.nip         ";

        $query = $this->db->query($q_mst_jabatan);
        return $query; 
    }

    function show_data_master_jabatan_id($nip){
        $q_mst_jabatan =
           " select z.*                                           ".
           "  from (                                              ".
           "  select 'P' ket,a.* from mst_pejabat a               ".
           "  union                                               ".
           "  select 'S' ket,b.* from mst_pejabat_petugas b       ".
           "  ) z                                                 ".
           " where concat(z.kdunit,' ',z.nip) ='".$nip."'         ".
           " order by round(z.kdunit)                             ";

        $query = $this->db->query($q_mst_jabatan);
        return $query; 
    }

    function combo_useridkode($kdunit){
        $q_users =
           " select * from zsys_users            ".
           " where kdunit = '".$kdunit."'        ".
           " and expire = 0                      ".
           " and useridkode > 0                  ";
           //;

        $query = $this->db->query($q_users);
        return $query; 
    }

    //--------------------------------------------------
    function insert_master_pejabat($data){
        $this->db->insert('mst_pejabat', $data);
        return true;
    }

    function update_master_pejabat($vkdunit,$vnip,$data){
        $this->db->where('kdunit',$vkdunit);
        $this->db->where('nip',$vnip);
        $this->db->update('mst_pejabat', $data);
        return true;
    }

    function hapus_master_pejabat($vkdunit,$vnip){
        $this->db->where('kdunit',$vkdunit);
        $this->db->where('nip',$vnip);
        $this->db->delete('mst_pejabat');
        return true;
    }
    //--------------------------------------------------
    function insert_mst_pejabat_petugas($data){
        $this->db->insert('mst_pejabat_petugas', $data);
        return true;
    }

    function update_mst_pejabat_petugas($vkdunit,$vnip,$data){
        $this->db->where('kdunit',$vkdunit);
        $this->db->where('nip',$vnip);
        $this->db->update('mst_pejabat_petugas', $data);
        return true;
    }

    function hapus_mst_pejabat_petugas($vkdunit,$vnip){
        $this->db->where('kdunit',$vkdunit);
        $this->db->where('nip',$vnip);
        $this->db->delete('mst_pejabat_petugas');
        return true;
    }

// --------------------------------------------------------------------------------------------------
// 4) Master data Laba Rugi
// -------------------------------------------------------------------------------------------------- 
    function show_data_master_labarugi_id($myode) {
        $q_mst_lr_id =
           " select * from mst_kredit_biaya_labarugi                  ".
           " where CONCAT(kdktrpusat,' ',kodeproduk,' ',kodebiaya) = '".$myode."' limit 1 ";
        $query = $this->db->query($q_mst_lr_id);
        return $query;
    }


    function insert_mst_labarugi($data){
        $this->db->insert('mst_kredit_biaya_labarugi', $data);
        return true;
    }

    function update_mst_labarugi($vkdktrpusat,$vkodeproduk,$vkodebiaya,$data){
        $this->db->where('kdktrpusat',$vkdktrpusat);
        $this->db->where('kodeproduk',$vkodeproduk);
        $this->db->where('kodebiaya',$vkodebiaya);
        $this->db->update('mst_kredit_biaya_labarugi', $data);
        return true;
    }

    function hapus_mst_labarugi($vkdktrpusat,$vkodeproduk,$vkodebiaya){
        $this->db->where('kdktrpusat',$vkdktrpusat);
        $this->db->where('kodeproduk',$vkodeproduk);
        $this->db->where('kodebiaya',$vkodebiaya);
        $this->db->delete('mst_kredit_biaya_labarugi');
        return true;
    }

// --------------------------------------------------------------------------------------------------
// 5) Master data Neraca
// -------------------------------------------------------------------------------------------------- 
    function show_data_master_neraca_id($myode) {
        $q_mst_lr_id =
           " select * from mst_kredit_biaya_neraca                  ".
           " where CONCAT(kdktrpusat,' ',kodeproduk,' ',kodebiaya) = '".$myode."' limit 1 ";
        $query = $this->db->query($q_mst_lr_id);
        return $query;
    }


    function insert_mst_neraca($data){
        $this->db->insert('mst_kredit_biaya_neraca', $data);
        return true;
    }

    function update_mst_neraca($vkdktrpusat,$vkodeproduk,$vkodebiaya,$data){
        $this->db->where('kdktrpusat',$vkdktrpusat);
        $this->db->where('kodeproduk',$vkodeproduk);
        $this->db->where('kodebiaya',$vkodebiaya);
        $this->db->update('mst_kredit_biaya_neraca', $data);
        return true;
    }

    function hapus_mst_neraca($vkdktrpusat,$vkodeproduk,$vkodebiaya){
        $this->db->where('kdktrpusat',$vkdktrpusat);
        $this->db->where('kodeproduk',$vkodeproduk);
        $this->db->where('kodebiaya',$vkodebiaya);
        $this->db->delete('mst_kredit_biaya_neraca');
        return true;
    }


// --------------------------------------------------------------------------------------------------
// 6) Master data secore
// --------------------------------------------------------------------------------------------------


    function show_data_master_scoring_id($vkdproduk,$vidscorcard){
        $query = $this->db->query(
            ' select * from mst_kredit_scorcard        '.
            ' where kodeproduk="'.$vkdproduk.'"        '.
            ' and idscorcard = "'.$vidscorcard.'"      ');
        return $query;  
    }

    function insert_mst_scoring($data){
        $this->db->insert('mst_kredit_scorcard', $data);
        return true;
    }

    function update_mst_scoring($vkdktrpusat,$vkodeproduk,$vidscorcard,$data){
        $this->db->where('kdktrpusat',$vkdktrpusat);
        $this->db->where('kodeproduk',$vkodeproduk);
        $this->db->where('idscorcard',$vidscorcard);
        $this->db->update('mst_kredit_scorcard', $data);
        return true;
    }

    function hapus_mst_scoring($vkdktrpusat,$vkodeproduk,$vidscorcard){
        $this->db->where('kdktrpusat',$vkdktrpusat);
        $this->db->where('kodeproduk',$vkodeproduk);
        $this->db->where('idscorcard',$vidscorcard);
        $this->db->delete('mst_kredit_scorcard', $data);
        return true;
    }

// --------------------------------------------------------------------------------------------------
// 7) Master data propinsi
// --------------------------------------------------------------------------------------------------

    function data_master_kabupaten($v_kdprovinsi){
        $query = $this->db->query(
            ' select * from mst_zn_kabupaten        '.
            ' where kdprovinsi="'.$v_kdprovinsi.'"  '.
            ' order by round(kdunit) asc            ');
        return $query; 
    }

    function combo_data_kdprovinsi_all(){
        $this->db->order_by('kdprovinsi', 'asc');
        $query = $this->db->get('mst_zn_provnsi');
        return $query; 
    }

    function combo_data_kdprovinsi_id($kdktrpusat){
        $this->db->where('kdktrpusat',$kdktrpusat);
        $this->db->order_by('kdprovinsi', 'asc');
        $query = $this->db->get('mst_zn_provnsi');
        return $query; 
    }

    function combo_data_kdkabupaten_id($kdprovinsi){
        $this->db->where('kdprovinsi',$kdprovinsi);
        $this->db->order_by('kdkabupaten', 'asc');
        $query = $this->db->get('mst_zn_kabupaten');
        return $query; 
    } 

    function combo_data_kdkecamatan_id($kdprovinsi,$kdkabupaten ){
        $this->db->where('kdprovinsi',$kdprovinsi);
        $this->db->where('kdkabupaten',$kdkabupaten);
        $this->db->order_by('kdkecamatan', 'asc');
        $query = $this->db->get('mst_zn_kecamatan');
        return $query; 
    } 

    function combo_data_kddesa_id($kdprovinsi,$kdkabupaten,$kdkecamatan ) {
        $this->db->where('kdprovinsi',$kdprovinsi);
        $this->db->where('kdkabupaten',$kdkabupaten);
        $this->db->where('kdkecamatan',$kdkecamatan);
        $this->db->order_by('kddesa', 'asc');
        $query = $this->db->get('mst_zn_desa');
        return $query; 
    }

}