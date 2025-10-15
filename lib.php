<?php

// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin version and other meta-data are defined here.
 *
 * @package     local_verifypsa
 * @copyright   2024 Roy Ploamntes <rplomantes@nephilaweb.com.ph>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Inject popup markup on the next page after login (dashboard or frontpage).
 */
function local_verifypsa_before_standard_html_head(): string {
    global $SESSION;

    if (empty($SESSION->local_verifypsa_showpopup)) {
        return '';
    }

    $flag = $SESSION->local_verifypsa_showpopup;
    unset($SESSION->local_verifypsa_showpopup);

    $verifyurl    = get_config('local_verifypsa', 'verifyurl') ?: '#';
    $verifymessage= get_config('local_verifypsa', 'message') ?: get_string('defaultmessage', 'local_verifypsa');

    // Message per case.
    if ($flag === 'notfound') {
        $custommsg = get_string('notfoundmessage', 'local_verifypsa');
        // Optionally hide Verify button if not found:
        $hideverify = 'style="display:none"';
    } else {
        $custommsg = $verifymessage;
        $hideverify = '';
    }

    // Return a single <script> that appends the popup.
    return <<<HTML
<script>
require(['jquery'], function($) {
    $(function() {
        var popup = `
            <div id="verify-popup" style="position:fixed; top:0; left:0; width:100%; height:100%;
                 background:rgba(0,0,0,0.6); display:flex; justify-content:center; align-items:center; z-index:9999;">
                <div style="background:#fff; padding:20px; border-radius:10px; text-align:center; max-width:460px; box-shadow:0 8px 20px rgba(0,0,0,0.25);">
                    <h3 style="margin:0 0 10px 0;">\${M.util.get_string('popupheading', 'local_verifypsa')}</h3>
                    <p style="margin:0 0 15px 0;">{$custommsg}</p>
                    <div style="margin-top:10px;">
                        <a href="{$verifyurl}" class="btn btn-primary" {$hideverify} style="margin:5px;">\${M.util.get_string('verifynow', 'local_verifypsa')}</a>
                        <button id="verifypsa-continue" class="btn btn-secondary" style="margin:5px;">\${M.util.get_string('continue', 'local_verifypsa')}</button>
                    </div>
                </div>
            </div>`;
        $('body').append(popup);
        $('#verifypsa-continue').on('click', function(){ $('#verify-popup').remove(); });
    });
});
</script>
HTML;
}


