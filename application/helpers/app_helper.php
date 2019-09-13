<?php

if (!function_exists('multi_menu')) {
	function multi_menu($label_id, $parent_id = 0) {
		$ci =& get_instance();

        if ($parent_id != 0 && $parent_id > 0) {
        	// Child
        	$rows = $ci->db->where('a.parent_id', $parent_id)
                 	   	   ->get('user_sub_menu a');
        } else {
        	// Parent
        	$rows = $ci->db->where('a.menu_id', $label_id)
            		   	   ->where('a.parent_id', $parent_id)
                 	   	   ->get('user_sub_menu a');
        }


        $generate = null;

        foreach ($rows->result_array() as $row) {
        	$check = $ci->db->where('parent_id', $row['id'])->get('user_sub_menu')->num_rows();

        	$tree = $check > 0 ? ' treeview' : null;

        	$class = $ci->uri->segment(1) == $row['url'] || $ci->uri->segment(1) == '' ? 'active' . $tree : trim($tree, ' ');
        	$generate .= '<li class="' . $class . '">';

        	if ($check > 0) {
        		$generate .= '
        			<a href="javascript:void(0)">
        				<i class="' . $row['icon'] . '"></i>
        				<span>' . $row['title'] . '</span>
        				<span class="pull-right-container">
			              <i class="fa fa-angle-left pull-right"></i>
			            </span>
        			</a>';
        		$generate .= '<ul class="treeview-menu">';
        		$generate .= multi_menu($label_id, (int) $row['id']);
        		$generate .= '</ul>';
        	} else {
        		$generate .= 
	        		'<a href="' . base_url($row['url']) . '"><i class="' . $row['icon'] . '"></i> <span>' . $row['title'] . '</span></a>';	
        	}

	        $generate .= '</li>';
        }


        return $generate;
	}
}