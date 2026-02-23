@extends('layouts.app')

@section('content')
<div class="bg-[#f9f9f9]/80 flex flex-col items-start justify-start relative overflow-hidden min-h-screen">

    {{-- HEADER --}}
    <header class="bg-black py-2.5 px-4 flex flex-col items-start justify-start self-stretch shrink-0 relative">
        <div class="py-1.5 flex flex-row items-center justify-between w-full max-w-[1264px] mx-auto relative">
            <a href="{{ route('home') }}" class="text-main text-left font-rubik text-lg md:text-2xl leading-[140%] font-extrabold uppercase">
                Лавка желаний и предсказаний
            </a>
            <div class="flex flex-row gap-2.5 items-center justify-start shrink-0 relative">
                <div class="text-white text-center font-rubik text-sm font-semibold hidden sm:block">
                    Поддержка
                </div>
                <a href="https://t.me/LPIHGVal" class="tg-btn" target="_blank" rel="noopener">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2982 7.26996C10.7752 7.94496 7.73215 9.33996 3.16815 11.457C2.42815 11.771 2.03915 12.078 2.00415 12.378C1.94415 12.885 2.54115 13.085 3.35415 13.358C3.46415 13.394 3.57815 13.432 3.69615 13.473C4.49515 13.75 5.57015 14.073 6.12915 14.086C6.63615 14.098 7.20215 13.876 7.82715 13.418C12.0902 10.354 14.2912 8.80496 14.4302 8.77196C14.5272 8.74796 14.6622 8.71896 14.7542 8.80496C14.8452 8.89196 14.8362 9.05596 14.8262 9.09996C14.7672 9.36796 12.4262 11.686 11.2142 12.886C10.8362 13.26 10.5682 13.525 10.5142 13.586C10.3902 13.721 10.2652 13.85 10.1452 13.973C9.40315 14.735 8.84515 15.307 10.1762 16.24C10.8162 16.689 11.3262 17.06 11.8372 17.43C12.3942 17.834 12.9502 18.236 13.6692 18.738C13.8532 18.866 14.0282 18.999 14.1982 19.128C14.8472 19.621 15.4292 20.063 16.1492 19.993C16.5672 19.952 16.9992 19.533 17.2192 18.283C17.7372 15.333 18.7572 8.93696 18.9922 6.30096C19.0132 6.07096 18.9872 5.77496 18.9662 5.64496C18.9462 5.51496 18.9022 5.33096 18.7432 5.19396C18.5562 5.03196 18.2662 4.99796 18.1372 4.99996C17.5482 5.01096 16.6452 5.34596 12.2972 7.26996H12.2982Z" fill="white"/>
                    </svg>
                </a>
            </div>
        </div>
    </header>

    {{-- CONTENT --}}
    <div class="bg-add flex-1 self-stretch px-4 py-16 md:py-24">
        <div class="w-full max-w-[1264px] mx-auto">

            <h1 class="text-white font-rubik text-2xl md:text-[32px] leading-[140%] font-extrabold uppercase mb-10">
                Политика конфиденциальности
            </h1>

            <div class="flex flex-col gap-8 text-grey font-rubik text-sm leading-[170%]">

                <div class="flex flex-col gap-3">
                    <h2 class="text-white font-rubik text-lg leading-[140%] font-semibold">1. Общие положения</h2>
                    <p>Настоящая Политика конфиденциальности (далее — «Политика») определяет порядок обработки и защиты персональных данных пользователей сайта «Лавка желаний и предсказаний» (далее — «Сайт»).</p>
                    <p>Используя Сайт, вы соглашаетесь с условиями данной Политики. Если вы не согласны с условиями Политики, пожалуйста, не используйте Сайт.</p>
                    <p>Администрация Сайта оставляет за собой право вносить изменения в настоящую Политику. Актуальная версия Политики всегда доступна на данной странице.</p>
                </div>

                <div class="flex flex-col gap-3">
                    <h2 class="text-white font-rubik text-lg leading-[140%] font-semibold">2. Какие данные мы собираем</h2>
                    <p>В процессе использования Сайта мы можем собирать следующие данные:</p>
                    <ul class="flex flex-col gap-1.5 pl-5" style="list-style-type: disc;">
                        <li>Технические данные: IP-адрес, тип браузера, операционная система, дата и время посещения, уникальный идентификатор устройства (cookie).</li>
                        <li>Данные об использовании Сайта: информация о просмотренных страницах, совершённых действиях (открытие предсказаний, отправка писем).</li>
                        <li>Платёжные данные: информация, необходимая для обработки добровольных пожертвований (обрабатывается платёжным провайдером ЮKassa, мы не храним данные банковских карт).</li>
                        <li>Содержимое писем, отправленных через форму «Письмо в небесную канцелярию».</li>
                    </ul>
                </div>

                <div class="flex flex-col gap-3">
                    <h2 class="text-white font-rubik text-lg leading-[140%] font-semibold">3. Цели обработки данных</h2>
                    <p>Собранные данные используются для следующих целей:</p>
                    <ul class="flex flex-col gap-1.5 pl-5" style="list-style-type: disc;">
                        <li>Обеспечение функционирования Сайта и предоставление его сервисов.</li>
                        <li>Обработка добровольных пожертвований.</li>
                        <li>Улучшение качества работы Сайта и пользовательского опыта.</li>
                        <li>Предотвращение мошенничества и злоупотреблений.</li>
                        <li>Выполнение требований законодательства Российской Федерации.</li>
                    </ul>
                </div>

                <div class="flex flex-col gap-3">
                    <h2 class="text-white font-rubik text-lg leading-[140%] font-semibold">4. Хранение и защита данных</h2>
                    <p>Мы принимаем необходимые организационные и технические меры для защиты персональных данных от несанкционированного доступа, изменения, раскрытия или уничтожения.</p>
                    <p>Персональные данные хранятся на защищённых серверах и доступны ограниченному кругу лиц, имеющих специальные права доступа и обязанных сохранять конфиденциальность данных.</p>
                    <p>Срок хранения персональных данных определяется целями их обработки и требованиями законодательства.</p>
                </div>

                <div class="flex flex-col gap-3">
                    <h2 class="text-white font-rubik text-lg leading-[140%] font-semibold">5. Передача данных третьим лицам</h2>
                    <p>Мы не продаём, не обмениваем и не передаём персональные данные третьим лицам, за исключением следующих случаев:</p>
                    <ul class="flex flex-col gap-1.5 pl-5" style="list-style-type: disc;">
                        <li>Обработка платежей через платёжный сервис ЮKassa (ООО «ЮМани»).</li>
                        <li>Выполнение требований законодательства, судебных решений или запросов государственных органов.</li>
                        <li>Защита прав, собственности или безопасности Сайта и его пользователей.</li>
                    </ul>
                </div>

                <div class="flex flex-col gap-3">
                    <h2 class="text-white font-rubik text-lg leading-[140%] font-semibold">6. Файлы cookie</h2>
                    <p>Сайт использует файлы cookie для обеспечения корректной работы сервиса. Файлы cookie — это небольшие текстовые файлы, сохраняемые на вашем устройстве.</p>
                    <p>Мы используем следующие типы cookie:</p>
                    <ul class="flex flex-col gap-1.5 pl-5" style="list-style-type: disc;">
                        <li>Технические cookie: необходимы для работы Сайта (идентификатор устройства для определения бесплатных открытий).</li>
                        <li>Сессионные cookie: используются для поддержания сессии пользователя.</li>
                    </ul>
                    <p>Вы можете отключить использование cookie в настройках вашего браузера, однако это может повлиять на функциональность Сайта.</p>
                </div>

                <div class="flex flex-col gap-3">
                    <h2 class="text-white font-rubik text-lg leading-[140%] font-semibold">7. Права пользователей</h2>
                    <p>В соответствии с законодательством Российской Федерации вы имеете право:</p>
                    <ul class="flex flex-col gap-1.5 pl-5" style="list-style-type: disc;">
                        <li>Получить информацию о том, какие ваши персональные данные обрабатываются.</li>
                        <li>Потребовать уточнения, блокирования или уничтожения персональных данных, если они являются неполными, устаревшими или неточными.</li>
                        <li>Отозвать согласие на обработку персональных данных.</li>
                    </ul>
                    <p>Для реализации указанных прав вы можете обратиться в службу поддержки через Telegram.</p>
                </div>

                <div class="flex flex-col gap-3">
                    <h2 class="text-white font-rubik text-lg leading-[140%] font-semibold">8. Добровольные пожертвования</h2>
                    <p>Все переводы средств на Сайте являются добровольными пожертвованиями на развитие развлекательного проекта. Платёж не является покупкой товара или услуги.</p>
                    <p>Обработка платежей осуществляется через сертифицированный платёжный сервис ЮKassa. Данные банковских карт вводятся на защищённой странице платёжного сервиса и не передаются Сайту.</p>
                </div>

                <div class="flex flex-col gap-3">
                    <h2 class="text-white font-rubik text-lg leading-[140%] font-semibold">9. Контактная информация</h2>
                    <p>По всем вопросам, связанным с обработкой персональных данных, вы можете обратиться в службу поддержки через Telegram.</p>
                </div>

                <div class="flex flex-col gap-3">
                    <p class="text-grey font-rubik text-xs leading-[140%]">Дата последнего обновления: 16 февраля 2026 г.</p>
                </div>

            </div>
        </div>
    </div>

    {{-- FOOTER --}}
    <div class="bg-black pt-10 pb-10 md:pt-[70px] md:pb-[70px] px-4 flex flex-col gap-[30px] md:gap-[50px] items-start justify-start self-stretch shrink-0 relative">
        <div class="flex flex-col gap-6 md:flex-row md:gap-[30px] items-start justify-start w-full max-w-[1264px] mx-auto relative">
            <div class="flex flex-col gap-5 items-start justify-start shrink-0 relative">
                <div class="text-main text-left font-rubik text-xl leading-[140%] font-black uppercase w-[185px]">
                    Лавка желаний и предсказаний
                </div>
                <div class="text-white text-center font-rubik text-sm leading-[140%]">
                    2026 &copy; Все права защищены
                </div>
            </div>
            <div class="flex flex-col gap-5 items-start justify-start flex-1 relative">
                <div class="text-white font-rubik text-sm leading-[140%] font-semibold">Дисклеймер</div>
                <div class="text-grey text-left font-rubik text-sm leading-[140%] self-stretch">
                    Сервис носит исключительно развлекательный характер. Все тексты являются художественными и интерпретационными материалами и не являются предсказаниями, руководством к действию или профессиональными рекомендациями.
                </div>
                <div class="text-grey text-left font-rubik text-sm leading-[140%] self-stretch">
                    Все переводы средств на сайте являются добровольными пожертвованиями на развитие проекта. Платёж не является покупкой товара или услуги.
                </div>
            </div>
            <div class="flex flex-col gap-5 items-start justify-start flex-1 relative">
                <div class="text-white font-rubik text-sm leading-[140%] font-semibold">Навигация</div>
                <div class="flex flex-col gap-2.5 items-start justify-start shrink-0 relative">
                    <a href="{{ route('terms') }}" class="footer-link">Правила и условия</a>
                    <a href="{{ route('privacy') }}" class="footer-link">Политика конфиденциальности</a>
                    <a href="{{ route('data-policy') }}" class="footer-link">Политика обработки данных</a>
                </div>
            </div>
            <div class="flex flex-col gap-5 items-start justify-start flex-1 relative">
                <div class="text-white font-rubik text-sm leading-[140%] font-semibold">Поддержка</div>
                <div class="flex flex-col gap-2.5 items-start justify-start self-stretch shrink-0 relative">
                    <div class="text-grey text-left font-rubik text-sm leading-[140%] self-stretch">
                        Проблемы с пожертвованием?<br>Напишите в поддержку в Telegram
                    </div>
                    <div class="rounded-[19px] shrink-0 w-[38px] h-[38px] relative">
                        <div class="bg-[#1bb1f0] rounded-[19px] absolute right-0 left-0 bottom-0 top-0"></div>
                        <a href="#" target="_blank" rel="noopener" class="w-6 h-6 absolute left-[50%] top-[50%] block" style="translate: -50% -50%">
                            <svg class="w-full h-full overflow-visible" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2982 7.27008C10.7752 7.94508 7.73215 9.34008 3.16815 11.4571C2.42815 11.7711 2.03915 12.0781 2.00415 12.3781C1.94415 12.8851 2.54115 13.0851 3.35415 13.3581C3.46415 13.3941 3.57815 13.4321 3.69615 13.4731C4.49515 13.7501 5.57015 14.0731 6.12915 14.0861C6.63615 14.0981 7.20215 13.8761 7.82715 13.4181C12.0902 10.3541 14.2912 8.80508 14.4302 8.77208C14.5272 8.74808 14.6622 8.71908 14.7542 8.80508C14.8452 8.89208 14.8362 9.05608 14.8262 9.10008C14.7672 9.36808 12.4262 11.6861 11.2142 12.8861C10.8362 13.2601 10.5682 13.5251 10.5142 13.5861C10.3902 13.7211 10.2652 13.8501 10.1452 13.9731C9.40315 14.7351 8.84515 15.3071 10.1762 16.2401C10.8162 16.6891 11.3262 17.0601 11.8372 17.4301C12.3942 17.8341 12.9502 18.2361 13.6692 18.7381C13.8532 18.8661 14.0282 18.9991 14.1982 19.1281C14.8472 19.6211 15.4292 20.0631 16.1492 19.9931C16.5672 19.9521 16.9992 19.5331 17.2192 18.2831C17.7372 15.3331 18.7572 8.93708 18.9922 6.30108C19.0132 6.07108 18.9872 5.77508 18.9662 5.64508C18.9462 5.51508 18.9022 5.33108 18.7432 5.19408C18.5562 5.03208 18.2662 4.99808 18.1372 5.00008C17.5482 5.01108 16.6452 5.34608 12.2972 7.27008H12.2982Z" fill="white"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
