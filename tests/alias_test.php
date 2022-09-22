<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.
use local_alias\manager;

defined('MOODLE_INTERNAL') || die();

class alias_test extends advanced_testcase
{
    /**
     * Function to set admin and reset data.
     *
     * @return manager
     */
    public function set_admin_and_reset_data(): manager {
        $this->resetAfterTest();
        $this->setUser(2);
        return new manager();
    }

    /**
     * Test create alias
     *
     * @return void
     */
    public function test_create_alias() {
        $manager = $this->set_admin_and_reset_data();
        $result = $manager->create_alias('Friendly test', 'Destination test');
        $this->assertTrue($result);
    }

    /**
     * test get alias list
     *
     * @return void
     * @throws dml_exception
     */
    public function test_get_list() {
        $manager = $this->set_admin_and_reset_data();
        $manager->create_alias('Friendly test', 'Destination test');
        $result = $manager->get_alias_list(0, 3, '');
        $this->assertCount(1, $result['result']);
    }

    /**
     * Test get alias by id
     *
     * @return void
     * @throws dml_exception
     */
    public function test_get_alias_by_id() {
        $manager = $this->set_admin_and_reset_data();
        $manager->create_alias('test', 'Destination test');
        $aliases = $manager->get_alias_list(0, 3, '');
        $alias = array_pop($aliases['result']);
        $result = $manager->get_alias_by_id($alias->id);
        $this->assertEquals('test', $result->friendly);
    }

    /**
     * Test update alias
     *
     * @return void
     * @throws dml_exception
     */
    public function test_update_alias() {
        $manager = $this->set_admin_and_reset_data();
        $manager->create_alias('Friendly test', 'Destination test');
        $aliases = $manager->get_alias_list(0, 3, '');
        $alias = array_pop($aliases['result']);
        $manager->update_alias($alias->id, 'edit', 'edit');
        $updated = $manager->get_alias_by_id($alias->id);
        $this->assertEquals('edit', $updated->friendly);
    }

    /**
     * Test delete alias
     *
     * @return void
     * @throws dml_exception
     */
    public function test_delete_alias() {
        $manager = $this->set_admin_and_reset_data();
        $manager->create_alias('Friendly test', 'Destination test');
        $aliases = $manager->get_alias_list(0, 3, '');
        $alias = array_pop($aliases['result']);
        $result = $manager->delete_alias($alias->id);
        $this->assertTrue($result);
        $this->assertFalse($manager->get_alias_by_id($alias->id));
        $this->assertEmpty( $aliases['result']);
    }

    /**
     * Test search alias
     *
     * @return void
     * @throws dml_exception
     */
    public function test_search_alias() {
        $manager = $this->set_admin_and_reset_data();
        $manager->create_alias('test', 'Destination test');
        $manager->create_alias('tien', 'Destination test');
        $manager->create_alias('tao', 'Destination test');
        $aliases = $manager->get_alias_list(0, 3, 'test');
        $alias = array_pop($aliases['result']);
        $this->assertEquals('test', $alias->friendly);
    }

    /**
     * Test pagination alias list
     *
     * @return void
     * @throws dml_exception
     */
    public function test_paginate() {
        $manager = $this->set_admin_and_reset_data();
        for ($i = 1; $i <= 4; $i++) {
            $manager->create_alias("huynh{$i}", "$i");
        }
        $aliasespage1 = $manager->get_alias_list(0, 3, '');
        $this->assertNotEmpty($aliasespage1);
        $this->assertCount(3, $aliasespage1['result']);
        $this->assertEquals(4, $aliasespage1['count']);

        $aliasespage2 = $manager->get_alias_list(1, 3, '');
        $this->assertNotEmpty($aliasespage2);
        $this->assertCount(1, $aliasespage2['result']);
        $this->assertEquals(4, $aliasespage2['count']);
    }
}
