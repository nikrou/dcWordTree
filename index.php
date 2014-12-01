<?php
// +-----------------------------------------------------------------------+
// | dcWordTree - a plugin for dotclear                                    |
// +-----------------------------------------------------------------------+
// | Copyright(C) 2014 Nicolas Roudaire             http://www.nikrou.net  |
// +-----------------------------------------------------------------------+
// | This program is free software; you can redistribute it and/or modify  |
// | it under the terms of the GNU General Public License version 2 as     |
// | published by the Free Software Foundation                             |
// |                                                                       |
// | This program is distributed in the hope that it will be useful, but   |
// | WITHOUT ANY WARRANTY; without even the implied warranty of            |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU      |
// | General Public License for more details.                              |
// |                                                                       |
// | You should have received a copy of the GNU General Public License     |
// | along with this program; if not, write to the Free Software           |
// | Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,            |
// | MA 02110-1301 USA.                                                    |
// +-----------------------------------------------------------------------+

if (!defined('DC_CONTEXT_ADMIN')) { exit; }

if (!empty($_SESSION['dcwordtree_message'])) {
    $message = $_SESSION['dcwordtree_message'];
    unset($_SESSION['dcwordtree_message']);
}

$is_super_admin = $core->auth->isSuperAdmin();
$core->blog->settings->addNameSpace('dcwordtree');
$dcwordtree_active = $core->blog->settings->dcwordtree->active;
$dcwordtree_was_actived = $dcwordtree_active;

if (!empty($_POST['saveconfig'])) {
    try {
        $dcwordtree_active = (empty($_POST['dcwordtree_active']))?false:true;
        $core->blog->settings->dcwordtree->put('active', $dcwordtree_active, 'boolean');

        // change other settings only if they were in html page
        if ($dcwordtree_was_actived) {
            if (isset($_POST['dcwordtree_images'])) {
                $dcwordtree_images = explode("\n", trim($_POST['dcwordtree_images']));
                $core->blog->settings->dcwordtree->put('images', json_encode($dcwordtree_images), 'string');
            }
        }

        $_SESSION['dcwordtree_message'] = __('The configuration has been updated.');
        http::redirect($p_url);
    } catch(Exception $e) {
        http::redirect($p_url);
    }
}

include(dirname(__FILE__).'/tpl/index.tpl');
