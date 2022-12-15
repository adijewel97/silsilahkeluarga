<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_silsilah extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

  	public function get_silsilah_tree_awal(){
          $query = $this->db->query(
                    "    
                      select * 
                      from
                      (
                          select 
                              IFNULL(( select MID(a.tgl_lahir,1,4) 
                                from trs_silsilah_detail a where id_child = x.id_parent),0) thl_parent,
                              MID(x.tgl_lahir,1,4) thl_current,
                              x.*,    
                              if (ROUND(x.id_relasi) > 3, 
                                 #ada relasi
                                 CONCAT(id_parent,'X', (                                        
                                     select id_child from trs_silsilah_detail                               
                                     where id_parent = x.id_parent                                          
                                     and id_relasi in ('3')                                                 
                                  )),
                                 #tidak ada relasi
                              if (x.id_relasi = 2,x.id_parent, 
                                    if((x.id_parent <> '') and (x.id_relasi = 1 or x.id_relasi = 2 ),
                                      CONCAT(id_parent,'X', (                                         
                                                 select id_child from trs_silsilah_detail                               
                                                 where id_parent = x.id_parent                                          
                                                 and id_relasi in ('3')                                                 
                                      )),x.id_parent)) 
                                  )   id_parent_abs                                    
                          from                                                                                     
                          ( 
                            SELECT 
                              a.id_child,                                                                     
                              a.id_child as id_child_x,                                                       
                              a.nama_view,                                                                    
                              a.tgl_lahir,                                                                    
                              a.foto_path,                                                                    
                              a.id_parent,                                                                    
                              a.id_relasi,                                                                    
                              a.hidup,                                                                        
                              'false' AS pseudo,
                              kota_tinggal                                                             
                            FROM trs_silsilah_detail a                                                           
                            UNION                                                                             
                            SELECT
                              CONCAT(b.id_child) AS id_child,                                                 
                              b.id_child as id_child_x,                                                       
                              b.nama_view,                                                                    
                              b.tgl_lahir,                                                                    
                              b.foto_path,                                                                    
                              b.id_parent,                                                                    
                              b.id_relasi,                                                                    
                              b.hidup,                                                                        
                              'false' AS pseudo,
                              kota_tinggal                                                                 
                            FROM trs_silsilah_detail b                                                           
                            WHERE b.id_relasi IN ('3')                                                            
                            UNION                                                                             
                            SELECT
                              CONCAT(b.id_parent, 'X', b.id_child) AS id_child,                               
                              b.id_child asid_child_x,                                                        
                              CONCAT((select nama_view from trs_silsilah_detail                               
                                      where id_child = b.id_parent limit 1), ' x ', b.nama_view) AS nama_view,  
                              b.tgl_lahir,                                                                    
                              b.foto_path,                                                                    
                              b.id_parent,                                                                    
                              '3' AS id_relasi,                                                               
                              b.hidup,                                                                        
                              'true' AS pseudo,
                              kota_tinggal                                                                   
                            FROM trs_silsilah_detail b                                                           
                            WHERE b.id_relasi IN ('3')                                                            
                            and 1 = (SELECT max(1)FROM  trs_silsilah_detail d                                 
                            WHERE d.id_parent = b.id_parent #AND  d.id_relasi > 3                                                      
                          ) x   
                      ) y                                                                                   
                      order by y.thl_current,y.id_relasi
                     "
                    );

                   /* " select x.*, x.id_parent id_parent_abs ".
                    " FROM trs_silsilah_detail x            ". 
                    " order by x.tgl_lahir,x.id_parent      "*/

          $data['hasil'] = $query->result_array();
          return $data['hasil'];
    }

    public function get_silsilah_tree(){
          $query = $this->db->query(
                    "    
                      select * from
                      (
                      select 
                          if  ( thl_parent >= thl_current, 
                                thl_parent+1,
                                thl_current
                              ) thl_sortied,  
                          y.*
                      from 
                      (
                        select 
                           IFNULL(( select MID(a.tgl_lahir,1,4) 
                                  from trs_silsilah_detail a where id_child = x.id_parent),0) thl_parent,
                           MID(x.tgl_lahir,1,4) thl_current,
                           x.*,    
                           if (ROUND(x.id_relasi) > 3, 
                           #ada relasi
                           CONCAT(id_parent,'X', (                                        
                                           select id_child from trs_silsilah_detail                               
                                           where id_parent = x.id_parent                                          
                                           and id_relasi in ('3')                                                 
                                         )),
                           #tidak ada relasi
                           if (x.id_relasi = 2,x.id_parent,                                    
                                               if((x.id_parent <> '')                                           
                                               and (x.id_relasi = 1 or x.id_relasi = 2 )                        
                                               ,CONCAT(id_parent,'X', (                                         
                                           select id_child from trs_silsilah_detail                               
                                           where id_parent = x.id_parent                                          
                                           and id_relasi in ('3')                                                 
                                         )),x.id_parent)) 
                           )   id_parent_abs                                    
                        from                                                                                     
                        ( 
                          SELECT 
                            a.id_child,                                                                     
                            a.id_child as id_child_x,                                                       
                            a.nama_view,                                                                    
                            a.tgl_lahir,                                                                    
                            a.foto_path,                                                                    
                            a.id_parent,                                                                    
                            a.id_relasi,                                                                    
                            a.hidup,                                                                        
                            'false' AS pseudo,
                            kota_tinggal                                                             
                          FROM  trs_silsilah_detail a                                                           
                          UNION                                                                             
                          SELECT 
                            CONCAT(b.id_child) AS id_child,                                                 
                            b.id_child as id_child_x,                                                       
                            b.nama_view,                                                                    
                            b.tgl_lahir,                                                                    
                            b.foto_path,                                                                    
                            b.id_parent,                                                                    
                            b.id_relasi,                                                                    
                            b.hidup,                                                                        
                            'false' AS pseudo,
                            kota_tinggal                                                                 
                          FROM trs_silsilah_detail b                                                           
                          WHERE b.id_relasi IN ('3')                                                            
                          UNION                                                                             
                          SELECT 
                            CONCAT(b.id_parent, 'X', b.id_child) AS id_child,                               
                            b.id_child asid_child_x,                                                        
                            CONCAT((select nama_view from trs_silsilah_detail                               
                                    where id_child = b.id_parent limit 1), ' x ', b.nama_view) AS nama_view,  
                            b.tgl_lahir,                                                                    
                            b.foto_path,                                                                    
                            b.id_parent,                                                                    
                            '3' AS id_relasi,                                                               
                            b.hidup,                                                                        
                            'true' AS pseudo,
                            kota_tinggal                                                                   
                          FROM trs_silsilah_detail b                                                           
                          WHERE b.id_relasi IN ('3')                                                            
                          and 1 = ( 
                                    SELECT max(1) 
                                    FROM  trs_silsilah_detail d                                 
                                    WHERE d.id_parent = b.id_parent 
                                    #AND  d.id_relasi > 3
                                  )                                                                                
                        ) x                                                                                      
                      ) y
                      ) z
                      order by z.thl_sortied, z.id_relasi
                     "
                    );

                   /* " select x.*, x.id_parent id_parent_abs ".
                    " FROM trs_silsilah_detail x            ". 
                    " order by x.tgl_lahir,x.id_parent      "*/

          $data['hasil'] = $query->result_array();
          return $data['hasil'];
    }

    public function get_silsilah_label_id($id_vs_relasi){
        $query = $this->db->query(
                    " select * from (                                 
                          select  id_child, id_parent , nama_view , id_relasi , tgl_lahir , kelamin, foto_path,
                          hidup, tempat_lahir, tempat_wafat,tgl_wafat,keterangan, nama_depan, nama_belakang, kota_tinggal   
                          from trs_silsilah_detail
                      ) x  where CONCAT(x.id_child,'|',x.id_relasi) = '".$id_vs_relasi."' ".
                     "order by x.tgl_lahir"
                  );
        return  $query ;

    }

    public function get_silsilah_table_all(){
        $query = $this->db->query(
                    " select * from (                                 
                          select  id_child, id_parent , nama_view , id_relasi , tempat_lahir, tgl_lahir , kelamin, foto_path,
                          hidup,  tempat_wafat,tgl_wafat,keterangan, nama_depan, nama_belakang     
                          from trs_silsilah_detail   
                      ) x order by x.tgl_lahir"
                  );
        return  $query ;

    }

    public function get_silsilah_detail_id($vnama){
        $this->db->where('nama_view',$vnama);
        $query = $this->db->from('trs_silsilah');
        $query = $this->db->get();      
        return $query;
    }

    public function get_silsilah_detail_all(){
        $query = $this->db->from('trs_silsilah_detail');
        $query = $this->db->get();      
        return $query;
    }

    public function insert_silsilah($data){
        $query = $this->db->insert('trs_silsilah_detail',$data);
        return true;
    }

    public function update_silsilah($id, $id_relasi, $data){
        $this->db->where('id_child',$id );
        $this->db->where('id_relasi',$id_relasi );
        $query = $this->db->update('trs_silsilah_detail',$data);
        return true;
    }

    public function delete_silsilah($id, $id_relasi){
            $this->db->where('id_child',$id );
            $this->db->where('id_relasi',$id_relasi );
            $this->db->delete('trs_silsilah_detail');
        return true;
    }

}