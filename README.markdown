# CodeIgniter Recaptcha Spark

Let me start off by saying 99% of this library is not created by me. I took the source code 
from this library (http://codeigniter.com/wiki/ReCAPTCHA) and converted it to a spark. I did
not feel like the previous recaptcha spark library was easy enough to use.

## Requirements

No additional libraries are required, however you are required to load form_validation BEFORE
loading this spark. Failure to do so should result in fatal errors.

## How to use

### Get API Key

First you need to visit http://www.recaptcha.com and get yourself an API key. Then go into the
config folder and update the recaptcha.php file. You will need to put your public AND private
key into the file.

### Example view file

File: application/views/recaptcha.php

    <?= validation_errors() ?>
    <form method="post">
        <?= $recaptcha ?>
        <input type="submit" value="Submit" />
    </form>
### Example controller file

File: application/controllers/recaptcha.php

    class Recaptcha extends CI_Controller
    {
        public function index()
        {
            $this->load->library('form_validation');
            $this->load->spark('recaptcha_spark/1.0.13');

            if ($this->form_validation->run())
            {
                //Do Success Stuff
            }
            else
            {
                $this->load->view('recaptcha', array('recaptcha' => $this->recaptcha->get_html()));
            }
        }
        
        public function check_captcha($val) 
        {
            return check_captcha($val);
        }
    }
    
Please note the public function check_captcha simply refers to the check_captcha in the 
helper class. I could not find a way around this at this point. The callback system for
form_validation I believe only calls back $this-> {function_name} and I couldn't come
up with a better solution. If you have any ideas please leave comments.