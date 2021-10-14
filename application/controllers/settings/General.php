<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends MY_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->require_auth_level(ADMINISTRATOR);
	}


	/**
	* Settings page
	*
	*/
	function index()
	{
		$this->data['settings'] = $this->settings_model->get_all('crbs');

		if ($this->input->post()) {
			$this->save_settings();
		}

		$this->data['title'] = 'Configurações';
		$this->data['showtitle'] = $this->data['title'];
		$this->data['body'] = $this->load->view('settings/general', $this->data, TRUE);

		return $this->render();
	}



	/**
	* Controller function to handle submitted form
	*
	*/
	private function save_settings()
	{
		// Parse data input from view and carry out appropriate action.

		// Load image manipulation library
		$this->load->library('image_lib');

		$this->load->library('form_validation');
		$this->form_validation->set_rules('bia', 'Reserva com antecedência', 'max_length[3]|numeric');
		$this->form_validation->set_rules('num_max_bookings', 'Número máximo de reservas', 'max_length[3]|numeric');
		$this->form_validation->set_rules('displaytype', 'Tipo de exibição', 'required');
		$this->form_validation->set_rules('d_columns', 'Colunas de exibição', 'callback__valid_columns');
		$this->form_validation->set_rules('date_format_long', 'Formato de data longo', 'required|max_length[15]');
		$this->form_validation->set_rules('date_format_weekday', 'Formato de dia da semana', 'max_length[15]');
		$this->form_validation->set_rules('time_format_period', 'Formato de tempo do período', 'max_length[15]');
		$this->form_validation->set_rules('bookings_show_user_single', 'Exibição do usuário (individual)', 'is_natural');
		$this->form_validation->set_rules('bookings_show_user_recurring', 'Exibição do usuário (recorrente)', 'is_natural');
		$this->form_validation->set_rules('login_message_enabled', 'Mensagem de login', 'is_natural');
		$this->form_validation->set_rules('login_message_text', 'Texto da mensagem de login', 'max_length[1024]');
		$this->form_validation->set_rules('maintenance_mode', 'Modo de manutenção', 'is_natural');
		$this->form_validation->set_rules('maintenance_mode_message', 'Mensagem do modo de manutenção', 'max_length[1024]');

		if ($this->form_validation->run() == FALSE) {
			return FALSE;
		}

		$settings = array(
			'bia' => (int) $this->input->post('bia'),
			'num_max_bookings' => (int) $this->input->post('num_max_bookings'),
			'displaytype' => $this->input->post('displaytype'),
			'd_columns' => $this->input->post('d_columns'),
			'date_format_long' => $this->input->post('date_format_long'),
			'date_format_weekday' => $this->input->post('date_format_weekday'),
			'time_format_period' => $this->input->post('time_format_period'),
			'bookings_show_user_single' => $this->input->post('bookings_show_user_single'),
			'bookings_show_user_recurring' => $this->input->post('bookings_show_user_recurring'),
			'login_message_enabled' => $this->input->post('login_message_enabled'),
			'login_message_text' => $this->input->post('login_message_text'),
			'maintenance_mode' => $this->input->post('maintenance_mode'),
			'maintenance_mode_message' => $this->input->post('maintenance_mode_message'),
		);

		$settings['colour'] = '468ED8';

		// Set default date value if empty
		$date_format_long = trim($settings['date_format_long']);
		if ( ! strlen($date_format_long)) {
			$settings['date_format_long'] = 'l jS F Y';
		}

		$this->settings_model->set($settings);

		$this->session->set_flashdata('saved', msgbox('info', 'As configurações foram atualizadas.'));

		redirect('settings/general');
	}


	function _valid_columns($cols)
	{
		// Day: Periods / Rooms
		// Room: Periods / Days
		$valid['day'] = array('periods', 'rooms');
		$valid['room'] = array('periods', 'days');

		$displaytype = $this->input->post('displaytype');

		switch ($displaytype) {

			case 'day':
				if (in_array($cols, $valid['day'])) {
					$ret = TRUE;
				} else {
					$ret = FALSE;
				}
			break;

			case 'room':
				if (in_array($cols, $valid['room'])) {
					$ret = TRUE;
				} else {
					$ret = FALSE;
				}
			break;
		}

		if ($ret == FALSE) {
			$this->form_validation->set_message('_valid_columns', 'A coluna que você selecionou é incompatível com o tipo de exibição.');
		}

		return $ret;
	}


}
