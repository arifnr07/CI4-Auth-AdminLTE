<?php

namespace App\Controllers;

use App\Libraries\Crud;


class Menu extends BaseController
{
	protected $crud;

	function __construct()
	{
		$table_name = 'Menu';
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
		$columns = null;
		$where = null;
		$order = [['name', 'ASC']];
		$data['table'] = $this->crud->view($page, $per_page, $columns, $where, $order);
		return view('datatables/table', $data);
	}

	function add()
	{

		$data['form'] = $form = $this->crud->form();
		$data['title'] = $this->crud->getAddTitle();

		if (is_array($form) && isset($form['redirect']))
			return redirect()->to($this->baseurl($this->crud->getTable()));
		//return redirect()->to($form['redirect']);

		return view('datatables/form', $data);
	}

	function edit($id)
	{
		if (!$this->crud->current_values($id))
			return redirect()->to($this->crud->getBase() . '/' . $this->crud->getTable());

		$data['id'] = $id;
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
		$fields['name'] = ['label' => 'Name', 'required' => true, 'unique' => [true, 'name']];
		$fields['link'] = ['label' => 'Link', 'required' => true, 'unique' => [true, 'link']];
		$fields['icon'] = ['label' => 'Icon'];
		$fields['parent_id'] = ['label' => 'Parent'];
		$fields['role_id'] = ['label' => 'Role'];
		$fields['created_at'] = ['label' => 'Created at', 'type' => 'unset'];

		return $fields;
	}

	//--------------------------------------------------------------------

}
