import asyncio
import json
import logging
import os

from aiogram import Bot, Dispatcher, F, types
from aiogram.filters import CommandStart
from aiogram.types import (
    InlineKeyboardMarkup,
    InlineKeyboardButton,
    ReplyKeyboardMarkup,
    KeyboardButton,
    WebAppInfo,
)

logging.basicConfig(level=logging.INFO)

load_dotenv()

# BOT_TOKEN = os.getenv("TOKEN")
BOT_TOKEN = "8525154496:AAEAhLBWNSFSbuMlY00OyLw9EUUjNgGorak"

if not BOT_TOKEN:
    raise RuntimeError("TOKEN не найден")

bot = Bot(BOT_TOKEN)
dp = Dispatcher()


@dp.message(CommandStart())
async def start(message: types.Message):
    web_app_url = "https://tg-bot-lorian2217.amvera.io/"

    # Inline-кнопка (рекомендуется)
    inline_kb = InlineKeyboardMarkup(
        inline_keyboard=[
            [
                InlineKeyboardButton(
                    text="Открыть Mini App",
                    web_app=WebAppInfo(url=web_app_url),
                )
            ]
        ]
    )

    await message.answer(
        "Привет! Открой Mini App 👇",
        reply_markup=inline_kb
    )

    # Reply-кнопка (тоже рабочая, но хуже UX)
    reply_kb = ReplyKeyboardMarkup(
        keyboard=[
            [
                KeyboardButton(
                    text="Открыть Mini App",
                    web_app=WebAppInfo(url=web_app_url),
                )
            ]
        ],
        resize_keyboard=True
    )

    await message.answer(
        "Или через обычную кнопку:",
        reply_markup=reply_kb
    )


@dp.message(F.web_app_data)
async def parse_webapp_data(message: types.Message):
    """
    Ловим данные, отправленные из Mini App
    Telegram.WebApp.sendData(...)
    """
    try:
        data = json.loads(message.web_app_data.data)
    except json.JSONDecodeError:
        await message.answer("❌ Ошибка данных")
        return

    await message.answer(
        f"📦 <b>Данные из Mini App</b>\n\n"
        f"<pre>{json.dumps(data, indent=2, ensure_ascii=False)}</pre>",
        parse_mode="HTML"
    )


async def main():
    await bot.delete_webhook(drop_pending_updates=True)
    await dp.start_polling(bot)


if __name__ == "__main__":
    asyncio.run(main())
