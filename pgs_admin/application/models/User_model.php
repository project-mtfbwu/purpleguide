<?php
Class User_model extends CI_Model{
    public function create($formArray){
        $this->db->insert('users',$formArray);
    }
    public function checkuser($email,$password){
        $q= $this->db->where(['email'=>$email,'password'=>$password])
                    ->get('admin');
                    if($q->num_rows()==1){
                        return $q->row(0)->u_id;
                    }
                    else{
                        return FALSE;
                    }

    }
   public function change_password($pass,$change_pass,$confirm_pass)
   {
    $data=$this->db->query("UPDATE users SET password=$change_pass
WHERE password = $pass");
    return $data;
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
                    if(isset($_FILES[$m_file]))   
                    {  
                        
                        $file_name =  $_FILES[$m_file]['name']; 
                         
                        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
                        $img_name = rand(100,10000).time().'.'.$extension  ;  
                  
                         $Path1 =  $path.$img_name; 
                
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
        $this->db->where('id',$productId);
        $this->db->update('product_tbl',$formArray);
    }
    public function deleteUser($productId){
        $this->db->where('p_id',$productId);
        $this->db->delete('product');
    }
    public function add_cart($addData){
        return $this->db->insert('add_cart',$addData);
    }
     public function add_data($tbl, $addData){
        return $this->db->insert($tbl,$addData);
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
    
  public function update($tbl,$wh,$tag)
    {
       return  $res = $this->db->where($wh)->update($tbl, $tag);

    }
 public function delete($tbl,$wh)
 {

    $this->db->where($wh);
    $del = $this->db->delete($tbl);
    return $del;
 }
     public function multi_file_upload($m_file, $path)  
       {
               $img_name =array();

               if (!isset($_FILES[$m_file])) {
                    return $img_name;
               }

               $total = isset($_FILES[$m_file]['name']) ? count($_FILES[$m_file]['name']) : 0;

               for($i = 0; $i < $total; $i++ ){
                     // Keep indexes aligned with other facilitator fields
                     $img_name[$i] = '';

                     $str_imgName =  $_FILES[$m_file]['name'][$i] ?? '';
                     if($str_imgName){
                         $value = explode(".", $str_imgName);
                         $ext = isset($value[1]) ? strtolower($value[1]) : '';
                         if (!$ext) {
                             continue;
                         }

                         $img = rand(100000,999999).'.'.$ext;
                         $Path1 =  $path.$img;

                         if(move_uploaded_file($_FILES[$m_file]['tmp_name'][$i],$Path1))
                         {
                             $img_name[$i] = $img ;
                         }else{
                             $img_name[$i] = '' ;
                         }
                     }
                }

          return  $img_name;                

       }
    public function insert($tbl,$data)
            {
                    $res = $this->db->insert($tbl,$data);

                return ($res)? $this->db->insert_id() : false;

            }   

}
?>