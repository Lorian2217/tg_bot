import asyncio
import json
import logging
import os
from aiogram import Bot, Dispatcher, F, types
from aiogram.filters import CommandStart
from aiogram.types import InlineKeyboardMarkup, InlineKeyboardButton, WebAppInfo
from dotenv import load_dotenv

logging.basicConfig(level=logging.INFO)
load_dotenv()

BOT_TOKEN = os.getenv("TOKEN")
if not BOT_TOKEN:
    raise RuntimeError("TOKEN не найден! Проверьте файл .env")

bot = Bot(BOT_TOKEN)
dp = Dispatcher()


@dp.message(CommandStart())
async def start(message: types.Message):
    """
    Отправка кнопки для открытия Mini App
    """
    web_app_url = "https://tg-bot-lorian2217.amvera.io/miniapp/index.html"

    inline_kb = InlineKeyboardMarkup(
        inline_keyboard=[
            [InlineKeyboardButton(text="Открыть Mini App", web_app=WebAppInfo(url=web_app_url))]
        ]
    )

    await message.answer(
        "Привет! Нажми кнопку, чтобы открыть Mini App 👇",
        reply_markup=inline_kb
    )


@dp.message(F.web_app_data)
async def parse_webapp_data(message: types.Message):
    """
    Получаем данные от Mini App
    """
    try:
        data = json.loads(message.web_app_data.data)
    except json.JSONDecodeError:
        await message.answer("❌ Ошибка при разборе данных из Mini App.")
        return

    await message.answer(
        f"📦 <b>Данные из Mini App:</b>\n<pre>{json.dumps(data, indent=2, ensure_ascii=False)}</pre>",
        parse_mode="HTML"
    )


async def main():
    await bot.delete_webhook(drop_pending_updates=True)
    await dp.start_polling(bot)


if __name__ == "__main__":
    asyncio.run(main())
