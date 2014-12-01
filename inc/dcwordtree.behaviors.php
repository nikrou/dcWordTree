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

class dcWordTreeBehaviors
{
    public static function addTplPath($core) {
        $core->tpl->setPath($core->tpl->getPath(), dirname(__FILE__).'/../default-templates');
    }

    public static function publicHeadContent($core) {
        $res = '';
        $res .= sprintf(
            '<script type="text/javascript" src="%s/js/d3.js"></script>'."\n",
            html::stripHostURL($core->blog->getQmarkURL().'pf=dcWordTree')
        );
        $res .= sprintf(
            '<script type="text/javascript" src="%s/js/d3.layout.cloud.js"></script>'."\n",
            html::stripHostURL($core->blog->getQmarkURL().'pf=dcWordTree')
        );
        $res .= sprintf(
            '<script type="text/javascript" src="%s/js/dcwordtree.js"></script>'."\n",
            html::stripHostURL($core->blog->getQmarkURL().'pf=dcWordTree')
        );
        $res .= '<script type="text/javascript">';
        $res .= 'var fill = d3.scale.category10();';
        $res .= 'var width = 800, height = 600, padding = 3;';
        $res .= '</script>';
        $res .= '<style type="text/css">';
        $res .= 'svg text { cursor: pointer; }';
        $res .= '</style>';

        echo $res;
    }
}