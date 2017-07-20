<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('SMIT_Model.php');

class Model_Guide extends SMIT_Model{
    /**
     * Initialize table
     */
    var $guide              = "smit_guide";

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
    // CRUD (Manipulation) data guide
    // ---------------------------------------------------------------------------------

    /**
     * Get Guide
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  ID of Guide
     * @return  Mixed   False on invalid date parameter, otherwise data of guide(s).
     */
    function get_guide($id=''){
        if ( !empty($id) ) {
            if( is_array($id) ){
                $this->db->where_in($this->primary, $id);
            }else{
                $id = absint($id);
                $this->db->where($this->primary, $id);
            }
        };

        $this->db->order_by("datecreated", "DESC");
        $query      = $this->db->get($this->guide);
        return ( !empty($id) && !is_array($id) ? $query->row() : $query->result() );
    }

    /**
     * Get guide data by conditions
     *
     * @author  Iqbal
     * @param   String  $field  (Required)  Database field name or special field name defined inside this function
     * @param   String  $value  (Optional)  Value of the field being searched
     * @return  Mixed   Boolean false on failed process, invalid data, or data is not found, otherwise StdClass of guide
     */
    function get_guide_by($field, $value='')
    {
        $id = '';

        switch ($field) {
            case 'id':
                $id     = $value;
                break;
            case 'uniquecode':
                $value  = $value;
                $id     = '';
                $field  = 'uniquecode';
                break;
            default:
                return false;
        }

        if ( $id != '' && $id > 0 )
            return $this->get_guide($id);

        if( empty($field) ) return false;

        $db     = $this->db;

        $db->where($field, $value);
        $query  = $db->get($this->guide);

        if ( !$query->num_rows() )
            return false;

        foreach ( $query->result() as $row ) {
            $guide = $row;
        }

        return $guide;
    }

    /**
     * Save data of guide
     *
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of guide
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_guide($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->guide, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }

    /**
     * Retrieve all guide data
     *
     * @author  Iqbal
     * @param   Int     $limit              Limit of user               default 0
     * @param   Int     $offset             Offset ot user              default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of user list
     */
    function get_all_guides($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "id", $conditions);
            $conditions = str_replace("%uniquecode%",           "uniquecode", $conditions);
            $conditions = str_replace("%title%",                "title", $conditions);
            $conditions = str_replace("%name%",                 "name", $conditions);
            $conditions = str_replace("%description%",          "description", $conditions);
            $conditions = str_replace("%url%",                  "url", $conditions);
            $conditions = str_replace("%extension%",            "extension", $conditions);
            $conditions = str_replace("%datecreated%",          "datecreated", $conditions);
        }

        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "id", $order_by);
            $order_by   = str_replace("%uniquecode%",           "uniquecode",  $order_by);
            $order_by   = str_replace("%title%",                "title",  $order_by);
            $order_by   = str_replace("%name%",                 "name",  $order_by);
            $order_by   = str_replace("%description%",          "description",  $order_by);
            $order_by   = str_replace("%url%",                  "url",  $order_by);
            $order_by   = str_replace("%extension%",            "extension",  $order_by);
            $order_by   = str_replace("%datecreated%",          "datecreated",  $order_by);
        }

        $sql = 'SELECT * FROM ' . $this->guide. '';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;

        return $query->result();
    }

    // ---------------------------------------------------------------------------------
}
/* End of file Model_Guide.php */
/* Location: ./application/models/Model_Guide.php */
