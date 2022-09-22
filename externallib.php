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
 * External function to delete alias.
 *
 * @package    local_alias
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

use local_alias\manager;
require_once($CFG->libdir . "/externallib.php");

class local_alias_external extends external_api {
    /**
     * Return desc of method params
     *
     * @return external_function_parameters
     */
    public static function delete_alias_parameters(): external_function_parameters {
        return new external_function_parameters(
            ['aliasid' => new external_value(PARAM_INT, 'id of alias')],
        );
    }
    /**
     * itself
     *
     * @param $aliasid
     * @return string
     * @throws invalid_parameter_exception
     * @throws required_capability_exception|dml_exception
     */
    public static function delete_alias($aliasid): string {
        $params = self::validate_parameters(self::delete_alias_parameters(), array('aliasid' => $aliasid));
        $context = context_system::instance();
        require_capability('local/alias:managealias', $context);
        $manager = new manager();
        return $manager->delete_alias($aliasid);
    }
    /**
     * Return desc of method result value
     *
     * @return external_value
     */
    public static function delete_alias_returns(): external_value {
        return new external_value(PARAM_BOOL, 'True if the alias was successfully deleted.');
    }
}
