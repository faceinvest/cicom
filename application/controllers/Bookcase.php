<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bookcase extends Base_Controller
{
    public $book;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('file');
    }

    public function index()
    {
        //$string = read_file('');
        $this->data['book'] = $this->get_and_read();
        return $this->render('bookcase', $this->data);
    }

    public function put_book()
    {
        //положить книгу в шкаф
        fclose($this->book);
    }

    public function get_and_read()
    {
        //достать и прочитать книгу из шкафа
        $book = '';
        $this->book = fopen("book/oop.txt", "r");
        while (!feof($this->book)) {
            $book .= '<p>'.fgets($this->book)."<p>";
        }
        $this->put_book();

        return $book;
    }

    public function add_to_book()
    {
        //дописать в книгу
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Здесь происходит запись в конец файла
            $this->book = fopen("book/oop.txt", 'a');
            fwrite($this->book, "\r\n" . $_POST['text'] );

            $this->put_book();

            redirect(base_url()."/bookcase");
        }
    }
}