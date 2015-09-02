<div class="js-back-to-top back-to-top" onclick="javascript:gotoTop()">
    <i class="fa fa-chevron-up"></i>
</div>

<?php
switch($this->agent->browser()) {
    case 'Opera':
    case 'Chrome':
    case 'Firefox':
    case 'Safari':
        echo '<script src="static/lib/jquery/jquery-2.1.4.min.js"></script>';
        break;
    default:
        echo '<script src="static/lib/jquery/jquery-1.11.3.min.js"></script>';
        break;
}
?>
<script src="static/js/api.js"></script>
<script>
    window._td = {};
    _td.api = require('api');
</script>
<script src="static/js/global.js"></script>
