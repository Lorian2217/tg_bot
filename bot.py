from aiogram import Bot, Dispatcher, types
from aiogram.types import WebAppInfo, InlineKeyboardButton, InlineKeyboardMarkup
from aiogram.utils import executor

TOKEN = "8525154496:AAEAhLBWNSFSbuMlY00OyLw9EUUjNgGorak"  # вставь свой токен
bot = Bot(token=TOKEN)
dp = Dispatcher(bot)

# Старт
@dp.message_handler(commands=['start'])
async def start_cmd(message: types.Message):
    # Кнопка для запуска веб-приложения
    keyboard = InlineKeyboardMarkup()
    web_app_url = "https://yourdomain.com"  # адрес, где будет ваше HTML
    keyboard.add(InlineKeyboardButton(text="Открыть Mini App", web_app=WebAppInfo(url=web_app_url)))
    
    await message.answer("Привет! Открой мини-приложение:", reply_markup=keyboard)

# Обработка данных, которые присылает Web App через tg.sendData()
@dp.message_handler(content_types=types.ContentTypes.WEB_APP_DATA)
async def web_app_data(message: types.Message):
    data = message.web_app_data.data
    await message.answer(f"Я получил ваше сообщение: {data}")

if __name__ == "__main__":
    executor.start_polling(dp, skip_updates=True)
