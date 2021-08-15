<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Acces-Control-Allow-Methods: GET, OPTIIONS");


class Snap extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-D6sigaN-VsoFa1pEcTSD_dGd', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');
		$this->load->model('Front_model');
		define('MENU', $this->Front_model->get_menu());
    }

    public function index()
    {
		
    	$this->load->view('checkout_snap');
    }

    public function token()
    {
		
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$telpon = $this->input->post('telpon');
		$nominal1 = $this->input->post('nominal');
		$nominal2 = $this->input->post('nominal1');
		$nominal = (int)$nominal1 + (int)$nominal2;
		//var_dump($nominal, $nominal2);
		
		
		// Required
		$transaction_details = array(
		  'order_id' => rand(),
		  'gross_amount' => $nominal, // no decimal allowed for creditcard
		);

		// Optional
		$item1_details = array(
		  'id' => 'a1',
		  'price' => $nominal,
		  'quantity' => 1,
		  'name' => "Celengan Keadilan"
		);

		// // Optional
		// $item2_details = array(
		//   'id' => 'a2',
		//   'price' => 20000,
		//   'quantity' => 2,
		//   'name' => "Orange"
		// );

		// Optional
		$item_details = array ($item1_details);

		// Optional
		$billing_address = array(
		'first_name'	=> $nama,
		'email'			=> $email, 
		'phone'         => $telpon,
		'country_code'  => 'IDN'
		);

		// // Optional
		// $shipping_address = array(
		//   'first_name'    => "Obet",
		//   'last_name'     => "Supriadi",
		//   'address'       => "Manggis 90",
		//   'city'          => "Jakarta",
		//   'postal_code'   => "16601",
		//   'phone'         => "08113366345",
		//   'country_code'  => 'IDN'
		// );

		// Optional
		$customer_details = array(
		  'first_name'	      => $nama,
		  'email'         => $email,
		  'phone'         => $telpon,
		  'billing_address'  => $billing_address,
		  
		);

		// Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit' => 'hour', 
            'duration'  => 3
        );
        
        $transaction_data = array(
            'transaction_details'=> $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
    }

    public function finish()
    {
    	$result = json_decode($this->input->post('result_data'));
		// echo 'RESULT <br><pre>';
		// var_dump($result);
		// echo '</pre>' ;
		$data['download'] = $this->Front_model->get_download_group();
		$data['title'] = 'LBH Surabaya | donasi';
		$this->load->view('front/header', $data);
		$this->load->view('page/donasi');
		$this->load->view('front/footer');

    }
}
