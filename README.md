# Joomla Rapid K2 Theme
Implementacja szablonów Twig dla CCK K2.

## Instalacja
Musisz mieć zainstalowany pakiet [Joomla Rapid Framework](https://github.com/mikoweb/Joomla-Rapid-Framework). Można to zrobić ręcznie skryptem composer.phar ale najszybszą metodą będzie użycie narzędzia [Joomla Startup](https://github.com/mikoweb/Joomla-Startup).

Po ściągnięciu na serwer repozytorium Joomla Startup musisz utworzyć dwa pliki `install.custom.json` oraz `update.custom.json` o zawartości:

```json
{
    "require": {
        "mikoweb/joomla-rapid-k2-theme": "dev-master"
    }
}
```

Teraz możesz zainstalować CMS Joomla.

`php joomla.php joomla:install 3.3.*`

Nie zapomnij włączyć pluginu na zapleczu.

## Konfiguracja

![Uruchomienie Twig](https://raw.githubusercontent.com/mikoweb/joomla-rapid-k2-theme/master/01.png)
![Wybór szablonu Twig](https://raw.githubusercontent.com/mikoweb/joomla-rapid-k2-theme/master/02.png)

## Tworzenie szablonu

Wystarczy przekopiować domyślny szablon.

`cp JOOMLA/components/com_k2/templates/twig/views/default JOOMLA/components/com_k2/templates/twig/views/MY_THEME`

Mechanizm `templates override` jest w pełni wspierany. Wystarczy skopiować pliki `*.html.twig` do katalogu:

`JOOMLA/templates/JOOMLA_THEME/views/extension/components/com_k2/templates/twig/views/K2_THEME`

## Ilustracje

Jest możliwość żeby każdy szablon miał osobne rozmiary ilustracji wpisów. Wystarczy zedytować plik `JOOMLA/components/com_k2/templates/twig/config/MY_THEME/images.yml` lub `JOOMLA/templates/JOOMLA_THEME/config/com_k2/MY_THEME/images.yml`.

Ilustracje mają pełne wsparcie dla RWD dlatego w sekcji `media` można podać dowolną ilość reguł  `media queries`, dzięki którym można np. dynamicznie zmieniać adres źródłowy obrazka w zależności od szerokości ekranu.

W sekcji `images` ustawia się parametry źródeł ilustracji typu: szerokość, wysokość, jakość, format. Istotnymi parametrami są `index` i `media-index`. Pierwszy określa z jakiego pliku będą generowane ilustracje. Lista wartości:

`0`: XSmall
`1`: Small
`2`: Medium
`3`: Large
`4`: XLarge
`6`: Original

Natomiast `media-index` oznacza numer reguły `media queries`, którą zdefiniowałeś w sekcji `media`. Są to indeksy tablicy zatem numerowanie rozpoczyna się od numeru `0`.
