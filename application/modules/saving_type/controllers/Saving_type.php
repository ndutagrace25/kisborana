<?php
class Saving_type extends MX_Controller
{ 
    

    public function __construct()
    {
        parent::__construct();
        $this->load->model("saving_type_model");        
       $this->load->model("site/site_model"); 

       
    }

   //all saving types
    public function index()
    {
        $v_data["all_saving_type"] = $this->saving_type_model->get_saving_type();

        $data = array("title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("saving_type/all_saving_type", $v_data, true),
        );
        $this->load->view("site/layouts/layout", $data);
    }

    //ading new saving type    
    public function new_saving_type()
    {
        $this->form_validation->set_rules("saving_type_name", "Saving Type Name", "required");       

        if ($this->form_validation->run()) 
        {
            $saving_type_id = $this->saving_type_model->add_saving_type();
            if ($saving_type_id > 0) {
                $this->session->set_flashdata("success_message", "New saving type has been added");
            } else {
                $this->session->set_flashdata
                    ("error_message", "unable to add saving type");
            }
            redirect("saving_type");
        

        $data["form_error"] = validation_errors();
        }
        $v_data ["add_saving_type"]= "saving_type/saving_type_model";
        $data = array("title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("saving_type/saving_type", $v_data, true),

        );
        $this->load->view("site/layouts/layout", $data);
    }

    
    //editing saving type
    public function update_saving_type($saving_type_id)
    {
        $this->form_validation->set_rules("saving_type_name", "Saving Type Name", "required");

        if($this->form_validation->run())
        {
            $saving_type_id = $this->saving_type_model->edit_saving_type($saving_type_id);

            redirect("saving_type");
        }
        else
        {
            $validation_errors = validation_errors();
            if(!empty ($validation_errors))
            {
                $this->session->set_flashdata("error",$validation_errors);
            }
        }

        //1. get data for the saving type with the passed saving_type_id from the model
        $single_saving_type_data = $this->saving_type_model->get_single_saving_type($saving_type_id);
        
       
        if($single_saving_type_data->num_rows()>0)
        {
            $row = $single_saving_type_data->row();
            $saving_type_id = $row->saving_type_id;
            $saving_type_name = $row->saving_type_name;

        }

        $v_data = array (
            "saving_type_id" => $saving_type_id,
            "saving_type_name" => $saving_type_name
        );
        //var_dump($v_data);die();

        //2. load view with the data from step 1
        $data = array(
            "title"=>$this->site_model->display_page_title(),
            "content"=>$this->load->view("saving_type/edit_saving_type", $v_data, true),
        );
        
        $this->load->view("site/layouts/layout", $data);

    }

    //deleting a row
    public function delete_saving_type($saving_type_id)
    {
        $undeleted = $this->saving_type_model->remove_saving_type($saving_type_id);

        $v_data["all_saving_type"] = $undeleted;
        $data = array(
            "title"=>$this->site_model->display_page_title(),
            "content"=>$this->load->view("saving_type/all_saving_type", $v_data, true),
        );
        
        $this->load->view("site/layouts/layout", $data);
    }

      //deactivate
      public function deactivate_saving_type($saving_type_id)
      {
          //1. load model and pass saving_type_id so as to update the saving_type_status column of that particular saving_type
          $undeactivated = $this->saving_type_model->limit_saving_type($saving_type_id);
          //2. Return all saving_type where the value saving_type_status column is 1; meaning, they are deactivated
          
          $v_data["all_saving_type"] = $undeactivated;
          //3. load the all friends view with data from step 2
          $data = array(
              "title"=>$this->site_model->display_page_title(),
              "content"=>$this->load->view("saving_type/all_saving_type", $v_data, true),
          );
          
          $this->load->view("site/layouts/layout", $data);
      }
  
      //activate
      public function activate_saving_type($saving_type_id)
      {
          //1. load model and pass saving_type_id so as to update the saving_type_status column of that particular saving_type
          $unactivated = $this->saving_type_model->active_saving_type($saving_type_id);
          //2. Return all saving_types where the value saving_type_status column is 1; meaning, they are active
          
          $v_data["all_saving_type"] = $unactivated;
          //3. load the all friends view with data from step 2
          $data = array(
              "title"=>$this->site_model->display_page_title(),
              "content"=>$this->load->view("saving_type/all_saving_type", $v_data, true),
          );
          
          $this->load->view("site/layouts/layout", $data);
      }
    
}
?>