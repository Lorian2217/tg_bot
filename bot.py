import asyncio
import json
import logging

from aiogram import Bot, Dispatcher, F, types
from aiogram.filters import CommandStart
from aiogram.types import InlineKeyboardMarkup, InlineKeyboardButton, WebAppInfo
from dotenv import load_dotenv
import os

logging.basicConfig(level=logging.INFO)
load_dotenv()

BOT_TOKEN = os.getenv("TOKEN")  # пытаемся взять токен из переменных окружения
if not BOT_TOKEN:
    # Если токен не найден, сразу аварийно выходим с понятным сообщением
    raise RuntimeError(
        "❌ TOKEN не найден! Добавьте токен вашего бота в переменные окружения."
    )

bot = Bot(BOT_TOKEN)
dp = Dispatcher()


# -------------------------
# /start
# -------------------------
@dp.message(CommandStart())
async def start(message: types.Message):
    """
    Обработчик команды /start.
    Определяет, с какого клиента пользователь (ПК или мобильный),
    и показывает кнопку Mini App, которая точно работает.
    """
    web_app_url = "https://tg-bot-lorian2217.amvera.io/"

    # Простая инлайн-кнопка — работает везде
    inline_kb = InlineKeyboardMarkup(
        inline_keyboard=[
            [InlineKeyboardButton(text="Открыть Mini App", web_app=WebAppInfo(url=web_app_url))]
        ]
    )

    # Отправляем пользователю сообщение с кнопкой
    await message.answer(
        "Привет! Нажми кнопку, чтобы открыть Mini App 👇",
        reply_markup=inline_kb
    )


# -------------------------
# Обработка данных от Mini App
# -------------------------
@dp.message(F.web_app_data)
async def parse_webapp_data(message: types.Message):
    """
    Получаем JSON-данные, отправленные Mini App.
    """
    try:
        data = json.loads(message.web_app_data.data)
    except json.JSONDecodeError:
        await message.answer("❌ Ошибка при разборе данных из Mini App.")
        return

    await message.answer(
        f"📦 <b>Данные из Mini App:</b>\n\n"
        f"<pre>{json.dumps(data, indent=2, ensure_ascii=False)}</pre>",
        parse_mode="HTML"
    )


# -------------------------
# Главная функция
# -------------------------
async def main():
    await bot.delete_webhook(drop_pending_updates=True)
    await dp.start_polling(bot)


if __name__ == "__main__":
    asyncio.run(main())
