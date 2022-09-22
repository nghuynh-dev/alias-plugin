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
 * Js confirm delete alias
 *
 */

import * as Str from 'core/str';
import Ajax from 'core/ajax';
import Notification from 'core/notification';

export const init = () => {
    document.addEventListener('click', e => {
        const deletebtn = e.target.closest('.alias-delete-btn');
        if (deletebtn) {
            let str = deletebtn.classList[0];
            let aliasid = str.substr(str.lastIndexOf('aliasid') + 'aliasid'.length);
            const alias = {aliasid: aliasid};
            document.addEventListener('click', e => {
               const confirmdelete = e.target.closest('.confirm-delete-alias');
               if (confirmdelete) {
                   const request = {
                       methodname: 'local_alias_delete_alias',
                       args: alias,
                   };
                   Ajax.call([request])[0].done(function (data) {
                       if (data === true) {
                           window.location.reload();
                       } else {
                           Notification.addNotification({
                               message: Str.get_string('messagedeletefail', 'local_message'),
                               type: 'error'
                           });
                       }
                   }).fail(Notification.exception);
               }
            });
        }
    });
};
