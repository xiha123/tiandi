<?php
switch($this->agent->browser()) {
    case 'Opera':
    case 'Chrome':
    case 'Firefox':
    case 'Safari':
        echo '<script src="../static/lib/jquery/jquery-2.1.4.min.js"></script>';
        break;
    default:
        echo '<script src="../static/lib/jquery/jquery-1.11.3.min.js"></script>';
        break;
}
?>

<script src="../static/js/admin/global.js"></script>