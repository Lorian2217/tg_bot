from aiogram import Bot, Dispatcher, types
from aiogram.utils import executor

TOKEN = "8525154496:AAEAhLBWNSFSbuMlY00OyLw9EUUjNgGorak"
bot = Bot(TOKEN)
dp = Dispatcher(bot)

@dp.message_handler(commands=['start'])
async def start_cmd(message: types.Message):
    await message.answer(
        "Открой мини-приложение:",
        reply_markup=types.InlineKeyboardMarkup(
            inline_keyboard=[
                [types.InlineKeyboardButton(
                    text="Открыть Mini App",
                    web_app=types.WebAppInfo(url="https://yourapp.ampera.app")
                )]
            ]
        )
    )

@dp.message_handler(content_types=types.ContentTypes.WEB_APP_DATA)
async def handle_webapp_data(message: types.Message):
    data = message.web_app_data.data
    await message.answer(f"Бот получил: {data}")

if __name__ == "__main__":
    executor.start_polling(dp, skip_updates=True)
