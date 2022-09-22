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
 * Manage alias page
 *
 * @package    local_alias
 */

use local_alias\form\filter;
use local_alias\manager;
require_once(__DIR__ . '/../../config.php');

global $DB;
$context = context_system::instance();
$page = optional_param('page', 0, PARAM_INT);
$aliasid = optional_param('id', null, PARAM_INT);
$perpage = 3;
$query = optional_param('query', '', PARAM_TEXT);
$baseurl = new moodle_url('/local/alias/manage.php', ['page' => $page, 'query' => $query]);

require_login();
require_capability('local/alias:managealias', $context);

$PAGE->set_url(new moodle_url('/local/alias/manage.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title(get_string('managealias', 'local_alias'));
$PAGE->requires->js_call_amd('local_alias/confirm', 'init');
$PAGE->requires->css('/local/alias/style/style.css');
$mform = new filter();
if ($mform->is_cancelled()) {
    redirect($CFG->wwwroot . '/local/alias/manage.php', get_string('messagecancelled', 'local_alias'));
} else if ($fromform = $mform->get_data()) {
    if ($fromform->query) {
        redirect($CFG->wwwroot . "/local/alias/manage.php?query=$fromform->query",
            "$fromform->query" . get_string('messagefilter', 'local_alias'));
    }
}
if ($query !== '') {
    $mform->set_data(['query' => $query]);
}

$manager = new manager();
$alias = $manager->get_alias_list($page, $perpage, $query);
$paginate = $OUTPUT->paging_bar($alias['count'], $page, $perpage, $baseurl);

$templatecontext = (object)[
    'alias' => array_values($alias['result']),
    'editurl' => new moodle_url('/local/alias/edit.php'),
    'form' => $mform->render(),
    'count' => $alias['count'],
    'paginate' => $paginate
];
echo $OUTPUT->header();
echo $OUTPUT->render_from_template('local_alias/manage', $templatecontext);
echo $OUTPUT->footer();

