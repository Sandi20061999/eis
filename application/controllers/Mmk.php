<?php

use Jajo\JSONDB;

class Mmk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function card()
    {
    }
    function chart()
    {
    }
    function accordiontable()
    {
    }
    function header()
    {
    }
    function getlevel()
    {
        echo "<option value=''>Pilih Level</option>";
        $getlevel = file_get_contents(base_url() . 'level.json');
        $l = json_decode($getlevel, true);
        foreach ($l['level'] as $k => $v) {
            $selected = ($k == $this->input->post('type')) ? ' selected="selected"' : "";
            echo '<option id="' . $k . '" value="' . $k . '" ' . $selected . '>' . $k . '</option>';
        }
    }
    function gettype()
    {
        echo "<option value=''>Pilih Type</option>";
        $level = $_POST['level'];
        $getlevel = file_get_contents(base_url() . 'level.json');
        $l = json_decode($getlevel, true);
        foreach ($l['level'][$level]['filter'] as $k => $v) {
            $selected = ($k == $this->input->post('type')) ? ' selected="selected"' : "";
            echo '<option id="' . $k . '" value="' . $k . '" ' . $selected . '>' . $k . '</option>';
        }
    }
    function getfilter()
    {
        echo "<option value=''>Pilih Filter</option>";
        $level = $_POST['level'];
        $type = $_POST['type'];
        $getlevel = file_get_contents(base_url() . 'level.json');
        $l = json_decode($getlevel, true);
        foreach ($l['level'][$level]['filter'][$type] as $k => $v) {
            $selected = ($v == $this->input->post('type')) ? ' selected="selected"' : "";
            echo '<option id="' . $v . '" value="' . $v . '" ' . $selected . '>' . $v . '</option>';
        }
    }
    function getapi()
    {
        echo "<option value=''>Pilih API</option>";
        $ap = $data = $this->db->select('id,name')->get('api')->result_array();
        foreach ($ap as $a) {
            $selected = ($a['name'] == $this->input->post('api')) ? ' selected="selected"' : "";
            echo '<option id="' . $a['id'] . '" value="' . $a['id'] . '" ' . $selected . '>' . $a['name'] . '</option>';
        }
    }
    function getfiltervalue()
    {
        echo "<option value=''>Pilih Filter</option>";
        $api_id = $_POST['api_id'];
        $filter = $_POST['filter'];
        $temp = [];
        $gV = $this->db->select('jsonFile,name')->get_where('api', ['id' => $api_id])->result_array();
        foreach ($gV as $a) {
            $json_db = new JSONDB($a['jsonFile']);
            $rslt = $json_db->select($filter)
                ->from()
                ->get();
            // $temp[] = $rslt;
            $au = array_unique(array_column($rslt, $filter));
            $ai = array_intersect_key($rslt, $au);
            $temp[] = $ai;
        }
        asort($temp[0]);
        foreach ($temp[0] as $a) {
            $selected = ($a[$filter] == $this->input->post('api')) ? ' selected="selected"' : "";
            echo '<option id="' . $a[$filter] . '" value="' . $a[$filter] . '" ' . $selected . '>' . $a[$filter] . '</option>';
        }
    }
    function getjurusan()
    {
        echo "<option value=''>Pilih Jurusan</option>";
        $temp = [];
        $gV = $this->db->select('jsonFile,name')->get_where('api', ['id' => 23])->result_array();
        foreach ($gV as $a) {
            $json_db = new JSONDB($a['jsonFile']);
            $rslt = $json_db->select('id_jurusan,nm_jurusan')
                ->from()
                ->get();
            // $temp[] = $rslt;
            $au = array_unique(array_column($rslt, 'id_jurusan'));
            $ai = array_intersect_key($rslt, $au);
            $temp[] = $ai;
        }
        asort($temp[0]);
        foreach ($temp[0] as $a) {
            $selected = ($a['id_jurusan'] == $this->input->post('api')) ? ' selected="selected"' : "";
            echo '<option id="' . $a['id_jurusan'] . '" value="' . $a['id_jurusan'] . '" ' . $selected . '>' . $a['id_jurusan'] .' | '.$a['nm_jurusan'] . '</option>';
        }
    }
    function geticon()
    {
        echo "<option value=''>Pilih Icon</option>";
        $icon = ['fa fa-address-book-o ','fa fa-address-book ','fa fa-address-card ','fa fa-address-card-o ','fa fa-adjust ','fa fa-american-sign-language-interpreting ','fa fa-anchor ','fa fa-archive ','fa fa-area-chart ','fa fa-arrows ','fa fa-arrows-h ','fa fa-arrows-v ','fa fa-asl-interpreting ','fa fa-assistive-listening-systems ','fa fa-asterisk ','fa fa-at ','fa fa-automobile ','fa fa-audio-description ','fa fa-balance-scale ','fa fa-ban ','fa fa-bank ','fa fa-bar-chart ','fa fa-bar-chart-o ','fa fa-barcode ','fa fa-bars ','fa fa-bath ','fa fa-bathtub ','fa fa-battery-0 ','fa fa-battery-1 ','fa fa-battery-2 ','fa fa-battery-3 ','fa fa-battery-4 ','fa fa-battery-empty ','fa fa-battery-full ','fa fa-battery-half ','fa fa-battery-quarter ','fa fa-battery-three-quarters ','fa fa-bed ','fa fa-beer ','fa fa-bell ','fa fa-bell-o ','fa fa-bell-slash ','fa fa-bell-slash-o ','fa fa-bicycle ','fa fa-binoculars ','fa fa-birthday-cake ','fa fa-blind ','fa fa-bolt ','fa fa-bomb ','fa fa-book ','fa fa-bookmark ','fa fa-bookmark-o ','fa fa-braille ','fa fa-briefcase ','fa fa-bug ','fa fa-building ','fa fa-building-o ','fa fa-bullhorn ','fa fa-bullseye ','fa fa-bus ','fa fa-cab ','fa fa-calculator ','fa fa-calendar ','fa fa-calendar-o ','fa fa-calendar-check-o ','fa fa-calendar-minus-o ','fa fa-calendar-plus-o ','fa fa-calendar-times-o ','fa fa-camera ','fa fa-camera-retro ','fa fa-car ','fa fa-caret-square-o-down ','fa fa-caret-square-o-left ','fa fa-caret-square-o-right ','fa fa-caret-square-o-up ','fa fa-cart-arrow-down ','fa fa-cart-plus ','fa fa-cc ','fa fa-certificate ','fa fa-check ','fa fa-check-circle ','fa fa-check-circle-o ','fa fa-check-square ','fa fa-check-square-o ','fa fa-child ','fa fa-circle ','fa fa-circle-o ','fa fa-circle-o-notch ','fa fa-circle-thin ','fa fa-clock-o ','fa fa-clone ','fa fa-close ','fa fa-cloud ','fa fa-cloud-download ','fa fa-cloud-upload ','fa fa-code ','fa fa-code-fork ','fa fa-coffee ','fa fa-cog ','fa fa-cogs ','fa fa-comment ','fa fa-comment-o ','fa fa-comments ','fa fa-comments-o ','fa fa-commenting ','fa fa-commenting-o ','fa fa-compass ','fa fa-copyright ','fa fa-credit-card ','fa fa-credit-card-alt ','fa fa-creative-commons ','fa fa-crop ','fa fa-crosshairs ','fa fa-cube ','fa fa-cubes ','fa fa-cutlery ','fa fa-dashboard ','fa fa-database ','fa fa-deaf ','fa fa-deafness ','fa fa-desktop ','fa fa-diamond ','fa fa-dot-circle-o ','fa fa-download ','fa fa-drivers-license ','fa fa-drivers-license-o ','fa fa-edit ','fa fa-ellipsis-h ','fa fa-ellipsis-v ','fa fa-envelope ','fa fa-envelope-o ','fa fa-envelope-open ','fa fa-envelope-open-o ','fa fa-envelope-square ','fa fa-eraser ','fa fa-exchange ','fa fa-exclamation ','fa fa-exclamation-circle ','fa fa-exclamation-triangle ','fa fa-external-link ','fa fa-external-link-square ','fa fa-eye ','fa fa-eye-slash ','fa fa-eyedropper ','fa fa-fax ','fa fa-female ','fa fa-fighter-jet ','fa fa-file-archive-o ','fa fa-file-audio-o ','fa fa-file-code-o ','fa fa-file-excel-o ','fa fa-file-image-o ','fa fa-file-movie-o ','fa fa-file-pdf-o ','fa fa-file-photo-o ','fa fa-file-picture-o ','fa fa-file-powerpoint-o ','fa fa-file-sound-o ','fa fa-file-video-o ','fa fa-file-word-o ','fa fa-file-zip-o ','fa fa-film ','fa fa-filter ','fa fa-fire ','fa fa-fire-extinguisher ','fa fa-flag ','fa fa-flag-checkered ','fa fa-flag-o ','fa fa-flash ','fa fa-flask ','fa fa-folder ','fa fa-folder-o ','fa fa-folder-open ','fa fa-folder-open-o ','fa fa-frown-o ','fa fa-futbol-o ','fa fa-gamepad ','fa fa-gavel ','fa fa-gear ','fa fa-gears ','fa fa-genderless ','fa fa-gift ','fa fa-glass ','fa fa-globe ','fa fa-graduation-cap ','fa fa-group ','fa fa-hard-of-hearing ','fa fa-hdd-o ','fa fa-handshake-o ','fa fa-hashtag ','fa fa-headphones ','fa fa-heart ','fa fa-heart-o ','fa fa-heartbeat ','fa fa-history ','fa fa-home ','fa fa-hotel ','fa fa-hourglass ','fa fa-hourglass-1 ','fa fa-hourglass-2 ','fa fa-hourglass-3 ','fa fa-hourglass-end ','fa fa-hourglass-half ','fa fa-hourglass-o ','fa fa-hourglass-start ','fa fa-i-cursor ','fa fa-id-badge ','fa fa-id-card ','fa fa-id-card-o ','fa fa-image ','fa fa-inbox ','fa fa-industry ','fa fa-info ','fa fa-info-circle ','fa fa-institution ','fa fa-key ','fa fa-keyboard-o ','fa fa-language ','fa fa-laptop ','fa fa-leaf ','fa fa-legal ','fa fa-lemon-o ','fa fa-level-down ','fa fa-level-up ','fa fa-life-bouy ','fa fa-life-buoy ','fa fa-life-ring ','fa fa-life-saver ','fa fa-lightbulb-o ','fa fa-line-chart ','fa fa-location-arrow ','fa fa-lock ','fa fa-low-vision ','fa fa-magic ','fa fa-magnet ','fa fa-mail-forward ','fa fa-mail-reply ','fa fa-mail-reply-all ','fa fa-male ','fa fa-map ','fa fa-map-o ','fa fa-map-pin ','fa fa-map-signs ','fa fa-map-marker ','fa fa-meh-o ','fa fa-microchip ','fa fa-microphone ','fa fa-microphone-slash ','fa fa-minus ','fa fa-minus-circle ','fa fa-minus-square ','fa fa-minus-square-o ','fa fa-mobile ','fa fa-mobile-phone ','fa fa-money ','fa fa-moon-o ','fa fa-mortar-board ','fa fa-motorcycle ','fa fa-mouse-pointer ','fa fa-music ','fa fa-navicon ','fa fa-newspaper-o ','fa fa-object-group ','fa fa-object-ungroup ','fa fa-paint-brush ','fa fa-paper-plane ','fa fa-paper-plane-o ','fa fa-paw ','fa fa-pencil ','fa fa-pencil-square ','fa fa-pencil-square-o ','fa fa-percent ','fa fa-phone ','fa fa-phone-square ','fa fa-photo ','fa fa-picture-o ','fa fa-pie-chart ','fa fa-plane ','fa fa-plug ','fa fa-plus ','fa fa-plus-circle ','fa fa-plus-square ','fa fa-plus-square-o ','fa fa-podcast ','fa fa-power-off ','fa fa-print ','fa fa-puzzle-piece ','fa fa-qrcode ','fa fa-question ','fa fa-question-circle ','fa fa-question-circle-o ','fa fa-quote-left ','fa fa-quote-right ','fa fa-random ','fa fa-recycle ','fa fa-refresh ','fa fa-registered ','fa fa-remove ','fa fa-reorder ','fa fa-reply ','fa fa-reply-all ','fa fa-retweet ','fa fa-road ','fa fa-rocket ','fa fa-rss ','fa fa-rss-square ','fa fa-s15 ','fa fa-search ','fa fa-search-minus ','fa fa-search-plus ','fa fa-send ','fa fa-send-o ','fa fa-server ','fa fa-share ','fa fa-share-alt ','fa fa-share-alt-square ','fa fa-share-square ','fa fa-share-square-o ','fa fa-shield ','fa fa-ship ','fa fa-shopping-bag ','fa fa-shopping-basket ','fa fa-shopping-cart ','fa fa-shower ','fa fa-sign-in ','fa fa-sign-out ','fa fa-sign-language ','fa fa-signal ','fa fa-signing ','fa fa-sitemap ','fa fa-sliders ','fa fa-smile-o ','fa fa-snowflake-o ','fa fa-soccer-ball-o ','fa fa-sort ','fa fa-sort-alpha-asc ','fa fa-sort-alpha-desc ','fa fa-sort-amount-asc ','fa fa-sort-amount-desc ','fa fa-sort-asc ','fa fa-sort-desc ','fa fa-sort-down ','fa fa-sort-numeric-asc ','fa fa-sort-numeric-desc ','fa fa-sort-up ','fa fa-space-shuttle ','fa fa-spinner ','fa fa-spoon ','fa fa-square ','fa fa-square-o ','fa fa-star ','fa fa-star-half ','fa fa-star-half-empty ','fa fa-star-half-full ','fa fa-star-half-o ','fa fa-star-o ','fa fa-sticky-note ','fa fa-sticky-note-o ','fa fa-street-view ','fa fa-suitcase ','fa fa-sun-o ','fa fa-support ','fa fa-tablet ','fa fa-tachometer ','fa fa-tag ','fa fa-tags ','fa fa-tasks ','fa fa-taxi ','fa fa-television ','fa fa-terminal ','fa fa-thermometer ','fa fa-thermometer-0 ','fa fa-thermometer-1 ','fa fa-thermometer-2 ','fa fa-thermometer-3 ','fa fa-thermometer-4 ','fa fa-thermometer-empty ','fa fa-thermometer-full ','fa fa-thermometer-half ','fa fa-thermometer-quarter ','fa fa-thermometer-three-quarters ','fa fa-thumb-tack ','fa fa-thumbs-down ','fa fa-thumbs-o-up ','fa fa-thumbs-up ','fa fa-ticket ','fa fa-times ','fa fa-times-circle ','fa fa-times-circle-o ','fa fa-times-rectangle ','fa fa-times-rectangle-o ','fa fa-tint ','fa fa-toggle-down ','fa fa-toggle-left ','fa fa-toggle-right ','fa fa-toggle-up ','fa fa-toggle-off ','fa fa-toggle-on ','fa fa-trademark ','fa fa-trash ','fa fa-trash-o ','fa fa-tree ','fa fa-trophy ','fa fa-truck ','fa fa-tty ','fa fa-tv ','fa fa-umbrella ','fa fa-universal-access ','fa fa-university ','fa fa-unlock ','fa fa-unlock-alt ','fa fa-unsorted ','fa fa-upload ','fa fa-user ','fa fa-user-circle ','fa fa-user-circle-o ','fa fa-user-o ','fa fa-user-plus ','fa fa-user-secret ','fa fa-user-times ','fa fa-users ','fa fa-vcard ','fa fa-vcard-o ','fa fa-video-camera ','fa fa-volume-control-phone ','fa fa-volume-down ','fa fa-volume-off ','fa fa-volume-up ','fa fa-warning ','fa fa-wheelchair ','fa fa-wheelchair-alt ','fa fa-window-close ','fa fa-window-close-o ','fa fa-window-maximize ','fa fa-window-minimize ','fa fa-window-restore ','fa fa-wifi ','fa fa-wrench'];
        foreach ($icon as $k => $v) {
            $selected = ($v == $this->input->post('api')) ? ' selected="selected"' : "";
            echo '<option id="' . $v . '" value="' . $v . '" ' . $selected . '><i class="fa '. $v.'"></i>'. $v.'</option>';
        }
    }
}
