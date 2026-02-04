import requests
from flask import Flask, request, jsonify

app = Flask(__name__)

TELEGRAM_API_URL = "https://api.telegram.org/bot8525154496:AAEAhLBWNSFSbuMlY00OyLw9EUUjNgGorak/sendMessage"

@app.route('/webhook', methods=['POST'])
def webhook():
    data = request.json

    if "callback_query" in data:
        callback_data = data['callback_query']['data']
        chat_id = data['callback_query']['message']['chat']['id']
        message = f"Вы выбрали: {callback_data}"

        payload = {
            'chat_id': chat_id,
            'text': message
        }

        response = requests.post(TELEGRAM_API_URL, data=payload)
        return jsonify(response.json()), 200
    return '', 200

if __name__ == '__main__':
    app.run(port=5000)
