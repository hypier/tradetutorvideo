<?php

require_once("Rest.inc.php");

	class API extends REST {

		public $data = "";
		const demo_version = false;

		private $db 	= NULL;
		private $mysqli = NULL;
		public function __construct() {
			// Init parent contructor
			parent::__construct();
			// Initiate Database connection
			$this->dbConnect();	
		}

		/*
		 *  Connect to Database
		*/
		private function dbConnect() {
			require_once ("../includes/config.php");
			$this->mysqli = new mysqli($host, $user, $pass, $database);
			$this->mysqli->query('SET CHARACTER SET utf8');
		}

		public function processApi() {
			if(isset($_REQUEST['x']) && $_REQUEST['x']!=""){
				$func = strtolower(trim(str_replace("/","", $_REQUEST['x'])));
				if((int)method_exists($this,$func) > 0) {
					$this->$func();
				} else {
					header( 'Content-Type: application/json; charset=utf-8' );
					echo 'processApi - method not exist';
					exit;
				}
			} else {
				header( 'Content-Type: application/json; charset=utf-8' );
				echo 'processApi - method not exist';
				exit;
			}
		}		

		/* Api Checker */
		private function check_connection() {
			if (mysqli_ping($this->mysqli)) {
				//echo "Responses : Congratulations, database successfully connected.";
                $respon = array(
                    'status' => 'ok', 'database' => 'connected'
                );
                $this->response($this->json($respon), 200);
			} else {
                $respon = array(
                    'status' => 'failed', 'database' => 'not connected'
                );
                $this->response($this->json($respon), 404);
			}
		}

		private function get_total_views() {

			include "../includes/config.php";

			$jsonObj = array();	

			$query = "SELECT * FROM tbl_gallery WHERE id='".$_GET['id']."'";
			$sql = mysqli_query($connect, $query) or die(mysqli_error());

			while ($data = mysqli_fetch_assoc($sql)) {
				
				$row['id'] = $data['id'];
				$row['video_title'] = $data['video_title'];
				$row['total_views'] = $data['total_views'];
				
				array_push($jsonObj, $row);
				
			}

			$view_qry = mysqli_query($connect, "UPDATE tbl_gallery SET total_views = total_views + 1 WHERE id = '".$_GET['id']."'");
			

			$set['result'] = $jsonObj;
			
			header( 'Content-Type: application/json; charset=utf-8' );
			echo $val= str_replace('\\/', '/', json_encode($set, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
			die();	

		}

		private function get_videos() {
			
			include "../includes/config.php";
		    $setting_qry    = "SELECT * FROM tbl_settings where id = '1'";
		    $setting_result = mysqli_query($connect, $setting_qry);
		    $settings_row   = mysqli_fetch_assoc($setting_result);
		    $api_key    = $settings_row['api_key']; 

			if (isset($_GET['api_key'])) {

				$access_key_received = $_GET['api_key'];
				
				if ($access_key_received == $api_key) {

					$sort = $_GET['sort'];

					if($this->get_request_method() != "GET") $this->response('',406);
					$limit = isset($this->_request['count']) ? ((int)$this->_request['count']) : 10;
					$page = isset($this->_request['page']) ? ((int)$this->_request['page']) : 1;
					
					$offset = ($page * $limit) - $limit;
					$count_total = $this->get_count_result("SELECT COUNT(DISTINCT n.id) FROM tbl_gallery n WHERE n.video_status = '1' ");
					
					$query = "SELECT DISTINCT 
								n.id AS 'vid',
								n.cat_id,
								n.video_title, 
								n.video_url, 
								n.video_id,
								n.video_thumbnail,
								n.video_duration,
								n.video_description,
								n.video_type,
								n.size,
								n.total_views,
								n.date_time,
								
								c.category_name
								
							FROM 
								tbl_gallery n, 
								tbl_category c 
								
							WHERE 
								n.video_status = '1' AND
								n.cat_id = c.cid ORDER BY $sort LIMIT $limit OFFSET $offset";
							  
					$post = $this->get_list_result($query);
					$count = count($post);
					$respon = array(
						'status' => 'ok', 'count' => $count, 'count_total' => $count_total, 'pages' => $page, 'posts' => $post
					);
					$this->response($this->json($respon), 200);

				} else {
					die ('Oops, API Key is Incorrect!');
				}
			} else {
				die ('Forbidden, API Key is Required!');
			}

		}
		
		private function get_posts() {
			
			include "../includes/config.php";
		    $setting_qry    = "SELECT * FROM tbl_settings where id = '1'";
		    $setting_result = mysqli_query($connect, $setting_qry);
		    $settings_row   = mysqli_fetch_assoc($setting_result);
		    $api_key    = $settings_row['api_key']; 

			if (isset($_GET['api_key'])) {

				$access_key_received = $_GET['api_key'];
				
				if ($access_key_received == $api_key) {

					if($this->get_request_method() != "GET") $this->response('',406);
					$limit = isset($this->_request['count']) ? ((int)$this->_request['count']) : 10;
					$page = isset($this->_request['page']) ? ((int)$this->_request['page']) : 1;
					
					$offset = ($page * $limit) - $limit;
					$count_total = $this->get_count_result("SELECT COUNT(DISTINCT n.id) FROM tbl_gallery n WHERE n.video_status = '1' ");
					
					$query = "SELECT DISTINCT 
								n.id AS 'vid',
								n.cat_id,
								n.video_title, 
								n.video_url, 
								n.video_id,
								n.video_thumbnail,
								n.video_duration,
								n.video_description,
								n.video_type,
								n.size,
								n.total_views,
								n.date_time,
								
								c.category_name
								
							FROM 
								tbl_gallery n, 
								tbl_category c 
								
							WHERE n.video_status = '1' AND
								n.cat_id = c.cid ORDER BY n.id DESC LIMIT $limit OFFSET $offset";
							  
					$post = $this->get_list_result($query);
					$count = count($post);
					$respon = array(
						'status' => 'ok', 'count' => $count, 'count_total' => $count_total, 'pages' => $page, 'posts' => $post
					);
					$this->response($this->json($respon), 200);

				} else {
					die ('Oops, API Key is Incorrect!');
				}
			} else {
				die ('Forbidden, API Key is Required!');
			}

		}


		private function get_popular() {
			
			include "../includes/config.php";
		    $setting_qry    = "SELECT * FROM tbl_settings where id = '1'";
		    $setting_result = mysqli_query($connect, $setting_qry);
		    $settings_row   = mysqli_fetch_assoc($setting_result);
		    $api_key    = $settings_row['api_key']; 

			if (isset($_GET['api_key'])) {

				$access_key_received = $_GET['api_key'];
				
				if ($access_key_received == $api_key) {

					if($this->get_request_method() != "GET") $this->response('',406);
					$limit = isset($this->_request['count']) ? ((int)$this->_request['count']) : 10;
					$page = isset($this->_request['page']) ? ((int)$this->_request['page']) : 1;
					
					$offset = ($page * $limit) - $limit;
					$count_total = $this->get_count_result("SELECT COUNT(DISTINCT n.id) FROM tbl_gallery n WHERE n.video_status = '1' ");
					
					$query = "SELECT DISTINCT 
								n.id AS 'vid',
								n.cat_id,
								n.video_title, 
								n.video_url, 
								n.video_id,
								n.video_thumbnail,
								n.video_duration,
								n.video_description,
								n.video_type,
								n.size,
								n.total_views,
								n.date_time,
								
								c.category_name
								
							FROM 
								tbl_gallery n, 
								tbl_category c 
								
							WHERE n.video_status = '1' AND
								n.cat_id = c.cid ORDER BY n.total_views DESC LIMIT $limit OFFSET $offset";
							  
					$post = $this->get_list_result($query);
					$count = count($post);
					$respon = array(
						'status' => 'ok', 'count' => $count, 'count_total' => $count_total, 'pages' => $page, 'posts' => $post
					);
					$this->response($this->json($respon), 200);

				} else {
					die ('Oops, API Key is Incorrect!');
				}
			} else {
				die ('Forbidden, API Key is Required!');
			}

		}

		private function get_oldest() {
			
			include "../includes/config.php";
		    $setting_qry    = "SELECT * FROM tbl_settings where id = '1'";
		    $setting_result = mysqli_query($connect, $setting_qry);
		    $settings_row   = mysqli_fetch_assoc($setting_result);
		    $api_key    = $settings_row['api_key']; 

			if (isset($_GET['api_key'])) {

				$access_key_received = $_GET['api_key'];
				
				if ($access_key_received == $api_key) {

					if($this->get_request_method() != "GET") $this->response('',406);
					$limit = isset($this->_request['count']) ? ((int)$this->_request['count']) : 10;
					$page = isset($this->_request['page']) ? ((int)$this->_request['page']) : 1;
					
					$offset = ($page * $limit) - $limit;
					$count_total = $this->get_count_result("SELECT COUNT(DISTINCT n.id) FROM tbl_gallery n WHERE n.video_status = '1' ");
					
					$query = "SELECT DISTINCT 
								n.id AS 'vid',
								n.cat_id,
								n.video_title, 
								n.video_url, 
								n.video_id,
								n.video_thumbnail,
								n.video_duration,
								n.video_description,
								n.video_type,
								n.size,
								n.total_views,
								n.date_time,
								
								c.category_name
								
							FROM 
								tbl_gallery n, 
								tbl_category c 
								
							WHERE n.video_status = '1' AND
								n.cat_id = c.cid ORDER BY n.id ASC LIMIT $limit OFFSET $offset";
							  
					$post = $this->get_list_result($query);
					$count = count($post);
					$respon = array(
						'status' => 'ok', 'count' => $count, 'count_total' => $count_total, 'pages' => $page, 'posts' => $post
					);
					$this->response($this->json($respon), 200);

				} else {
					die ('Oops, API Key is Incorrect!');
				}
			} else {
				die ('Forbidden, API Key is Required!');
			}

		}


		public function get_post_detail() {

	    	$id = $_GET['id'];

		    include "../includes/config.php";

	    	$setting_qry    = "SELECT cat_id FROM tbl_gallery WHERE id = $id";
			$setting_result = mysqli_query($connect, $setting_qry);
			$settings_row   = mysqli_fetch_assoc($setting_result);
			$category_id    = $settings_row['cat_id'];

			if($this->get_request_method() != "GET") $this->response('',406);

			$query_post = "SELECT DISTINCT
								n.id AS 'vid',
								n.cat_id,
								n.video_title, 
								n.video_url, 
								n.video_id,
								n.video_thumbnail,
								n.video_duration,
								n.video_description,
								n.video_type,
								n.size,
								n.total_views,
								n.date_time,
									
								c.category_name			

							FROM 
								tbl_gallery n, 
								tbl_category c 

							WHERE n.cat_id = c.cid AND n.video_status = '1' AND n.id = $id
									 
							LIMIT 1";

			$query_suggested = "SELECT DISTINCT

								n.id AS 'vid',
								n.cat_id,
								n.video_title, 
								n.video_url, 
								n.video_id,
								n.video_thumbnail,
								n.video_duration,
								n.video_description,
								n.video_type,
								n.size,
								n.total_views,
								n.date_time,
								
								c.category_name
								  	
								FROM 
									tbl_gallery n, 
									tbl_category c

								  WHERE n.cat_id = c.cid AND n.video_status = '1' AND n.id != $id AND n.cat_id = $category_id

								  ORDER BY n.id 

								  DESC LIMIT 5";

			$post = $this->get_one_detail($query_post);
			$suggested = $this->get_list_result($query_suggested);
			$count = count($post);
			$respon = array(
				'status' => 'ok', 'post' => $post, 'suggested' => $suggested
			);
			$this->response($this->json($respon), 200);

	    }		
		
		private function get_category_index() {

			include "../includes/config.php";
		    $setting_qry    = "SELECT * FROM tbl_settings where id = '1'";
		    $setting_result = mysqli_query($connect, $setting_qry);
		    $settings_row   = mysqli_fetch_assoc($setting_result);
		    $api_key    = $settings_row['api_key']; 

			if (isset($_GET['api_key'])) {

				$access_key_received = $_GET['api_key'];
				
				if ($access_key_received == $api_key) {

					if($this->get_request_method() != "GET") $this->response('',406);
					$count_total = $this->get_count_result("SELECT COUNT(DISTINCT cid) FROM tbl_category");

					$query = "SELECT DISTINCT c.cid, c.category_name, c.category_image, COUNT(DISTINCT r.id) as video_count
					  FROM tbl_category c LEFT JOIN tbl_gallery r ON c.cid = r.cat_id AND r.video_status = '1' GROUP BY c.cid ORDER BY c.cid DESC";

					$news = $this->get_list_result($query);
					$count = count($news);
					$respon = array(
						'status' => 'ok', 'count' => $count, 'categories' => $news
					);
					$this->response($this->json($respon), 200);

				} else {
						die ('Oops, API Key is Incorrect!');
				}
			} else {
				die ('Forbidden, API Key is Required!');
			}
		}

		private function get_category_videos() {

			include "../includes/config.php";
		    $setting_qry    = "SELECT * FROM tbl_settings WHERE id = '1'";
		    $setting_result = mysqli_query($connect, $setting_qry);
		    $settings_row   = mysqli_fetch_assoc($setting_result);
		    $api_key    = $settings_row['api_key']; 

			if (isset($_GET['api_key'])) {

				$access_key_received = $_GET['api_key'];
				
				if ($access_key_received == $api_key) {

					$id = $_GET['id'];
					$sort = $_GET['sort'];

					if($this->get_request_method() != "GET") $this->response('',406);
					$limit = isset($this->_request['count']) ? ((int)$this->_request['count']) : 10;
					$page = isset($this->_request['page']) ? ((int)$this->_request['page']) : 1;
					
					$offset = ($page * $limit) - $limit;
					$count_total = $this->get_count_result("SELECT COUNT(DISTINCT id) FROM tbl_gallery WHERE video_status = '1' AND cat_id = '$id'");
					
					$query = "SELECT DISTINCT 
								cid,
								category_name,
								category_image
								
							FROM
								tbl_category 

							WHERE 
								cid = '$id'

							ORDER BY cid DESC";

					$query2 = "SELECT DISTINCT 
								n.id AS 'vid',
								n.cat_id,
								n.video_title, 
								n.video_url, 
								n.video_id,
								n.video_thumbnail,
								n.video_duration,
								n.video_description,
								n.video_type,
								n.size,
								n.total_views,
								n.date_time,
								
								c.category_name
								
							FROM 
								tbl_gallery n, 
								tbl_category c 
								
							WHERE 
								n.video_status = '1' AND
								n.cat_id = c.cid AND c.cid = '$id' ORDER BY $sort LIMIT $limit OFFSET $offset";
							  
					$category = $this->get_category_result($query);
					$post = $this->get_list_result($query2);
					$count = count($post);
					$respon = array(
						'status' => 'ok', 'count' => $count, 'count_total' => $count_total, 'pages' => $page, 'category' => $category, 'posts' => $post
					);
					$this->response($this->json($respon), 200);

				} else {
						die ('Oops, API Key is Incorrect!');
				}
			} else {
				die ('Forbidden, API Key is Required!');
			}

		}

		private function get_category_posts() {

			include "../includes/config.php";
		    $setting_qry    = "SELECT * FROM tbl_settings where id = '1'";
		    $setting_result = mysqli_query($connect, $setting_qry);
		    $settings_row   = mysqli_fetch_assoc($setting_result);
		    $api_key    = $settings_row['api_key']; 

			if (isset($_GET['api_key'])) {

				$access_key_received = $_GET['api_key'];
				
				if ($access_key_received == $api_key) {

					$id = $_GET['id'];

					if($this->get_request_method() != "GET") $this->response('',406);
					$limit = isset($this->_request['count']) ? ((int)$this->_request['count']) : 10;
					$page = isset($this->_request['page']) ? ((int)$this->_request['page']) : 1;
					
					$offset = ($page * $limit) - $limit;
					$count_total = $this->get_count_result("SELECT COUNT(DISTINCT id) FROM tbl_gallery WHERE video_status = '1' AND cat_id = '$id'");
					
					$query = "SELECT DISTINCT 
								cid,
								category_name,
								category_image
								
							FROM
								tbl_category 

							WHERE 
								cid = '$id'

							ORDER BY cid DESC";

					$query2 = "SELECT DISTINCT 
								n.id AS 'vid',
								n.cat_id,
								n.video_title, 
								n.video_url, 
								n.video_id,
								n.video_thumbnail,
								n.video_duration,
								n.video_description,
								n.video_type,
								n.size,
								n.total_views,
								n.date_time,
								
								c.category_name
								
							FROM 
								tbl_gallery n, 
								tbl_category c 
								
							WHERE 
								n.video_status = '1' AND
								n.cat_id = c.cid AND c.cid = '$id' ORDER BY n.id DESC LIMIT $limit OFFSET $offset";
							  
					$category = $this->get_category_result($query);
					$post = $this->get_list_result($query2);
					$count = count($post);
					$respon = array(
						'status' => 'ok', 'count' => $count, 'count_total' => $count_total, 'pages' => $page, 'category' => $category, 'posts' => $post
					);
					$this->response($this->json($respon), 200);

				} else {
						die ('Oops, API Key is Incorrect!');
				}
			} else {
				die ('Forbidden, API Key is Required!');
			}

		}

		private function get_search_results() {

			include "../includes/config.php";
		    $setting_qry    = "SELECT * FROM tbl_settings where id = '1'";
		    $setting_result = mysqli_query($connect, $setting_qry);
		    $settings_row   = mysqli_fetch_assoc($setting_result);
		    $api_key    = $settings_row['api_key']; 

			if (isset($_GET['api_key'])) {

				$access_key_received = $_GET['api_key'];
				
				if ($access_key_received == $api_key) {

					$search = $_GET['search'];

					if($this->get_request_method() != "GET") $this->response('',406);
					$limit = isset($this->_request['count']) ? ((int)$this->_request['count']) : 10;
					$page = isset($this->_request['page']) ? ((int)$this->_request['page']) : 1;
					
					$offset = ($page * $limit) - $limit;
					$count_total = $this->get_count_result("SELECT COUNT(DISTINCT n.id) FROM tbl_gallery n, tbl_category c WHERE n.cat_id = c.cid AND n.video_status = '1' AND (n.video_title LIKE '%$search%' OR n.video_description LIKE '%$search%')");

					$query = "SELECT DISTINCT 
								n.id AS 'vid',
								n.cat_id,
								n.video_title, 
								n.video_url, 
								n.video_id,
								n.video_thumbnail,
								n.video_duration,
								n.video_description,
								n.video_type,
								n.size,
								n.total_views,
								n.date_time,
								
								c.category_name
								
							FROM 
								tbl_gallery n, 
								tbl_category c 
								
							WHERE n.cat_id = c.cid AND n.video_status = '1' AND (n.video_title LIKE '%$search%' OR n.video_description LIKE '%$search%') 

							LIMIT $limit OFFSET $offset";
							  
					$post = $this->get_list_result($query);
					$count = count($post);
					$respon = array(
						'status' => 'ok', 'count' => $count, 'count_total' => $count_total, 'pages' => $page, 'posts' => $post
					);
					$this->response($this->json($respon), 200);

				} else {
						die ('Oops, API Key is Incorrect!');
				}
			} else {
				die ('Forbidden, API Key is Required!');
			}

		}
		
		private function get_search_category_results() {

			include "../includes/config.php";
				$setting_qry    = "SELECT * FROM tbl_settings where id = '1'";
				$setting_result = mysqli_query($connect, $setting_qry);
				$settings_row   = mysqli_fetch_assoc($setting_result);
				$api_key    = $settings_row['api_key'];

				if (isset($_GET['api_key'])) {

					$access_key_received = $_GET['api_key'];

					if ($access_key_received == $api_key) {

						$search = $_GET['search'];

						if($this->get_request_method() != "GET") $this->response('',406);
						$limit = isset($this->_request['count']) ? ((int)$this->_request['count']) : 10;
						$page = isset($this->_request['page']) ? ((int)$this->_request['page']) : 1;

						$offset = ($page * $limit) - $limit;
						$count_total = $this->get_count_result("SELECT COUNT(DISTINCT c.cid) FROM tbl_category c WHERE (c.category_name LIKE '%$search%')");
						
						$query = "SELECT DISTINCT c.cid, c.category_name, c.category_image, COUNT(DISTINCT r.id) as post_count
						  FROM tbl_category c LEFT JOIN tbl_gallery r ON c.cid = r.cat_id 
						  
						   WHERE (c.category_name LIKE '%$search%')
						  
						  GROUP BY c.cid ORDER BY c.cid DESC LIMIT $limit OFFSET $offset";

						$post = $this->get_list_result($query);
						$count = count($post);
						$respon = array(
							'status' => 'ok', 'count' => $count, 'count_total' => $count_total, 'pages' => $page, 'posts' => $post
						);
						$this->response($this->json($respon), 200);

					} else {
						$respon = array( 'status' => 'failed', 'message' => 'Oops, API Key is Incorrect!');
						$this->response($this->json($respon), 404);
					}
				} else {
					$respon = array( 'status' => 'failed', 'message' => 'Forbidden, API Key is Required!');
					$this->response($this->json($respon), 404);
				}

		}

		private function get_settings() {

			include "../includes/config.php";
			include "../functions.php";

			$setting_qry    = "SELECT * FROM tbl_settings WHERE id = '1'";
			$setting_result = mysqli_query($connect, $setting_qry);
			$settings_row   = mysqli_fetch_assoc($setting_result);
			$api_key    = $settings_row['api_key'];

			if (isset($_GET['api_key'])) {

				$access_key_received = $_GET['api_key'];

				if ($access_key_received == $api_key) {			

					if($this->get_request_method() != "GET") $this->response('',406);

					$sql_api_key = "SELECT * FROM tbl_settings WHERE id = 1";
					$key_result = $connect->query($sql_api_key);
					$key_row = $key_result->fetch_assoc();
					$youtube_api_key = encrypt($key_row['youtube_api_key']);

					$sql_settings = "SELECT package_name, onesignal_app_id, fcm_notification_topic, more_apps_url, privacy_policy  FROM tbl_settings WHERE id = 1";
					$sql_ads = "SELECT * FROM tbl_ads WHERE id = 1";
					$sql_placements = "SELECT * FROM tbl_ads_placement WHERE ads_placement_id = 1";

					$settings = $this->get_one_result($sql_settings);
					$ads = $this->get_one_result($sql_ads);
					$ads_placement = $this->get_one_result($sql_placements);

					$respon = array(
						'status' => 'ok', 'key' => $youtube_api_key, 'settings' => $settings, 'ads' => $ads, 'ads_placement' => $ads_placement
					);
					$this->response($this->json($respon), 200);

				} else {
					die ('Oops, API Key is Incorrect!');
				}
			} else {
				die ('Forbidden, API Key is Required!');
			}			

		}

		private function get_config() {

			include "../includes/config.php";
			include "../functions.php";

			$setting_qry    = "SELECT * FROM tbl_settings WHERE id = '1'";
			$setting_result = mysqli_query($connect, $setting_qry);
			$settings_row   = mysqli_fetch_assoc($setting_result);
			$api_key    = $settings_row['api_key'];

			if (isset($_GET['api_key'])) {

				$access_key_received = $_GET['api_key'];
				$package_name = $_GET['package_name'];

				if ($access_key_received == $api_key) {			

					if($this->get_request_method() != "GET") $this->response('',406);

					$sql_api_key = "SELECT * FROM tbl_settings WHERE id = 1";
					$key_result = $connect->query($sql_api_key);
					$key_row = $key_result->fetch_assoc();
					$youtube_api_key = encrypt($key_row['youtube_api_key']);

					$sql_settings = "SELECT onesignal_app_id, fcm_notification_topic, more_apps_url, privacy_policy, providers FROM tbl_settings WHERE id = 1";
					$sql_ads = "SELECT * FROM tbl_ads WHERE id = 1";
					$sqlApp = "SELECT package_name, status, redirect_url FROM tbl_app_config WHERE package_name = '$package_name' LIMIT 1 ";
					$sql_placements = "SELECT * FROM tbl_ads_placement WHERE ads_placement_id = 1";

					$settings = $this->get_one_result($sql_settings);
					$ads = $this->get_one_result($sql_ads);
					$ads_placement = $this->get_one_result($sql_placements);

					$appCount = count($this->get_list_result($sqlApp));
					$app = $this->get_one_result($sqlApp);
					$AppArray = array( 'package_name' => '', 'status' => '', 'redirect_url' => '');

					if ($appCount > 0) {
						$respon = array('status' => 'ok', 'key' => $youtube_api_key, 'app' => $app, 'settings' => $settings, 'ads' => $ads, 'ads_placement' => $ads_placement);
					} else {
						$respon = array('status' => 'ok', 'key' => $youtube_api_key, 'app' => $AppArray, 'settings' => $settings, 'ads' => $ads, 'ads_placement' => $ads_placement);
					}


					$this->response($this->json($respon), 200);

				} else {
					die ('Oops, API Key is Incorrect!');
				}
			} else {
				die ('Forbidden, API Key is Required!');
			}			

		}		
		
		private function get_ads() {

			include "../includes/config.php";
			$setting_qry    = "SELECT * FROM tbl_settings where id = '1'";
			$setting_result = mysqli_query($connect, $setting_qry);
			$settings_row   = mysqli_fetch_assoc($setting_result);
			$api_key    = $settings_row['api_key'];

			if (isset($_GET['api_key'])) {

				$access_key_received = $_GET['api_key'];

				if ($access_key_received == $api_key) {			

					if($this->get_request_method() != "GET") $this->response('',406);

					$query = "SELECT a.*, s.youtube_api_key, s.fcm_notification_topic, s.onesignal_app_id FROM tbl_ads a, tbl_settings s WHERE a.id = 1 AND s.id = 1";

					$result = $this->get_one_result($query);
					$respon = array(
						'status' => 'ok', 'ads' => $result
					);
					$this->response($this->json($respon), 200);

				} else {
					die ('Oops, API Key is Incorrect!');
				}
			} else {
				die ('Forbidden, API Key is Required!');
			}			

		}

		private function get_privacy_policy() {

			include "../includes/config.php";

			$setting_qry    = "SELECT * FROM tbl_settings WHERE id = '1'";
		    $setting_result = mysqli_query($connect, $setting_qry);
		    $settings_row   = mysqli_fetch_assoc($setting_result);
		    $api_key    = $settings_row['api_key']; 

			if (isset($_GET['api_key'])) {

				$access_key_received = $_GET['api_key'];
				
				if ($access_key_received == $api_key) {

					$sql = "SELECT * FROM tbl_settings WHERE id = 1";
					$result = mysqli_query($connect, $sql);

					header( 'Content-Type: application/json; charset=utf-8' );
					print json_encode(mysqli_fetch_assoc($result));

			} else {
					die ('Oops, API Key is Incorrect!');
				}
			} else {
				die ('Forbidden, API Key is Required!');
			}

		}

		public function get_user_token() {

		    $user_unique_id = $_GET['user_unique_id'];

			if($this->get_request_method() != "GET") $this->response('', 406);

			$query_post = "SELECT * FROM tbl_fcm_token WHERE user_unique_id = $user_unique_id ";

			$post = $this->get_one_result($query_post);
			$count = count($post);
			$respon = array(
				'status' => 'ok', 'response' => $post
			);
			$this->response($this->json($respon), 200);
		}

		public function get_package_name() {

			include "../includes/config.php";
				
			$sql = "SELECT package_name FROM tbl_settings WHERE id = 1";
			$result = mysqli_query($connect, $sql);

			header( 'Content-Type: application/json; charset=utf-8' );
			print json_encode(mysqli_fetch_assoc($result));

		}		


		 /*
		 * ======================================================================================================
		 * =============================== API utilities # DO NOT EDIT ==========================================
		 */

		private function get_list($query) {
			$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
			if($r->num_rows > 0) {
				$result = array();
				while($row = $r->fetch_assoc()) {
					$result[] = $row;
				}
				$this->response($this->json($result), 200); // send user details
			}
			$this->response('',204);	// If no records "No Content" status
		}
		
		private function get_list_result($query) {
			$result = array();
			$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
			if($r->num_rows > 0) {
				while($row = $r->fetch_assoc()) {
					$result[] = $row;
				}
			}
			return $result;
		}

		private function get_category_result($query) {
			$result = array();
			$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
			if($r->num_rows > 0) {
				while($row = $r->fetch_assoc()) {
					$result = $row;
				}
			}
			return $result;
		}

		private function get_one_result($query) {
			$result = array();
			$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
			if($r->num_rows > 0) $result = $r->fetch_assoc();
				return $result;
		}

		private function get_one($query) {
			$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
			if($r->num_rows > 0) {
				$result = $r->fetch_assoc();
				$this->response($this->json($result), 200); // send user details
			}
			$this->response('',204);	// If no records "No Content" status
		}

		private function get_one_detail($query) {
			$result = array();
			$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
			if($r->num_rows > 0) $result = $r->fetch_assoc();
			return $result;
		}		
		
		private function get_count($query) {
			$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
			if($r->num_rows > 0) {
				$result = $r->fetch_row();
				$this->response($result[0], 200); 
			}
			$this->response('',204);	// If no records "No Content" status
		}
		
		private function get_count_result($query) {
			$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
			if($r->num_rows > 0) {
				$result = $r->fetch_row();
				return $result[0];
			}
			return 0;
		}
		
		private function post_one($obj, $column_names, $table_name) {
			$keys 		= array_keys($obj);
			$columns 	= '';
			$values 	= '';
			foreach($column_names as $desired_key) { // Check the recipe received. If blank insert blank into the array.
			  if(!in_array($desired_key, $keys)) {
			   	$$desired_key = '';
				} else {
					$$desired_key = $obj[$desired_key];
				}
				$columns 	= $columns.$desired_key.',';
				$values 	= $values."'".$this->real_escape($$desired_key)."',";
			}
			$query = "INSERT INTO ".$table_name."(".trim($columns,',').") VALUES(".trim($values,',').")";
			//echo "QUERY : ".$query;
			if(!empty($obj)) {
				//$r = $this->mysqli->query($query) or trigger_error($this->mysqli->error.__LINE__);
				if ($this->mysqli->query($query)) {
					$status = "success";
			    $msg 		= $table_name." created successfully";
				} else {
					$status = "failed";
			    $msg 		= $this->mysqli->error.__LINE__;
				}
				$resp = array('status' => $status, "msg" => $msg, "data" => $obj);
				$this->response($this->json($resp),200);
			} else {
				$this->response('',204);	//"No Content" status
			}
		}

		private function post_update($id, $obj, $column_names, $table_name) {
			$keys = array_keys($obj[$table_name]);
			$columns = '';
			$values = '';
			foreach($column_names as $desired_key){ // Check the recipe received. If key does not exist, insert blank into the array.
			  if(!in_array($desired_key, $keys)) {
			   	$$desired_key = '';
				} else {
					$$desired_key = $obj[$table_name][$desired_key];
				}
				$columns = $columns.$desired_key."='".$this->real_escape($$desired_key)."',";
			}

			$query = "UPDATE ".$table_name." SET ".trim($columns,',')." WHERE id=$id";
			if(!empty($obj)) {
				// $r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
				if ($this->mysqli->query($query)) {
					$status = "success";
					$msg 	= $table_name." update successfully";
				} else {
					$status = "failed";
					$msg 	= $this->mysqli->error.__LINE__;
				}
				$resp = array('status' => $status, "msg" => $msg, "data" => $obj);
				$this->response($this->json($resp),200);
			} else {
				$this->response('',204);	// "No Content" status
			}
		}

		private function delete_one($id, $table_name) {
			if($id > 0) {
				$query="DELETE FROM ".$table_name." WHERE id = $id";
				if ($this->mysqli->query($query)) {
					$status = "success";
			    $msg 		= "One record " .$table_name." successfully deleted";
				} else {
					$status = "failed";
			    $msg 		= $this->mysqli->error.__LINE__;
				}
				$resp = array('status' => $status, "msg" => $msg);
				$this->response($this->json($resp),200);
			} else {
				$this->response('',204);	// If no records "No Content" status
			}
		}
		
		private function responseInvalidParam() {
			$resp = array("status" => 'Failed', "msg" => 'Invalid Parameter' );
			$this->response($this->json($resp), 200);
		}

		/* ==================================== End of API utilities ==========================================
		 * ====================================================================================================
		 */

		/* Encode array into JSON */
		private function json($data) {
			if(is_array($data)) {
				return json_encode($data, JSON_NUMERIC_CHECK);
			}
		}

		/* String mysqli_real_escape_string */
		private function real_escape($s) {
			return mysqli_real_escape_string($this->mysqli, $s);
		}
	}

	// Initiiate Library

	$api = new API;
	$api->processApi();
?>
