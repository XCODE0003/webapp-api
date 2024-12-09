import { createI18n } from 'vue-i18n'

const messages = {
    en: {
        other: {
            monet: 'Your monets',
        },
        footer: {
            home: 'Home',
            shop: 'Shop',
            boost: 'Boost',
            roulette: 'Roulette',
            referral: 'Referral',
        },
        home: {
            claim_bonus: 'Claim bonus',
            all_balance: 'Earn of all time',
            casino: 'Casino',


        },
        shop: {
            monet: 'Monet',
            autoclaim: 'Autoclaim storage',
        },
        header: {
            your_league: 'Your league',
            gold: 'Gold',
            silver: 'Silver',
            bronze: 'Bronze',
        },
        boost: {
            timer: 'Timer',
            autobot: 'Autobot',
            tap: 'Profit per tap',
            profit_per_hour: 'Profit per hour',
            hours: 'hours',
        },
        buttons: {
            buy: 'Buy',
            upgrade: 'Upgrade',
            claim: 'Claim',
            deposit: 'Deposit',
            close: 'Close',
        },
        referral: {
            share_link: 'Share link',
            invited_all_description_1: 'Invite your friends and get bonus - ',
            invited_all_description_2: 'of refferal profit',

        },
        spin: {
            free_spins: 'Free spins',
            description_1: 'You have ',
            description_2: 'free spins',
            spin: 'Spin!',
            price_one_spin: 'Price one spin',
        },
        deposit: {
            description: 'Send exactly the amount specified below to the address below, the balance will be replenished after the transaction is confirmed',
            comment: 'Comment for replenishment',
            address: 'Address for replenishment',
            amount: 'Amount (TON)',
            title: 'Replenishment of the balance',
        },
    },
    ru: {
        other: {
            monet: 'Ваши монеты',
        },
        footer: {
            home: 'Главная',
            shop: 'Магазин',
            boost: 'Буст',
            roulette: 'Рулетка',
            referral: 'Друзья',
        },
        shop: {
            monet: 'Монет',
            autoclaim: 'Автосбор сундука',
        },
        home: {
            claim_bonus: 'Забрать бонус',
            all_balance: 'Заработано за все время',
            casino: 'Казино',
        },
        header: {
            your_league: 'Ваша лига',
            gold: 'Золото',
            silver: 'Серебро',
            bronze: 'Бронза',
        },
        boost: {
            timer: 'Таймер',
            autobot: 'Автобот',
            tap: 'Прибыль за клик',
            profit_per_hour: 'Прибыль в час',
            hours: 'Часа',

        },
        buttons: {
            buy: 'Купить',
            upgrade: 'Улучшить',
            claim: 'Забрать',
            close: 'Закрыть',
            deposit: 'Пополнить',
        },
        referral: {
            share_link: 'Поделиться ссылкой',
            invited_all_description_1: 'Пригласите друзей и получите бонус - ',
            invited_all_description_2: 'от реферальной прибыли',
        },
        spin: {
            free_spins: 'Бесплатные вращения',
            description_1: 'У вас ',
            description_2: ' бесплатных вращений',
            spin: 'Крутить!',
            price_one_spin: 'Цена одного вращения',
        },
        deposit: {
            description: 'Отправьте строго ту сумму которая указана ниже на адрес ниже, баланс будет пополнен после подтверждения транзакции',
            amount: 'Сумма (TON)',
            address: 'Адрес для пополнения',
            comment: 'Комментарий для пополнения',
            title: 'Пополнение баланса',
        },
    }
}

const i18n = createI18n({
    locale: localStorage.getItem("lang") || 'ru', // установите язык по умолчанию
    fallbackLocale: 'en', // установите запасной язык
    messages,
})

export default i18n
