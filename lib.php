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

function local_verifypsa_before_standard_html_head() {
    global $SESSION;

    if (!empty($SESSION->local_verifypsa_showpopup)) {
        unset($SESSION->local_verifypsa_showpopup);

        $verifyurl = get_config('local_verifypsa', 'verifyurl');
        $custommsg = get_config('local_verifypsa', 'custommsg');

        $popup = <<<HTML
<script>
require(['jquery'], function($) {
    $(document).ready(function() {
        var popup = `
            <div id="verify-popup" style="position:fixed; top:0; left:0; width:100%; height:100%;
                 background:rgba(0,0,0,0.6); display:flex; justify-content:center; align-items:center; z-index:9999;">
                <div style="background:#fff; padding:20px; border-radius:10px; text-align:center; max-width:400px;">
                    <h3>Account Verification</h3>
                    <p>{$custommsg}</p>
                    <a href="{$verifyurl}" class="btn btn-primary" style="margin:5px;">Verify Now</a>
                    <button id="continue-btn" class="btn btn-secondary" style="margin:5px;">Continue</button>
                </div>
            </div>`;
        $('body').append(popup);

        $('#continue-btn').click(function(){
            $('#verify-popup').remove();
        });
    });
});
</script>
HTML;
        return $popup;
    }
}
