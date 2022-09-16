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
    public function set_admin_and_reset_data(): manager {
        $this->resetAfterTest();
        $this->setUser(2);
        return new manager();
    }
    public function test_create_alias() {
        $manager = $this->set_admin_and_reset_data();
        $result = $manager->create_alias('Friendly test', 'Destination test');
        $this->assertTrue($result);
    }
    public function test_get_list() {
        $manager = $this->set_admin_and_reset_data();
        $manager->create_alias('Friendly test', 'Destination test');
        $result = $manager->get_alias_list(0, 3, '');
        $this->assertCount(1, $result['result']);
    }
    public function test_get_alias_by_id() {
        $manager = $this->set_admin_and_reset_data();
        $manager->create_alias('Friendly test', 'Destination test');
        $result = $manager->get_alias_by_id(1);
        $this->assertCount(1, $result['result']);
    }
}
