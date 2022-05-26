from datetime import datetime

from aiogram import Bot, Dispatcher, executor, types
import logging

logging.basicConfig(level=logging.INFO)

TOKEN = "5314942065:AAHOQV9K5KpVpvK4em1vEJVauaWjwh6WlWM"
OPERATOR = 679143250
bot = Bot(token=TOKEN, parse_mode=types.ParseMode.HTML)
dp = Dispatcher(bot)


@dp.message_handler(commands=["start"])
async def hello(message: types.Message):
    # print(message)
    if message.chat.id == OPERATOR:
        await message.answer("Bot ishlamoqda !\n Python aiogramdan salom !")
    else:
        full_name = f"{message.from_user.first_name} {message.from_user.last_name}"
        reply = f"PHP 😎 Assalom alaykum <b>{full_name}</b>, " \
                f"<a href='https://www.youtube.com/c/infomiruz'>infomiruz chatboti</a>ga hush kelibsiz !!!\nMurojat Yo'llashingiz Mumkin"
        from_id = message.from_user.id
        await message.answer(reply)
        reply = f"Yangi mijoz:\n{full_name}\n👉 👉 <a href='tg://user?id={from_id}'>{from_id}</a>\n{datetime.now()}"
        await bot.send_message(OPERATOR, reply)
        await bot.forward_message(OPERATOR, from_id, message.message_id)


@dp.message_handler()
async def hello(message: types.Message):
    # print(message)
    if message.chat.id == OPERATOR:
        if message.reply_to_message:
            await bot.send_message(message.reply_to_message.forward_from.id, message.text)
    else:
        await bot.forward_message(OPERATOR, message.chat.id, message.message_id)


if __name__ == "__main__":
    executor.start_polling(dispatcher=dp, skip_updates=True)
