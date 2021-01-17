<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// -- Define WebPush namespaces
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

// -- Change the name of the controller to Main
class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->model('main_model');
		$this->load->helper(['url']);
	}

	public function index()
	{
		$this->load->view('index');
	}

	/* ------------------------------------------ Web Push Notifications ---------------------------------------------------- */

	public function push_subscription() {

		$subscription = json_decode(file_get_contents('php://input'), true); // for PHP 7
		$_POST = $subscription;

		if (!isset($subscription['endpoint'])) {
			echo 'Error: not a subscription';
			return;
		}

		$method = $_SERVER['REQUEST_METHOD'];

		switch ($method) {
			case 'POST':
				// create a new subscription entry in your database (endpoint is unique)
				//filter out bad data
				$myQuery = $this->db->query("SELECT * FROM subscribers WHERE endpoint = '".$this->input->post('endpoint')."'");
				try{
					$result = $myQuery->result();
					if(empty($result)) {
						$insert_data = array(
							'endpoint' => $this->input->post('endpoint'),
							'auth' => $this->input->post('authToken'),
							'p256dh' => $this->input->post('publicKey')
						);
			
						if ($this->main_model->insert('subscribers', $insert_data)) {
							echo 'Subscribtion successful.';
						} else {
							echo 'Sorry there is some problem.';
						}
					}
				}
				catch(Exception $error) {
					echo 'Sorry there has been an error processing your request!';
				}
				break;
			case 'PUT':
				// update the key and token of subscription corresponding to the endpoint
				//filter out bad data
				$myQuery = $this->db->query("SELECT * FROM subscribers WHERE endpoint = '".$this->input->post('endpoint')."'");
				print_r($myQuery);
				try{
					$result = $myQuery->result();
					if($result[0]->id !== NULL) {
						$insert_data = array(
							'endpoint' => $this->input->post('endpoint'),
							'auth' => $this->input->post('authToken'),
							'p256dh' => $this->input->post('publicKey')
						);
			
						if ($this->main_model->update_record('subscribers', $result[0]->id, $insert_data)) {
							echo 'Subscribtion updated successful.';
						} else {
							echo 'Sorry there is some problem.';
						}
					}
				}
				catch(Exception $error) {
					echo 'Sorry there has been an error processing your request!';
				}
				break;
			case 'DELETE':
				// delete the subscription corresponding to the endpoint
				$myQuery = $this->db->query("SELECT * FROM subscribers WHERE endpoint = '".$this->input->post('endpoint')."'");
				try{
					$result = $myQuery->result();
					if(!empty($result[0]->id)) {
			
						if ($this->main_model->delete_record('subscribers', $result[0]->id)) {
							echo 'Unsubscribtion successful.';
						} else {
							echo 'Sorry there is some problem.';
						}
					}
				}
				catch(Exception $error) {
					echo 'Sorry there has been an error processing your request!';
				}
				break;
			default:
				echo "Error: method not handled";
				return;
		}

	}

	public function send_push_notification() {

		// here I'll get the subscription endpoint in the POST parameters
		// but in reality, you'll get this information in your database
		// because you already stored it (cf. push_subscription.php)
		$query = $this->admin_model->get_data('subscribers')->result();
		foreach($query as $row) {

			$data = array(
				"contentEncoding" => "aesgcm",
				"endpoint" => $row->endpoint,
				"keys" => array(
						"auth" => $row->auth,
						"p256dh" => $row->p256dh
					)
			);
			// $subscription = Subscription::create(json_decode(file_get_contents('php://input'), true));
			$subscription = Subscription::create($data);

			$auth = array(
				'VAPID' => array(
					'subject' => 'PHP Codeigniter Web Push Notification',
					'publicKey' => file_get_contents(APPPATH . './../keys/public_key.txt'), // don't forget that your public key also lives in app.js
					'privateKey' => file_get_contents(APPPATH . './../keys/private_key.txt'), // in the real world, this would be in a secret file
				),
			);

			$webPush = new WebPush($auth);

			$options = [
				'title' => 'کمپلهای ترکی اصلی',
				'body' => 'DEM Online Shopping',
				'icon' => 'assets/img/dem_logo.png',
				'badge' => 'assets/img/dem_logo.png',
				'url' => 'https://localhost/dem.af/shop'
			];
			$report = $webPush->sendOneNotification(
				$subscription,
				json_encode($options)
			);

			// handle eventual errors here, and remove the subscription from your server if it is expired
			$endpoint = $report->getRequest()->getUri()->__toString();

			if ($report->isSuccess()) {
				echo "[v] Message sent successfully for subscription {$endpoint}.";
			} else {
				echo "[x] Message failed to sent for subscription {$endpoint}: {$report->getReason()}";
			}
		}
	}
}
