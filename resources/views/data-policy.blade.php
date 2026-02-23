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
                Политика обработки персональных данных
            </h1>

            <div class="flex flex-col gap-8 text-grey font-rubik text-sm leading-[170%]">

                <div class="flex flex-col gap-3">
                    <h2 class="text-white font-rubik text-lg leading-[140%] font-semibold">1. Введение</h2>
                    <p>Настоящая Политика обработки персональных данных (далее — «Политика») разработана в соответствии с Федеральным законом от 27.07.2006 № 152-ФЗ «О персональных данных» и определяет порядок обработки персональных данных и меры по обеспечению их безопасности на сайте «Лавка желаний и предсказаний» (далее — «Оператор», «Сайт»).</p>
                    <p>Политика действует в отношении всех персональных данных, которые Оператор может получить от пользователей Сайта.</p>
                </div>

                <div class="flex flex-col gap-3">
                    <h2 class="text-white font-rubik text-lg leading-[140%] font-semibold">2. Основные понятия</h2>
                    <ul class="flex flex-col gap-1.5 pl-5" style="list-style-type: disc;">
                        <li><strong class="text-white">Персональные данные</strong> — любая информация, относящаяся к прямо или косвенно определённому или определяемому физическому лицу (субъекту персональных данных).</li>
                        <li><strong class="text-white">Обработка персональных данных</strong> — любое действие (операция) или совокупность действий с персональными данными, включая сбор, запись, систематизацию, накопление, хранение, уточнение, извлечение, использование, передачу, обезличивание, блокирование, удаление и уничтожение.</li>
                        <li><strong class="text-white">Оператор</strong> — лицо, самостоятельно или совместно с другими лицами организующее и (или) осуществляющее обработку персональных данных.</li>
                        <li><strong class="text-white">Пользователь</strong> — любое физическое лицо, имеющее доступ к Сайту посредством сети Интернет.</li>
                    </ul>
                </div>

                <div class="flex flex-col gap-3">
                    <h2 class="text-white font-rubik text-lg leading-[140%] font-semibold">3. Состав обрабатываемых персональных данных</h2>
                    <p>Оператор может обрабатывать следующие персональные данные Пользователя:</p>
                    <ul class="flex flex-col gap-1.5 pl-5" style="list-style-type: disc;">
                        <li>IP-адрес.</li>
                        <li>Данные файлов cookie (уникальный идентификатор устройства).</li>
                        <li>Информация о браузере (тип, версия, язык).</li>
                        <li>Информация об операционной системе.</li>
                        <li>Дата и время обращения к Сайту.</li>
                        <li>Адреса запрашиваемых страниц.</li>
                        <li>Содержимое текстовых сообщений (писем), введённых Пользователем в формы Сайта.</li>
                    </ul>
                    <p>Оператор не осуществляет сбор и обработку специальных категорий персональных данных (касающихся расовой, национальной принадлежности, политических взглядов, религиозных или философских убеждений, состояния здоровья, интимной жизни).</p>
                </div>

                <div class="flex flex-col gap-3">
                    <h2 class="text-white font-rubik text-lg leading-[140%] font-semibold">4. Цели обработки персональных данных</h2>
                    <p>Обработка персональных данных осуществляется в следующих целях:</p>
                    <ul class="flex flex-col gap-1.5 pl-5" style="list-style-type: disc;">
                        <li>Предоставление Пользователю доступа к функциональности Сайта.</li>
                        <li>Идентификация устройства Пользователя для предоставления бесплатного первого открытия.</li>
                        <li>Обработка добровольных пожертвований.</li>
                        <li>Обеспечение технической поддержки и устранение неполадок.</li>
                        <li>Анализ использования Сайта для улучшения качества обслуживания.</li>
                        <li>Обеспечение безопасности Сайта и предотвращение мошенничества.</li>
                        <li>Исполнение требований законодательства Российской Федерации.</li>
                    </ul>
                </div>

                <div class="flex flex-col gap-3">
                    <h2 class="text-white font-rubik text-lg leading-[140%] font-semibold">5. Правовые основания обработки</h2>
                    <p>Обработка персональных данных осуществляется на следующих правовых основаниях:</p>
                    <ul class="flex flex-col gap-1.5 pl-5" style="list-style-type: disc;">
                        <li>Согласие субъекта персональных данных на обработку его персональных данных (п. 1 ч. 1 ст. 6 ФЗ № 152-ФЗ).</li>
                        <li>Необходимость исполнения договора, стороной которого является субъект персональных данных (п. 5 ч. 1 ст. 6 ФЗ № 152-ФЗ).</li>
                        <li>Необходимость для осуществления прав и законных интересов Оператора (п. 7 ч. 1 ст. 6 ФЗ № 152-ФЗ).</li>
                    </ul>
                </div>

                <div class="flex flex-col gap-3">
                    <h2 class="text-white font-rubik text-lg leading-[140%] font-semibold">6. Порядок и условия обработки</h2>
                    <p>Обработка персональных данных осуществляется с использованием средств автоматизации и без использования таких средств.</p>
                    <p>При обработке персональных данных Оператор обеспечивает:</p>
                    <ul class="flex flex-col gap-1.5 pl-5" style="list-style-type: disc;">
                        <li>Конфиденциальность персональных данных.</li>
                        <li>Применение организационных и технических мер для защиты персональных данных от несанкционированного или случайного доступа, уничтожения, изменения, блокирования, копирования, распространения и иных неправомерных действий.</li>
                        <li>Ограничение доступа к персональным данным определённым кругом лиц.</li>
                    </ul>
                </div>

                <div class="flex flex-col gap-3">
                    <h2 class="text-white font-rubik text-lg leading-[140%] font-semibold">7. Передача персональных данных</h2>
                    <p>Оператор может передавать персональные данные третьим лицам в следующих случаях:</p>
                    <ul class="flex flex-col gap-1.5 pl-5" style="list-style-type: disc;">
                        <li>Пользователь выразил согласие на такую передачу.</li>
                        <li>Передача необходима для обработки платежей — платёжному провайдеру ЮKassa (ООО «ЮМани», ОГРН 1127711000031).</li>
                        <li>Передача предусмотрена законодательством Российской Федерации.</li>
                        <li>Передача необходима для защиты прав и законных интересов Оператора или третьих лиц.</li>
                    </ul>
                    <p>Трансграничная передача персональных данных не осуществляется.</p>
                </div>

                <div class="flex flex-col gap-3">
                    <h2 class="text-white font-rubik text-lg leading-[140%] font-semibold">8. Сроки обработки и хранения</h2>
                    <p>Персональные данные обрабатываются и хранятся в течение сроков, необходимых для достижения целей обработки, если иной срок не установлен законодательством.</p>
                    <p>По достижении целей обработки или в случае утраты необходимости в достижении этих целей, а также при отзыве субъектом согласия на обработку, персональные данные подлежат уничтожению в срок не более 30 дней.</p>
                </div>

                <div class="flex flex-col gap-3">
                    <h2 class="text-white font-rubik text-lg leading-[140%] font-semibold">9. Меры по обеспечению безопасности</h2>
                    <p>Оператор принимает необходимые и достаточные организационные и технические меры для защиты персональных данных, в том числе:</p>
                    <ul class="flex flex-col gap-1.5 pl-5" style="list-style-type: disc;">
                        <li>Использование защищённого соединения (HTTPS/SSL) для передачи данных.</li>
                        <li>Ограничение доступа к персональным данным сотрудников и контрагентов.</li>
                        <li>Использование межсетевых экранов и систем обнаружения вторжений.</li>
                        <li>Регулярное обновление программного обеспечения серверов.</li>
                        <li>Резервное копирование данных.</li>
                    </ul>
                </div>

                <div class="flex flex-col gap-3">
                    <h2 class="text-white font-rubik text-lg leading-[140%] font-semibold">10. Права субъекта персональных данных</h2>
                    <p>Субъект персональных данных имеет право:</p>
                    <ul class="flex flex-col gap-1.5 pl-5" style="list-style-type: disc;">
                        <li>Получать информацию, касающуюся обработки его персональных данных.</li>
                        <li>Требовать от Оператора уточнения, блокирования или уничтожения персональных данных, если они являются неполными, устаревшими, неточными, незаконно полученными или не являются необходимыми для заявленной цели обработки.</li>
                        <li>Отозвать согласие на обработку персональных данных путём направления соответствующего запроса через службу поддержки.</li>
                        <li>Обжаловать действия или бездействие Оператора в уполномоченный орган по защите прав субъектов персональных данных (Роскомнадзор) или в судебном порядке.</li>
                    </ul>
                </div>

                <div class="flex flex-col gap-3">
                    <h2 class="text-white font-rubik text-lg leading-[140%] font-semibold">11. Заключительные положения</h2>
                    <p>Оператор имеет право вносить изменения в настоящую Политику. Актуальная версия Политики размещается на данной странице Сайта.</p>
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
