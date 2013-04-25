<?
class User_model extends CI_Model {


    function __construct()
    {
        // 呼叫模型(Model)的建構函數
        parent::__construct();
    }
    
    function all()
    {
        $query = $this->db->get('users');
        return $query->result();
    }

    function get_user($id){
        $this->db->where("id" , $id);
        $query = $this->db->get('users');
        return $query->result();
    }

    function create($data){
        return $this->db->insert('users', $data); 
    }
	
	function edit($data){
		
	
	}
    function delete($data){
        $this->db->where('id', $id);
        return $this->db->delete('users',$data);
    }

}
?>
