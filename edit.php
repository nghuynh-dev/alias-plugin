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
 * Create page Edit alias
 *
 * @package    local_alias
 */
require_once(__DIR__ . '/../../config.php');
use local_alias\form\edit;
use local_alias\manager;

$context = context_system::instance();
$aliasid = optional_param('id', null, PARAM_INT);

require_login();
require_capability('local/alias:managealias', $context);

$PAGE->set_url(new moodle_url('/local/alias/edit.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_heading(get_string('editalias', 'local_alias'));

// Edit process.
$mform = new edit();
if ($mform->is_cancelled()) {
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
if ($aliasid) {
    $manager = new manager();
    $aliasdata = $manager->get_alias_by_id($aliasid);
    if (!$aliasdata) {
        throw new invalid_parameter_exception('Alias not found');
    }
    $mform->set_data($aliasdata);
}

// Render.
echo $OUTPUT->header();
$mform->display();
echo $OUTPUT->footer();
