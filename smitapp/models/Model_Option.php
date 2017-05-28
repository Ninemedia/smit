<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('SMIT_Model.php');

class Model_Option extends SMIT_Model{
    /**
     * Initialize table and primary field variable
     */
    var $table      = "smit_options";
    var $workunit   = "smit_workunit";
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
        }
        
        if( !empty($order_by) ){
            $order_by   = str_replace("%workunit_name%",        "workunit_name", $order_by);
        }
        
        $sql = 'SELECT * FROM ' . $this->workunit. '';
        
        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'workunit_id DESC');
        
        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        
        return $query->result();
    }
}
/* End of file SModel_Option.php */
/* Location: ./application/models/Model_Option.php */
