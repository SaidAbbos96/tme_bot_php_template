from aiogram.types import InlineKeyboardMarkup, InlineKeyboardButton, WebAppInfo

main_i_menu = InlineKeyboardMarkup(
    inline_keyboard = [
        [
            InlineKeyboardButton(text="NFT Market", web_app=WebAppInfo(url="https://mproweb.uz/YTless/NFT_market/web/"))
        ],
        [
            InlineKeyboardButton(text="Green Market", web_app=WebAppInfo(url="https://mproweb.uz/YTless/greenMarket/store/"))
        ],
        [
            InlineKeyboardButton(text="Swupjs", web_app=WebAppInfo(url="https://mproweb.uz/YTless/greenMarket/swap/"))
        ]
    ]
)