<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
?>

<footer class="footer">
    <div class="container">
        <div class="footer-counters">
            <!-- Rating@Mail.ru logo -->
            <a href="http://top.mail.ru/jump?from=2827040">
            <img src="//top-fwz1.mail.ru/counter?id=2827040;t=280;l=1"
            style="border:0;" height="31" width="38" alt="Рейтинг@Mail.ru" /></a>
            <!-- //Rating@Mail.ru logo -->
        </div>
        <div class="footer-links">
            &copy; Коворкинг-ревю <?= date('Y') ?>
            &nbsp;&nbsp;
            <div class="footer-social">
            <a href="https://www.facebook.com/coworkingreview/" target="_blank">
              <svg class="" aria-hidden="true" aria-labelledby="title" version="1.1" role="img" width="24" height="24" viewBox="0 0 24 24"><path d="M12 24c-6.616 0-12-5.384-12-12s5.384-12 12-12 12 5.384 12 12-5.384 12-12 12zm0-22.909c-6.015 0-10.909 4.894-10.909 10.909s4.894 10.909 10.909 10.909 10.909-4.894 10.909-10.909-4.894-10.909-10.909-10.909zM14.727 8.798h-1.558c-.184 0-.389.242-.389.566v1.125h1.947v1.604h-1.948v4.816h-1.839v-4.816h-1.667v-1.604h1.668v-.944c0-1.354.939-2.455 2.229-2.455h1.558v1.707z"/></svg>
            </a>
            <a href="https://vk.com/coworkingreview" target="_blank">
              <svg class="" aria-hidden="true" aria-labelledby="title" version="1.1" role="img" width="24" height="24" viewBox="0 0 24 24"><path d="M12 24c-6.616 0-12-5.384-12-12s5.384-12 12-12 12 5.384 12 12-5.384 12-12 12zm0-22.909c-6.015 0-10.909 4.894-10.909 10.909s4.894 10.909 10.909 10.909 10.909-4.894 10.909-10.909-4.894-10.909-10.909-10.909zM16.33 11.926s1.725-2.433 1.896-3.232c.057-.286-.069-.445-.365-.445h-1.497c-.343 0-.468.148-.572.365 0 0-.809 1.724-1.793 2.81-.316.351-.477.457-.651.457-.141 0-.205-.118-.205-.434v-2.776c0-.388-.046-.503-.365-.503h-2.399c-.183 0-.297.106-.297.251 0 .365.56.448.56 1.439v2.044c0 .411-.023.572-.217.572-.514 0-1.737-1.771-2.422-3.781-.137-.41-.286-.525-.674-.525h-1.496c-.217 0-.377.148-.377.365 0 .399.468 2.251 2.307 4.729 1.234 1.668 2.856 2.57 4.318 2.57.891 0 1.108-.148 1.108-.526v-1.28c0-.32.125-.457.309-.457.205 0 .568.067 1.416.902 1.005.96 1.073 1.359 1.622 1.359h1.679c.171 0 .332-.08.332-.365 0-.377-.491-1.051-1.245-1.85-.309-.411-.811-.856-.971-1.063-.229-.239-.16-.376 0-.627z"/></svg>
          </a>
      </div>

            &nbsp;&nbsp;
            <?= Html::a('О&nbsp;проекте', ['site/about']) ?>
            &nbsp;&nbsp;
            <?= Html::a('Контакты', ['site/contacts']) ?>


        </div>

    </div>
</footer>
