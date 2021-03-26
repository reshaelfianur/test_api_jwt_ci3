<?php defined('BASEPATH') or exit('No direct script access allowed');

class Mail
{
    private $key;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->library('email');
        $this->ci->load->library('my_encryption');
        $this->ci->load->model('setting/m_smtp');
        $this->ci->load->helper('email');
        $this->key = 'reslin123';
    }

    public function send_mail($param)
    {
        $q = $this->ci->m_smtp->get(['smtp_status' => 1], 'smtp_id', 1);

        if ($q->num_rows() < 1) {
            $response = [
                'success' => false,
                'message' => 'Your SMTP configuration has not been set up properly'
            ];
        } else {
            if (valid_email($param['recipient'])) {
                $config      = [];
                $config_data = $q->row();

                $config['protocol']     = 'smtp';
                $config['useragent']    = 'HRISSMTPLIB';
                $config['smtp_host']    = $config_data->smtp_host;
                $config['smtp_port']    = $config_data->smtp_port;
                $config['smtp_timeout'] = '7';
                $config['smtp_user']    = $config_data->smtp_user;
                $config['smtp_pass']    = $this->ci->my_encryption->decrypt($this->key, $config_data->smtp_pass);
                $config['charset']      = 'utf-8';
                $config['newline']      = "\r\n";
                $config['mailtype']     = 'html';
                $config['crlf']         = "\r\n";
                $config['validation']   = false;
                $config['wordwrap']     = false;
                $config['starttls']     = ($config_data->smtp_encrypt_type == 1) ? true : false;

                $this->ci->email->initialize($config);
                $this->ci->email->from($config_data->smtp_email, $config_data->smtp_name);
                $this->ci->email->to($param['recipient']);
                $this->ci->email->subject($param['subject']);
                $this->ci->email->message($param['content']);

                if ($this->ci->email->send()) {
                    $response = [
                        'success' => true,
                        'message' => 'Email has been sent'
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'message' => $this->ci->email->print_debugger()
                    ];
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Recipient email is not valid'
                ];
            }
        }
        return $response;
    }

    public function send_mail_with_attachment($param)
    {
        $q = $this->ci->m_smtp->get(['smtp_status' => 'A'], 'smtp_id', 1);

        if ($q->num_rows() < 1) {
            $response = [
                'success' => false,
                'message' => 'Your SMTP configuration has not been set up properly'
            ];
        } else {
            if (valid_email($param['recipient'])) {
                $config      = [];
                $config_data = $q->row();

                $config['protocol']     = 'smtp';
                $config['useragent']    = 'HRISSMTPLIB';
                $config['smtp_host']    = $config_data->smtp_host;
                $config['smtp_port']    = $config_data->smtp_port;
                $config['smtp_timeout'] = '7';
                $config['smtp_user']    = $config_data->smtp_user;
                $config['smtp_pass']    = $this->ci->my_encryption->decrypt($this->key, $config_data->smtp_pass);
                $config['charset']      = 'utf-8';
                $config['newline']      = "\r\n";
                $config['mailtype']     = 'html';
                $config['crlf']         = "\r\n";
                $config['validation']   = false;
                $config['wordwrap']     = false;
                $config['starttls']     = ($config_data->smtp_encrypt_type == 1) ? true : false;

                $this->ci->email->initialize($config);
                $this->ci->email->from($config_data->smtp_email, $config_data->smtp_name);
                $this->ci->email->to($param['recipient']);
                $this->ci->email->attach($param['attachment']);
                $this->ci->email->subject($param['subject']);
                $this->ci->email->message($param['content']);

                if ($this->ci->email->send()) {
                    $response = [
                        'success' => true,
                        'message' => 'Email has been sent'
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'message' => $this->ci->email->print_debugger()
                    ];
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Recipient email is not valid'
                ];
            }
        }
        return $response;
    }
}
