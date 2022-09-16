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
 * Version details
 *
 * @package    local_alias
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace local_alias\form;
use moodleform;

defined('MOODLE_INTERNAL') || die();

require_once("$CFG->libdir/formslib.php");

class filter extends moodleform {
    public function definition() {
        $mform = $this->_form; // Don't forget the underscore!
        $mform->addElement('text', 'query', get_string('filterfriendly', 'local_alias'));
        $mform->setType('query', PARAM_NOTAGS);
        $this->add_action_buttons(false, get_string('filter', 'local_alias'));
    }
    public function validation($data, $files) {
        return array();
    }
}
