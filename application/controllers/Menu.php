<?php

 
class Menu extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Sub_menu_model');
    } 

    /*
     * Listing of menu
     */
    function index()
    {
        $data['menu'] = $this->Menu_model->get_all_menu();
        
        $data['_view'] = 'admin/menu/index';
        $this->load->view('admin/layouts/main',$data);
    }

    /*
     * Adding a new menu
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('menu','Menu','required');
		$this->form_validation->set_rules('icon','Icon','required');
		$this->form_validation->set_rules('by','By','required');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'menu' => $this->input->post('menu'),
				'icon' => $this->input->post('icon'),
				'by' => $this->input->post('by'),
            );
            
            $menu_id = $this->Menu_model->add_menu($params);
            // $subMenu = $this->Sub_menu_model->get_all_sub_menu();
            // $mas = [];
            // foreach($subMenu as $sB){
            //     $par = [
            //         'menu_id' => $menu_id,
            //         'sub_menu_id' => $sB['id']
            //     ];
            //     array_push($mas,$par);
            // }
            // $this->db->insert_batch('menu_access_sub_menu',$mas);
            redirect('menu/index');
        }
        else
        {            
            $data['_view'] = 'admin/menu/add';
            $this->load->view('admin/layouts/main',$data);
        }
    }  

    /*
     * Editing a menu
     */
    function edit($id)
    {   
        // check if the menu exists before trying to edit it
        $data['menu'] = $this->Menu_model->get_menu($id);
        
        if(isset($data['menu']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('menu','Menu','required');
			$this->form_validation->set_rules('icon','Icon','required');
			$this->form_validation->set_rules('by','By','required');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'menu' => $this->input->post('menu'),
					'icon' => $this->input->post('icon'),
					'by' => $this->input->post('by'),
                );

                $this->Menu_model->update_menu($id,$params);            
                redirect('menu/index');
            }
            else
            {
                $data['_view'] = 'admin/menu/edit';
                $this->load->view('admin/layouts/main',$data);
            }
        }
        else
            show_error('The menu you are trying to edit does not exist.');
    } 

    /*
     * Deleting menu
     */
    function remove($id)
    {
        $menu = $this->Menu_model->get_menu($id);

        // check if the menu exists before trying to delete it
        if(isset($menu['id']))
        {
            $this->Menu_model->delete_menu($id);
            $this->Menu_model->delete_menu_access($id);
            redirect('menu/index');
        }
        else
            show_error('The menu you are trying to delete does not exist.');
    }
    
}
