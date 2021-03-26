<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends My_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('bcrypt');
        $this->load->helper('captcha');

        $this->controller = 'auth';
        $this->secretKey  = 'R3$7!n';
    }

    public function index_get()
    {
        return $this->load->view('auth/login', $this->captcha());
    }

    public function authenticate_post()
    {
        $username   = $this->input->post('username');
        $password   = $this->input->post('password');
        $captcha    = $this->input->post('captcha');

        $ip         = $this->input->ip_address(); // getenv()
        $userAgent  = $this->input->user_agent();

        $defaultIp  = '127.0.0.1';
        $ip         = (!empty($ip)) ? $ip : $defaultIp;
        $userAgent  = (!empty($userAgent)) ? $userAgent : 'UNKNOWN';

        $checkUsername  = $this->m_user->get(['user_name' => $username]);
        $row            = $checkUsername->row();

        if ($checkUsername->num_rows() > 0) {
            $checkPassword  = $this->bcrypt->validate($password, $row->user_salt, $row->user_password);

            if ($checkPassword) {

                $captchaSession = $this->session->userdata('captcha');

                if ($captcha == $captchaSession) {

                    $session = [
                        'session_id'        => session_id(),
                        'ip_address'        => $ip,
                        'user_agent'        => $userAgent,
                        'logged_in'         => true,
                        'user_name'         => $username,
                        'user_id'           => $row->user_id,
                        'user_fullname'     => $row->user_full_name,
                        'user_email'        => $row->user_email,
                        'user_last_login'   => $row->user_last_login,
                        'user_last_request' => dateTimeNow(),
                        'timestamp'         => now(),
                    ];
                    $this->session->set_userdata($session);

                    $updateData = [
                        'user_name'       => $username,
                        'user_status'     => 1,
                        'user_last_lock'  => null,
                        'user_last_login' => dateTimeNow(),
                    ];
                    $this->m_user->update($updateData, ['user_name' => $username]);

                    $response = [
                        'token'   => AUTHORIZATION::generateToken($session),
                        'message' => 'Successfully Login',
                        'success' => true
                    ];
                } else {
                    $response = [
                        'captcha' => $this->captcha()['captchaImage'],
                        'element' => 'captcha',
                        'message' => 'These captcha do not match!',
                        'success' => false
                    ];
                }
            } else {
                $response = [
                    'captcha' => $this->captcha()['captchaImage'],
                    'element' => 'password',
                    'message' => 'These credentials do not match our record!',
                    'success' => false
                ];
            }
        } else {
            $response = [
                'captcha' => $this->captcha()['captchaImage'],
                'element' => 'username',
                'message' => 'The Username field does not exist!',
                'success' => false
            ];
        }

        return $this->set_response_json($response);
    }

    public function logout_get()
    {
        $this->captcha();
        $this->session->set_userdata(['logged_in' => false]);

        $data = [
            'type'    => 'info',
            'message' => 'You have been logged out.'
        ];
        $this->session->set_flashdata('data', $data);

        return redirect('auth');
    }

    public function captcha()
    {
        makeDir('assets/captch_img');

        $config = [
            'img_url'     => base_url() . 'assets/captch_img/',
            'img_path'    => 'assets/captch_img/',
            'img_height'  => 45,
            'word_length' => 5,
            'img_width'   => '200',
            'font_size'   => 10
        ];

        $captchaNew  = create_captcha($config);
        unset($_SESSION['captcha']);

        $this->session->set_userdata('captcha', $captchaNew['word']);
        $data['captchaImage'] = $captchaNew['image'];

        return $data;
    }

    public function captcha_refresh_get()
    {
        echo $this->captcha()['captchaImage'];
    }

    public function register_get()
    {
        return $this->load->view('auth/register');
    }

    public function register_post()
    {
        $user = $this->m_user->insert([
            'user_name'                 => trim($this->input->post('user_name')),
            'user_email'                => trim($this->input->post('user_email')),
            'user_password'             => $this->bcrypt->hash(trim(randomString(16))),
            'user_salt'                 => $this->bcrypt->salt(),
        ], true);

        if ($user) {
            $response = [
                'message' => 'Succesfully created the User',
                'success' => true
            ];
        } else {
            $response = [
                'message' => 'Error in the database while created the User',
                'success' => false
            ];
        }

        return $this->set_response_json($response);
    }
}
