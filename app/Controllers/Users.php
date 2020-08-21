<?php

namespace App\Controllers;

use App\Libraries\Crud;


class Users extends BaseController
{
	protected $crud;

	function __construct()
	{
		$table_name = 'Users';
		$params = [
			'table' => strtolower($table_name),
			'dev' => false,
			'fields' => $this->field_options(),
			'form_title_add' => 'Add ' . $table_name,
			'form_title_update' => 'Edit ' . $table_name,
			'form_submit' => 'Add',
			'table_title' => $table_name,
			'form_submit_update' => 'Update',
			'base' => '',
		];

		$this->crud = new Crud($params, service('request'));
	}

	public function index()
	{

		$page = 1;
		if (isset($_GET['page'])) {
			$page = (int) $_GET['page'];
			$page = max(1, $page);
		}

		$data['title'] = $this->crud->getTableTitle();


		$per_page = 10;
		$columns = ['id', 'username', 'email'];
		$where = null;
		$order = [['id', 'ASC']];
		$data['table'] = $this->crud->view($page, $per_page, $columns, $where, $order);
		return view('datatables/table', $data);
	}

	function add()
	{

		$data['form'] = $form = $this->crud->form();
		$data['title'] = $this->crud->getAddTitle();

		if (is_array($form) && isset($form['redirect']))
			return redirect()->to($form['redirect']);

		return view('datatables/form', $data);
	}

	function edit($id)
	{
		if (!$this->crud->current_values($id))
			return redirect()->to($this->crud->getBase() . '/' . $this->crud->getTable());

		$data['item_id'] = $id;
		$data['form'] = $form = $this->crud->form();

		if (is_array($form) && isset($form['redirect']))
			return redirect()->to($this->crud->getBase() . '/' . $this->crud->getTable());
		//return redirect()->to($form['redirect']);

		$data['title'] = $this->crud->getEditTitle();
		return view('datatables/form', $data);
	}

	protected function field_options()
	{
		$fields = [];
		$fields['id'] = ['label' => 'ID'];
		$fields['email'] = ['label' => 'Email', 'required' => 'true', 'unique' => [true, 'email']];
		$fields['username'] = ['label' => 'Username', 'required' => 'true', 'unique' => [true, 'username']];
		$fields['password_hash'] = ['label' => 'Password', 'only_add' => true, 'required' => 'true', 'type' => 'password', 'confirm' => true, 'password_hash' => true];
		$fields['reset_hash'] = ['label' => 'Reset hash', 'type' => 'unset'];
		$fields['reset_at'] = ['label' => 'Reset at', 'type' => 'unset'];
		$fields['reset_expires'] = ['label' => 'Reset Expires', 'type' => 'unset'];
		$fields['activate_hash'] = ['label' => 'Activate Hash', 'type' => 'unset'];
		$fields['status'] = ['label' => 'Status', 'type' => 'unset'];
		$fields['status_message'] = ['label' => 'Status Message', 'type' => 'unset'];
		$fields['active'] = ['label' => 'Active', 'only_edit' => true];
		$fields['force_pass_reset'] = ['label' => 'Password Reset', 'type' => 'unset'];
		$fields['created_at'] = ['label' => 'Created at', 'type' => 'unset'];
		$fields['updated_at'] = ['label' => 'Updated at', 'type' => 'unset'];
		$fields['deleted_at'] = ['label' => 'Deleted at', 'type' => 'unset'];

		return $fields;
	}

	//--------------------------------------------------------------------

}
