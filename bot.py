import asyncio
import logging
import json
import os

from aiogram import Bot, Dispatcher, types, F
from aiogram.utils.keyboard import ReplyKeyboardBuilder
from aiogram.enums.content_type import ContentType
from aiogram.filters import CommandStart
from aiogram.enums.parse_mode import ParseMode
from aiogram.types import InlineKeyboardButton, InlineKeyboardMarkup, WebAppInfo


logging.basicConfig(level=logging.INFO)

bot = Bot(os.getenv("TOKEN"))
dp = Dispatcher()

@dp.message(CommandStart())
async def start(message: types.Message):
    webAppInfo = types.WebAppInfo(url="https://tg-bot-lorian2217.amvera.io/")


    kb = InlineKeyboardMarkup(inline_keyboard=[ [ InlineKeyboardButton( text="Открыть WebApp", web_app=WebAppInfo( url="https://tg-bot-lorian2217.amvera.io/" ) ) ] ])
    await message.answer("Привет!", reply_markup=kb)
    

    builder = ReplyKeyboardBuilder()
    builder.add(types.KeyboardButton(text='Отправить данные', web_app=webAppInfo))

    builder.adjust(1)
    
    await message.answer(text='Привет!', reply_markup=builder.as_markup())

@dp.message(F.content_type == ContentType.WEB_APP_DATA)
async def parse_data(message: types.Message):
    data = json.loads(message.web_app_data.data)
    await message.answer(f'<b>{data["title"]}</b>\n\n<code>{data["desc"]}</code>\n\n{data["text"]}', parse_mode=ParseMode.HTML)

async def main():
    await bot.delete_webhook(drop_pending_updates=True)
    await dp.start_polling(bot)
    
if __name__ == "__main__":
    asyncio.run(main())