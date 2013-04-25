<?php

class Student extends CI_Controller {

  function __construct()
  {
    parent::__construct(); 
  }
    
  function index()
  {
    // display information for the view
    $data['title'] = "Classroom: Home Page";
    $data['headline'] = "Welcome to the Classroom Management System";
    $data['include'] = 'student_index';

    $this->load->view('template', $data);
  }

  function add()
  {
    $this->load->helper('form');
    
    // display information for the view
    $data['title'] = "Classroom: Add Student";
    $data['headline'] = "Add a New Student";
    $data['include'] = 'student_add';

    $this->load->view('template', $data);
  }

  function create()
  {
    $this->load->helper('url');
    
    $this->load->model('MStudent','',TRUE);
    $this->MStudent->addStudent($_POST);
    redirect('student/add','refresh');
  }

  function listing()
  {
    $this->load->library('table');
    
    $this->load->model('MStudent','',TRUE);
    $students_qry = $this->MStudent->listStudents();

    // generate HTML table from query results
    $tmpl = array (
      'table_open' => '<table border="0" cellpadding="3" cellspacing="0">',
      'heading_row_start' => '<tr bgcolor="#AFD6FF">',
      'row_start' => '<tr bgcolor="#dddddd">' 
      );
    $this->table->set_template($tmpl); 
    
    $this->table->set_empty("&nbsp;"); 
  
    $this->table->set_heading('', 'Child Name', 'Parent Name', 'Address', 
        'City', 'State', 'Zip', 'Phone', 'Email');

  
    $table_row = array();
    foreach ($students_qry->result() as $student)
    {
      $table_row = NULL;
      $table_row[] = '<nobr>' . 
        anchor('student/edit/' . $student->id, 'edit') . ' | ' .
        anchor('student/delete/' . $student->id, 'delete',
          "onClick=\" return confirm('Are you sure you want to '
            + 'delete the record for $student->s_name?')\"") .
        '</nobr>';
      // replaced above :: $table_row[] = anchor('student/edit/' . $student->id, 'edit');
      $table_row[] = $student->s_name;
      $table_row[] = $student->p_name;
      $table_row[] = $student->address;
      $table_row[] = $student->city;
      $table_row[] = $student->state;
      $table_row[] = $student->zip;
      $table_row[] = $student->phone;
      $table_row[] = mailto($student->email);

      $this->table->add_row($table_row);
    }    

    $students_table = $this->table->generate();
    
    // generate HTML table from query results
    // replaced above :: $students_table = $this->table->generate($students_qry);
    
    // display information for the view
    $data['title'] = "Classroom: Student Listing";
    $data['headline'] = "Student Listing";
    $data['include'] = 'student_listing';

    $data['data_table'] = $students_table;

    $this->load->view('template', $data);
  }
  
  function edit()
  {
    $this->load->helper('form');

    $id = $this->uri->segment(3);
    $this->load->model('MStudent','',TRUE);
    $data['row'] = $this->MStudent->getStudent($id)->result();

    // display information for the view
    $data['title'] = "Classroom: Edit Student";
    $data['headline'] = "Edit Student Information";
    $data['include'] = 'student_edit';

    $this->load->view('template', $data);
  }

  function update()
  {
    $this->load->model('MStudent','',TRUE);
    $this->MStudent->updateStudent($_POST['id'], $_POST);
    redirect('student/listing','refresh');
  }

  function delete()
  {
    $id = $this->uri->segment(3);
    
    $this->load->model('MStudent','',TRUE);
    $this->MStudent->deleteStudent($id);
    redirect('student/listing','refresh');
  }

}
/* End of file student.php */
/* Location: ./system/application/controllers/student.php */
