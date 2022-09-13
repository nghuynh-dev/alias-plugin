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

/**
 * Alias manager CRUD
 *
 * @package    local_alias
 */
namespace local_alias;
use dml_exception;
use stdClass;

class manager {
    /**
     * @return array
     */
    public function get_alias_list(): array
    {
        global $DB;
        try {
            return $DB->get_records('alias');
        } catch (dml_exception $e) {
            return [];
        }
    }
    /**
     * @param string $friendly
     * @param string $destination
     * @return bool
     */
    public function create_alias(string $friendly, string $destination):bool {
        global $DB;

        $recordtoinsert = new stdClass();
        $recordtoinsert->friendly = $friendly;
        $recordtoinsert->destination = $destination;

        try {
            return $DB->insert_record('alias', $recordtoinsert, false);
        } catch (dml_exception $e) {
            return false;
        }
    }

    /**
     * @param int $id
     * @return false|mixed|stdClass
     * @throws dml_exception
     */
    public function get_alias_by_id(int $id) {
        global $DB;
        return $DB->get_record('alias', ['id' => $id]);
    }

    public function update_alias($id, $friendly, $destination)
    {
    }
}