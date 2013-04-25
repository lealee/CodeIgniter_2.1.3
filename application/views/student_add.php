<?php 

echo form_open('student/create');

// an array of the fields in the student table
echo '<table border="0" cellpadding="3" cellspacing="0">';
$field_array = array('id','s_name','p_name','address','city','state','zip','phone','email');

foreach($field_array as $field)
{
echo '<tr bgcolor="#AFD6FF"><td align=left><p>' . $field.': ';
echo form_input(array('name' => $field)) . '</td></tr></p>';

}
echo '</table>';

// not setting the value attribute omits the submit from the $_POST array
echo form_submit('', 'Add'); 

echo form_close();

