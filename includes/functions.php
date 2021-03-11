<?php

function randomKey($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $len_chars = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, $len_chars - 1); 
        $randomString .= $characters[$index]; 
    }
    return $randomString; 
}

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

function login_elearning($username, $password, $token) {
	$curl = curl_init();
	
	$form = [
		'username' => $username,
		'password' => $password,
		'execution' => $token,
		'_eventId' => 'submit',
		'geolocation' => ''
	];
	
	$cookies = BASE_PATH  . '/cookie_elearning.txt';

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://sso.tdmu.edu.vn/login?service=https%3A%2F%2Felearning.tdmu.edu.vn%2Flogin%2Findex.php',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS => http_build_query($form),
	  CURLOPT_HTTPHEADER => array(
		'authority: sso.tdmu.edu.vn',
		'cache-control: max-age=0',
		'upgrade-insecure-requests: 1',
		'origin: https://sso.tdmu.edu.vn',
		'content-type: application/x-www-form-urlencoded',
		'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.104 Safari/537.36',
		'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
		'referer: https://sso.tdmu.edu.vn/login',
		'accept-language: en-US,en;q=0.9,vi;q=0.8,zh-CN;q=0.7,zh;q=0.6',
	  ),
	  CURLOPT_COOKIEJAR => $cookies,
	  CURLOPT_COOKIEFILE =>  $cookies
	));

	$response = curl_exec($curl);

	curl_close($curl);
	
	
	// Elearning
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://elearning.tdmu.edu.vn/login/index.php',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTPHEADER => array(
		'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.104 Safari/537.36',
		'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
		'referer: https://sso.tdmu.edu.vn/login',
		'accept-language: en-US,en;q=0.9,vi;q=0.8,zh-CN;q=0.7,zh;q=0.6',
	  ),
	  CURLOPT_COOKIEJAR => $cookies,
	  CURLOPT_COOKIEFILE =>  $cookies
	));

	$response = curl_exec($curl);

	curl_close($curl);
	
}


function get_title_contest($contest_id) {

	$cookies = BASE_PATH  . '/cookie_elearning.txt';
	if(!file_exists($cookies) OR (filemtime($cookies) < (time() - 300))) {
		$jwtToken = 'eyJhbGciOiJIUzUxMiIsInR5cCI6IkpXVCJ9.vXkxapyl6o7XsJKIbEaWtXikqqv3BNU4l5Z7nF6oCw7SZ3tonhhabrNNjGG-exRgwnFNcQfmGSTZrGSVmJlPiW2GyGjMRb8VK8UbgaFZkGe0HSgS4piY5bu_s1cpsqva6qxVJw2zU7_9IfxPquUwxDs4IkPk5_iiMDclsJlyfttMI99FXh8yc5YUaqw4RfjsFU4wtNcEiBo3VE8CC5ylkL-JEKW48tGK7HCx1m0EDtRHTAGsdi_8VudcL5YM5fiMv60UKrvQjDNLgtAnX5Y2_PB27L2SVU5koN_j-u8jc2dS9lGyAHzHeb2MNhtWzOnzT82dJPe-nGR0DgJtrCc35olT3Czxm01QeiZQ23CvakkSmPoUTP7S-5yob69Vy_z3CKrIR-YlqvM1-g2k-BqQ12mWbk3wHE6G4HHV7WA0x33vuKTqqNGluqEOmAO439fFQHnFOD72d4FThiIix2L_coMI04bbpwCJDFnmPUzgLb3XhigZwEa90Wkg7r1naN9qnJ7atVXAbMbHzYX8uyOLFCLwJzVIdmaAwaaBbXY46AKRovEbf-fRVnXkZb6BU8D92LU-85dSKJAJUSO0B18jo_tn-kujq8n4iwa3P7xXQV7bv1nd40Obrj_aX6nRid1-9eWNT6STKN96MArhgGz8tniL7f9RUtCaP78MQ43tMGm6sUY5_B6yLKj6A6UQ702eLY8aKPwTGMleCzSpgMlA5HYkE2HOzR49OHAWzGffz2yui0Q-dxC3jdW4QcH0JH8iqXE771a1sW_gna-7MNKFLRpt0QdqSBPp_JRW_xrBFV8F1v_4U7XkrLXP1vsy2uNy0mqonEtBOv6IVWT6u61IKcOzvtG-YVleqcVc2oN6DE2NpcoZmt9ep5qKkfwdGXWQ4iVRv29eYAWNOuGQGbbMOzLSdDFKEM2tM26f_dze3wL-jKgmDodNSzCyvRYhMNnFUp1sqNo6mh1Wm-h-r5_1OXHOidgyowNVjxPrHJs6TXYd1O-aKklDH39giEu9jRw-0jc_jI3Gs4pa_ozolaCcdU360-FX7EW4egeqR9qRyiKoAOfXujGvZUA_3DNTZmVj3qIzYDa5uM6kSxRiIOTYdg._wjeqAZBm-H-oM7e9Kzj6lMeYphgymQEWoY4-PWrHKbXlWsoF-8dcA6H_b1sr6BdMtPqxQjwuCwLQlqXXhQAPw';
		$guid = strtolower(GUID());
		login_elearning(CRAWLER_USERNAME, CRAWLER_PASSWORD, $guid . '_' . base64_encode($jwtToken));
	}
	
	// Get JSON file
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://elearning.tdmu.edu.vn/mod/quiz/report.php?mode=overview&id=' . $contest_id,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTPHEADER => array(
		'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.104 Safari/537.36',
		'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
		'referer: https://sso.tdmu.edu.vn/login',
		'accept-language: en-US,en;q=0.9,vi;q=0.8,zh-CN;q=0.7,zh;q=0.6',
	  ),
	  CURLOPT_COOKIEJAR => $cookies,
	  CURLOPT_COOKIEFILE =>  $cookies
	));

	$response = curl_exec($curl);

	curl_close($curl);
	
	preg_match("'<div class=\"page-header-headings\"><h1>(.*?)</h1></div>'si", $response, $match);
	
    if ($match) {
        return $match[1];
    }
    
	return false;
}


function get_contest_result_by_json($contest_id) {

	$cookies = BASE_PATH  . '/cookie_elearning.txt';
	if(!file_exists($cookies) OR (filemtime($cookies) < (time() - 300))) {
		$jwtToken = 'eyJhbGciOiJIUzUxMiIsInR5cCI6IkpXVCJ9.vXkxapyl6o7XsJKIbEaWtXikqqv3BNU4l5Z7nF6oCw7SZ3tonhhabrNNjGG-exRgwnFNcQfmGSTZrGSVmJlPiW2GyGjMRb8VK8UbgaFZkGe0HSgS4piY5bu_s1cpsqva6qxVJw2zU7_9IfxPquUwxDs4IkPk5_iiMDclsJlyfttMI99FXh8yc5YUaqw4RfjsFU4wtNcEiBo3VE8CC5ylkL-JEKW48tGK7HCx1m0EDtRHTAGsdi_8VudcL5YM5fiMv60UKrvQjDNLgtAnX5Y2_PB27L2SVU5koN_j-u8jc2dS9lGyAHzHeb2MNhtWzOnzT82dJPe-nGR0DgJtrCc35olT3Czxm01QeiZQ23CvakkSmPoUTP7S-5yob69Vy_z3CKrIR-YlqvM1-g2k-BqQ12mWbk3wHE6G4HHV7WA0x33vuKTqqNGluqEOmAO439fFQHnFOD72d4FThiIix2L_coMI04bbpwCJDFnmPUzgLb3XhigZwEa90Wkg7r1naN9qnJ7atVXAbMbHzYX8uyOLFCLwJzVIdmaAwaaBbXY46AKRovEbf-fRVnXkZb6BU8D92LU-85dSKJAJUSO0B18jo_tn-kujq8n4iwa3P7xXQV7bv1nd40Obrj_aX6nRid1-9eWNT6STKN96MArhgGz8tniL7f9RUtCaP78MQ43tMGm6sUY5_B6yLKj6A6UQ702eLY8aKPwTGMleCzSpgMlA5HYkE2HOzR49OHAWzGffz2yui0Q-dxC3jdW4QcH0JH8iqXE771a1sW_gna-7MNKFLRpt0QdqSBPp_JRW_xrBFV8F1v_4U7XkrLXP1vsy2uNy0mqonEtBOv6IVWT6u61IKcOzvtG-YVleqcVc2oN6DE2NpcoZmt9ep5qKkfwdGXWQ4iVRv29eYAWNOuGQGbbMOzLSdDFKEM2tM26f_dze3wL-jKgmDodNSzCyvRYhMNnFUp1sqNo6mh1Wm-h-r5_1OXHOidgyowNVjxPrHJs6TXYd1O-aKklDH39giEu9jRw-0jc_jI3Gs4pa_ozolaCcdU360-FX7EW4egeqR9qRyiKoAOfXujGvZUA_3DNTZmVj3qIzYDa5uM6kSxRiIOTYdg._wjeqAZBm-H-oM7e9Kzj6lMeYphgymQEWoY4-PWrHKbXlWsoF-8dcA6H_b1sr6BdMtPqxQjwuCwLQlqXXhQAPw';
		$guid = strtolower(GUID());
		login_elearning(CRAWLER_USERNAME, CRAWLER_PASSWORD, $guid . '_' . base64_encode($jwtToken));
	}
	
	// Get JSON file
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://elearning.tdmu.edu.vn/mod/quiz/report.php?download=json&mode=overview&id=' . $contest_id,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTPHEADER => array(
		'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.104 Safari/537.36',
		'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
		'referer: https://sso.tdmu.edu.vn/login',
		'accept-language: en-US,en;q=0.9,vi;q=0.8,zh-CN;q=0.7,zh;q=0.6',
	  ),
	  CURLOPT_COOKIEJAR => $cookies,
	  CURLOPT_COOKIEFILE =>  $cookies
	));

	$response = curl_exec($curl);

	curl_close($curl);
	
	// echo $response;
	
	$contest_result = json_decode($response);
	
	if (isset($contest_result[0]) && count($contest_result[0]) > 0) {
	    file_put_contents(BASE_PATH . '/data/' . $contest_id . '.json', json_encode($contest_result[0]));
	    return $contest_result[0];
	}
	
	return false;
}