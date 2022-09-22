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
 * Create edit alias form
 *
 * @package    local_alias
 */
namespace local_alias\form;
use moodleform;

defined('MOODLE_INTERNAL') || die();

require_once("$CFG->libdir/formslib.php");

class edit extends moodleform {
    public function definition() {
        $mform = $this->_form;

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $mform->addElement('text', 'friendly', get_string('friendly', 'local_alias'));
        $mform->setType('friendly', PARAM_TEXT);
        $mform->setDefault('friendly', '');
        $mform->addRule('friendly', get_string('defaultfriendly', 'local_alias'), 'required', null, 'client');

        $mform->addElement('text', 'destination', get_string('destination', 'local_alias'));
        $mform->setType('destination', PARAM_TEXT);
        $mform->setDefault('destination', '');
        $mform->addRule('destination', get_string('defaultdestination', 'local_alias'), 'required', null, 'client');

        $this->add_action_buttons();
    }

    public function validation($data, $files) {
        return array();
    }
}
