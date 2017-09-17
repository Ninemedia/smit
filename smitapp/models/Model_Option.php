<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('SMIT_Model.php');

class Model_Option extends SMIT_Model{
    /**
     * Initialize table and primary field variable
     */
    var $table      = "smit_options";
    var $workunit   = "smit_workunit";
    var $category   = "smit_category";
    var $category_product   = "smit_category_product";
    
    /**
	* Constructor - Sets up the object properties.
	*/
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Add Options
     * 
     * @author  Iqbal
     * @param   Array/Object    $data   (Required)  Data of option to add
     * @return  Mixed   Boolean false on failed process, invalid data, or data is not found, otherwise Int of Option ID
     */
    function add_option($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->table, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }
    
    /**
     * Update Options
     * 
     * @author  Iqbal
     * @param   Array/Object    $data   (Required)  Data of option to update
     * @param   Int             $id     (Required)  ID of Option
     * @return  Mixed   Boolean false on failed process, invalid data, or data is not found, otherwise Int of Option ID
     */
    function update_option($data, $id){
        if( empty($id) ) return false;
        if( empty($data) ) return false;
        if( $this->db->update($this->table, $data, array('id_option' => $id)) ) return true;
        return false;
    }
    
    /**
     * Retrieve all wotkunit data
     * 
     * @author  Iqbal
     * @param   Int     $limit              Limit of user               default 0
     * @param   Int     $offset             Offset ot user              default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of user list
     */
    function get_all_workunit($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%workunit_name%",        "workunit_name", $conditions);
            $conditions = str_replace("%status%",               "status", $conditions);
        }
        
        if( !empty($order_by) ){
            $order_by   = str_replace("%workunit_name%",        "workunit_name", $order_by);
            $order_by   = str_replace("%status%",               "status",  $order_by);
        }
        
        $sql = 'SELECT * FROM ' . $this->workunit. '';
        
        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'workunit_id DESC');
        
        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        
        return $query->result();
    }
    
    /**
     * Save data of category
     * 
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of category
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_category($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->category, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }
    
    /**
     * Retrieve all category data
     * 
     * @author  Iqbal
     * @param   Int     $limit              Limit of user               default 0
     * @param   Int     $offset             Offset ot user              default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of user list
     */
    function get_all_category($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%category_id%",          "category_id", $conditions);
            $conditions = str_replace("%category_name%",        "category_name", $conditions);
        }
        
        if( !empty($order_by) ){
            $order_by   = str_replace("%category_id%",          "category_id", $order_by);
            $order_by   = str_replace("%category_name%",        "category_name", $order_by);
        }
        
        $sql = 'SELECT * FROM ' . $this->category. '';
        
        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'category_id DESC');
        
        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        
        return $query->result();
    }
    
    /**
     * Get Category
     * 
     * @author  Iqbal
     * @param   Int     $id     (Required)  ID of Category
     * @return  Mixed   False on invalid date parameter, otherwise data of category(s).
     */
    function get_category($id=''){
        if ( !empty($id) ) { 
            $id = absint($id); 
            $this->db->where('id', $id);
        };
        
        $this->db->order_by("category_name", "ASC"); 
        $query = $this->db->get($this->category);
		if ( ! $query || ! $query->num_rows() )
			return false;
		
        return ( !empty($id) ? $query->row() : $query->result() );
    }
    
    /**
     * Update Category by ID
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  Incibation ID
     * @param   Array   $data   (Required)  Array data of product
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_category($id, $data){
        if( empty($id) || empty($data) ) return false;
        $this->db->where('category_id', $id);

        if( $this->db->update($this->category, $data) )
            return true;

        return false;
    }
    
    /**
     * Delete Category 
     *
     * @param   Int     $id     (Required)  PIN Posting ID
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function delete_category($id){
        if( empty($id) )
            return false;

        $this->db->where('category_id', $id);
        if( $this->db->delete($this->category) )
            return true;

        return false;
    }
    
    /**
     * Get category data by category ID
     * 
     * @author  Iqbal
     * @param   Integer $user_id  (Required)  User ID
     * @return  Mixed   False on failed process, otherwise object of user.
     */
    function get_categorydata($category_id){
        if ( !is_numeric($category_id) ) return false;

        $category_id = absint($category_id);
        if ( !$category_id ) return false;
        
        $query = $this->db->get_where($this->category, array('category_id' => $category_id));
        if ( !$query->num_rows() )
            return false;

        foreach ( $query->result() as $row ) {
            $category = $row;
        }
        
        return $category;
    }
    
    // -----------------------------------------------------------------------------------------------------------
    
    /**
     * Save data of workunit
     * 
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of workunit
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_workunit($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->workunit, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }
    
    /**
     * Get workunit data by workunit ID
     * 
     * @author  Iqbal
     * @param   Integer $user_id  (Required)  User ID
     * @return  Mixed   False on failed process, otherwise object of user.
     */
    function get_workunitdata($workunit_id){
        if ( !is_numeric($workunit_id) ) return false;

        $workunit_id = absint($workunit_id);
        if ( !$workunit_id ) return false;
        
        $query = $this->db->get_where($this->workunit, array('workunit_id' => $workunit_id));
        if ( !$query->num_rows() )
            return false;

        foreach ( $query->result() as $row ) {
            $workunit = $row;
        }
        
        return $workunit;
    }
    
    /**
     * Delete Workunit 
     *
     * @param   Int     $id     (Required)  PIN Posting ID
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function delete_workunit($id){
        if( empty($id) )
            return false;

        $this->db->where('workunit_id', $id);
        if( $this->db->delete($this->workunit) )
            return true;

        return false;
    }
    
    /**
     * Update Workunit by ID
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  Incibation ID
     * @param   Array   $data   (Required)  Array data of product
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_workunit($id, $data){
        if( empty($id) || empty($data) ) return false;
        $this->db->where('workunit_id', $id);

        if( $this->db->update($this->workunit, $data) )
            return true;

        return false;
    }
    
    // Category Product
    // --------------------------------------------------------------------------------------------------
    /**
     * Retrieve all category data
     * 
     * @author  Iqbal
     * @param   Int     $limit              Limit of user               default 0
     * @param   Int     $offset             Offset ot user              default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of user list
     */
    function get_all_category_product($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%category_id%",          "category_id", $conditions);
            $conditions = str_replace("%category_name%",        "category_name", $conditions);
        }
        
        if( !empty($order_by) ){
            $order_by   = str_replace("%category_id%",          "category_id", $order_by);
            $order_by   = str_replace("%category_name%",        "category_name", $order_by);
        }
        
        $sql = 'SELECT * FROM ' . $this->category_product. '';
        
        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'category_id DESC');
        
        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        
        return $query->result();
    }
    
    /**
     * Save data of category product
     * 
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of category
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_category_product($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->category_product, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }
    
    /**
     * Update Category by ID
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  Incibation ID
     * @param   Array   $data   (Required)  Array data of product
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_categoryproduct($id, $data){
        if( empty($id) || empty($data) ) return false;
        $this->db->where('category_id', $id);

        if( $this->db->update($this->category_product, $data) )
            return true;

        return false;
    }
    
    /**
     * Get category data by category ID
     * 
     * @author  Iqbal
     * @param   Integer $user_id  (Required)  User ID
     * @return  Mixed   False on failed process, otherwise object of user.
     */
    function get_categoryproductdata($category_id){
        if ( !is_numeric($category_id) ) return false;

        $category_id = absint($category_id);
        if ( !$category_id ) return false;
        
        $query = $this->db->get_where($this->category_product, array('category_id' => $category_id));
        if ( !$query->num_rows() )
            return false;

        foreach ( $query->result() as $row ) {
            $category = $row;
        }
        
        return $category;
    }
    
    /**
     * Get Category
     *
     * @param   Int     $id     (Required)  ID of Category
     * @return  Mixed   False on invalid date parameter, otherwise data of Category(s).
     */
    function get_categoryproduct($id=''){
        if ( !empty($id) ) {
            $id = absint($id);
            $this->db->where('category_id', $id);
        };

        $this->db->order_by("category_id", "ASC");
        $query      = $this->db->get($this->category_product );
        return ( !empty($id) ? $query->row() : $query->result() );
    }
    
    /**
     * Delete Category 
     *
     * @param   Int     $id     (Required)  PIN Posting ID
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function delete_categoryproduct($id){
        if( empty($id) )
            return false;

        $this->db->where('category_id', $id);
        if( $this->db->delete($this->category_product) )
            return true;

        return false;
    }
    
}
/* End of file SModel_Option.php */
/* Location: ./application/models/Model_Option.php */
