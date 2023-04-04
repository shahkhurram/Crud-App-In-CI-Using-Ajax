<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carmodel extends CI_Controller {


	public function index()
	{
		$this->load->model('Car_model');
		$cars=$this->Car_model->all();
		$data['cars']=$cars;

		$this->load->view('carmodel/list',$data);
	}
	public function showCreateForm(){
		$html=$this->load->view('carmodel/create','',true);
		$response['html']=$html;
		echo json_encode($response);

	}
	public function saveModel(){
		$this->load->model('Car_model');
		$this->load->library (array('form_validation', 'session'));
            $this->load->helper(array('url', 'form'));
		// $this->load->library('form-validation');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('color','Color','required');
		$this->form_validation->set_rules('price','Price','required');
			if($this->form_validation->run()==true){
				$formArray=array();
				$formArray['name']=$this->input->post('name');
				$formArray['color']=$this->input->post('color');
				$formArray['transmission']=$this->input->post('transmission');
				$formArray['price']=$this->input->post('price');
				$formArray['created_at']=date('y-m-d H:i:s');
				// $formArray['updated_at']=date('y-m-d H:i:s');
				$id=$this->Car_model->create($formArray);
				
			
				$cars=$this->Car_model->getRow($id);
				$rdata['car']=$cars;

				$rowhtml=$this->load->view('carmodel/car_row',$rdata,true);

				$response['car']=$rowhtml;
				$response['status']=1;
				$response['message']="<div class=\"alert alert-success\"> Record has been submitted Successfully</div> ";
				
			}
			else{
				$response['status']=0;
				$response['name']=strip_tags(form_error('name'))	;
				$response['color']=strip_tags(form_error('color'))	;
				$response['price']=strip_tags(form_error('price'))	;


			}
			echo json_encode($response);

	}
	public function updatemodel(){
		$this->load->model('Car_model');
		$id=$this->input->post('id');

		$cars=$this->Car_model->getRow($id);
		if(empty($cars)){
			$response['msg']="either record deleted or not exist.";
				$response['status']=100;
				json_encode($response);
				exit;
		}


		$this->load->library (array('form_validation', 'session'));
            $this->load->helper(array('url', 'form'));
		// $this->load->library('form-validation');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('color','Color','required');
		$this->form_validation->set_rules('price','Price','required');
			if($this->form_validation->run()==true){
				$formArray=array();
				$formArray['name']=$this->input->post('name');
				$formArray['color']=$this->input->post('color');
				$formArray['transmission']=$this->input->post('transmission');
				$formArray['price']=$this->input->post('price');
				// $formArray['created_at']=date('y-m-d H:i:s');
				$formArray['updated_at']=date('y-m-d H:i:s');
				$id=$this->Car_model->update($id,$formArray);
				$cars=$this->Car_model->getRow($id);

				$response['car']=$cars;
				$response['status']=1;
				$response['message']="<div class=\"alert alert-success\"> Record has been updated Successfully</div> ";
				
			}
			else{
				$response['status']=0;
				$response['name']=strip_tags(form_error('name'))	;
				$response['color']=strip_tags(form_error('color'))	;
				$response['price']=strip_tags(form_error('price'))	;


			}
			echo json_encode($response);


	}
	public function getCarModel($id){
		$this->load->model('Car_model');
		$cars=$this->Car_model->getRow($id);
		$data['car']=$cars;
		$html=$this->load->view('carmodel/edit',$data,true);
		$response['html']=$html;
		echo json_encode($response);
		
	}
	public function deleteModel($id){
		$this->load->model('Car_model');
		$cars=$this->Car_model->getRow($id);
		
		if(empty($cars)){
			    $response['msg']="<div class=\"alert alert-warning\">Either record already deleted or not exist.</div>";
				$response['status']=0;
				 echo json_encode($response);
				exit;
		}else{
			    $this->Car_model->delete($id);
			    $response['msg']="<div class=\"alert alert-success\">Record Has been deleted</div>";
				$response['status']=1;
				 echo json_encode($response);
		}

	}
	
	
}