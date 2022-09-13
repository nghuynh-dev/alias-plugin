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
require_once(__DIR__ . '/../../config.php');
//require_once($CFG->dirroot . '/local/alias/classes/form/edit.php');

use local_alias\form\edit;
use local_alias\manager;
global $DB;

$PAGE->set_url(new moodle_url('/local/alias/edit.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_heading('Edit');



//display form, process handle form
$mform = new edit();

if ($mform->is_cancelled()) {
    //Go back manage.php
    redirect($CFG->wwwroot . '/local/alias/manage.php', get_string('messagecancelled', 'local_alias'));

} else if ($fromform = $mform->get_data()) {
    $manager = new manager();

    if ($fromform->id) {
        $manager->update_alias($fromform->id, $fromform->friendly, $fromform->destination);
        redirect($CFG->wwwroot . '/local/alias/manage.php', get_string('messageupdated', 'local_alias'). ' ' . $fromform->friendly);
    }

    $manager->create_alias($fromform->friendly, $fromform->destination);
    redirect($CFG->wwwroot . '/local/alias/manage.php', get_string('messagecreated', 'local_alias'). ' ' . $fromform->friendly);
}




$aliasid = optional_param('id', null, PARAM_INT);

if ($aliasid) {
    $manager = new manager();
    $aliasdata = $manager->get_alias_by_id($aliasid);

    if(!$aliasdata) {
        throw new invalid_parameter_exception('Alias not found');
    }
    $mform->set_data($aliasdata);
}


echo $OUTPUT->header();

$templatecontext = (object)[
];

echo $OUTPUT->render_from_template('local_alias/edit', $templatecontext);
$mform->display();

echo $OUTPUT->footer();