<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('SMIT_Model.php');

class Model_News extends SMIT_Model{
    /**
     * Initialize table
     */
    var $news           = "smit_news";
    
    /**
     * Initialize primary field
     */
    var $primary        = "id";
    
    /**
	* Constructor - Sets up the object properties.
	*/
    public function __construct()
    {
        parent::__construct();
    }

    // ---------------------------------------------------------------------------------
    // CRUD (Manipulation) data news
    // ---------------------------------------------------------------------------------
    
    /**
     * Get news
     * 
     * @author  Iqbal
     * @param   Int     $id     (Required)  ID of news
     * @return  Mixed   False on invalid date parameter, otherwise data of news(s).
     */
    function get_news($id=''){
        if ( !empty($id) ) { 
            $id = absint($id); 
            $this->db->where($this->primary, $id);
        };
        
        $this->db->order_by("datecreated", "DESC"); 
        $query      = $this->db->get($this->news);        
        return ( !empty($id) ? $query->row() : $query->result() );
    }
    
    /**
     * Get news
     * 
     * @author  Iqbal
     * @param   Int     $uniquecode     (Required)  ID of news
     * @return  Mixed   False on invalid date parameter, otherwise data of news(s).
     */
    function get_news_by_uniquecode($uniquecode=''){
        if ( !empty($uniquecode) ) { 
            $this->db->where('uniquecode', $uniquecode);
        };
        
        $this->db->order_by("datecreated", "DESC"); 
        $query      = $this->db->get($this->news);        
        return ( !empty($uniquecode) ? $query->row() : $query->result() );
    }
    
    /**
     * Save data of news
     * 
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of news
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_news($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->news, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }
    
    /**
     * Retrieve all news data
     * 
     * @author  Iqbal
     * @param   Int     $limit              Limit of user               default 0
     * @param   Int     $offset             Offset ot user              default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of user list
     */
    function get_all_news($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "id", $conditions);
            $conditions = str_replace("%no_news%",              "no_news", $conditions);
            $conditions = str_replace("%title%",                "title", $conditions);
            $conditions = str_replace("%name%",                 "name", $conditions);
            $conditions = str_replace("%description%",          "description", $conditions);
            $conditions = str_replace("%url%",                  "url", $conditions);
            $conditions = str_replace("%status%",               "status", $conditions);
            $conditions = str_replace("%extension%",            "extension", $conditions);
            $conditions = str_replace("%datecreated%",          "datecreated", $conditions);
            $conditions = str_replace("%datemodified%",          "datemodified", $conditions);
        }
        
        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "id", $order_by);
            $order_by   = str_replace("%no_news%",              "no_news",  $order_by);
            $order_by   = str_replace("%title%",                "title",  $order_by);
            $order_by   = str_replace("%name%",                 "name",  $order_by);
            $order_by   = str_replace("%description%",          "description",  $order_by);
            $order_by   = str_replace("%url%",                  "url",  $order_by);
            $order_by   = str_replace("%status%",               "status",  $order_by);
            $order_by   = str_replace("%extension%",            "extension",  $order_by);
            $order_by   = str_replace("%datecreated%",          "datecreated",  $order_by);
            $conditions = str_replace("%datemodified%",          "datemodified", $conditions);
        }
        
        $sql = 'SELECT * FROM ' . $this->news. '';
        
        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'datemodified DESC');
        
        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        
        return $query->result();
    }
    
    /**
     * Count data of news
     * 
     * @author  Iqbal
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function count_data_news(){
        $sql = 'SELECT COUNT(id) AS total FROM ' . $this->news. '';
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return 0;
        
        return $query->row()->total;
    }
    
    /**
     * Delete News List 
     *
     * @param   Int     $id     (Required)  PIN Posting ID
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function delete_news($uniquecode){
        if( empty($uniquecode) )
            return false;

        $this->db->where('uniquecode', $uniquecode);
        if( $this->db->delete($this->news) )
            return true;

        return false;
    }
    
    /** Update data of News List
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  communication ID
     * @param   Array   $data   (Required)  Array data of slider
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_news($uniquecode, $data){
        if( empty($uniquecode) || empty($data) ) return false;
        $this->db->where('uniquecode', $uniquecode);

        if( $this->db->update($this->news, $data) )
            return true;

        return false;
    }
    
    // ---------------------------------------------------------------------------------
}
/* End of file Model_Guide.php */
/* Location: ./application/models/Model_Guide.php */
