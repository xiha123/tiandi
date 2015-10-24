<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="static/css/QA/money.css" />
<link rel="stylesheet" href="static/css/global.css"/>

</head>

<div class="box">
    <ul>
        <li class="moneymessage">购买信息确认</li>
        <i class="fa fa-long-arrow-right fl"></i>
        <li class="moneymessage">悬着支付方式</li>
        <i class="fa fa-long-arrow-right fl"></i>
        <li>确认结果</li>
    </ul>
    <ul>
        <li class="moneymessage">购买金币数量</li>
       <li>
           <select autofocus>
               <option value="100">100</option>
               <option value="50">50</option>
               <option value="30">30</option>
               <option value="10">10</option>
           </select>
       </li>

    </ul>

    <p>需要支付100元</p>
    <input type="submit"value="确认购买"/>
</div>

