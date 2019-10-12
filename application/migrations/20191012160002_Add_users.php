<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_users extends CI_Migration {

	/**
	 * https://www.marcus-povey.co.uk/2013/03/11/automatic-create-and-modified-timestamps-in-mysql/
	 */
	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'firstname' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'lastname' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'username' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			),
            'created_at'=> array(
                'type'  => 'DATETIME',
                'null' => FALSE
            ),
            'updated_at'=> array(
                'type'      => 'TIMESTAMP',
                'ON UPDATE CURRENT_TIMESTAMP' => TRUE
            ),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('users');
	}

	public function down()
	{
		$this->dbforge->drop_table('users');
	}
}