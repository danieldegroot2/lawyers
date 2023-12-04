<?php

use Illuminate\Support\Facades\Route;

const USER_TYPE_ID = 1;
const EMPLOYEE_TYPE_ID = 2;

?>
<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="/main">Lawyers</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                @guest
                    <li class="nav-item">
                        <a @class([
                            'nav-link',
                            'active' => Route::currentRouteName() === 'actionSignup_usercontroller'
                        ]) href="/site/signup">Регистрация</a>
                    </li>
                    <li class="nav-item">
                        <a @class([
                            'nav-link',
                            'active' => Route::currentRouteName() === 'actionLogin_usercontroller'
                        ]) href="/site/login">Вход</a>
                    </li>
                @endguest

                @auth
                    <?php $user = Auth::user(); ?>
                    <li class="nav-item dropdown" data-bs-theme="light">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $user->first_name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <?php if ($user->type_id === USER_TYPE_ID): ?>
                                <li><a class="dropdown-item" href="/clientcabinet">Кабинет клиента</a></li>
                                <li><a class="dropdown-item" href="/createvacancy">Создать вакансию</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="/employeecabinet">Кабинет юриста</a></li>
                            <?php endif; ?>

                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/site/logout">Выход</a></li>
                        </ul>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>
