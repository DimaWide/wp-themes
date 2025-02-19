# Описание проекта

Это веб приложение позволяет пользователям покупать токены, проверять их статус и получать базовую информацию о токенах.

**Ссылка на сайт:** [pump.black](https://pump.black)

Скриншот: [Главная страница](https://github.com/DimaWide/wp-themes/blob/main/assets-data/pump.black/screencapture-loc-pump-black.jpg) | [Мобильный вид](https://github.com/DimaWide/wp-themes/blob/main/assets-data/pump.black/screencapture-loc-pump-black-mobile.jpg)

## Основные функции

### 1. Раздел FEATURED FIELDS
- Отображает недавно купленные токены на странице **Order**, связанные с токеном по CA Mint ID.

#### Описание:
- Токены отображаются в этом разделе в течение определённого времени, согласно настройкам плана.
- После нажатия "Order" отправляется API-запрос для создания нового инвойса через [nowpayments.io](https://nowpayments.io).
- Новый заказ добавляется в таблицу `wp_np_orders` с данными заказа и его статусом.
- Создаётся новый тип поста "featured_field", и токен сохраняется в таблице `wp_featured_fields_token` для облегчения поиска.
- После завершения оплаты статус заказа в таблице `wp_np_orders` автоматически обновляется на "завершён".
- Соответствующий "featured_field" становится активным, и начинается отсчёт времени его активности на основе настроек плана.
- Добавлена Cron-задача для выполнения периодических действий.

![Featured Fields](https://github.com/DimaWide/wp-themes/blob/main/assets-data/pump.black/Featured%20Fields.jpg)

<img src="https://github.com/DimaWide/wp-themes/blob/main/assets-data/pump.black/order-page.jpg" alt="image" width="49%"> <img src="https://github.com/DimaWide/wp-themes/blob/main/assets-data/pump.black/packages.jpg" alt="image" width="49%">


### 2. Раздел UPCOMING LAUNCHES
- Отображает токены, которые будут скоро запущены, с таймером обратного отсчета.

#### Описание:
- Создан пользовательский тип поста `upcoming_field` для управления предстоящими запусками токенов.
- Добавлен JavaScript-таймер, синхронизированный с серверным временем, который ведет обратный отсчет до даты запуска (`Launch Date`) каждого `upcoming_field`.
- Пользователи могут автоматически добавлять данные токенов, вводя Mint ID токена в админ-панели поста `upcoming_field`. После сохранения поста отправляется запрос на внешний API `https://frontend-api.pump.fun/coins/{mint}`, а данные токена сохраняются в таблице `wp_upcoming_field_token`.
- Данные токена затем извлекаются из локальной базы данных для отображения на фронтенде, что оптимизирует производительность и гарантирует надёжность в случае сбоев внешних сервисов.
- Добавлен статус столбца для доступности токенов.
- Добавлена кнопка для повторной загрузки данных токена при сбоях внешнего API.
- Доступна ручная настройка всех полей и времени запуска.

<img src="https://github.com/DimaWide/wp-themes/blob/main/assets-data/pump.black/UPCOMING LAUNCHES.jpg" alt="image"> <img src="https://github.com/DimaWide/wp-themes/blob/main/assets-data/pump.black/UPCOMING LAUNCHES (1).png" alt="image" width="49%"> <img src="https://github.com/DimaWide/wp-themes/blob/main/assets-data/pump.black/UPCOMING LAUNCHES (2).png" alt="image" width="50%">

### 3. Динамические таблицы токенов
- Таблицы, такие как NEW LIVESTREAM, DEX PAID и BIG BUYS, отображают данные токенов из внешней базы данных и обновляются динамически через WebSocket.
- Реализована буферизация для таблицы BigBuys, что позволяет пользователям приостановить поток токенов и накопить данные.

#### Описание:
- Изначально данные таблиц извлекаются с помощью функции `getTableData()`, которая получает информацию из внешней базы данных.
- При загрузке страницы устанавливается соединение с WebSocket-сервером, который передает данные токенов с помощью Python-скрипта.
- Каждое сообщение WebSocket, содержащее данные токенов в формате JSON, обновляет соответствующую таблицу. Новые строки добавляются через метод `AddRow` класса `TableManager`, который динамически генерирует строки с использованием класса `TableRowBase` и его расширений, таких как `LiveStreamRow`,  `BigBuysRow`,  `BigBuysRow`.
Используя ООП, принципы наследования, полиморфизма и коппозицию мы получаем такой модульный подход который гарантирует масштабируемость и лёгкость обслуживания.

![Токен Таблицы](https://github.com/DimaWide/wp-themes/blob/main/assets-data/pump.black/fields-animation.gif)

### 4. Проверка статуса DEXSCREENER PAID
- Проверка статуса оплаты DEXScreener для токена и отображение соответствующей информации о токене.

#### Описание:
- Форма доступна для ввода Mint ID токена. После нажатия кнопки "CHECK" пользователя перенаправляет на страницу **Dex Paid** с Mint ID в качестве параметра URL.
- На странице выполняется AJAX-запрос с использованием Mint ID для получения данных токена и его статуса DexPaid.
- После получения данных информация о токене и статус отображаются с анимацией и звуковым сопровождением при положительном статусе Dex Paid.
- Пользователи могут загрузить информацию о токене в виде изображения с помощью библиотеки `html2canvas.js`.

![Dex Paid Status](https://github.com/DimaWide/wp-themes/blob/main/assets-data/pump.black/dex-paid-status.gif)

### 5. Покупка планов с оплатой криптовалютой (nowpayments.io)
- Пользователи могут покупать планы через оплату криптовалютой на странице **Order**.

#### Описание:
- Созданы три плана с соответствующими настройками.
- Форма на странице **Order** позволяет пользователям ввести Mint ID токена для получения информации и продолжения покупки плана.
- После покупки отправляется запрос на API [nowpayments.io](https://nowpayments.io), создавая инвойс. Пользователь затем перенаправляется на страницу оплаты, где он может завершить оплату в Solana (SOL).
- Администраторам доступна возможность имитации покупки токенов для тестирования.

![Order Plan](https://github.com/DimaWide/wp-themes/blob/main/assets-data/pump.black/gif-1.gif)

### 6. Плагин интеграции оплаты через NowPayments.io
- Был разработан пользовательский плагин для интеграции оплаты через криптовалюты через nowpayments.io.
- Ссылка GitHub: [Плагин - NOWPayments Integration for WordPress](https://github.com/DimaWide/wp-plugins/tree/main/nowpayments-integration/README.md)

#### Особенности:
- При покупке плана отправляется API-запрос на `https://api.nowpayments.io/v1/invoice` с деталями заказа, и создается инвойс для оплаты в SOL.
- При активации создается таблица для хранения информации о заказах.
- Зарегистрирован маршрут REST API для обработки уведомлений о статусе заказа и автоматического обновления базы данных.

### 7. Пользовательская админ-страница для управления заказами
- Создана пользовательская админ-страница для отображения информации о заказах.

![Order Management Page](https://github.com/DimaWide/wp-themes/blob/main/assets-data/pump.black/np-orders-page.jpg)
