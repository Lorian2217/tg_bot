from flask import Flask, render_template

app = Flask(__name__)

@app.route("/")
def index():
    return render_template("index.html")

if __name__ == "__main__":
    # host 0.0.0.0 и port 80 обязательны для Ampera
    app.run(host="0.0.0.0", port=80)