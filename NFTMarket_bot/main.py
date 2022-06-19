from aiogram import Bot, Dispatcher, executor, types
from aiogram.types.message import ContentTypes
import logging
from keyboards import main_i_menu


logging.basicConfig(level=logging.INFO)

TOKEN = "5418286898:AAHoScgPto00ziw5JFadzRac_1JiAZBQ7pY"
bot = Bot(token=TOKEN, parse_mode=types.ParseMode.HTML)
dp = Dispatcher(bot)

shipping_options = [
    types.ShippingOption(id='free', title='Global POST', prices=[
        types.LabeledPrice(label="in a 30 days to home", amount=0)
    ]),
    types.ShippingOption(id='premium', title='Delivers by courier', prices=[
        types.LabeledPrice(label="in a 3 days to home", amount=130*100)
    ]),
]


@dp.message_handler(commands=["info", "start"])
async def info(message: types.Message):
    print(message)
    full_name = f"{message.from_user.first_name} {message.from_user.last_name}"
    reply = f"Hello <b>{full_name}</b> 🖐, Welcome to " \
            f"<a href='https://www.youtube.com/c/infomiruz'>infomiruz NFT Market</a> !!!"
    if message.text == "/start":
        reply += "\n<pre>✅You can buy only the most profitable NFT tokens from us.👇</pre>"
    await message.answer(reply, reply_markup=main_i_menu)


@dp.message_handler(commands=["testpay"])
async def info(message: types.Message):
    print(message)
    await bot.send_invoice(
        message.chat.id,
        title="NFT MARKET TEST ORDER",
        description="order checkout from web app",
        provider_token="284685063:TEST:YjJmZTU0OWQ0YTE3",
        currency="USD",
        photo_url="http://d2vrvpw63099lz.cloudfront.net/checkout-elements/checkout-boy.jpg",
        photo_width=735,
        photo_height=490,
        is_flexible=True,
        max_tip_amount=10000*100,
        prices=[
            types.LabeledPrice(label="Product 1", amount=250*100),
            types.LabeledPrice(label="Product 2", amount=150*100)
        ],
        payload="testpay=1445",
        need_name=True,
        need_email=True,
        need_phone_number=True,
        need_shipping_address=True,
        reply_markup=types.InlineKeyboardMarkup(
            inline_keyboard=[
                [
                    types.InlineKeyboardButton(text="Pay for order", pay=True)
                ],
                [
                    types.InlineKeyboardButton(
                        text="⭕️ Cancel pay", callback_data="pay||cancel")
                ],
                [
                    types.InlineKeyboardButton(text="♻️ Back to NFT Market", web_app=types.WebAppInfo(
                        url="https://mproweb.uz/YTless/NFT_market/web/"))
                ]
            ])
    )


@dp.shipping_query_handler(lambda query: True)
async def shipping(shipping_query: types.ShippingQuery):
    print(shipping_query)
    if shipping_query.shipping_address.country_code in ["UZ", "CA", "US"]:
        await bot.answer_shipping_query(shipping_query.id, ok=True, shipping_options=shipping_options)
    else:
        error_message = "Oh, we're so sorry that we can't ship to your country. !"
        await bot.answer_shipping_query(shipping_query.id, ok=False, error_message=error_message)


@dp.pre_checkout_query_handler(lambda query: True)
async def checkout(pre_checkout_query: types.PreCheckoutQuery):
    print(pre_checkout_query)
    await bot.answer_pre_checkout_query(pre_checkout_query.id, ok=True)
    # await bot.answer_pre_checkout_query(pre_checkout_query.id, ok=False, error_message="Pay to cancelled !")


@dp.message_handler(content_types=ContentTypes.SUCCESSFUL_PAYMENT)
async def success_payment(message: types.Message):
    print(message)
    print("bor")
    # await bot.send_message(chat_id=message.chat.id, text="Thank you for order !")
    await bot.send_photo(chat_id=message.chat.id, photo="https://www.nttdatapay.com/images/Best-Success-Rates.png",caption="Thank you for order !")


if __name__ == "__main__":
    executor.start_polling(dispatcher=dp, skip_updates=True)
