from aiogram import Bot, Dispatcher, executor, types
import logging
from main import chat_anwser

logging.basicConfig(level=logging.INFO)

TOKEN = "5345101033:AAFPKk22BxDWCnUikgL11CXrB8dzyi2acI4"

bot = Bot(token=TOKEN)
dp = Dispatcher(bot)

@dp.message_handler(commands=["start", "info"])
async def hello(message: types.Message):
    await message.answer("Bot ishlamoqda !")\


@dp.message_handler()
async def hello(message: types.Message):
    answer = chat_anwser(message.text)
    print(answer)
    await message.answer(answer)


if __name__ == "__main__":
    executor.start_polling(dispatcher=dp, skip_updates=True)

