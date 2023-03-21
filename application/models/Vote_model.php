<?php if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Vote_model extends CI_Model
{
    /**
     * ----------------------------------------------------------------------------
     * ----------------------------------------------------------------------------
     *
     * VOTE PASS / VOTE KEYS
     *
     * ---------------------------------------------------------------------------
     */
    /**
     * Verifies the validity or existence of the vote pass
     * @param  String   $pass   the vote pass
     * @return boolean          TRUE if pass exist
     */
    function check_votepass($pass)
    {
        $this->db->select("*");
        $this->db->where("key", $pass);
        $this->db->limit(1);

        $query = $this->db->get("vote_keys");

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This verifies the votepass if it is used or not
     * @param  String   $pass   the vote pass
     * @return boolean          TRUE if is_used
     */
    function verify_votepass($pass)
    {
        $this->db->select("*");
        $this->db->where("key", $pass);
        $this->db->where("is_used", 1);
        $this->db->limit(1);

        $query = $this->db->get("vote_keys");

        if ($query->num_rows() == 1) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * This Generates the vote Key Passes
     * @param  int      $key     the number of keys to be generated
     * @return boolean           it actually returns TRUE all the time. This could be VOID.
     */
    function generate_key($key)
    {
        $codes = [];

        // Generate the codes
        for ($x = 1; $x <= $key; $x++) {
            $code = "";
            $code .=
                strtoupper(random_string("alpha", 1)) .
                strtolower(random_string("alpha", 3));
            // Add the code to the array if it is not already present
            if (!in_array($code, $codes)) {
                $codes[] = $code;
            }
        }

        // Print the codes
        foreach ($codes as $code) {
            $data = [
                "key" => $code,
            ];

            $this->db->insert("vote_keys", $data);
        }
        return true;
    }

    /**
     * This Clears the vote_key table
     * @return [void] [just a wild action]
     */
    function clear_votekeys()
    {
        $this->db->empty_table("vote_keys");
    }

    /**
     * A multipurpose function used in printing and admin panel
     * Returns the requested vote keys
     * @param [String] $[str] [< 'Identifier of the query; all' = return all;>]
     * @return [Integer]    Returns the array of vote keys
     */

    function fetch_votepass($str)
    {
        if ($str == "all") {
            $query = $this->db->get("vote_keys");
        } else {
            $this->db->where("is_used", $str);
            $query = $this->db->get("vote_keys");
        }

        return $query->result_array();
    }

    /**
     * A multipurpose function used in printing and admin panel
     * Returns the number of rows of the requested vote keys
     * @param [String] $[str] [< 'Identifier of the query; all' = return all;>]
     * @return [Integer] [<Returns an Integer>]
     */

    function count_votepass($str)
    {
        if ($str == "all") {
            return $this->db->count_all_results("vote_keys");
        } else {
            $this->db->where("is_used", $str);
            return $this->db->count_all_results("vote_keys");
        }
    }

    function used_votepass($key)
    {
        $data = [
            "is_used" => 1,
        ];
        $this->db->where("key", $key);
        return $this->db->update("vote_keys", $data);
    }

    ////////////////////////////////////////////////////////////////////////////////////

    /**
     * ------------------------------------------------------------------------------------------
     * ------------------------------------------------------------------------------------------
     * VOTES
     *-------------------------------------------------------------------------------------------
     */

    /**
     * This Clears the votes table
     * @return [void] [just a wild action]
     */
    function clear_votes()
    {
        $this->db->empty_table("votes");
    }

    /**
     * This processes the votes
     * @param  String Array $vote  The Array of votes
     * @param  String       $user  The votepass userdata
     * @return Boolean     returns TRUE if success
     */
    function submit_vote($vote, $user)
    {
        foreach ($vote as $key => $value) {
            $data = [
                "candidate_id" => cleancrypt(
                    $this->encryption->decrypt($value)
                ),
                "vote_pass" => $user,
            ];

            if (!$this->db->insert("votes", $data)) {
                return false;
            }
        }

        return true;
    }
}
