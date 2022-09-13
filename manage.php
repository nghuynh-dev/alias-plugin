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
 */
use local_alias\manager;
require_once(__DIR__ . '/../../config.php');
global $DB;

$PAGE->set_url(new moodle_url('/local/alias/manage.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title(get_string('managealias', 'local_alias'));
//$PAGE->set_heading(get_string('managealias', 'local_alias'));

$manager = new manager();
$alias = $manager->get_alias_list();

echo $OUTPUT->header();

$templatecontext = (object)[
    'alias' => array_values($alias),
    'editurl' => new moodle_url('/local/alias/edit.php')
];

echo $OUTPUT->render_from_template('local_alias/manage', $templatecontext);
echo $OUTPUT->footer();

//1	http://localhost/home 	http://localhost/course.php?id=1
//2	http://localhost/education	http://localhost/course.php?id=2
//3	http://localhost/sports	http://localhost/course.php?id=3
//4	http://localhost/money	http://localhost/course.php?id=4
//5	http://localhost/about	http://localhost/course.php?id=5
//6	http://localhost/study	http://localhost/course.php?id=6
//7	http://localhost/learning	http://localhost/course.php?id=7
//8	http://localhost/mathematics-education 	http://localhost/course.php?id=8

