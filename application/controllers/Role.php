<?php

class Role extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Role_model');
    } 

    /*
     * Listing of role
     */
    function index()
    {
        $data['role'] = $this->Role_model->get_all_role();
        
        $data['_view'] = 'admin/role/index';
        $this->load->view('admin/layouts/main',$data);
    }

    /*
     * Adding a new role
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('role','Role','required');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'role' => $this->input->post('role'),
            );
            
            $role_id = $this->Role_model->add_role($params);
            redirect('role/index');
        }
        else
        {            
            $data['_view'] = 'admin/role/add';
            $this->load->view('admin/layouts/main',$data);
        }
    }  

    /*
     * Editing a role
     */
    function edit($id)
    {   
        // check if the role exists before trying to edit it
        $data['role'] = $this->Role_model->get_role($id);
        
        if(isset($data['role']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('role','Role','required');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'role' => $this->input->post('role'),
                );

                $this->Role_model->update_role($id,$params);            
                redirect('role/index');
            }
            else
            {
                $data['_view'] = 'admin/role/edit';
                $this->load->view('admin/layouts/main',$data);
            }
        }
        else
            show_error('The role you are trying to edit does not exist.');
    } 

    /*
     * Deleting role
     */
    function remove($id)
    {
        $role = $this->Role_model->get_role($id);

        // check if the role exists before trying to delete it
        if(isset($role['id']))
        {
            $this->Role_model->delete_role($id);
            redirect('role/index');
        }
        else
            show_error('The role you are trying to delete does not exist.');
    }
    
}
