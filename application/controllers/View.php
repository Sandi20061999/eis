<?php

 
class View extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('View_model');
    } 

    /*
     * Listing of view
     */
    function index()
    {
        $data['view'] = $this->View_model->get_all_view();
        
        $data['_view'] = 'admin/view/index';
        $this->load->view('admin/layouts/main',$data);
    }

    /*
     * Adding a new view
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('jsonFile','JsonFile','required');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'jsonFile' => $this->input->post('jsonFile'),
            );
            
            $view_id = $this->View_model->add_view($params);
            redirect('view/index');
        }
        else
        {            
            $data['_view'] = 'admin/view/add';
            $this->load->view('admin/layouts/main',$data);
        }
    }  

    /*
     * Editing a view
     */
    function edit($id)
    {   
        // check if the view exists before trying to edit it
        $data['view'] = $this->View_model->get_view($id);
        
        if(isset($data['view']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('jsonFile','JsonFile','required');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'jsonFile' => $this->input->post('jsonFile'),
                );

                $this->View_model->update_view($id,$params);            
                redirect('view/index');
            }
            else
            {
                $data['_view'] = 'admin/view/edit';
                $this->load->view('admin/layouts/main',$data);
            }
        }
        else
            show_error('The view you are trying to edit does not exist.');
    } 

    /*
     * Deleting view
     */
    function remove($id)
    {
        $view = $this->View_model->get_view($id);

        // check if the view exists before trying to delete it
        if(isset($view['id']))
        {
            $this->View_model->delete_view($id);
            redirect('view/index');
        }
        else
            show_error('The view you are trying to delete does not exist.');
    }
    
}
