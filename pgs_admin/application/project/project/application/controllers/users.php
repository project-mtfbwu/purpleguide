<?php
Class Users extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('upload');
        $this->load->library('form_validation');
    }
    public function index(){
        redirect (base_url().'index.php/Users/login');
    }
    public function register(){

        $this->form_validation->set_rules('first_name','First Name','required');
        $this->form_validation->set_rules('last_name','Last Name','required');
        $this->form_validation->set_rules('email','Email','required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('phone','Phone','required|is_unique[users.phone]');
        $this->form_validation->set_rules('password','Password','required');

        if($this->form_validation->run() ==false){
            $this->load->view('register');
        } else{
            $formArray = array();
            $formArray['first_name'] = $this->input->post('first_name');
            $formArray['last_name'] = $this->input->post('last_name');
            $formArray['email'] = $this->input->post('email');
            $formArray['phone'] = $this->input->post('phone');
            $formArray['password'] = $this->input->post('password');
            
            $this->User_model->create($formArray);
            $this->session->set_flashdata('msg','Record Added Successfully');
            redirect (base_url().'index.php/Users/login');
        }
    }
    public function login(){
        $this->load->model('User_model');

        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('password','Password','required');
            $password = $this->input->post('password'); 
            $email = $this->input->post('email');
            $user = $this->User_model->checkuser($email,$password);


               if($user)
               {$user_data = array(
                'u_id' => $user,
                'email' => $email,                
                'password' => $password,
                );
                $this->load->library('session');
                $this->session->set_userdata('u_id',$user);
                redirect (base_url().'index.php/Users/user_product');
               }
               else{
                $this->load->view('login');
               }
    }

    //     public function login(){

    //     $this->form_validation->set_rules('email','email','required');
    //     $this->form_validation->set_rules('password','Password','required');
            
    //     if ($this->form_validation->run() == false) {
    //         redirect(base_url('index.php/Users/login'));
    //     } else {
    //         $pass = $this->input->post('password'); 
    //         $email = $this->input->post('email');

    //         $user = $this->User_model->getUserdata($email,$pass);
    //         $u_id=$user[0]->u_id;
    //         $this->session->set_userdata('u_id',$u_id);
    //         $email=$user[0]->email;
    //         $this->session->set_userdata('email',$email);
            
        
    //            if($user)
    //            {
    //             $this->session->set_userdata('u_id',$user);
    //             redirect(base_url('index.php/Users/user_product'));
    //            }

    //            else{
    //             redirect(base_url('index.php/Users/login'));
    //            }}
    // }




    public function product(){
        if(!$this->session->userdata('u_id'))
            return redirect('users/login');

                $this->load->library('pagination');

        $config=[
            'base_url' => base_url('index.php/Users/product/'),
            'per_page' => 1,
            'total_rows' => $this->User_model->num_rows(),
            ];
        $this->pagination->initialize($config);
        $data = array();

        $data['users'] = $this->User_model->user_product($config['per_page'],$this->uri->segment(3));
        // print_r($data['user_product']);
        // die();
        $this->load->view('product',$data);
        
            

        //$user = $this->User_model->get_data();
        
        //$data['users'] = $user;
        //$this->load->view('product',$data);
        //print_r($data);
       // exit;
    }

    public function newform()
    {
        if(!$this->session->userdata('u_id'))
            return redirect('users/login');
        $this->load->view('create_product');
    }
    public function user_dashboard()
    {
        if(!$this->session->userdata('u_id'))
            return redirect('users/login');

        $u_id = $this->session->userData('u_id');
        $q = "SELECT a.p_id,a.total_price,a.quantity,p.p_name,p.image,p.Price FROM add_cart as a join product as p on a.p_id = p.p_id WHERE a.u_id = '$u_id'";
        $data['orderData'] = $this->db->query($q)->result_array();
        // print_r($data);
        // die();

        $qq = "SELECT SUM(total_price) as t , count(u_id) as u from add_cart where u_id = '$u_id' ";
        $data['tdata'] = $this->db->query($qq)->result_array();

        $this->load->view('user_dashboard',$data);

    }
    public function user_product()
    {
        if(!$this->session->userdata('u_id'))
            return redirect('users/login');
        $this->load->library('pagination');

        $config=[
            'base_url' => base_url('index.php/Users/user_product/'),
            'per_page' => 1,
            'total_rows' => $this->User_model->num_rows(),
            ];
        $this->pagination->initialize($config);
        // print_r(total_rows);
        // die();

        $data = array();

        //$data['users'] = $this->User_model->get_data();
                
        $data['users'] = $this->User_model->user_product($config['per_page'],$this->uri->segment(3));
        // print_r($data['user_product']);
        // die();
        $this->load->view('user_product',$data);
    }
    public function create_product(){
        if(!$this->session->userdata('u_id'))
            return redirect('users/login');
        $this->load->model('User_model');
        $this->form_validation->set_rules('p_name','Product Name','required');
        $this->form_validation->set_rules('description','Description','required');
        //$this->form_validation->set_rules('image','Image','required');
        $this->form_validation->set_rules('price','Price','required');

        if ($this->form_validation->run() == false)
            {
                $this->load->view('create_product');
        } else
        {

            $formArray=array();
            $formArray['p_name'] = $this->input->post('p_name');
            $formArray['description'] = $this->input->post('description');
            $formArray['image']= $this->User_model->file_upload('image','assets/images/');
            $formArray['price'] = $this->input->post('price');
            $data= $this->User_model->create_product($formArray);
            $this->session->set_flashdata('success','Product Created Successfully');
            redirect(base_url().'index.php/users/product');
        }
         
    }    

    public function logout(){

            $this->session->sess_destroy();
          redirect(base_url('index.php/Users/login')); 
    }
    public function edit($productId){
        if(!$this->session->userdata('u_id'))
            return redirect('users/login');
        $user = $this->User_model->getProduct($productId);
        $data=array();
        $data['user'] = $user;

        $this->form_validation->set_rules('p_name','Product Name','required');
        $this->form_validation->set_rules('description','Description','required');
        $this->form_validation->set_rules('price','Price','required');

        if ($this->form_validation->run() == false) {
            $this->load->view('edit',$data);
        } else {
            $formArray['p_name'] = $this->input->post('p_name');
            $formArray['description'] = $this->input->post('description');
         $formArray['image']= $this->User_model->file_upload('image','assets/images/');
            $formArray['price'] = $this->input->post('price');
            $this->User_model->updateUser($productId,$formArray);
            $this->session->set_flashdata('success','Product Updated Successfully');
            redirect(base_url().'index.php/users/product');
        } 

    }
    public function delete($productId){
        if(!$this->session->userdata('u_id'))
            return redirect('users/login');
        $this->load->model('User_model');
        $user = $this->User_model->getProduct($productId);
        if (empty($user)) {
            $this->session->set_flashdata('failure','Record Not Found in database');
            redirect(base_url().'index.php/users/product');
        }
        $this->User_model->deleteUser($productId);
        $this->session->set_flashdata('success','Record deleted Successfully');
        redirect(base_url().'index.php/users/product');
    }
    public function add_cart()
    {
        if(!$this->session->userdata('u_id'))
            return redirect('users/login');

        $p_id = $this->input->post('p_id');
        $u_id = $this->input->post('u_id');
        $quantity = $this->input->post('quantity');
        $Price = $this->input->post('Price');

        $total_price = $quantity*$Price;

        if(empty($p_id) || empty($u_id) || empty($quantity) || empty($Price)){

            $this->session->set_flashdata('error','All Field Required');
             redirect(base_url('index.php/users/user_product')); die();
        }

        $u_id = $this->session->userData('u_id');
        $qqq = "SELECT quantity,total_price,price FROM add_cart WHERE u_id ='$u_id' and p_id='$p_id' ";
        $datta= $this->db->query($qqq)->result();
        // print_r($datta);
        // die();
        if($datta){
      
            $qty = $datta[0]->quantity;
            $newquantity = $qty+$quantity;

            $t_price = $datta[0]->total_price;
            $price = $datta[0]->price;
            $newtotalprice = $t_price+($quantity*$price);


            $dataaa = $this->User_model->update_cart($newquantity,$newtotalprice,$u_id,$p_id);
            if ($dataaa) {
                redirect(base_url('index.php/users/user_dashboard'));                
            }else{
                redirect(base_url('index.php/users/user_product'));
            }
        }
        else{

        $addData = ['p_id'=>$p_id,'u_id'=>$u_id,'quantity'=>$quantity,'Price'=>$Price,'total_price'=>$total_price];
        $data= $this->User_model->add_cart($addData);


        if($data){
            $this->session->set_flashdata('success','Add Successfully');
                redirect(base_url('index.php/users/user_product')); 
        }else{
                $this->session->set_flashdata('error','something went wrong please try again');
              redirect(base_url('index.php/users/user_product')); die();
        }
    }
    }
}
        

?>        