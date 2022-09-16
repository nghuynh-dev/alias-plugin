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
use dml_transaction_exception;
use stdClass;

class manager {
    /**
     * @param int $page
     * @return array
     */
    public function get_alias_list(int $page, int $perpage, string $query): array {
        global $DB;
        $select = $DB->sql_like('friendly', ':friendly');
        $params = ['friendly' => '%'.$DB->sql_like_escape($query).'%'];
        $count = $DB->count_records_select('alias', $select, $params);
        $sql = "SELECT *
                  FROM {alias} a
                 WHERE $select
              ORDER BY a.id DESC";
        $result = $DB->get_records_sql($sql, $params, $page * $perpage, $perpage);
        try {
            return [
                'result' => $result,
                'count' => $count
            ];
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

    /**
     * @throws dml_exception
     */
    public function update_alias(int $id, string $friendly, string $destination): bool {
        global $DB;
        $obj = new stdClass();
        $obj->id = $id;
        $obj->friendly = $friendly;
        $obj->destination = $destination;
        return $DB->update_record('alias', $obj);
    }

    /**
     * @throws dml_transaction_exception
     * @throws dml_exception
     */
    public function delete_alias($aliasid): bool {
        global $DB;
        $transaction = $DB->start_delegated_transaction();
        $deletealias = $DB->delete_records('alias', ['id' => $aliasid]);
        if ($deletealias) {
            $DB->commit_delegated_transaction($transaction);
        }
        return true;
    }
}
