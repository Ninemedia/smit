<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('SMIT_Model.php');

class Model_Search extends SMIT_Model{
    /**
     * Initialize table
     */
    var $announcement                   = "smit_announcement";
    var $news                           = "smit_news";
    var $tenant                         = 'smit_incubation_tenant';
    var $incubation_product             = 'smit_incubation_product';
    var $incubation_blog                = 'smit_incubation_blog';
    var $praincubation                  = "smit_praincubation";
    var $praincubation_product          = "smit_praincubation_product";
    var $guide                          = "smit_guide";
    
    /**
	* Constructor - Sets up the object properties.
	*/
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Retrieve all search data
     * 
     * @author  Iqbal
     * @param   Int     $limit              Limit of search             default 0
     * @param   Int     $offset             Offset ot search            default 0
     * @param   String  $search_key         Search key                  default ''
     * @return  Object  Result of search list
     */
    function get_search($limit=0, $offset=0, $search_key){
        if ( !$search_key ) return false;
        
        $sql = '
        SELECT
            search_id,
            search_uid,
            search_number,
            search_title,
            search_desc,
            search_slug,
            search_type,
            search_datecreated
        FROM (
            SELECT
                id AS search_id, 
                uniquecode AS search_uid, 
                no_announcement AS search_number, 
                title AS search_title,
                `desc` AS search_desc,
                "" AS search_slug,
                "announcement" AS search_type,
                datecreated AS search_datecreated
            FROM ' . $this->announcement . ' 
            WHERE title LIKE "%'.$search_key.'%" OR `desc` LIKE "%'.$search_key.'%"
                UNION ALL
            SELECT
                id AS search_id,
                uniquecode AS search_uid,
                no_news AS search_number,
                title AS search_title,
                `desc` AS search_desc,
                "" AS search_slug,
                "news" AS search_type,
                datecreated AS search_datecreated
            FROM ' . $this->news . '
            WHERE title LIKE "%'.$search_key.'%" OR `desc` LIKE "%'.$search_key.'%"
                UNION ALL
            SELECT
                id AS search_id,
                uniquecode AS search_id,
                "" AS search_number,
                title AS search_title,
                `description` AS search_desc,
                "" AS search_slug,
                "blog_tenant" AS search_type,
                datecreated AS search_datecreated
            FROM ' . $this->incubation_blog . '
            WHERE title LIKE "%'.$search_key.'%" OR `description` LIKE "%'.$search_key.'%"
                UNION ALL
            SELECT
                id AS search_id,
                uniquecode AS search_id,
                "" AS search_number,
                event_title AS search_title,
                `event_desc` AS search_desc,
                "" AS search_slug,
                "list_praincubation" AS search_type,
                datecreated AS search_datecreated
            FROM ' . $this->praincubation . '
            WHERE event_title LIKE "%'.$search_key.'%" OR `event_desc` LIKE "%'.$search_key.'%"
                UNION ALL
            SELECT
                id AS search_id,
                uniquecode AS search_id,
                "" AS search_number,
                title AS search_title,
                `description` AS search_desc,
                "" AS search_slug,
                "list_praincubation_product" AS search_type,
                datecreated AS search_datecreated
            FROM ' . $this->praincubation_product . '
            WHERE title LIKE "%'.$search_key.'%" OR `description` LIKE "%'.$search_key.'%"
                UNION ALL
            SELECT
                id AS search_id,
                uniquecode AS search_id,
                "" AS search_number,
                name_tenant AS search_title,
                `description` AS search_desc,
                slug AS search_slug,
                "list_tenant" AS search_type,
                datecreated AS search_datecreated
            FROM ' . $this->tenant . '
            WHERE name LIKE "%'.$search_key.'%" OR name_tenant LIKE "%'.$search_key.'%" OR `description` LIKE "%'.$search_key.'%"
                UNION ALL
            SELECT
                id AS search_id,
                uniquecode AS search_id,
                "" AS search_number,
                title AS search_title,
                `description` AS search_desc,
                "" AS search_slug,
                "list_incubation_product" AS search_type,
                datecreated AS search_datecreated
            FROM ' . $this->incubation_product . '
            WHERE title LIKE "%'.$search_key.'%" OR `description` LIKE "%'.$search_key.'%"
                UNION ALL
            SELECT
                id AS search_id,
                uniquecode AS search_id,
                "" AS search_number,
                title AS search_title,
                `description` AS search_desc,
                "" AS search_slug,
                "list_guide" AS search_type,
                datecreated AS search_datecreated
            FROM ' . $this->guide . '
            WHERE title LIKE "%'.$search_key.'%" OR `description` LIKE "%'.$search_key.'%"
        ) AS A 
        ORDER BY search_datecreated DESC';
        
        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;
        
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;

        return $query->result();
    }

    // ---------------------------------------------------------------------------------
}
/* End of file Model_Search.php */
/* Location: ./application/models/Model_Search.php */
