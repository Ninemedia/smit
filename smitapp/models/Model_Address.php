<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('SMIT_Model.php');

class Model_Address extends SMIT_Model{
    /**
     * Initialize table
     */
    var $province           = "smit_province";
    var $regional           = "smit_regional";
    
    /**
     * Initialize primary field
     */
    var $primary            = "id";
    
    /**
	* Constructor - Sets up the object properties.
	*/
    public function __construct()
    {
        parent::__construct();
    }

    // ---------------------------------------------------------------------------------
    // CRUD (Manipulation) data province and regional
    // ---------------------------------------------------------------------------------
    
    /**
     * Get Province
     * 
     * @author  Iqbal
     * @param   Int     $id     (Required)  ID of Province
     * @return  Mixed   False on invalid date parameter, otherwise data of province(s).
     */
    function get_provinces($id=''){
        if ( !empty($id) ) { 
            $id = absint($id); 
            $this->db->where('province_id', $id);
        };
        
        $this->db->order_by("province_name", "ASC"); 
        $query      = $this->db->get($this->province);        
        return ( !empty($id) ? $query->row() : $query->result() );
    }
    
    /**
     * Get Cities
     * 
     * @author  Iqbal
     * @param   Int     $id     (Required)  ID of Cities
     * @return  Mixed   False on invalid date parameter, otherwise data of city(ies).
     */
    function get_cities($id=''){
        if ( !empty($id) ) { 
            $id = absint($id); 
            $this->db->where('regional_id', $id);
        };
        
        $this->db->order_by("regional_name", "ASC"); 
        $query      = $this->db->get($this->regional);        
        return ( !empty($id) ? $query->row() : $query->result() );
    }
    
    /**
     * Get Cities
     * 
     * @author  Iqbal
     * @param   Int     $id     (Required)  ID of Cities
     * @return  Mixed   False on invalid date parameter, otherwise data of city(ies).
     */
    function get_cities_by_province($province_id){
        if ( !$province_id || empty($province_id) ) return false; 
        
        $province_id = absint($province_id);
        if ( !$province_id ) return false;

        $this->db->where('province_id', $province_id);
        $this->db->order_by("regional_name", "ASC"); 
        $query      = $this->db->get($this->regional); 
               
        return $query->result();
    }
    
    /**
     * Save data of province
     * 
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of province
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_province($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->province, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }
    
    /**
     * Save data of regional
     * 
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of regional
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_regional($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->regional, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }
    
    // ---------------------------------------------------------------------------------
}
/* End of file Model_Address.php */
/* Location: ./application/models/Model_Address.php */
