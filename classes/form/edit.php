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

require_once("$CFG->libdir/formslib.php");

class edit extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;

        $mform = $this->_form; // Don't forget the underscore!

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $mform->addElement('text', 'friendly', get_string('friendly', 'local_alias'));
        $mform->setType('friendly', PARAM_NOTAGS);
        $mform->setDefault('friendly', '');

        $mform->addElement('text', 'destination', get_string('destination', 'local_alias'));
        $mform->setType('destination', PARAM_NOTAGS);
        $mform->setDefault('destination', '');

        $this->add_action_buttons();
    }
    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}
