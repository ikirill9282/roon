// Device UUID Management
function getDeviceUuid() {
    let uuid = getCookie('device_uuid');
    if (!uuid) {
        uuid = generateUUID();
        setCookie('device_uuid', uuid, 365);
    }
    return uuid;
}

function generateUUID() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        const r = Math.random() * 16 | 0;
        const v = c === 'x' ? r : (r & 0x3 | 0x8);
        return v.toString(16);
    });
}

function setCookie(name, value, days) {
    const expires = new Date();
    expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
    document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/`;
}

function getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

// CSRF Token
function getCSRFToken() {
    return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
}

// Debounce function
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const context = this;
        const later = () => {
            clearTimeout(timeout);
            func.apply(context, args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Letter Form Handler
document.addEventListener('DOMContentLoaded', function() {
    const letterForm = document.getElementById('letter-form');
    const letterMessage = document.getElementById('letter-message');
    const charCount = document.getElementById('char-count');
    const submitBtn = document.getElementById('letter-submit-btn');

    if (letterMessage && charCount) {
        letterMessage.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = `${length}/500`;
            if (length >= 500) {
                charCount.style.color = '#ff0000';
            } else {
                charCount.style.color = '';
            }
        });
    }

    if (letterForm) {
        letterForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.6';
            }

            const message = letterMessage.value.trim();
            
            if (!message || message.length > 500) {
                showError('Сообщение должно быть от 1 до 500 символов');
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.style.opacity = '1';
                }
                return;
            }

            showLetterPaymentModal(message);
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
            }
        });
    }

    // Prediction Cards Handler
    const predictionCards = document.querySelectorAll('.prediction-card');
    const deviceUuid = getDeviceUuid();

    predictionCards.forEach(card => {
        const debouncedClick = debounce(async function() {
            const category = this.getAttribute('data-category');
            if (!category) return;

            // Disable card temporarily
            this.style.pointerEvents = 'none';
            this.style.opacity = '0.6';

            try {
                const response = await fetch('/api/predictions/open', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': getCSRFToken(),
                    },
                    body: JSON.stringify({
                        category: category,
                        device_uuid: deviceUuid,
                    }),
                });

                const data = await response.json();

                if (data.success && data.free) {
                    // Free prediction - show it
                    showPrediction(data.prediction);
                } else if (data.payment_required) {
                    // Payment required
                    showPaymentModal(data.amount, data.category);
                } else {
                    showError(data.message || 'Произошла ошибка');
                }
            } catch (error) {
                console.error('Error:', error);
                showError('Произошла ошибка при открытии предсказания');
            } finally {
                // Re-enable card
                this.style.pointerEvents = '';
                this.style.opacity = '1';
            }
        }, 300);

        card.addEventListener('click', debouncedClick);
    });

    // Check for payment success/failure messages
    const urlParams = new URLSearchParams(window.location.search);
    const paymentSuccess = urlParams.get('payment_success') || sessionStorage.getItem('payment_success');
    const paymentCategory = sessionStorage.getItem('payment_category');
    
    if (paymentSuccess) {
        sessionStorage.removeItem('payment_success');
        
        // If it was a prediction payment, automatically open it
        if (paymentCategory) {
            // Open prediction after successful payment (paid)
            setTimeout(async () => {
                try {
                    const response = await fetch('/api/predictions/open-paid', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': getCSRFToken(),
                        },
                        body: JSON.stringify({
                            category: paymentCategory,
                            device_uuid: getDeviceUuid(),
                        }),
                    });

                    const data = await response.json();
                    if (data.success && data.prediction) {
                        showPrediction(data.prediction);
                    } else {
                        showError(data.message || 'Не удалось получить предсказание');
                    }
                } catch (error) {
                    console.error('Error opening prediction:', error);
                    showError('Произошла ошибка при открытии предсказания');
                }
                sessionStorage.removeItem('payment_category');
            }, 500);
        } else {
            showLetterSentModal();
        }
    }
    
    if (urlParams.get('payment_failed')) {
        showError('Платеж не был обработан');
    }
});

// Telegram SVG icon reusable
const telegramSvg = `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2982 7.27008C10.7752 7.94508 7.73215 9.34008 3.16815 11.4571C2.42815 11.7711 2.03915 12.0781 2.00415 12.3781C1.94415 12.8851 2.54115 13.0851 3.35415 13.3581C3.46415 13.3941 3.57815 13.4321 3.69615 13.4731C4.49515 13.7501 5.57015 14.0731 6.12915 14.0861C6.63615 14.0981 7.20215 13.8761 7.82715 13.4181C12.0902 10.3541 14.2912 8.80508 14.4302 8.77208C14.5272 8.74808 14.6622 8.71908 14.7542 8.80508C14.8452 8.89208 14.8362 9.05608 14.8262 9.10008C14.7672 9.36808 12.4262 11.6861 11.2142 12.8861C10.8362 13.2601 10.5682 13.5251 10.5142 13.5861C10.3902 13.7211 10.2652 13.8501 10.1452 13.9731C9.40315 14.7351 8.84515 15.3071 10.1762 16.2401C10.8162 16.6891 11.3262 17.0601 11.8372 17.4301C12.3942 17.8341 12.9502 18.2361 13.6692 18.7381C13.8532 18.8661 14.0282 18.9991 14.1982 19.1281C14.8472 19.6211 15.4292 20.0631 16.1492 19.9931C16.5672 19.9521 16.9992 19.5331 17.2192 18.2831C17.7372 15.3331 18.7572 8.93708 18.9922 6.30108C19.0132 6.07108 18.9872 5.77508 18.9662 5.64508C18.9462 5.51508 18.9022 5.33108 18.7432 5.19408C18.5562 5.03208 18.2662 4.99808 18.1372 5.00008C17.5482 5.01108 16.6452 5.34608 12.2972 7.27008H12.2982Z" fill="white"/>
</svg>`;

const checkboxSvg = `<div class="modal-checkbox" data-checked="false">
    <svg class="checkbox-icon" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect x="1" y="1" width="16" height="16" rx="3" stroke="#595555" stroke-width="1.5" fill="none" class="checkbox-border"/>
        <rect x="1" y="1" width="16" height="16" rx="3" fill="#197adc" class="checkbox-fill" style="opacity:0"/>
        <path d="M5 9.5L7.5 12L13 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="checkbox-check" style="opacity:0"/>
    </svg>
</div>`;

const policyText = `<span class="text-grey">Я подтверждаю, что ознакомлен и даю согласие на обработку персональных данных на условиях и для целей, определяемых </span><a href="/privacy" class="div-policy-link" target="_blank">Политикой конфиденциальности</a><span class="text-grey">, так же совершаете добровольное пожертвование на развитие развлекательного проекта. Платёж не является покупкой товара или услуги.</span>`;

const supportBlock = `<div class="flex flex-row gap-2.5 items-start justify-start shrink-0">
    <div class="text-grey text-left font-rubik text-xs leading-[140%]">
        Проблемы с пожертвованием?<br>Напишите в поддержку в Telegram
    </div>
    <a href="https://t.me/LPIHGVal" target="_blank" rel="noopener" class="tg-btn">${telegramSvg}</a>
</div>`;

// Init checkbox toggle inside a container
function initCheckboxes(container) {
    container.querySelectorAll('.modal-checkbox').forEach(cb => {
        cb.addEventListener('click', function() {
            const checked = this.dataset.checked === 'true';
            this.dataset.checked = String(!checked);
            const fill = this.querySelector('.checkbox-fill');
            const check = this.querySelector('.checkbox-check');
            const border = this.querySelector('.checkbox-border');
            if (!checked) {
                fill.style.opacity = '1';
                check.style.opacity = '1';
                border.style.opacity = '0';
            } else {
                fill.style.opacity = '0';
                check.style.opacity = '0';
                border.style.opacity = '1';
            }
        });
    });
}

// Close any open modal
function closeModal() {
    const overlay = document.querySelector('.modal-overlay');
    if (overlay) overlay.remove();
}

// Create modal wrapper
function createModalOverlay() {
    const overlay = document.createElement('div');
    overlay.className = 'modal-overlay';
    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) closeModal();
    });
    return overlay;
}

// Show Prediction Payment Modal (Открытие сверстка)
function showPaymentModal(amount, category) {
    closeModal();
    const overlay = createModalOverlay();
    overlay.innerHTML = `
        <div class="modal-box gap-10">
            <div class="text-white text-center font-rubik text-2xl md:text-[32px] leading-[140%] font-extrabold uppercase">
                Открытие сверстка
            </div>
            <div class="flex flex-col gap-5 items-center justify-center self-stretch">
                <div class="flex flex-col gap-2.5 items-center justify-center self-stretch">
                    <div class="bg-black rounded p-[25px] flex items-center justify-center self-stretch h-[60px]">
                        <div class="text-grey text-left font-rubik text-sm leading-[140%]">${amount} рублей</div>
                    </div>
                    <div class="text-grey text-left font-rubik text-xs leading-[140%] self-stretch">
                        Вы совершаете добровольное пожертвование на развитие развлекательного проекта. Платёж не является покупкой товара или услуги.
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-5 items-center justify-start self-stretch">
                <div class="flex flex-row gap-2.5 items-start justify-start self-stretch">
                    <button id="modal-back-btn" class="bg-add rounded py-2 px-5 flex items-center justify-center flex-1 h-[50px] cursor-pointer hover:opacity-80 transition-opacity">
                        <span class="text-grey text-center font-rubik text-sm leading-[140%] font-semibold">Назад</span>
                    </button>
                    <button id="confirm-payment-btn" class="bg-main rounded py-2 px-5 flex items-center justify-center flex-1 h-[50px] cursor-pointer hover:opacity-90 transition-opacity">
                        <span class="text-white text-center font-rubik text-sm leading-[140%] font-semibold">Открыть</span>
                    </button>
                </div>
                <div class="flex flex-col gap-3.5 items-start justify-start self-stretch">
                    <div class="flex flex-row gap-3.5 items-start justify-start self-stretch">
                        ${checkboxSvg}
                        <div class="text-left font-rubik text-xs leading-[140%] flex-1">${policyText}</div>
                    </div>
                </div>
                ${supportBlock}
            </div>
        </div>
    `;
    document.body.appendChild(overlay);
    initCheckboxes(overlay);

    overlay.querySelector('#modal-back-btn').addEventListener('click', closeModal);
    overlay.querySelector('#confirm-payment-btn').addEventListener('click', async function() {
        this.disabled = true;
        this.style.opacity = '0.6';

        try {
            sessionStorage.setItem('payment_category', category);
            const response = await fetch('/api/payments/create', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': getCSRFToken(),
                },
                body: JSON.stringify({
                    type: 'prediction',
                    related_id: 0,
                    category: category,
                }),
            });
            const data = await response.json();
            if (data.success && data.payment_url) {
                window.location.href = data.payment_url;
            } else {
                showError(data.message || 'Произошла ошибка');
                this.disabled = false;
                this.style.opacity = '1';
            }
        } catch (error) {
            console.error('Error:', error);
            showError('Произошла ошибка при создании платежа');
            this.disabled = false;
            this.style.opacity = '1';
        }
    });
}

// Show Prediction Result Modal (Твое предсказание)
function showPrediction(prediction) {
    closeModal();
    const overlay = createModalOverlay();
    const imgSrc = prediction.image || '';
    const imgBlock = imgSrc ? `<img class="shrink-0 w-[197px] h-[197px]" style="object-fit: cover; aspect-ratio: 1; border-radius: 8px;" src="${escapeHtml(imgSrc)}" alt="Предсказание" />` : '';

    overlay.innerHTML = `
        <div class="modal-box gap-[30px]">
            <div class="text-white text-left font-rubik text-2xl md:text-[32px] leading-[140%] font-extrabold uppercase">
                Твое предсказание
            </div>
            <div class="flex flex-col gap-5 items-center justify-center self-stretch">
                <div class="flex flex-col gap-2.5 items-center justify-center self-stretch">
                    <div class="bg-black rounded p-[25px] flex items-start justify-start self-stretch relative">
                        <div class="text-main text-left font-rubik text-sm leading-[140%] pr-8">${sanitizeHtml(prediction.content)}</div>
                        <button class="copy-prediction-btn" title="Копировать">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="9" y="9" width="13" height="13" rx="2" stroke="#595555" stroke-width="2"/>
                                <path d="M5 15H4C2.89543 15 2 14.1046 2 13V4C2 2.89543 2.89543 2 4 2H13C14.1046 2 15 2.89543 15 4V5" stroke="#595555" stroke-width="2"/>
                            </svg>
                        </button>
                    </div>
                    <div class="text-grey text-center font-rubik text-sm leading-[140%]">Прочитай и сохрани в памяти</div>
                </div>
                ${imgBlock}
            </div>
            <div class="flex flex-col gap-2.5 items-center justify-center self-stretch">
                <div class="flex flex-row gap-2.5 items-start justify-start self-stretch">
                    <button id="modal-back-btn" class="rounded py-2 px-5 flex items-center justify-center flex-1 h-[50px] cursor-pointer hover:opacity-80 transition-opacity">
                        <span class="text-grey text-center font-rubik text-sm leading-[140%] font-semibold">Вернуть обратно</span>
                    </button>
                    <button id="modal-open-more-btn" class="bg-main rounded py-2 px-5 flex items-center justify-center flex-1 h-[50px] cursor-pointer hover:opacity-90 transition-opacity">
                        <span class="text-white text-center font-rubik text-sm leading-[140%] font-semibold">Открыть еще!</span>
                    </button>
                </div>
                <div class="flex flex-col gap-3.5 items-start justify-start self-stretch">
                    <div class="flex flex-row gap-3.5 items-start justify-start self-stretch">
                        ${checkboxSvg}
                        <div class="text-left font-rubik text-xs leading-[140%] flex-1">${policyText}</div>
                    </div>
                </div>
                ${supportBlock}
            </div>
        </div>
    `;
    document.body.appendChild(overlay);
    initCheckboxes(overlay);

    // Copy button
    const copyBtn = overlay.querySelector('.copy-prediction-btn');
    if (copyBtn) {
        copyBtn.addEventListener('click', function() {
            const text = prediction.content.replace(/<[^>]*>/g, '');
            navigator.clipboard.writeText(text).then(() => {
                this.innerHTML = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 13l4 4L19 7" stroke="#197adc" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>`;
                setTimeout(() => {
                    this.innerHTML = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="9" y="9" width="13" height="13" rx="2" stroke="#595555" stroke-width="2"/><path d="M5 15H4C2.89543 15 2 14.1046 2 13V4C2 2.89543 2.89543 2 4 2H13C14.1046 2 15 2.89543 15 4V5" stroke="#595555" stroke-width="2"/></svg>`;
                }, 1500);
            });
        });
    }

    overlay.querySelector('#modal-back-btn').addEventListener('click', closeModal);
    overlay.querySelector('#modal-open-more-btn').addEventListener('click', closeModal);
}

// Show Letter Payment Modal (Письмо в небесную канцелярию)
function showLetterPaymentModal(message) {
    closeModal();
    const overlay = createModalOverlay();
    overlay.innerHTML = `
        <div class="modal-box gap-10">
            <div class="text-white text-center font-rubik text-2xl md:text-[32px] leading-[140%] font-extrabold uppercase self-stretch">
                Письмо в небесную канцелярию
            </div>
            <div class="flex flex-col gap-5 items-center justify-center self-stretch">
                <div class="flex flex-col gap-2.5 items-center justify-center self-stretch">
                    <div class="bg-black rounded p-[25px] flex items-center justify-center self-stretch h-[60px]">
                        <div class="text-grey text-left font-rubik text-sm leading-[140%]">50 рублей</div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-5 items-center justify-start self-stretch">
                <div class="flex flex-row gap-2.5 items-start justify-start self-stretch">
                    <button id="modal-back-btn" class="rounded py-2 px-5 flex items-center justify-center flex-1 h-[50px] cursor-pointer hover:opacity-80 transition-opacity">
                        <span class="text-grey text-center font-rubik text-sm leading-[140%] font-semibold">Назад</span>
                    </button>
                    <button id="confirm-letter-btn" class="bg-main rounded py-2 px-5 flex items-center justify-center flex-1 h-[50px] cursor-pointer hover:opacity-90 transition-opacity">
                        <span class="text-white text-center font-rubik text-sm leading-[140%] font-semibold">Отправить</span>
                    </button>
                </div>
                <div class="flex flex-col gap-3.5 items-start justify-start self-stretch">
                    <div class="flex flex-row gap-3.5 items-start justify-start self-stretch">
                        ${checkboxSvg}
                        <div class="text-left font-rubik text-xs leading-[140%] flex-1">${policyText}</div>
                    </div>
                </div>
                ${supportBlock}
            </div>
        </div>
    `;
    document.body.appendChild(overlay);
    initCheckboxes(overlay);

    overlay.querySelector('#modal-back-btn').addEventListener('click', closeModal);
    overlay.querySelector('#confirm-letter-btn').addEventListener('click', async function() {
        this.disabled = true;
        this.style.opacity = '0.6';

        try {
            const response = await fetch('/api/letters', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': getCSRFToken(),
                },
                body: JSON.stringify({ message }),
            });
            const data = await response.json();
            if (data.success && data.payment_url) {
                window.location.href = data.payment_url;
            } else if (data.success) {
                showLetterSentModal();
            } else {
                showError(data.message || 'Произошла ошибка');
                this.disabled = false;
                this.style.opacity = '1';
            }
        } catch (error) {
            console.error('Error:', error);
            showError('Произошла ошибка при отправке письма');
            this.disabled = false;
            this.style.opacity = '1';
        }
    });
}

// Show Letter Sent Success Modal (Письмо отправлено)
function showLetterSentModal() {
    closeModal();
    const overlay = createModalOverlay();
    overlay.innerHTML = `
        <div class="modal-box gap-10">
            <div class="text-white text-left font-rubik text-2xl md:text-[32px] leading-[140%] font-extrabold uppercase">
                Письмо отправлено
            </div>
            <div class="flex flex-col gap-5 items-start justify-start self-stretch">
                <div class="text-white text-center font-rubik text-lg leading-[140%] font-medium self-stretch">
                    Благодарим тебя. Послание принято<br>и отправлено в небесную канцелярию
                </div>
            </div>
            <div class="flex flex-col gap-2.5 items-start justify-start self-stretch">
                <div class="flex flex-row items-center justify-between self-stretch">
                    <button id="modal-back-btn" class="rounded py-2 px-5 flex items-center justify-center flex-1 h-[50px] cursor-pointer hover:opacity-80 transition-opacity">
                        <span class="text-grey text-center font-rubik text-sm leading-[140%] font-semibold">Вернуться обратно</span>
                    </button>
                    <button id="modal-send-more-btn" class="bg-main rounded py-2 px-5 flex items-center justify-center flex-1 h-[50px] cursor-pointer hover:opacity-90 transition-opacity">
                        <span class="text-white text-center font-rubik text-sm leading-[140%] font-semibold">Отправить еще!</span>
                    </button>
                </div>
                <div class="text-grey text-center font-rubik text-sm leading-[140%] self-stretch">
                    Сервис носит развлекательный характер.
                </div>
            </div>
        </div>
    `;
    document.body.appendChild(overlay);
    initCheckboxes(overlay);

    overlay.querySelector('#modal-back-btn').addEventListener('click', closeModal);
    overlay.querySelector('#modal-send-more-btn').addEventListener('click', function() {
        closeModal();
        const letterMessage = document.getElementById('letter-message');
        if (letterMessage) {
            letterMessage.value = '';
            letterMessage.focus();
            const charCount = document.getElementById('char-count');
            if (charCount) charCount.textContent = '0/500';
        }
    });
}

// Show Success Message
function showSuccess(message) {
    const notification = document.createElement('div');
    notification.className = 'success-notification';
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: #4CAF50;
        color: white;
        padding: 15px 20px;
        border-radius: 5px;
        z-index: 10001;
        box-shadow: 0 4px 6px rgba(0,0,0,0.3);
    `;
    document.body.appendChild(notification);
    setTimeout(() => notification.remove(), 5000);
}

// Show Error Message
function showError(message) {
    const notification = document.createElement('div');
    notification.className = 'error-notification';
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: #f44336;
        color: white;
        padding: 15px 20px;
        border-radius: 5px;
        z-index: 10001;
        box-shadow: 0 4px 6px rgba(0,0,0,0.3);
    `;
    document.body.appendChild(notification);
    setTimeout(() => notification.remove(), 5000);
}

// Sanitize HTML - allow safe tags, strip everything else
function sanitizeHtml(html) {
    const div = document.createElement('div');
    div.innerHTML = html;
    div.querySelectorAll('script,style,iframe,object,embed,form,input').forEach(el => el.remove());
    return div.innerHTML;
}

// Escape HTML
function escapeHtml(text) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, m => map[m]);
}
