<!DOCTYPE html>

<html lang="hr">
    <head>
        <title>Autor</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="title" content="O autoru" />
        <meta name="author" content="Toni Škobić" />
        <meta
            name="description"
            content="11.6.2021. Stranica O autoru web stranice, ključne riječi: autor, rođendan"
        />
        <link rel="stylesheet" href="./css/main.css" />
    </head>

    <body>
        <header class="m-b-md">
            <a class="title link" href="#content">Autor</a>
            <nav class="box-fluid navigation">
                <ul class="list--unstyled list--direction">
                    <li>
                        <a href="./index.html">Početna</a>
                    </li>
                    <li>
                        <a href="./author.php">O autoru</a>
                    </li>
                    <li>
                        <a href="./login.php">Prijava</a>
                    </li>
                    <li>
                        <a href="./registration.html">Registracija</a>
                    </li>
                </ul>
            </nav>

            <section aria-label="social networks" class="social-icons">
                <img
                    class="social-icon m-l-sm"
                    src="./multimedia/images/rss.png"
                    alt="rss"
                />
            </section>
        </header>
        <main id="content">
            <section aria-label="about author" class="box centered">
                <ul class="list--unstyled">
                    <li>Ime: Toni</li>
                    <li>Prezime: Škobić</li>
                    <li>
                        <address>
                            E-pošta:
                            <a href="mailto:tskobic@foi.hr">tskobic@foi.hr</a>
                        </address>
                    </li>
                </ul>
                <div class="gallery__image">
                    <figure class="zoom">
                        <picture>
                            <source srcset="./multimedia/images/profilna.jpeg" />
                            <img
                                src="./multimedia/images/profilna.jpeg"
                                alt="Toni Škobić"
                            />
                        </picture>
                        <figcaption>Toni Škobić</figcaption>
                    </figure>
                </div>

            </section>
        </main>
        <footer class="box-fluid footer m-t-md">
            <div>
                <a href="./author.html">Toni Škobić</a>
                <p>&copy; 2021 T. Škobić</p>
            </div>
        </footer>
    </body>
</html>
