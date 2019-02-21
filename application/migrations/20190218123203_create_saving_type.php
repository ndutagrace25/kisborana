<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_saving_type extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'saving_type_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'saving_type_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        
                        
                ));
                $this->dbforge->add_field("`saving_type_status` tinyint NOT NULL DEFAULT 1");
                $this->dbforge->add_field("`created_by` int NOT NULL ");
                $this->dbforge->add_field("`created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
                $this->dbforge->add_field("`modified_by` int NULL ");
                $this->dbforge->add_field("`modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP");
                $this->dbforge->add_field("`deleted` tinyint NOT NULL DEFAULT 0");
                $this->dbforge->add_field("`deleted_on` timestamp NULL DEFAULT NULL");
                $this->dbforge->add_field("`deleted_by` int NULL");
              
               
               
                $this->dbforge->add_key('saving_type_id', TRUE);
                $this->dbforge->create_table('saving_type');
        }

        public function down()
        {
                $this->dbforge->drop_table('saving_type');
        }
}