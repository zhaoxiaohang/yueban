<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/21
 * Time: 14:52
 */

?>
<link rel="stylesheet" href="/assets/index/css/error.css">

<div class="container">
    <div class="hero-unit error">
        <h1><?= $errorCode ?></h1>
        <p class="error-msg"><?= $errorMsg ?></p>
        <p>
            <a href="/"><button>去首页</button></a>&nbsp;&nbsp;
        </p>
    </div>
</div>


