<?php
namespace PHPUnitCheckMail;
use PHPUnit\Framework\TestCase;
class CheckMail extends TestCase{
    protected $headers;
    protected $subject;
    protected $message;
    protected function setUp() {
        $this->message = 'test_message_new';
        $this->subject = 'testSubject';
        $this->headers = 'From: privat_m@ukr.net' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
    }
    
    /**
     * @dataProvider mailProvider
     * Тест проходит успешно если возвращаемое значение равно true
     * Используется метод провайдер данных (mailProvider) для получения аргумента $email
     */
    public function testMXinDNS($email, $pop3, $port, $sslflag, $pass){
        $re = '/.*@(.*)/';
        preg_match($re, $email, $match);
        $domain = $match[1];
        $this->assertTrue(getmxrr($domain, $mx_records));
    }
    /**
     * @dataProvider mailProvider
     * Тест на отправку письма на ящик по SMTP протоколу
     * Тест проходит успешно если возвращаемое значение равно true
     * Используется метод провайдер данных (mailProvider) для получения аргумента $email
     */
    public function testSendMail($email, $pop3, $port, $sslflag, $pass){
        $this->assertTrue(mail($email, $this->subject, $this->message, $this->headers));
    }

    /**
     * @dataProvider mailProvider
     * Тест на получение письма по POP3 протоколу
     * Тест проходит успешно если возвращаемое значение равно true
     * Используется метод провайдер данных (mailProvider) для получения аргумента $email
     */
    public function testGetMailPOP3($email, $pop3, $port, $sslstr, $pass){
        $pop_conn = fsockopen($sslstr.$pop3, $port,$errno, $errstr, 10); 
        if($this->checkResponce($pop_conn)){
            fputs($pop_conn,"USER $email\r\n");
            print fgets($pop_conn,1024)."\r\n";
            stream_set_timeout($pop_conn, 5);
            fputs($pop_conn,"PASS $pass\r\n");
//            $res = fgets($pop_conn,1024)."\r\n";
            if($this->checkResponce($pop_conn)){
                fputs($pop_conn,"STAT\r\n");
                $numLetters = explode(' ', fgets($pop_conn,1024))[1];
                print __METHOD__."_letter: $numLetters _mess: $this->message\r\n";
                fputs($pop_conn,"RETR $numLetters\r\n");
                $this->assertTrue(stripos($this->get_data($pop_conn), $this->message) !== false, 'Не найдено!');
            }else $this->assertTrue (FALSE, 'Неверный логин или пароль либо протокол POP3 не поддерживается!');
            // Закрываем сессию:
            fputs($pop_conn,'QUIT'.CRLF);
        }else $this->assertTrue (FALSE, "Невозможно подключится к серверу ".$sslstr.$pop3.": $port");
    }

    
    /*
     * Метод предоставляющий данные для тестирования.
     * Для каждого массива будет произведен отдельный тест
     */
    public function mailProvider(){
        return [
            ['test@ukr.net', 'pop3.ukr.net', 110, '', '******'],
            ['test2@gmail.com', 'pop.gmail.com', 995, 'ssl://', 'testpass']
        ];
    }
    
    protected function get_data($pop_conn)
    {
        $data="";
        while (!feof($pop_conn)) {
            $buffer = chop(fgets($pop_conn,1024));
            //for logging
            if(stripos($buffer, 'Received') !== false){
                file_put_contents('log.txt', '['.date('d-m-Y H:i').']'.$buffer."\r\n", FILE_APPEND | LOCK_EX);
            }
            $data .= "$buffer\r\n";
            if(trim($buffer) == ".") break;
        }
        return $data;
    }
    /*
    public function getMailTop(){
        $sslstr = '';
        $pop3 = 'pop3.ukr.net';
        $port = 110;
        $email = 's211211@ukr.net';
        $pass = 'm8xDFkJ';
        $pop_conn = fsockopen($sslstr.$pop3, $port,$errno, $errstr, 10);        
//        print fgets($pop_conn,1024)."\r\n";
        if($this->checkResponce($pop_conn)){
            fputs($pop_conn,"USER $email\r\n");
            print fgets($pop_conn,1024)."\r\n";
            
            stream_set_timeout($pop_conn, 5);
            fputs($pop_conn,"PASS $pass\r\n");
            print fgets($pop_conn,1024)."\r\n";
            
            if($this->checkResponce($pop_conn)){
                fputs($pop_conn,"STAT\r\n");
                fgets($pop_conn,1024);
                $numLetters = explode(' ', fgets($pop_conn,1024))[1];
//                var_dump($numLetters);
                fputs($pop_conn,"RETR $numLetters\r\n");
//                print($this->get_data($pop_conn));
                var_dump(stripos($this->get_data($pop_conn), 'test_message_31') !== false);
            }else                echo 'error';
            // Закрываем сессию:
            fputs($pop_conn,'QUIT'.CRLF);
        }
    }
    */
    private function checkResponce($responce){
        return stripos(fgets($responce,1024), '+OK') !== false;
    }
}
/*
$o = new CheckMail;
$o->getMailTop();
 * 
 */