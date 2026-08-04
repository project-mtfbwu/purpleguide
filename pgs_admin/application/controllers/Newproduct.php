<?php

class Newproduct extends CI_Controller {
   public function __construct(){
        parent::__construct();
        $this->load->model('User_model','um'); 

    }
    public function add_product(){
      //$data['category']=$this->um->get_dataa('category_tbl',['block_status'=>0]);
      $sql = "SELECT * FROM `category_tbl` ORDER BY CASE WHEN `category_id` = '0' THEN `id` ELSE `category_id` END, `category_id` ";
         $data['category'] = $this->db->query($sql)->result();
      $this->load->view('product',$data);
   }
   public function add_product_data()
   {
      $desc = $this->input->post('cat_desc');
      $tec_sp = $this->input->post('tec_speci');
      $name = ucfirst(trim($this->input->post('prod_name'), " \t"));
      $product_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));
      $rand = "-";


      $cat_id = $this->input->post('select');
       if (empty($name)||empty($desc)||empty($tec_sp)||empty($cat_id)) {
          $this->session->set_flashdata('error','All field required');
          redirect (base_url().'/Product/add_product');die();

        }    $image1 = $this->um->file_upload('prod_image1','assets/images/');
        if($image1){
            $prod_data['image1'] = $image1;
        }
             $image2 = $this->um->file_upload('prod_image2','assets/images/');
        if($image2){
             $prod_data['image2'] = $image2;
        }
             $image3 = $this->um->file_upload('prod_image3','assets/images/');
        if($image3){
             $prod_data['image3'] = $image3;
        } 
        if(empty($image1) && empty($image2) && empty($image3))
        {
           $this->session->set_flashdata('error','Atleast one image required');
          redirect (base_url().'/Product/add_product');die();  
        }
                                                          $prod_data['cat_id']       = $cat_id;
                                                        $prod_data['description']       = $desc;
                                                  $prod_data['tecnicle_specification']= $tec_sp;
                                                         $prod_data['product_name']     = $name;
                                                         $prod_data['product_slug']     = $product_slug;
     
     //print_r($prod_data); die();
                                                         $id = $this->um->add_data('product_tbl', $prod_data);
                                              if ($id) {
                                                            $this->session->set_flashdata('success','Product added successfully');
                                              redirect (base_url().'Product/product_view');die();
                                                         }  
                                                         else{
                                                             $this->session->set_flashdata('error','Product not added');
                                              redirect (base_url().'Product/add_product');die();
                                                         }
   }
   
   public function edit_product($id)
   {   $data=array();
      $id = $this->uri->segment(3);
      $this->session->set_userdata('id',$id);
      $sql = "select a.id,a.category_name,b.product_name,b.id as p_id,b.description,b.image1,b.image2,b.image3,b.tecnicle_specification from category_tbl as a join product_tbl as b on a.id = b.cat_id where b.id = '$id'";
         $res = $this->db->query($sql)->result();
            if (!$res) {
               
             redirect (base_url('Product/product_view/').$p_id);die();
            }
            $data['product'] = $res;
          $sql = "SELECT * FROM `category_tbl` ORDER BY CASE WHEN `category_id` = '0' THEN `id` ELSE `category_id` END, `category_id` ";
         $data['category'] = $this->db->query($sql)->result();
      $this->load->view('edit_product',$data);
   }
   public function edit_product_data(){
      $prod_data = array();
      $c_id = $this->session->set_userdata('id');
      $p_id = $this->input->post('id');
      $select = $this->input->post('select');
      $name = ucfirst(trim($this->input->post('prod_name'), " \t"));
      $product_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));
      $rand = "-";


      $description = $this->input->post('description');
     //print_r($description);die();
      $speci = $this->input->post('tec_speci');
     
       if (empty($name)||empty($speci)) {
          $this->session->set_flashdata('error','All field required');
          redirect (base_url('Product/edit_product/').$p_id);die();

        }    $image1 = $this->um->file_upload('prod_image1','assets/images/');
             $image2 = $this->um->file_upload('prod_image2','assets/images/');
             $image3 = $this->um->file_upload('prod_image3','assets/images/');
             if ($image1) {
               $prod_data['image1'] = $image1;                                       
             }
             if ($image2) {
                   $prod_data['image2']   = $image2;
             }
             if ($image3) {
               $prod_data['image3'] = $image3;
             }
             
                                                          $prod_data['cat_id']       = $select;
                                                        
                                                  $prod_data['tecnicle_specification']= $speci;
                                                  $prod_data['description']= $description;  
                                                         $prod_data['product_name']     = $name;
                                                         $prod_data['product_slug']     = $product_slug;
                                                         

                                                         $id = $this->um->update('product_tbl',['id'=>$p_id] ,$prod_data);
                                              if ($id) {
                                                            $this->session->set_flashdata('success','Product updated successfully');
                                              redirect (base_url('/Product/product_view/'));die();
                                                         }  
                                                         else{
                                                             $this->session->set_flashdata('error','Product not updated');
                                              redirect (base_url('/Product/edit_product/').$p_id);die();
                                                         } 
   }

 public function product_view_new(){
     $sql = array();
     $whr = '';
          $category_name = $this->input->post('cat_name');
     if($category_name){
         $whr =" where a.id = '$category_name' OR a.category_id = '$category_name'";
       //print_r ($whr);die();
     }  
          $sql['cate'] = $this->db->query("SELECT * FROM `category_tbl` where block_status='0' and category_id = '0'
")->result();
         $data = "select a.id,a.category_name,a.category_id,b.id as p_id,b.product_name,b.description,b.block_status,b.image1,b.image2,b.image3,b.tecnicle_specification from category_tbl as a join product_tbl as b on a.id = b.cat_id $whr order by b.id desc";
   //print_r ($data);die();
   
         $sql['product'] = $this->db->query($data)->result();
      $this->load->view('product_view_new',$sql);
   }

  
  
   function block($id)
    {
    $id = $this->uri->segment(3);
    $sql = $this->um->get_dataa('product_tbl',['id'=>$id]);
   
     $status= $sql[0]->block_status;
   if ($id) {
      
   if ($status==0) {
      
      $data= $this->um->update('product_tbl',['id'=>$id],['block_status'=>1]);
       $this->session->set_flashdata('success', 'Product locked Successfully');
       redirect (base_url().'Product/product_view');die();

   }else{
      
         $data= $this->um->update('product_tbl',['id'=>$id],['block_status'=>0]);
          $this->session->set_flashdata('success', 'Product Unlocked Successfully');
           redirect (base_url().'Product/product_view');die();
        }
    }else{
         
          $this->session->set_flashdata('error', 'Product  id not found');
           redirect (base_url().'Product/product_view');die();
    }
   }
   public function delete_product(){
      $id = $this->uri->segment(3);
         $res = $this->um->delete('product_tbl',['id'=>$id]);
         
        if($res)                            
        {
            $this->session->set_flashdata('success', 'Product Deleted Successfully');
             redirect (base_url().'Product/product_view');die();
        }else{
            $this->session->set_flashdata('error', 'Product Not Deleted');
             redirect (base_url().'Product/product_view');die();
        }
    }

}