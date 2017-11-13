<?php
/**
 * Created by PhpStorm.
 * User: invest
 * Date: 02.11.2017
 * Time: 10:36
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_Add_cicom extends CI_Migration {
    public function up(){
        //table users
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 150
            ),
            'date' => array(
                'type' => 'DATETIME',
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'unsigned' => TRUE,
                'constraint' => 150
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => 200
            ),

        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users');

        //table comments
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => 200
            ),
            'ThemeModel' => array(
                'type' => 'VARCHAR',
                'constraint' => 150
            ),
            'user_id' => array(
                'type' => 'INT',
            ),
            'date' => array(
                'type' => 'DATETIME',
            ),
            'text' => array(
                'type' => 'TEXT'
            ),

            'parent_id' => array(
                'type' => 'INT'
            )

        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('comments');

        //table theme
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'theme_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 150
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('theme');
    }

    public function down(){
        $this->dbforge->drop_table('users');
        $this->dbforge->drop_table('comments');
        $this->dbforge->drop_table('theme');
    }
}