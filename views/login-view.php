<?php
require_once "partials/header.php";
?>
    <main class="login-page">
        <div class="container-1 wrapper">
            <form action="login.php<?=  isset($redirect_url) && $redirect_url ? '?redirect_url=' . $redirect_url : '' ?>" method="post"
                  class="login-form">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" value="<?= session_old_value('email', '') ?>" required id="email" name="email"
                           placeholder="Votre adresse email ">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" required placeholder="Votre adresse email " id="password" name="password">
                </div>
                <button class="btn btn-primary login-button">Connexion</button>
                <a href="register.php<?= isset($redirect_url) && $redirect_url ? '?redirect_url=' . $redirect_url : '' ?>" class="login-outer-text">S'incrire</a>
            </form>
            <div>
                <h1 class="title">Rejoignez nous !</h1>
                <p class="login-description">
                    Rejoignez notre librairie et profitez des avantages suivants :
                </p>

                <ul class="avantages-list">
                    <li class="avantage">
                        <div class="icon">
                            <svg width="42" height="42" viewBox="0 0 42 42" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <circle cx="21" cy="21" r="21" fill="#55EFC4"/>
                                <path d="M19.294 27.998C18.859 27.998 18.447 27.795 18.183 27.445L14.61 22.724C14.4995 22.5782 14.4189 22.4121 14.3727 22.2351C14.3265 22.0581 14.3156 21.8737 14.3407 21.6925C14.3657 21.5113 14.4263 21.3369 14.5188 21.1791C14.6114 21.0213 14.7341 20.8833 14.88 20.773C15.0259 20.6622 15.1922 20.5813 15.3693 20.5349C15.5465 20.4885 15.7311 20.4776 15.9126 20.5026C16.094 20.5277 16.2687 20.5884 16.4266 20.6811C16.5846 20.7738 16.7227 20.8968 16.833 21.043L19.184 24.147L25.095 14.655C25.291 14.3416 25.6034 14.1187 25.9635 14.0353C26.3236 13.9519 26.7021 14.0147 27.016 14.21C27.669 14.616 27.87 15.476 27.462 16.13L20.478 27.34C20.3588 27.5322 20.1945 27.6924 19.9993 27.8068C19.8041 27.9211 19.584 27.986 19.358 27.996C19.336 27.998 19.316 27.998 19.294 27.998Z"
                                      fill="#00B894"/>
                            </svg>
                        </div>
                        <span>Réserver votre livre depuis chez vous !</span>
                    </li>
                    <li class="avantage">
                        <div class="icon">
                            <svg width="42" height="42" viewBox="0 0 42 42" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <circle cx="21" cy="21" r="21" fill="#55EFC4"/>
                                <path d="M19.294 27.998C18.859 27.998 18.447 27.795 18.183 27.445L14.61 22.724C14.4995 22.5782 14.4189 22.4121 14.3727 22.2351C14.3265 22.0581 14.3156 21.8737 14.3407 21.6925C14.3657 21.5113 14.4263 21.3369 14.5188 21.1791C14.6114 21.0213 14.7341 20.8833 14.88 20.773C15.0259 20.6622 15.1922 20.5813 15.3693 20.5349C15.5465 20.4885 15.7311 20.4776 15.9126 20.5026C16.094 20.5277 16.2687 20.5884 16.4266 20.6811C16.5846 20.7738 16.7227 20.8968 16.833 21.043L19.184 24.147L25.095 14.655C25.291 14.3416 25.6034 14.1187 25.9635 14.0353C26.3236 13.9519 26.7021 14.0147 27.016 14.21C27.669 14.616 27.87 15.476 27.462 16.13L20.478 27.34C20.3588 27.5322 20.1945 27.6924 19.9993 27.8068C19.8041 27.9211 19.584 27.986 19.358 27.996C19.336 27.998 19.316 27.998 19.294 27.998Z"
                                      fill="#00B894"/>
                            </svg>
                        </div>
                        <span>Lisez vos livres directement en ligne !</span>
                    </li>
                    <li class="avantage">
                        <div class="icon">
                            <svg width="42" height="42" viewBox="0 0 42 42" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <circle cx="21" cy="21" r="21" fill="#55EFC4"/>
                                <path d="M19.294 27.998C18.859 27.998 18.447 27.795 18.183 27.445L14.61 22.724C14.4995 22.5782 14.4189 22.4121 14.3727 22.2351C14.3265 22.0581 14.3156 21.8737 14.3407 21.6925C14.3657 21.5113 14.4263 21.3369 14.5188 21.1791C14.6114 21.0213 14.7341 20.8833 14.88 20.773C15.0259 20.6622 15.1922 20.5813 15.3693 20.5349C15.5465 20.4885 15.7311 20.4776 15.9126 20.5026C16.094 20.5277 16.2687 20.5884 16.4266 20.6811C16.5846 20.7738 16.7227 20.8968 16.833 21.043L19.184 24.147L25.095 14.655C25.291 14.3416 25.6034 14.1187 25.9635 14.0353C26.3236 13.9519 26.7021 14.0147 27.016 14.21C27.669 14.616 27.87 15.476 27.462 16.13L20.478 27.34C20.3588 27.5322 20.1945 27.6924 19.9993 27.8068C19.8041 27.9211 19.584 27.986 19.358 27.996C19.336 27.998 19.316 27.998 19.294 27.998Z"
                                      fill="#00B894"/>
                            </svg>
                        </div>
                        <span>Vos livres disponibles ou que vous soyez !</span>
                    </li>
                </ul>
            </div>
        </div>
    </main>
<?php
require_once "partials/footer.php";
