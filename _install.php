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

$version = $core->plugins->moduleInfo('dcWordTree', 'version');
if (version_compare($core->getVersion('dcWordTree'), $version,'>=')) {
  return;
}

$settings = $core->blog->settings;
$settings->addNamespace('dcwordtree');

$settings->dcwordtree->put('active', false, 'boolean', 'dcWordTree plugin activated ?', false);

$core->setVersion('dcWordTree', $version);
return true;
