<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">Menu</li>
            <?php
            // $menu = $this->db->select('DISTINCT(menu),menu_id,icon')->join('menu_access_sub_menu', 'menu_access_sub_menu.id=role_access_menu_sub_menu.menu_access_sub_menu_id')->join('menu', 'menu.id=menu_access_sub_menu.menu_id')->order_by('menu.by', 'ASC')->get_where('role_access_menu_sub_menu', array('role_id' => $this->session->userdata('role_id')))->result_array();
            $html = '';
            foreach ($menu as $m) {
                $html .= '<li>
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <i class="' . $m["icon"] . ' text-primary menuAktif"></i><span class="nav-text">' . $m["menu"] . '</span>
                            </a>
                        <ul aria-expanded="false">
                ';
                $sub = $this->db->select('url,title')->join('menu_access_sub_menu', 'menu_access_sub_menu.id=role_access_menu_sub_menu.menu_access_sub_menu_id')->join('sub_menu', 'sub_menu.id=menu_access_sub_menu.sub_menu_id')->order_by('sub_menu.by', 'ASC')->get_where('role_access_menu_sub_menu', array('menu_id' => $m['id'], 'role_id' => $this->session->userdata('role_id')))->result_array();
                foreach ($sub as $s) {
                    $html .= '  <li>
                                    <a id="' . $s["url"] . '" class="link getView ' . $s["url"] . '">
                                        ' . $s["title"] . '
                                    </a>
                                </li>';
                }
                $html .= "</ul>
                </li>";
            }
            echo $html;
            ?>

        </ul>
    </div>
</div>

<div class="content-body">
    <div class="container-fluid">
        <div class="row">