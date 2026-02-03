from aiogram import Bot, Dispatcher, types
from aiogram.types import InlineKeyboardButton, InlineKeyboardMarkup, WebAppInfo
from aiogram.utils import executor
import os

TOKEN = "8525154496:AAEAhLBWNSFSbuMlY00OyLw9EUUjNgGorak"  # <-- вставь токен бота
bot = Bot(TOKEN)
dp = Dispatcher(bot)

# Команда /start
@dp.message_handler(commands=['start'])
async def start_cmd(message: types.Message):
    # Кнопка для мини-приложения
    web_app_url = "https://tg-bot-lorian2217.amvera.io/"  # <-- ссылка на ваш Ampera app
    keyboard = InlineKeyboardMarkup(inline_keyboard=[
        [InlineKeyboardButton(text="Открыть Mini App", web_app=WebAppInfo(url=web_app_url))]
    ])
    await message.answer("Привет! Открой мини-приложение:", reply_markup=keyboard)

# Получение данных из мини-приложения
@dp.message_handler(content_types=types.ContentTypes.WEB_APP_DATA)
async def handle_webapp_data(message: types.Message):
    user_msg = message.web_app_data.data
    await message.answer(f"Бот получил ваше сообщение: {user_msg}\nСпасибо, что написали!")

if __name__ == "__main__":
    executor.start_polling(dp, skip_updates=True)
