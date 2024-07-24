<?php

$logScreen = <<<HTML
<div class="reg-log-screen" id="reg-log-screen" style="translate: -50% -500%">
<div class="reg-log-screen-container">
    <div style="text-align: center">
    <button class="close-reg-log-screen" id="closeLogRegScreen" onclick=closeLogReg()>X</button>
    <h4 class="reg-log-h4">Форма входа/регистрации</h4>
    <center><h4 class="reg-log-h4 proc-status-h4" id="proc-status" style="visibility: hidden">Форма входа/регистрации</h4></center>
    </div>

    <form action="#" method="post" id="log-form" onsubmit="reqLogProc();return false">
    <div class="login-screen" id="log-screen">
        <div class="login-field">
            <h4 class="login-screen-h4">Логин (без пробелов и символов <span style="font-size:inherit;color:red">«»"`'</span>)</h4>
            <input type="text" id="log-login" class="login-screen-field" placeholder="Логин" name="log-login" onchange=checkValidLog()>
        </div>
        <div class="login-field">
            <h4 class="login-screen-h4">Пароль (без пробелов и символов <span style="font-size:inherit;color:red">«»"`'</span>)</h4>
            <input type="password" id="log-pass" class="login-screen-field" placeholder="Пароль" name="log-pass" onchange=checkValidLog()>
        </div>
        <div class="buttons-field">
            <input type="submit" class="log-btn reg-log-btn" name="log-in" value="Войти" disabled>
            <center style="font-size: 12pt">или</center>
            <button type="button" id="switch-to-reg" class="reg-log-btn" onclick=changeScreen(this)>Зарегистрироваться</button>
        </div>
    </div>
    </form>
    <form action="#" method="post" id="reg-form" onsubmit="reqRegProc();return false">
    <div class="login-screen" id="reg-screen" style="translate: 100%; display: none">
        <div class="login-field">
            <h4 class="login-screen-h4">Логин (без пробелов и символов <span style="font-size:inherit;color:red">«»"`'</span>)</h4>
            <input type="text" id="reg-login" class="login-screen-field" placeholder="Логин (мин. 3 символа)" name="reg-login" onchange=checkValid(this)>
        </div>
        <div class="login-field">
            <h4 class="login-screen-h4">Пароль (без пробелов и символов <span style="font-size:inherit;color:red">«»"`'</span>)</h4>
            <input type="password" id="reg-pass" class="login-screen-field" placeholder="Пароль (мин. 8 символов)" name="reg-pass" onchange=checkValid(this)>
        </div>
        <div class="login-field">
            <h4 class="login-screen-h4">Повторите пароль</h4>
            <input type="password" id="reg-pass-rep" class="login-screen-field" placeholder="Повторите пароль" onchange=checkValid(this)>
        </div>
        <div class="buttons-field">
            <input type="submit" class="reg-btn reg-log-btn" name="reg" value="Регистрация" disabled>
            <center style="font-size: 12pt">или</center>
            <button type="button" id="switch-to-log" class="reg-log-btn" onclick=changeScreen(this)>Уже есть аккаунт</button>
        </div>
    </div>
    </form>
</div>

</div>
HTML;

echo $logScreen;

?>


