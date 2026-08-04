<?php
Class User_model extends CI_Model{
    public function create($formArray){
        $this->db->insert('users',$formArray);
    }
    public function checkuser($email,$password){
        $q=$this->db->where(['email'=>$email,'password'=>$password])
                    ->get('users');
                    if($q->num_rows()==1){
                        return $q->row(0)->u_id;
                    }
                    else{
                        return FALSE;
                    }

    }
    public function get_dataa($tbl,$data)
            {
                    $res = $this->db->where($data)->get($tbl)->result();
              return $res;
        }

    public function getUserdata($email,$pass){
        $q=$this->db->query("select * from users where email='$email' and password='$pass'");
        return $q->result();
    }    


    public function get_data(){
        return $users = $this->db->get('product')->result_array();

    }
    public function create_product($formArray){
        $this->db->insert('product',$formArray);
    } 
    public function file_upload($m_file, $path)  
    {
            $img_name =''; 
            if(isset($_FILES[$m_file]) && $_FILES[$m_file]['size'] >0 )   
            {                                                                  
                $str_imgName =  $_FILES[$m_file]['name'];       
                  $value = explode(".", $str_imgName);    
           $img_name = rand(100000,999999).'.'.strtolower($value[1]); 
            
                 $Path1 =  $path.$img_name; 
                // $Path1 =  'assets/Selfie_img/'.$img_name; 
                if(!move_uploaded_file($_FILES[$m_file]['tmp_name'],$Path1))
                    {
                        $img_name = ''; 
                    }
            }                                                
      
       return  $img_name;                

    }
    
    public function getProduct($productId){
        $this->db->where('p_id',$productId);
        return $user = $this->db->get('product')->row_array();
    }
    public function updateUser($productId,$formArray){
        $this->db->where('p_id',$productId);
        $this->db->update('product',$formArray);
    }
    public function deleteUser($productId){
        $this->db->where('p_id',$productId);
        $this->db->delete('product');
    }
    public function add_cart($addData){
        return $this->db->insert('add_cart',$addData);
    }
    public function getSelectproducts($sproductId){
        $this->db->where('p_id',$productId);
        return $user = $this->db->get('add_cart')->row_array();
    }
    public function update_cart($newquantity,$newtotalprice,$u_id,$p_id){
        $this->db->where(['u_id'=>$u_id ,'p_id'=>$p_id]);
        $this->db->update('add_cart',['quantity'=> $newquantity,'total_price'=> $newtotalprice]);        
    } 
    public function user_product($limit,$offset)
    {
        $this->db->limit($limit,$offset);
        $q = $this->db->get('product');
        return $q->result_array();
        // return $users = $this->db->get('product')->result_array();
    }  
    public function num_rows(){
    $row = $this->db->get('product');
    return $row->num_rows(); //This $row is an Array, NOT count no. of rows
}
    



}
?>