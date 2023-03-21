<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Candidates_model extends CI_Model
{
        function __construct() {
        // Set table name
        $this->table = 'candidate';
    }
    

    // CANDIDATE MODULE ////////////////////////////////////////////////////////////////////

    /**
     * Saves a candidate record
     * @return boolean    returns TRUE if success
     */
    function create_candidate() { 

            $filename = ''; //img filename empty if not present

            //Process Image Upload
              if($_FILES['img']['name'] != NULL)  {        

                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png'; 
                $config['encrypt_name'] = TRUE;                        

                $this->load->library('upload', $config);
                $this->upload->initialize($config);         
                
                $field_name = "img";
                $this->upload->do_upload($field_name);
                $data2 = array('upload_data' => $this->upload->data());
                foreach ($data2 as $key => $value) {     
                  $filename = $value['file_name'];
                }
                
            }
      
            $data = array(              
                'name'      => $this->input->post('name'), 
                'position'     => $this->input->post('segment'),  
                'img'       => $filename  
             );
       
            return $this->db->insert('candidate', $data);          
            

    }
    
    /**
     * Deletes a candidate record
     * @param  int    $id    the DECODED id of the item.   
     * @return boolean    returns TRUE if success
     */
    function delete_candidate($id) {

        $filename = $this->read_candidate($id)['img'];

        //Deletes the old photo
        if(!filexist($filename)) {
          unlink('./uploads/'.$filename); 
        }

        return $this->db->delete('candidate', array('id' => $id)); 

    }


    /**
     * Updates a candidate record
     * @param  int      $id    the DECODED id of the item. 
     * @return void            returns TRUE if success
     */
    function update_candidate($id) { 

            $filename = $this->read_candidate($id)['img']; //gets the old data 

            //Process Image Upload
              if($_FILES['img']['name'] != NULL)  { 


                //Deletes the old photo
                if(!filexist($filename)) {
                  unlink('./uploads/'.$filename); 
                }

                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png'; 
                $config['encrypt_name'] = TRUE;                        

                $this->load->library('upload', $config);
                $this->upload->initialize($config);         
                
                $field_name = "img";
                $this->upload->do_upload($field_name);
                $data2 = array('upload_data' => $this->upload->data());
                foreach ($data2 as $key => $value) {     
                  $filename = $value['file_name'];
                }
                
            }
      
            $data = array(              
                'name'      => $this->input->post('name'),  
                'position'  => $this->input->post('position'),  
                'img'       => $filename  
             );
            
            $this->db->where('id', $id);
            return $this->db->update('candidate', $data);          
        
    }

    /**
     * @param  int      $id     the ID of the selected item
     * @return String Array     returns the Row Array
     */
    function read_candidate($id) {

            $this->db->select('*');        
            $this->db->where('id', $id);          
            $this->db->limit(1);

            $query = $this->db->get('candidate');

            return $query->row_array();
    }

    /**
     * Returns the paginated array of rows 
     * @param  int      $limit      The limit of the results; defined at the controller
     * @param  int      $id         the Page ID of the request. 
     * @return Array        The array of returned rows 
     */
    function fetch_candidates($limit, $id) {

            $this->db->select('
                candidate.name,
                candidate.position,
                candidate.img,
                candidate.id,
                ');
            // $this->db->join('party', 'party.title = candidate.party');
            $this->db->limit($limit, (($id-1)*$limit));

            $query = $this->db->get("candidate");

            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return false;

    }

    /**
     * Returns the total number of rows of candidate title
     * @return int       the total rows
     */
    function count_candidates() {
        return $this->db->count_all("candidate");
    }



    //////////////////
    /// HELPERS /// //
    //////////////////


    /**
     * Returns the complete Array of row items of 'years' table
     * @return String Arr   The array of row items of the 'years' table
     */
    function years() {

            $this->db->select('*');
            $query = $this->db->get('year');

            return $query->result_array();

    }


    /**
     * Returns the complete Array of row items of 'course' table
     * @return String Arr   The array of row items of the 'course' table
     */
    function courses() {

            $this->db->select('*');
            $query = $this->db->get('course');

            return $query->result_array();

    }



    /**
     * Returns the complete Array of row items of 'party' table
     * @return String Arr   The array of row items of the 'party' table
     */
    function party() {

            $this->db->select('*');
            $query = $this->db->get('party');

            return $query->result_array();

    }


    /**
     * Returns the complete Array of row items of 'segment' table
     * @return String Arr   The array of row items of the 'segment' table
     */
    function segment() {

            $this->db->select('*');
            $query = $this->db->get('segment');

            return $query->result_array();

    }

    
    /**
     * Returns the complete Array of row items of position table
     * @return String Arr   The array of row items of the position table
     */
    function positions() {

            $this->db->select('*');
            $this->db->order_by('placeorder', 'ASC');
            $query = $this->db->get('position');

            return $query->result_array();

    }


    /**
     * Returns all the Position with the corresponding candidates
     * @return String Arr - Multi-Dimension Array - the array of positions with 
     * the corresponding array of candidates, with the number of votes
     *
     */
    function fetch_votable() {

            //Fetches all available positions
            $this->db->select('*');      
            //$this->db->limit(2);
            $this->db->order_by('placeorder', 'ASC');
            $query  = $this->db->get('position');         
            
            //the loop of the main array
            //the array of positions
            foreach($query->result_array() as $position) {

                //Sets the position title
                $data['title'] = $position['title'];        

                $data['candidates'] = ''; //default value if null
                
                //Fetches candidates according to its position
                $this->db->select('
                candidate.name,
                candidate.position,
                candidate.img,
                candidate.id
                ');
                // $this->db->join('party', 'party.title = candidate.party');              
                $this->db->where('position', $position['title']);
                $query_candidate    = $this->db->get('candidate');
              
                foreach($query_candidate->result_array() as $can) {
                    //candidate information
                    $candid['name'] =  $can['name'];
                    $candid['position'] =  $can['position'];
                    $candid['img'] =  $can['img'];                  
                    $candid['id'] =  $can['id'];

                    //count votes
                    $this->db->where('candidate_id', cleancrypt($can['id']));
                    $candid['votes'] =  $this->db->count_all_results('votes');

                    //compile array
                    $candid_arr[] = $candid;                    
                    $data['candidates'] = $candid_arr;
                }  
                    $candid_arr = array(); //resets array

                //build the overall array
                $dataset[] = $data;

            }           

            return $dataset;

    }


    /**
     * Saves a segment record
     * @return boolean    returns TRUE if success
     */
    function create_segment() { 

      
            $data = array(              
                'title'  => $this->input->post('segment')           
             );
       
            return $this->db->insert('position', $data);         
            
    }


    /**
     * Saves a partylist record
     * @return boolean    returns TRUE if success
     */
    function create_partylist() { 

      
            $data = array(              
                'title'  => $this->input->post('title'),  
                'color'  => $this->input->post('color')            
             );
       
            return $this->db->insert('party', $data);         
            

    }

    /**
     * Deletes a candidate record
     * @param  int       $title    the DECODED title.   
     * @return boolean             returns TRUE if success
     */
    function delete_party($title) {

        return $this->db->delete('party', array('title' => $title)); 

    }

    /**
     * Deletes a segment record
     * @param  int       $title    the DECODED title.   
     * @return boolean             returns TRUE if success
     */
    function delete_segment($title) {

        return $this->db->delete('position', array('title' => $title)); 

    }

    /**
     * Updates a party record
     * @param  String     $title   the DECODED title
     * @return boolean             returns TRUE if success
     */
    function update_party($title) { 

      
            $data = array(              
                'title'  => $this->input->post('title'),  
                'color'  => $this->input->post('color')            
             );
            
            $this->db->where('title', $title);  
            return $this->db->update('party', $data);         
            

    }

    /**
     * Updates a segment record
     * @param  String     $title   the DECODED title
     * @return boolean             returns TRUE if success
     */
    function update_segment($title) { 

      
            $data = array(              
                'title'  => $this->input->post('title'),  
                'color'  => $this->input->post('color')            
             );
            
            $this->db->where('title', $title);  
            return $this->db->update('segment', $data);         
            

    }

    /*
     * Fetch members data from the database
     * @param array filter data based on the passed parameters
     */
        function getRows($params = array()){
        $this->db->select('*');
        $this->db->from($this->table);
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("id", $params)){
                $this->db->where('id', $params['id']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $this->db->order_by('id', 'desc');
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
                }
                
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        
        // Return fetched data
        return $result;
    }

        /*
     * Insert members data into the database
     * @param $data data to be insert based on the passed parameters
     */
    public function insert($data = array()) {
        if(!empty($data)){
            // Add created and modified date if not included
            if(!array_key_exists("created", $data)){
                $data['created'] = date("Y-m-d H:i:s");
            }
            if(!array_key_exists("modified", $data)){
                $data['modified'] = date("Y-m-d H:i:s");
            }
            
            // Insert member data
            $insert = $this->db->insert($this->table, $data);
            
            // Return the status
            return $insert?$this->db->insert_id():false;
        }
        return false;
    }

        /*
     * Update member data into the database
     * @param $data array to be update based on the passed parameters
     * @param $condition array filter data
     */
    public function update($data, $condition = array()) {
        if(!empty($data)){
            // Add modified date if not included
            if(!array_key_exists("modified", $data)){
                $data['modified'] = date("Y-m-d H:i:s");
            }
            
            // Update member data
            $update = $this->db->update($this->table, $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }



}