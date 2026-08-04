<?php
Class Upload_your_doc extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');     
        //$this->load->library('form_validation');
		  //      if (!$this->session->userdata('logged_in')) {
            //redirect('Login');
        //}
    }
    
    public function index(){
        $user_id = $this->session->userdata('user_id');
		  // Check if user is logged in
		   if (!$this->session->userdata('logged_in') || !$user_id) {
            $this->load->view('lock_upload_your_doc');
            return;
        }
		
		 $premium_app = $this->db
            ->where('user_id', $user_id)
            ->get('purplepremium_applications')
            ->row();

        // User logged in but not premium approved
        if (!$premium_app || $premium_app->status != 'approved') {
            $this->load->view('lock_upload_your_doc');
            return;
        }
        
        // Get user info
        $data['user'] = $this->db->where('id', $user_id)->get('users')->row();
        
        // Get all uploaded documents for this user
        $data['documents'] = $this->db->where('user_id', $user_id)
            ->order_by('document_type', 'ASC')
            ->order_by('uploaded_at', 'DESC')
            ->get('user_documents')
            ->result();
        
        // Standard document types list
        $data['standard_documents'] = [
            'Passport Front',
            'Passport Back',
            'CV',
            'LoR',
            'UG Marksheet - 1',
            'UG Provisional Certificate',
            'UG Degree Certificate',
            'SOP',
            '12th Marksheet',
            '10th Marksheet',
            'PG Marksheet - 1',
            'PG Consolidated Marksheet',
            'PG Provisional Certificate',
            'PG Degree Certificate',
            'pre-journey checklist'
        ];
        
        // Admin-added document types for this user (from admin user_documents page)
        $data['additional_document_types'] = [];
        if ($this->db->table_exists('user_additional_doc_types')) {
            $rows = $this->db->where('user_id', $user_id)
                ->order_by('display_order', 'ASC')
                ->order_by('id', 'ASC')
                ->get('user_additional_doc_types')
                ->result();
            foreach ($rows as $r) {
                $data['additional_document_types'][] = $r->doc_name;
            }
        }
        
        $this->load->view('upload-your-doc', $data);
    }
    
    public function upload_document(){
        // Disable profiler and ensure clean output
        $this->output->enable_profiler(FALSE);
        
        // Clear any previous output
        if (ob_get_level()) {
            ob_clean();
        }
        
        $user_id = $this->session->userdata('user_id');
        
        if (!$user_id) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            exit;
        }
        
        $document_type = $this->input->post('document_type');
        $document_name = $this->input->post('document_name'); // For additional documents
        $file_input_name = 'document_file';
        
        if (empty($document_type)) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Document type is required']);
            exit;
        }
        
        // Check if file was uploaded
        if (!isset($_FILES[$file_input_name]) || $_FILES[$file_input_name]['error'] != 0) {
            $error_msg = 'Please select a file to upload';
            if (isset($_FILES[$file_input_name]['error']) && $_FILES[$file_input_name]['error'] != 0) {
                $error_msg = 'File upload error: ' . $_FILES[$file_input_name]['error'];
            }
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => $error_msg]);
            exit;
        }
        
        // Validate file
        $file = $_FILES[$file_input_name];
        $allowed_types = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];
        $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        if (!in_array($file_ext, $allowed_types)) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid file type. Allowed: PDF, DOC, DOCX, JPG, PNG']);
            exit;
        }
        
        // Check file size (5MB max)
        if ($file['size'] > 5 * 1024 * 1024) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'File size exceeds 5MB limit']);
            exit;
        }
        
        // Upload file
        $upload_path = FCPATH . 'assets/documents/';
        
        // Create directory if it doesn't exist
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }
        
        // Generate unique filename
        $file_name = rand(100, 10000) . time() . '.' . $file_ext;
        $target_path = $upload_path . $file_name;
        
        if (move_uploaded_file($file['tmp_name'], $target_path)) {
            // Save to database
            $document_data = [
                'user_id' => $user_id,
                'document_type' => $document_type,
                'document_name' => !empty($document_name) ? trim($document_name) : null,
                'file_name' => $file_name,
                'file_path' => 'assets/documents/' . $file_name,
                'file_size' => $file['size'],
                'file_type' => $file['type'],
                'qc_status' => 'pending'
            ];
            
            $insert_result = $this->db->insert('user_documents', $document_data);
            
            if ($insert_result) {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => true, 
                    'message' => 'Document uploaded successfully',
                    'document_id' => $this->db->insert_id()
                ]);
                exit;
            } else {
                // Delete uploaded file if database insert failed
                if (file_exists($target_path)) {
                    unlink($target_path);
                }
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Failed to save document to database']);
                exit;
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Failed to upload file. Please check directory permissions.']);
            exit;
        }
    }
    
    public function delete_document(){
        $this->output->enable_profiler(FALSE);
        
        // Clear any previous output
        if (ob_get_level()) {
            ob_clean();
        }
        
        $user_id = $this->session->userdata('user_id');
        $document_id = (int) $this->input->post('document_id');
        
        if (!$user_id || !$document_id) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            exit;
        }
        
        // Get document info
        $document = $this->db->where('id', $document_id)
            ->where('user_id', $user_id)
            ->get('user_documents')
            ->row();
        
        if (!$document) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Document not found']);
            exit;
        }
        
        // Delete file
        $file_path = FCPATH . $document->file_path;
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        
        // Delete from database
        $this->db->where('id', $document_id)->delete('user_documents');
        
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Document deleted successfully']);
        exit;
    }
}

    