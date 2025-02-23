<?php
use App\Models\Menu;

function changeDateFormate($date, $date_format){
    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);
}

function dateDifferences($date1, $date2)
{
    $start_date = date_create($date1);
    $end_date = date_create($date2);
    $diff = date_diff($start_date, $end_date); //$diffrence_of_dates = $diff->format("%a"); //$diff->format("%R%a days"); positive/negative days
    return $diff->format("%a");
}

function value_to_index($key_val, $ref_result = array()) {
    $arr = array();
    foreach ($ref_result as $key => $item) {            
        $arr[$item->$key_val][] = $item;
    }
    return $arr;
}

function create_list($arr, $urutan){
    if($urutan == 0) {
        $html = "\n<ul class='pcoded-item pcoded-left-item'>\n";
    } else {
        $html = "\n<ul class='pcoded-submenu'>\n";
    }
    foreach ($arr as $key => $v) {
        if (array_key_exists('children', $v)) {
            $html .= "<li class='pcoded-hasmenu'>\n";
            $html .= '<a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-direction-alt"></i><b>M</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.main">'.$v['menu_item_name'].'</span>
                            <span class="pcoded-mcaret"></span>
                      </a>';
            $html .= create_list($v['children'], 1);
            $html .= "</li>\n";
        }else{
            if($urutan == 0) {
               $html .=    '<li class="active">
                                <a href="'.url('').'/'.$v['url'].'">
                                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.main">'.$v['menu_item_name'].'</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>';
            }
            if ($urutan == 1) {
                $html .=    '<li class="">
                                <a href="'.url('').'/'.$v['url'].'">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">'.$v['menu_item_name'].'</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                             </li>';
            }
        }
    }
    $html .= "</ul>\n";
    return $html;
}

function menu_tree(){
    $result = Menu::active()
                  ->orderBy('order')
                  ->get();
    return $result;
}

function buildTree(Array $data, $parent = 0) {
    $tree = array();
    foreach ($data as $d) {
        if ($d['parent'] == $parent) {
            $children = buildTree($data, $d['id']);
            // set a trivial key
            if (!empty($children)) {
                $d['_children'] = $children;
            }
            $tree[] = $d;
        }
    }
    return $tree;
}

function printTree($tree, $r = 0, $p = null) {
    foreach ($tree as $i => $t) {
        $dash = ($t['parent'] == 0) ? '' : str_repeat('-', $r) .' ';
        printf("\t<option value='%d'>%s%s</option>\n", $t['id'], $dash, $t['name']);
        if ($t['parent'] == $p) {
            // reset $r
            $r = 0;
        }
        if (isset($t['_children'])) {
            printTree($t['_children'], ++$r, $t['parent']);
        }
    }
}

function createTreeView($array, $currentParent, $currLevel = 0, $prevLevel = -1){
    foreach ($array as $menu){
        if ($currentParent == $menu->parent_id){                       
            if ($currLevel > $prevLevel) 
                echo " <ol class='tree'> "; 
            if ($currLevel == $prevLevel) 
                echo " </li> ";
            echo '<li><label for="subfolder2">'.$menu->name.'</label>&nbsp;<input value="'.$menu->id.'" type="checkbox" name="chk[]"/>';
            if ($currLevel > $prevLevel) 
                $prevLevel = $currLevel; 
            $currLevel++; 
            createTreeView ($array, $menu->id, $currLevel, $prevLevel);
            $currLevel--;               
        }   
    }
    if ($currLevel == $prevLevel) echo "</li></ol>";
}

